<?php

namespace App\Http\Controllers;

use App\Models\Reciept;
use App\Models\RecieptType;
use App\Models\Service;
use App\Models\Vehicle;
use Barryvdh\DomPDF\PDF;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Models\ServiceComponent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $query_data = request()->query();

        $invoices = DB::table("invoices as I")
            ->join('vehicles as V', 'I.vehicle_id', '=', 'V.id')
            ->join('services as S', 'I.service_id', '=', 'S.id')
            ->join('users as U', 'I.created_by', '=', 'U.id')
            ->when(auth()->user()->role === 3, function($query) {
                return $query->join('owners as O','V.owner_id','=','O.id')
                ->where('O.owner_phone','=',auth()->user()->phone);
            })
            ->select('U.first_name','U.surname', 'I.*','S.service_name', 'V.plate_number')
            ->when(isset($query_data["status"]), function ($q) use($query_data){
                return $q->where('I.status', $query_data["status"]);
            })
            ->when(isset($query_data["fromDate"]), function ($q) use($query_data){
                return $q->whereDate('I.created_at', '>=', $query_data["fromDate"], 'and', '<=', $query_data["toDate"]);
            })
            ->when(isset($query_data["created_by"]), function ($q) use($query_data){
                return $q->where('I.created_by', $query_data["created_by"]);
            })
            ->get();

            $users = DB::table('users')->where('id', '>', 1)->where('role', 2)->select('id','first_name','surname')->get();

            return view('invoices', compact('invoices', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($vehicleId)
    {
        $query = DB::table('vehicles as V')->where('V.id', $vehicleId);

        if($query->exists()){

            $vehicle = $query->join('owners as O','O.id','=','V.owner_id')
                        ->select(['V.id', 'O.owner_fname', 'O.owner_surname','V.vehicle_type_id', 'V.chassis_number','O.owner_license_number', 'V.plate_number', 'V.engine_number', 'O.owner_email', 'O.owner_phone'])
                        ->first();

            $vehicle_types = VehicleType::all();

            $services = Service::with(['service_component'])
            ->get();

            return view("invoiceForm", compact(["vehicle", "vehicle_types","services"]));
        }

        return back()->with("error", "Error occured during request");



    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $vehicleId)
    {
        $request->validate([
            'owner_name' => "required|string|max:255",
            "owner_email" => "required|string|email|max:255",
            "owner_phone"=> "required|string|max:11",
            "engine_number"=> "sometimes|string",
            "license_number"=> "required|string",
            "plate_number" => "required|string",
            "chassis_number"=> "sometimes|string",
            "vehicle_type"=> "required|integer"
        ]);

        // dd(config('REVPRO_STAGING_URL '));
        $link = "https://staging.revenue.ng/api/v1/autoRegInvoice?token=455UI345GNTF95DFJC82BS0995BNF898FHFBHF21213HFHRH2HHD8FBNBDGFSWCVBDJ&userId=54";
        //    Use the plate_number and retrieve the vehicle
        $query = DB::table('vehicles as V')->where("chassis_number", $request->chassis_number);

        if($query->exists()){

            if($request->has("service") && is_array($request->input('service'))){

                if(count($request->input("service")) < 1){
                    // User did not select any service
                    return back()->with("error", "You have not selected any service.");
                }

               $vehicle =  $query->join('owners as O','O.id','=','V.owner_id')
                                    ->select('O.*','V.*')
                                    ->first();

                $invoiceQueryData = [];

                $payload_services = [];

                $services_comp = [];

                $selected_services = $request->service;

                foreach ($selected_services as $servId) {

                    $query = Service::where("id",  $servId);

                    if(!$query->exists()){
                        // Service Ids' tampered with.
                        return back()->with("error", "Error occured. Kindly try again");
                    }

                    $service = $query->select('service_name', 'description', 'item_code')->first();

                   if(!$request->has("service_{$servId}")){
                        return back()->with("error", "Service component not selected");
                   }

                   if(!is_array($request->input("service_{$servId}"))){
                        return back()->with("error", "Service component not selected");

                   }elseif(count($request->input("service_{$servId}")) == 0){
                        return back()->with("error", "Service component not selected");
                   }

                   $selected_components = $request->input("service_{$servId}");

                    $comp_amts = 0; //track total service amounts base on each component array;

                    foreach ($selected_components as $cmpId) {
                        $query = ServiceComponent::where("id", $cmpId)->where("service_id",  $servId);

                        if(!$query->exists()){
                            // Component Id's tampered with from the front-end
                            return back()->with("error", "Error occured, please try again");
                        }

                        $queryRes = $query->select('amount', 'title')->first();

                        $comp_amts += $queryRes->amount;
                        // prepare invoice breakdown records to be inserted

                        // Generate a mapping of service component to the different service Ids
                        // This is will latter help while inserting the different service components as invoice breakdown.
                        $services_comp["{$servId}"][] = ["service_id"=> $servId, "component_id"=> $cmpId];

                   }//end components foreach

                // Prepare invoice records to be inserted

                array_push($invoiceQueryData, [
                    "vehicle_id"=> $vehicle->id,
                    "amount"=> $comp_amts,
                    "service_id"=> $servId,
                    "service_name"=> $service->service_name,
                    "status"=> "unpaid",
                ]);

                // prepare payload's service data
                $serviceObj = (object) array(
                    "name"=> $service->service_name,
                    "amount"=> $comp_amts,
                    "description"=> $service->description,
                    "item_code"=> $service->item_code
                );

                array_push($payload_services, $serviceObj);

            }//end services foreach

            // Prepare the payload's data
            $payload = (object) array(
                "first_name" => $vehicle->owner_fname,
                "last_name" => $vehicle->owner_surname,
                "email" => $vehicle->owner_email,
                "phone" => $vehicle->owner_phone,
                "tin" => $vehicle->tin ?? "", // query here for more info
                "birs_id"=> $vehicle->iirs_id ?? "", // query here for more info
                "payment_type"=> "bank",
                "service" => $payload_services,
                "engine_number"=> $vehicle->engine_number ?? "",
                "chassis_number"=> $vehicle->chassis_number ?? "",
                "plate_number" => $vehicle->plate_number ?? "",
                "model" => $vehicle->model ?? "",
                "category"=> $vehicle->category,
                "type" => VehicleType::where("id", $request->vehicle_type)->value("title"), //query here for more info
                "policy_number" => $vehicle->policy_number ?? "",
                "engine_capacity"=> $vehicle->engine_capacity ?? "",
                "odometer" => $vehicle->odometer ?? "",
                "color"=> $vehicle->color ?? "",
                "fuel_type" => $vehicle->fuel_type ?? "",
                "year_of_manufacture" => $vehicle->year_of_manufacture,
                "title"=> $vehicle->title,
                "address" => $vehicle->address,
                "owner_identification"=> $vehicle->owner_identification,
                "identification_no" => $vehicle->identification_no,
                "owner_license_number" => $vehicle->owner_license_number,
                "state" => $vehicle->state,
                "lga" => $vehicle->lga,

            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $link,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    "accept: application/json",
                    "cache-control: no-cache"
                ],
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => json_encode($payload),
            ));

            $response = curl_exec($curl);

            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                // there was an error while interacting with Reprov's  API
                return back()->with("error", "Error occured while initiating request. Please try again later. Check your internet connection.");
            }

            $response = json_decode($response);

            if($response->status !== "success" || empty($response->invoice_no)){
                return back()->with("error", "Error occured while initiating request. Please try again later");
            }

            // continue the process. Invoice generated on Repro's end
             // Store invoice and invoice breakdown
            foreach ($invoiceQueryData as $key => $data) {

                $data["trans_ref"] = $response->data[$key]->trans_reference;

                $data["created_at"] = now();

                $data["invoice_nos"] = $response->invoice_no;

                // Retrieve service's breakdownn using the different service Ids
                $invoice_breakdown = $services_comp["{$data["service_id"]}"];

                $data["created_by"] = auth()->user()->id;

                // Store Items to be rendered on preview page

                // $invoice_preview[] = ["service"=> $data["service_name"]];

                // Service name not relevant while inserting invoice
                unset($data["service_name"]);

                // Store Invoice
                $id = DB::table('invoices')->insertGetId($data);

                // Retrieve and format invoice breakdown
                $invoice_breakdown = array_map(function($breakdown) use ($id) {
                    $breakdown["invoice_id"] = $id;
                    $breakdown["created_at"] = now();
                    return $breakdown;
                }, $invoice_breakdown);

                // $invoice_preview[$key]["invoice_id"] = $id; //Track invoice Id also. Will be used in the invoice preview page
                //  Finally, store invoice breakdown
                DB::table('invoices_breakdown')->insert($invoice_breakdown);

            }

            // Flash invoice preview data into sesssion
            // $request->session()->flash('preview_invoices', $invoice_preview);

            $request->session()->flash('preview_invoice', $response->invoice_no);

            // Operation is successful, Redirect to invoice preview page to render generated invoices.
            return redirect()->route('invoices.preview');

        }
            return back()->with("error", "You have not selected any service.");
        }

        return back()->with("error", "Error occured, Please try again.");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInvoice()
    {
        //Only used data for testing purpose
        // When designing/modiying the invoice

        // Dummy data
        $invoice_metadata = (object) array(
            "invoice_nos" => "INVR61842C78BBBD2920",
            "owner_fname" =>"Jenkins",
            "owner_surname" =>"Jemmy",
            "owner_email" =>"jenkinsme@email.com",
            "owner_phone"=> "08899456783",
            "engine_number" => "123456rty",
            "owner_license_number" => "12346YRU",
            "chassis_number" => "4567tyui",
            "first_name" => "System",
            "surname" => "SuperAdmin",
            "plate_number" => "1234567tythtg",
            "created_at" => "2012-12-2013",
            "status"=> "unpaid",
            "total_amount"=> "30000" //remove this latter
        );


        $invoices = [
            (object) array(
                "status"=> "unpaid",
                "id"=> 1,
                "amount"=> "1050",
                "trans_ref"=>"MNTAR0059LY911XKGW9T33",
                "service_name" => "Vehicle Renewal"
            ),
            (object) array(
                "status"=> "unpaid",
                "id"=> 2,
                "amount"=> "1100",
                "trans_ref"=>"MNTAR0059LY911XKGW9T33",
                "service_name" => "Mobile Plate"
            ),
        ];

        $invoice_details = [
            (object) array (
                "amount"=> 450,
                "title"=> "SMS Alert",
                "invoice_id"=> 1,
            ),
            (object) array(
                "amount"=> 200,
                "title" => "Check Fee",
                "invoice_id"=> 1,
            ),
            (object) array(
                "amount"=> 200,
                "title" => "Classic Newman",
                "invoice_id"=> 1,
            ),
            (object) array(
                "amount"=> 200,
                "title" => "Entropy Version",
                "invoice_id"=> 1,
            ),

            (object) array(
                "amount"=> 200,
                "title" => "SMS Alert",
                "invoice_id"=> 2,
            ),
            (object) array(
                "amount"=> 500,
                "title" => "Vehicle Badge",
                "invoice_id"=> 2,
            ),
            (object) array(
                "amount"=> 200,
                "title" => "Driver's Badge",
                "invoice_id"=> 2,
            ),
            (object) array(
                "amount"=> 200,
                "title" => "Conductor's Badge",
                "invoice_id"=> 2,
            ),
        ];

        // dd($invoice_breakdown[0]->title);

        return view("pdf.invoice", compact('invoices','invoice_metadata','invoice_details'));
    }

     /**
     * Download Invoices
     */
    public function download(Request $request){

        $request->validate(
            ["invoice" => "required|string"]
        );

        $query = DB::table('invoices as I')->where('I.invoice_nos', $request->invoice);

        if($query->exists()){
            $invoice_metadata = $query->join('vehicles as V', 'V.id','=','I.vehicle_id')
            ->join('users as U','U.id', '=','I.created_by')
            ->join('owners as O', 'O.id','=','V.owner_id')
            ->select('O.owner_fname','O.owner_surname','O.owner_email','O.owner_phone','V.engine_number','O.owner_license_number','V.plate_number','I.created_at', 'V.chassis_number','U.first_name','U.surname','I.invoice_nos')
            ->first();

            // Calculate total amount
            $invoice_metadata-> total_amount = DB::table('invoices as I')->where('I.invoice_nos', $request->invoice)->sum('amount');

            $invoices = DB::table('invoices as I')->where('I.invoice_nos', $request->invoice)
            ->join('services as S', 'S.id','=','I.service_id')
            ->select('I.*','S.service_name')
            ->get();
            //Get invoice Breakdown
            $invoice_details = DB::table('invoices_breakdown as IB')
                ->join('invoices as I', 'I.id','=','IB.invoice_id')
                ->join('service_components as S', 'S.id','=','IB.component_id')
                ->where('I.invoice_nos', $request->invoice)
                ->select('IB.invoice_id','S.amount','S.title')
                ->get();

                $pdf = App::make('dompdf.wrapper');

                $pdf->loadView('pdf.invoice', compact('invoice_metadata','invoices','invoice_details'));
                // $pdf->loadView('pdf.invoice');

                // $filename = $invoice->status === "unpaid" ? "invoice.pdf": "receipt.pdf";
                $filename =  "invoice{$request->invoice}.pdf";

                return $pdf->download("{$filename}");
        }
        // return back()->with('error', 'Sorry, an error occured. Please try again latter');
        return redirect()->route('invoices.all');

    }

    /**
     * Display Generated invoices
     *
     * */
    public function preview(){
    //   Check whether  the required parameters are persisted in session
        if(!session("preview_invoice")){
            return back()->with("error", "No invoice is selected. Kindly select an invoice from the invoice page");
      }

      $invoice = session("preview_invoice");

      return view('invoicePreview', compact('invoice'));
    }

    /***
     * Process and render Invoice Breakdown
     *
     */
    public function invoice_breakdown($invoice_id){

        $components = DB::table("invoices_breakdown as IB")
            ->join('service_components as C', 'C.id', '=', 'IB.component_id')
            ->where('IB.invoice_id', $invoice_id)
            ->select('C.title','C.amount')
            ->get();

        $invoice = DB::table('invoices')->where('id', $invoice_id)->select('amount as total', 'trans_ref','invoice_nos')->first();


        return view("invoiceBreakdown", compact('components', 'invoice'));
    }

    public function invoice_update (Request $request){

        $ref = $request->trans_reference;

        $status = $request->status;

        if($request->has('trans_reference') && $request->has('status') && strtolower($status) === "paid"){
            // Check whether transf reerence exist and update the update at date
            $query = DB::table('invoices')->where('trans_ref',   $ref)->whereNull('updated_at');
            if($query->exists()){
                // Update the invoice status
               $query->update(["updated_at" => now(), "status"=> "paid"]);

                $invoice =  DB::table('invoices')->where('trans_ref', $ref)->select('vehicle_id','updated_at','service_id','id')->first();
                // Update last renewal date
                $vehQuery = DB::table('vehicles')->where('id', $invoice->vehicle_id)->update(['last_renewal_date'=> $invoice->updated_at]);

                $reciept_types = RecieptType::where('service_id',$invoice->service_id)->get();
                foreach($reciept_types as $reciept_type){
                    if(Reciept::where('invoice_id',$invoice->id)->first() == null){
                        $reciept = Reciept::create([
                            'reciept_type_id' => $reciept_type->id,
                            'expiry_date' => now()->addYears($reciept_type->valid_duration_years),
                            'invoice_id' => $invoice->id
                        ]);

                    }

                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Invoice updated succesfully',
                ], 200);
            }

            return  response()->json([
                'status'=> 'error',
                'message' => 'Invoice transaction reference not found',
            ], 404);

        }
        return  response()->json([
            'status'=> "error",
            'message' => 'No transaction reference and corresponding status',
        ], 500);

    }

    public function test_download(){
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('pdf.road-worthiness-certificate');
        // $pdf->loadView('pdf.invoice');

        // $filename = $invoice->status === "unpaid" ? "invoice.pdf": "receipt.pdf";
        $filename =  "insurance.pdf";

        return $pdf->download("{$filename}");
    }

    public function test_update(){
        return view('test-update');
    }
}
