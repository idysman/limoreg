<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $services = Service::all();
        
        return view("services", compact("services"));
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
                "service_name"=> 'required|max:255',
                "item_code"=> 'required|max:15',
                "description"=> 'sometimes'
        ]);

        Service::create($request->all());

        return back()->with("success", "Services added successfully");
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
    public function edit(Service $service)
    {
        return view("editService", compact("service"));

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
                "service_name"=> 'required|max:255',
                "item_code"=> 'required|max:15',
                "description"=> 'sometimes'
        ]);
        
        $service = [
            "service_name"=> $request->service_name, 
            "item_code"=> $request->item_code, 
            "description"=> $request->description ?? ""
        ];

        Service::where('id', $id)->update($service);

        return back()->with("success", "Services updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        
        return back()->with("success", "Services deleted successfully");
    }
}
