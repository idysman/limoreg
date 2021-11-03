<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\File;
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
        //
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
                "tin" => "2343253534", // query here for more info
                "birs_id"=> "3423424", // query here for more info
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

                // Retrieve service's breakdownn using the different service Ids
                $invoice_breakdown = $services_comp["{$data["service_id"]}"];

                // Generate invoice PDF
                $pdf = App::make('dompdf.wrapper');
            
                $pdf->loadView('pdf.invoice', ["vehicle"=>$vehicle, "invoice_breakdown"=> $invoice_breakdown, "invoice" => ["date_created"=> $data["created_at"], "trans_ref"=> $data["trans_ref"], "agent"=> "Ada Jacobs", "status"=> "Unpaid", "service"=> $response->data[$key]->name, "total_amount"=>$response->data[$key]->amount]]);
              
                $content = $pdf->download()->getOriginalContent();

                $filename = uniqid().".pdf";

                // Upload file to invoice folder
                Storage::disk('local')->put("/invoices/{$filename}",  $content);

                $data["file"] = Storage::url("invoices/{$filename}");

                $data["created_by"] = auth()->user()->id;
                
                // Store Invoice
                $id = DB::table('invoices')->insertGetId($data);

                // Retrieve and format invoice breakdown
                $invoice_breakdown = array_map(function($data) use ($id) {
                    $data["invoice_id"] = $id;
                    unset($data["title"]);
                    unset($data["amount"]);
                    return $data;
                }, $invoice_breakdown);

                //  Finally, store invoice breakdown
                DB::table('invoices_breakdown')->insert($invoice_breakdown);
               
            }

            // Do something here
            return back()->with("success", "Vehicle renewal initiated successfully");
        
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
        //
        return view("pdf.invoice");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
