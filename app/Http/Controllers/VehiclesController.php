<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVehicleRequest;


class VehiclesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicles = Vehicle::get();
        return view('vehicles',['vehicles' => $vehicles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $vehicle_types = VehicleType::all();

        return view("addVehicle", compact("vehicle_types"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        //    validated input
        $vehicle = $request->except(['vehicle_type', '_token']);

        $vehicle["vehicle_type_id"] = $request->vehicle_type;

        $vehicle["created_by"] = auth()->user()->id;

        $vehicle = Vehicle::create($vehicle);

        return back()->with(['success'=>'Vehicle registered successfully. Click the button below to generate invoice for the vehicle', 'link'=> route('invoice.generate', $vehicle->id), 'link_text'=> 'Proceed to Invoice generation']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicle_data = Vehicle::where('id', $id)->first();

        return view('showVehicle',['vehicle' => $vehicle_data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($vehicle)
    {
        $vehicle_types = VehicleType::all();
        $vehicle_data = Vehicle::where('id',$vehicle)->first();

        return view('editVehicle', [
            'vehicle' => $vehicle_data,
            'vehicle_types' => $vehicle_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicleRequest $request, $id)
    {

        $vehicle_fields = array_intersect(array_keys($request->all()), app(Vehicle::class)->getFillable());
        $vehicle_data = $request->only($vehicle_fields);

        Vehicle::where('id',$id)->update($vehicle_data);

        return back()->with('success', 'Vehicle updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicle::where('id',$id)->delete();

        return back()->with('success', 'Vehicle deleted successfully');
    }

     /**
     * Verify Vehicle existence.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function verify_vehicle(Request $request)
    {
    //    You can remove this latter
        $request->validate([
            "plate_number" => "required|string|max:255",
            "license_number"=> "required|string|max:255"
        ]);
        //  Double check credentials existence again
        $query = Vehicle::where("plate_number", $request->plate_number)
                        ->where('owner_license_number', $request->license_number);
        if($query->exists()){
            // Navigate to invoice form
            $vehicleId = $query->value("id");
            return redirect()->route('invoice.generate',  $vehicleId);
        }

        return back()->with('error', 'Vehicle credentials does not exists in the system. Kindly register vehicle');
        
    }

}
