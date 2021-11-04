<?php

namespace App\Http\Controllers;

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
      
        $invoices = DB::table("invoices")
            ->join('vehicles', 'invoices.vehicle_id', '=', 'vehicles.id')
            ->join('services', 'invoices.service_id', '=', 'services.id')
            ->join('users', 'invoices.created_by', '=', 'users.id')
            ->select('users.first_name','users.surname', 'invoices.*','services.service_name', 'vehicles.plate_number')
            ->get();
        
            return view('invoices', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($vehicleId)
    {
        $query = Vehicle::where('id', $vehicleId);
        
        if($query->exists()){
            
            $vehicle = $query->select(['id', 'owner_fname', 'owner_surname','vehicle_type_id', 'chassis_number','owner_license_number', 'plate_number', 'engine_number', 'owner_email', 'owner_phone'])
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
        $query = Vehicle::where("plate_number", $request->plate_number);

        if($query->exists()){
           
            if($request->has("service") && count($request->input("service")) > 0){
                $vehicle = $query->first(); 
                
                $invoiceQueryData = [];  
                
                $payload_services = []; 
                
                $services_comp = [];
                 
                $invoice_preview = []; 

                $selected_services = $request->service;
                
                foreach ($selected_services as $servId) {
                    
                    $query = Service::where("id",  $servId);
                    
                    if(!$query->exists()){
                        // Service Ids' tampered with.
                        return back()->with("error". "Error occured. Kindly try again");
                    }
                    
                    $service = $query->select('service_name', 'description', 'item_code')->first();
                    
                   if(!$request->has("service_{$servId}") && count($request->input("service_{$servId}")) == 0){
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
                        $services_comp["{$servId}"][] = ["service_id"=> $servId, "component_id"=> $cmpId, "title"=>  $queryRes->title, "amount"=> $queryRes->amount];
                        
                   }//end components foreach

                // Prepare invoice records to be inserted
                   
                // Use this for testing (@Testing)
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

                $createdBy = auth()->user()->first_name ." ".auth()->user()->surname;

                // Retrieve service's breakdownn using the different service Ids
                $invoice_breakdown = $services_comp["{$data["service_id"]}"];

                // Generate invoice PDF
                $pdf = App::make('dompdf.wrapper');
            
                $pdf->loadView('pdf.invoice', ["vehicle"=>$vehicle, "invoice_breakdown"=> $invoice_breakdown, "invoice" => ["date_created"=> $data["created_at"], "trans_ref"=> $data["trans_ref"], "agent"=> $createdBy, "status"=> "Unpaid", "service"=> $data["service_name"], "total_amount"=>$response->data[$key]->amount, "invoice_nos"=> $data["invoice_nos"]]]);
              
                $content = $pdf->download()->getOriginalContent();

                $filename = uniqid().".pdf";

                // Upload file to invoice folder
                Storage::disk('local')->put("/invoices/{$filename}",  $content);

                $data["file"] = "invoices/{$filename}";

                $data["created_by"] = auth()->user()->id;

                // Store Items to be rendered on preview page
                $invoice_preview[] = ["service"=> $data["service_name"]];

                // Service name not relevant while inserting invoice
                unset($data["service_name"]);
                
                // Store Invoice
                $id = DB::table('invoices')->insertGetId($data);

                // Retrieve and format invoice breakdown
                $invoice_breakdown = array_map(function($breakdown) use ($id) {
                    $breakdown["invoice_id"] = $id;
                    $breakdown["created_at"] = now();
                    unset($breakdown["title"]);
                    unset($breakdown["amount"]);
                    return $breakdown;
                }, $invoice_breakdown);
                
                $invoice_preview[$key]["invoice_id"] = $id; //Track invoice Id also. Will be used in the invoice preview page
                //  Finally, store invoice breakdown
                DB::table('invoices_breakdown')->insert($invoice_breakdown);
               
            }

            // Flash invoice preview data into sesssion 
            $request->session()->flash('preview_invoices', $invoice_preview);
            
            // Operation is successful, Redirect to invoice preview page to render generated invoices.
            return redirect()->route('invoices.preview');
        
        }
            return back()->with("error". "You have not selected any service.");
        }

        return back()->with("error". "Error occured, Please try again.");
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showInvoice()
    {
        //Only used for testing purpose
        return view("pdf.invoice");
    }

     /**
     * Download Invoices
     */
    public function download(Request $request){

        $request->validate(
            ["invoice" => "required|integer"]
        );

        $query = DB::table('invoices')->where('id', $request->invoice);

        if( $query->exists()){
            $file = $query->value("file");
            
            return Storage::download($file);
        }
        return back()->with('error', 'Sorry, an error occured. Please try again latter');

    }

    /**
     * Display Generated invoices
     *  
     * */   
    public function preview(){
    //   Check whether  the required parameters are persisted in session
        if(!session("preview_invoices")){
            return back()->with("error", "No invoice is selected. Kindly select an invoice from the invoice page");
      }
   
      $invoices = session("preview_invoices");
      
      return view('invoicePreview', compact('invoices'));
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
}
