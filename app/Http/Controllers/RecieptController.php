<?php

namespace App\Http\Controllers;

use App\Models\Reciept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class RecieptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query_data = request()->query();

        $reciepts = DB::table('reciepts')->orderBy('id','desc')
                    ->join('reciept_types','reciepts.reciept_type_id','=','reciept_types.id')
                    ->join('invoices','reciepts.invoice_id','=','invoices.id')
                    ->join('vehicles','invoices.vehicle_id','=','vehicles.id')
                    ->join('owners','vehicles.owner_id','=','owners.id')
                    ->when(auth()->user()->role === 3, function($query) {
                        return $query->join('owners as O','V.owner_id','=','O.id')
                        ->where('O.owner_phone','=',auth()->user()->phone);
                    })
                    ->select('reciept_types.name as name', 'owners.owner_fname as owner_name',
                            'reciepts.expiry_date as expiry_date','reciepts.created_at as issue_date',
                            'reciepts.reciept_number as reciept_number','reciepts.id as id','invoices.amount as amount')
                    ->when(isset($query_data["fromDate"]), function ($q) use($query_data){
                        return $q->whereDate('I.created_at', '>=', $query_data["fromDate"], 'and', '<=', $query_data["toDate"]);
                    })
                    ->when(isset($query_data["created_by"]), function ($q) use($query_data){
                        return $q->where('I.created_by', $query_data["created_by"]);
                    })
                    ->get();

                    $users = DB::table('users')->where('id', '>', 1)->where('role', 2)->select('id','first_name','surname')->get();

                    return view('allReciepts',['reciepts' => $reciepts, 'users' => $users]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reciept = DB::table('reciepts')
        ->join('reciept_types','reciepts.reciept_type_id','=','reciept_types.id')
        ->join('invoices','reciepts.invoice_id','=','invoices.id')
        ->join('vehicles','invoices.vehicle_id','=','vehicles.id')
        ->join('owners','vehicles.owner_id','=','owners.id')
        ->where('reciepts.id',$id)
        ->select('reciept_types.name as name', 'owners.owner_fname as owner_name',
                'reciepts.expiry_date as expiry_date','reciepts.created_at as issue_date',
                'reciepts.reciept_number as reciept_number','reciepts.id as id',
                'vehicles.chassis_number as chassis_number','vehicles.engine_number as engine_number',
                'invoices.amount as amount','owners.address as address','vehicles.model as model',
                'owners.state as state')
        ->first();
        $view_file = Reciept::where('id',$id)->reciept_type->view_file_name;

        $view_file = 'pdf.'."{$view_file}";

        return view($view_file,['reciepts' => $reciept]);
        // return view('pdf.license-reciept',['reciept' => $reciept]);
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

    public function download($id){
        $reciept = DB::table('reciepts')
        ->join('reciept_types','reciepts.reciept_type_id','=','reciept_types.id')
        ->join('invoices','reciepts.invoice_id','=','invoices.id')
        ->join('vehicles','invoices.vehicle_id','=','vehicles.id')
        ->join('owners','vehicles.owner_id','=','owners.id')
        ->where('reciepts.id',$id)
        ->select('reciept_types.name as name', 'owners.owner_fname as owner_name',
                'reciepts.expiry_date as expiry_date','reciepts.created_at as issue_date',
                'reciepts.reciept_number as reciept_number','reciepts.id as id',
                'vehicles.chassis_number as chassis_number','vehicles.engine_number as engine_number',
                'invoices.amount as amount','owners.address as address','vehicles.model as model',
                'owners.state as state')
        ->first();
        $view_file = Reciept::where('id',$id)->first()->reciept_type->view_file_name;

        $view_file = 'pdf.'.$view_file;

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView("{$view_file}",compact('reciept'));

        $filename =  $view_file.'.pdf';
        return $pdf->download("{$filename}");
    }


        /**
         * @param array $nums
         * @param array $target
         * @return array
         */
        public function leetcode() {
            $nums = [0,3,-3,4,-1];
            $target = -1;
            $sum = 0.1;
            $length = sizeof($nums);
            for($i = 0; $i<($length - 1);$i++){
                for($j=0; $j<$length;$j++){
                    if($i !== $j){
                        $sum = $nums[$i] + $nums[$j];
                    }

                if($sum == $target){
                    $array = array($i,$j);
                    return $array;
                }

                }

            }
        }

}
