@php
    
    $services = ["id"=> 1, "name"=>"Vehicle Liscense", "id"=> 2, "name"=>"Motor Liscense"];

    $serviceItem1 = ["id"=> 1, "name"=> "Yellow", "amount"=> 2];

@endphp

@extends("layouts.app")

@section("pageStyles")
     <!--  BEGIN CUSTOM STYLE FILE  -->
     <link href="{{ asset("assets/css/scrollspyNav.css") }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset("assets/css/custom-accordions.css") }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset("assets/css/switches.css") }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset("assets/css/theme-checkbox-radio.css") }}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap-select.min.css") }}">
     <!--  END CUSTOM STYLE FILE  --> 
@endsection

@section("content")

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title my-2">
                <h3>Register Automobile</h3>
            </div>
        </div>

        <div class="row  layout-top-spacing">
            <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-2 mx-4">
                                {{-- <h4>Register Automobile</h4> --}}
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route("vehicles.store") }}" class="px-4">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="owner-fname">Owner first Name</label>
                                        <input type="text" name="owner_fname" class="form-control @error('owner_fname') is-invalid @enderror" value="{{ old("owner_fname") }}"  id="owner-fname" placeholder="Vehicle owner's first name *" required>
                                    @error('owner_fname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner Surname</label>
                                        <input type="text" name="owner_surname" class="form-control @error('owner_surname') is-invalid @enderror" value="{{ old("owner_surname") }}" id="owner-surname" placeholder="Vehicle owner's surname *" required>
                                        
                                    @error('owner_surname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner License Number</label>
                                        <input type="text"  name="owner_license_number" class="form-control @error('owner_license_number') is-invalid @enderror"  value="{{ old("owner_license_number") }}" id="owner-license-number" placeholder="Vehicle owner's license Number *" required>
                                        
                                    @error('owner_license_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's Email</label>
                                        <input type="text" name="owner_email" value="{{ old("owner_email") }}" class="form-control @error('owner_email') is-invalid @enderror"  id="owner-email" placeholder="Vehicle owner's email *" required>
                                        
                                    @error('owner_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's Phone Number</label>
                                        <input type="text"  value="{{ old("owner_phone") }}" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror"  id="owner-phone" placeholder="Vehicle owner's phone Number *" required>
                                        
                                    @error('owner_phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's Identification</label>
                                          <select  name="owner_identification" class="form-control @error('owner_identification') is-invalid @enderror">
                                            <option>Voter's Card</option>
                                            <option>National Identification Numbr</option>
                                          </select>
                                          @error('owner_identification')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Identification Number</label>
                                        <input type="text" name="identification_no" class="form-control @error('identification_no') is-invalid @enderror"  value="{{ old("identification_no") }}" id="identification-no" placeholder="Owner's identification Number *" required>
                                        
                                        @error('identification_no')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's State of Origin</label>
                                        <input type="text" name="state" class="form-control @error('state') is-invalid @enderror"   value="{{ old("state") }}" id="state" placeholder="Owner's State *" required>
                                        
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's LGA</label>
                                        <input type="text" name="lga" class="form-control @error('lga') is-invalid @enderror" value="{{ old("lga") }}" id="state" placeholder="Owner's LGA *" required>
                                        
                                        @error('lga')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                           <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="engine-number">Vehicle's Engine Number</label>
                                        <input type="text" name="engine_number" class="form-control @error('engine_number') is-invalid @enderror"  value="{{ old("engine_number") }}" id="engine-number" placeholder="Engine's Number*" required>
                                        
                                        @error('engine_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label for="chassis_number">Vehicle's Chassis Number</label>
                                    <input type="text"  value="{{ old("chassis_number") }}" name="chassis_number" class="form-control  @error('chassis_number') is-invalid @enderror" id="rsurname" placeholder="Chassis Number*" required>

                                    @error('chassis_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="name">Vehicle's Plate Number</label>
                                <input type="text"  value="{{ old("plate_number") }}" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" id="plateNumber" placeholder="Plate Number" required>

                                @error('owner_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                        <div class="form-row">
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label for="car-model">Vehicle's Model</label>
                                    <input type="text" name="model" class="form-control @error('model') is-invalid @enderror"  value="{{ old("model") }}"  id="car-model" placeholder="Automobile Model*" required>
                                    
                                    @error('model')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="chassis_number">Vehicle's Category</label>
                                  <select class="form-control" name="category" id="">
                                    <option value="public">public</option>
                                    <option value="private">private</option>
                                    <option></option>
                                  </select>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="vehicle-type">Vehicle type</label>
                                <select class="form-control" name="vehicle_type" id="vehicle-type">
                                    @forelse ($vehicle_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->title }}</option>
                                    @empty
                                        <option value="">No Vehicle type</option>
                                    @endforelse
                                </select>
                                
                                @error('vehicle_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="policy-number">Policy Number</label>
                                <input type="text"  value="{{ old("policy_number") }}" name="policy_number" class="form-control @error('policy_number') is-invalid @enderror" id="policy-number" placeholder="Policy Number" required>
                                
                                @error('policy_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="tank-capacity">Tank Capacity</label>
                                <input type="text"  value="{{ old("tank_capacity") }}" name="tank_capacity" class="form-control @error('tank_capacity') is-invalid @enderror" id="tank-capacity" placeholder="Tank Capacity" required>
                                
                                @error('tank_capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="engine-capacity">Engine Capacity</label>
                                <input type="text"  value="{{ old("engine_capacity") }}" name="engine_capacity" class="form-control @error('engine_capacity') is-invalid @enderror" id="engine-capacity" placeholder="Engine Capacity" required>
                                
                                @error('engine_capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="color">Vehicle color</label>
                                <input type="text"  value="{{ old("color") }}" name="color" class="form-control @error('color') is-invalid @enderror" id="color" placeholder="Vehicle color" required>
                                
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="fuel-type">Fuel Type</label>
                                <input type="text"  value="{{ old("fuel_type") }}" name="fuel_type" class="form-control @error('fuel_type') is-invalid @enderror" id="fuel-type" placeholder="Fuel Type" required>
                                
                                @error('fuel_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="odometer">Odometer</label>
                                <input type="text"  value="{{ old("odometer") }}" name="odometer" class="form-control @error('odometer') is-invalid @enderror" id="odometer" placeholder="Odometer" required>
                                
                                @error('odometer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                
                    <div class="form-row">
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="title">Car Name</label>
                                <input type="text"  value="{{ old("title") }}" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Name of the car" required>
                                
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="year-of-manufacture">Year of Manufacture</label>
                                <input type="number" value="{{ old("year_of_manufacture") }}" name="year_of_manufacture" class="form-control @error('year_of_manufacture') is-invalid @enderror" id="year-of-manufacture" placeholder="Year of Manufacture" required>
                                
                                @error('year_of_manufacture')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="title">Owner Address</label>
                                <input type="text"  value="{{ old("address") }}" name="address" class="form-control @error('address') is-invalid @enderror" id="title" placeholder="Address of owner" required>
                                
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="tin">Taxpayer Identification Number</label>
                                <input type="text" value="{{ old("tin") }}" name="tin" class="form-control @error('tin') is-invalid @enderror" id="tin" placeholder=" Taxpayer Identification Number">
                                
                                @error('tin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="title">Imo State Internal Revenue Service Id</label>
                                <input type="text"  value="{{ old("iirs_id") }}" name="iirs_id" class="form-control @error('address') is-invalid @enderror" id="title" placeholder="Imo State Internal Revenue Service Id" required>
                                
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                        <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                        <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Register Car</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section("pageScripts")
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset("assets/js/scrollspyNav.js") }}"></script>
    <script src="{{ asset("assets/js/bootstrap-select.min.js") }}"></script>
    <script src="{{ asset("assets/js/ui-accordions.js") }}"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
   
@endsection