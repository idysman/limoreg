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
     <link href="{{ asset("assets/css/form_wizard.css") }}" rel="stylesheet" type="text/css" />
     <style>
        * {
            margin: 0;
            padding: 0
        }

        html {
            height: 100%
        }

        #grad1 {
            background-color: : #9C27B0;
            background-image: linear-gradient(120deg, #FF4081, #81D4FA)
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset .form-card {
            background: white;
            border: 0 none;
            border-radius: 0px;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            padding: 20px 40px 30px 40px;
            box-sizing: border-box;
            width: 94%;
            margin: 0 3% 20px 3%;
            position: relative
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform fieldset .form-card {
            text-align: left;
            color: #9E9E9E
        }

        #msform input,
        #msform textarea {
            padding: 0px 8px 4px 8px;
            border: none;
            border-bottom: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: none;
            font-weight: bold;
            border-bottom: 2px solid skyblue;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: skyblue;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
        }

        select.list-dt {
            border: none;
            outline: 0;
            border-bottom: 1px solid #ccc;
            padding: 2px 5px 3px 5px;
            margin: 2px
        }

        select.list-dt:focus {
            border-bottom: 2px solid skyblue
        }

        .card {
            z-index: 0;
            border: none;
            border-radius: 0.5rem;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #2C3E50;
            margin-bottom: 10px;
            font-weight: bold;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #000000
        }

        #progressbar li {
            list-style-type: none;
            font-size: 12px;
            width: 25%;
            float: left;
            position: relative
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f023"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f007"
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f09d"
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 18px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: skyblue
        }

        .radio-group {
            position: relative;
            margin-bottom: 25px
        }

        .radio {
            display: inline-block;
            width: 204;
            height: 104;
            border-radius: 0;
            background: lightblue;
            box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
            box-sizing: border-box;
            cursor: pointer;
            margin: 8px 2px
        }

        .radio:hover {
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
        }

        .radio.selected {
            box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }
     </style>
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
                            <div class="tab">
                            <div><h2 class="fs-title">Owner Information</h2></div>
                            <div class="form-row">
                            <div class="col-sm-4">
                                <fieldset>
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
                        </fieldset>

                            </div>
                            <div class="tab">
                                <fieldset>
                                    <h2 class="fs-title">Vehicle Information</h2>
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
                                </fieldset>
                                <div class="form-row m-auto">
                                    <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Register Car</button>
                                </div>
                            </div>

                    </div>

                        <small id="emailHelp2" class="form-text text-muted" style="padding: 20px">*Required Fields</small>

                        <div style="overflow:auto;">
                            <div style="float:right;">
                              <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                              <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                            </div>
                        </div>

                        <div style="text-align:center;margin-top:40px;padding:40px;">
                            <span class="step"></span>
                            <span class="step"></span>
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
    <script src="{{ asset("assets/js/form_control.js") }}"></script>

    <!-- END PAGE LEVEL SCRIPTS -->

@endsection
