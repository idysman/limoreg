<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // $vehicles = Vehicle::get();
        $user_phone = auth()->user()->phone;
        $vehicles = DB::table('vehicles as V')
                        ->join('owners as O', 'O.id','=','V.owner_id')
                        ->when(auth()->user()->role === 3, function($query){
                            return $query->where('O.owner_phone','=',auth()->user()->phone);
                        })
                        ->select('V.id','O.owner_fname','O.owner_surname','O.owner_phone','O.owner_email','V.chassis_number','V.model')

                        ->get();
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
        // $vehicle = $request->except(['vehicle_type', '_token']);



        $owner_fields = array_intersect(array_keys($request->all()), app(Owner::class)->getFillable());
        $owner_data = $request->only($owner_fields);
        $owner = Owner::create($owner_data);

        $vehicle_fields = array_intersect(array_keys($request->all()), app(Vehicle::class)->getFillable());
        $vehicle_data = $request->only($vehicle_fields);
        $vehicle_data["vehicle_type_id"] = $request->vehicle_type;

        $vehicle_data["created_by"] = auth()->user()->id;
        $vehicle_data["owner_id"] = $owner->id;




       $vehicle =  Vehicle::create($vehicle_data);

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
        $owner_data = Owner::where('id',$vehicle_data->owner_id)->first();

        return view('showVehicle',['vehicle' => $vehicle_data, 'owner' => $owner_data]);
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
        $owner_data = Owner::where('id',$vehicle_data->owner_id)->first();


        return view('editVehicle', [
            'vehicle' => $vehicle_data,
            'vehicle_types' => $vehicle_types,
            'owner' => $owner_data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVehicleRequest $request, $vehicle_id)
    {

        // $vehicle_fields = array_intersect(array_keys($request->all()), app(Vehicle::class)->getFillable());
        // $vehicle_data = $request->only($vehicle_fields);

        // Vehicle::where('id',$id)->update($vehicle_data);
        $vehicle_fields = array_intersect(array_keys($request->all()), app(Vehicle::class)->getFillable());
        $vehicle_data = $request->only($vehicle_fields);

        Vehicle::where('id',$vehicle_id)->update($vehicle_data);

        $owner_id = Vehicle::where('id',$vehicle_id)->first()->owner_id;

        $owner_fields = array_intersect(array_keys($request->all()), app(Owner::class)->getFillable());
        $owner_data = $request->only($owner_fields);
        Owner::where('id',$owner_id)->update($owner_data);

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
