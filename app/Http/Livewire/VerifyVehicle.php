<?php

namespace App\Http\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

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
            "phone_number" => "required|string|exists:vehicles,owner_phone",
            "plate_number"=> "required|string|exists:vehicles,plate_number"
        ]);

        // Validation sucessfully
        session()->forget('error');
    }
    
    public function verify_vehicle()
    {
        
        session()->flash('message', 'Vehicle credentials does not exist in the system, Kindly register vehicle.');
        
        $this->validate([
            "chassis_number"=> "required|string|exists:vehicles,chassis_number",
            "phone_number" => "required|string|exists:vehicles,owner_phone",
            "plate_number"=> "required|string|exists:vehicles,plate_number"
        ]);

        //  Double check credentials existence again
        $query = Vehicle::where("plate_number", $this->plate_number)
                        ->where('owner_phone', $this->phone_number)
                        ->where('chassis_number', $this->chassis_number);
        if($query->exists()){
            // Remove message from session
            session()->forget('message');
            // Navigate to invoice form
            $vehicleId = $query->value("id");
            
            return redirect()->route('invoice.generate',  $vehicleId);
        }
      
    }
    
    public function render()
    {
        return view('livewire.verify-vehicle');
    }
}
