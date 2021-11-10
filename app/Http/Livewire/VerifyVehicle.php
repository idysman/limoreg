<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class VerifyVehicle extends Component

{
    public $plate_number;
    
    public $chassis_number;
    
    public $phone_number;

    public function updated($field){
        // Flash an error flag into the session
        // Handle component rendering o the front-end
        session()->flash('error', true);

        $this->validateOnly($field, [
            "chassis_number"=> "required|string|exists:vehicles,chassis_number",
            "phone_number" => "required|string|exists:owners,owner_phone",
            "plate_number"=> "required|string|exists:vehicles,plate_number"
        ]);

        // Validation sucessfully
        session()->forget('error');
    }
    
    public function verify_vehicle()
    {
        
        session()->flash('message', 'Vehicle credentials is invalid or does not exist in the system, Kindly register vehicle.');
        
        $this->validate([
            "chassis_number"=> "required|string|exists:vehicles,chassis_number",
            "phone_number" => "required|string|exists:owners,owner_phone",
            "plate_number"=> "required|string|exists:vehicles,plate_number"
        ]);
        //  Double check credentials existence again
        $query = DB::table('vehicles as V')->where("V.plate_number", $this->plate_number)
                ->join('owners as O', 'O.id','=','V.owner_id')
                ->where('O.owner_phone', $this->phone_number)
                ->where('V.chassis_number', $this->chassis_number);
        if($query->exists()){
            // Remove message from session
            session()->forget('message');
            // Navigate to invoice form
            $vehicleId = $query->value("V.id");
            
            return redirect()->route('invoice.generate',  $vehicleId);
        }
      
    }
    
    public function render()
    {
        return view('livewire.verify-vehicle');
    }
}
