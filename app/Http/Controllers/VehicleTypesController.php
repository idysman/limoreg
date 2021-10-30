<?php

namespace App\Http\Controllers;

use App\Models\vehicleType;
use Illuminate\Http\Request;

class VehicleTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $vehicleTypes = vehicleType::all();
        return view("vehicleTypes", compact("vehicleTypes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Vehicle type
        $request->validate(
        [
            "title"=> 'required|max:255',
            "description"=> 'sometimes'
        ]);
        
        vehicleType::create($request->all());
      
      return back()->with('success', 'Vehicle type added successfully');

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
    public function edit(vehicleType $type)
    {
        return view('editVehicleType', compact("type"));
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
         //Vehicle type
         $request->validate(
            [
                "title"=> 'required|max:255',
                "description"=> 'sometimes'
            ]);

        $type = ["title"=>$request->title, "description"=> $request->description ?? ""];

        vehicleType::where('id', $id)->update($type);
        
        return back()->with("success", "Vehicle type updated sucessfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(vehicleType $type)
    {
        $type->delete();
        
        return back()->with("success", "Vehicle type deleted successfully");
    }
}
