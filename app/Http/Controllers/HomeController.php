<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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


        $total_invoices = DB::table('invoices')
        ->select('id', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });


//
        $mcount = [];

        foreach ($total_invoices as $key => $value) {
            $mcount[(int)$key] = count($value);
        }


        for ($i = 1; $i <= 12; $i++) {
            if (!empty($mcount[$i])) {
                $total_invoice_data[$i-1] = $mcount[$i];
            } else {
                $total_invoice_data[$i-1] = 0;
            }


        }


        $your_invoices = DB::table('invoices')
        ->where('created_by',$userId)
        ->select('id', 'created_at')
        ->get()
        ->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('m');
        });

        $mcount = [];

        foreach ($your_invoices as $key => $value) {
            $mcount[(int)$key] = count($value);
        }

        for ($i = 1; $i <= 12; $i++) {
            if (!empty($mcount[$i])) {
                $your_invoice_data[$i-1] = $mcount[$i];
            } else {
                $your_invoice_data[$i-1] = 0;
            }
        }


        $vehicles = DB::table('vehicles')->count();

        $userRegistrations = DB::table('vehicles')->where('created_by', $userId)->count();

        $invoices = DB::table('invoices')->count();

        $userInvoices = DB::table('invoices')->where('created_by', $userId)->count();

        if($role === 1){
            $services = DB::table('services')->count();
            $users = DB::table('users')->count();
            $vehicles_types = DB::table('vehicle_types')->count();

            return view('home', ["vehicles"=>  $vehicles, 'yourReg'=> $userRegistrations, "yourInvoice"=> $userInvoices, "invoices"=> $invoices, "services"=> $services, "vehicle_types"=> $vehicles_types, "users"=> $users, "total_invoices" => $total_invoice_data, "your_invoices" => $your_invoice_data ]);
        }

        return view('home', ["vehicles"=>  $vehicles, 'yourReg'=> $userRegistrations, "yourInvoice"=> $userInvoices, "invoices"=> $invoices,
                                "total_invoices" => $total_invoice_data, "your_invoices" => $your_invoice_data]);

    }
}
