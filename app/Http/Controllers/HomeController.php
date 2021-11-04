<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $role = auth()->user()->role;
        
        $vehicles = DB::table('vehicles')->count();

        $userRegistrations = DB::table('vehicles')->where('created_by', $userId)->count();

        $invoices = DB::table('invoices')->count();

        $userInvoices = DB::table('invoices')->where('created_by', $userId)->count();

        if($role === 1){
            $services = DB::table('services')->count();
            $users = DB::table('users')->count();
            $vehicles_types = DB::table('vehicle_types')->count();

            return view('home', ["vehicles"=>  $vehicles, 'yourReg'=> $userRegistrations, "yourInvoice"=> $userInvoices, "invoices"=> $invoices, "services"=> $services, "vehicle_types"=> $vehicles_types, "users"=> $users]);
        }

        return view('home', ["vehicles"=>  $vehicles, 'yourReg'=> $userRegistrations, "yourInvoice"=> $userInvoices, "invoices"=> $invoices]);
       
    }
}
