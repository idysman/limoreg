<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceComponent;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class ServicesComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Eager load resource with its relationship
        $components = ServiceComponent::with(["vehicle_type", "service"])->get();
        
        $vehicle_types = VehicleType::all();
        
        $services = Service::all();
        
        return view('serviceComponents', ["components"=> $components, "services"=> $services, "vehicle_types"=> $vehicle_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
        [
            "title"=> 'required|string|max:255',
            "vehicle_type"=>'required|integer',
            "service"=>'required|integer',
            "amount"=> 'required|integer'
        ]);
        
        $component = [
            "title" => $request->title,
            "vehicle_type_id"=> $request->vehicle_type,
            "service_id" => $request->service,
            "amount"=> $request->amount,
        ];

        ServiceComponent::create($component);

        return back()->with("success", "Service component added succesfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceComponent $component)
    
    {
        $vehicle_types = VehicleType::all();
        
        $services = Service::all();
        
        return view('editServiceComponents', ["component"=> $component, "services"=> $services, "vehicle_types"=> $vehicle_types]);
      
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
        $request->validate(
            [
                "title"=> 'required|string|max:255',
                "vehicle_type"=>'required|integer',
                "service"=>'required|integer',
                "amount"=> 'required|integer'
        ]);

        $component = [
            "title" => $request->title,
            "vehicle_type_id"=> $request->vehicle_type,
            "service_id" => $request->service,
            "amount"=> $request->amount,
        ];

        ServiceComponent::where("id", $id)->update($component);

        return back()->with("success", "Service component updated succesfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( ServiceComponent $component)
    {
        $component->delete();
        
        return back()->with('success', 'Service component deleted succesfully');
    }
}
