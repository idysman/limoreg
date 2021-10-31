
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
                <h3>Create Payment invoice</h3>
            </div>
        </div>

        <div class="row  layout-top-spacing">
            <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-2 mx-4">
                                {{-- <h4>Generate Renewal invoice</h4> --}}
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route("invoice.store", $vehicle->id) }}" class="px-4">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Vehicle Owner</label>
                                        <input type="text" value="{{ $vehicle->owner_fname. " ".$vehicle->owner_surname }}" readonly name="owner_name" class="form-control @error('vehicle_owner') is-invalid @enderror"  value="Joseph Johnson" id="vehicle_owner" placeholder=" Owner's Name *" required>
                                        
                                    @error('owner_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="owner_email">Vehicle's Owner Email</label>
                                        <input type="text" readonly value="{{ $vehicle->owner_email }}" name="owner_email" class="form-control  @error('owner_email') is-invalid @enderror" id="rsurname" placeholder="Vehicle Owner Email*" required>

                                        @error('owmer_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label for="name">Owner's Phone Number</label>
                                    <input type="text" readonly value="{{ $vehicle->owner_phone }}" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror" id="rMiddlename" placeholder="Owner's Phone Number" required>

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
                                    <label for="name">Vehicle's Engine Number</label>
                                    <input type="text" readonly name="engine_number" class="form-control @error('engine_number') is-invalid @enderror"  value="{{ $vehicle->engine_number }}" id="vehicle_owner" placeholder="Engine's Number*" required>
                                    
                                @error('engine_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label for="license-number">Owner's License Number</label>
                                    <input type="text" readonly value="{{ $vehicle->owner_license_number }}" name="license_number" class="form-control  @error('license_number') is-invalid @enderror" id="rsurname" placeholder="Owners' License Number*" required>

                                    @error('license_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group mb-4">
                                <label for="name">Vehicle's Plate Number</label>
                                <input type="text" readonly value="{{ $vehicle->plate_number }}" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" id="plate-number" placeholder="Plate Number" required>

                                @error('plate_number')
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
                                    <label for="chassis_number">Vehicle Chassis Number</label>
                                    <input type="text" readonly value="{{ $vehicle->chassis_number }}" name="chassis_number" class="form-control  @error('chassis_number') is-invalid @enderror" id="rsurname" placeholder="Owners' License Number*" required>

                                    @error('chassis_number')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group mb-4">
                                  <label for="Vehicle-type">Vehicle Type</label>
                                  <select readonly class="form-control" name="vehicle_type" id="vehicle-type">
                                    @forelse ($vehicle_types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id === $vehicle->vehicle_type_id ? "selected":"" }}>{{ $type->title }}</option>
                                    @empty
                                        <option value="">No  Vehicle types</option>
                                    @endforelse
                                  </select>
                                </div>
                            </div>
                        </div>

                            <div class="form-group">

                                <label class="mb-2">Select Services </label>
                                
                                <div id="iconsAccordion" class="accordion-icons">
                                    @forelse ($services as $service)
                                        <div class="card mb-4">
                                            <div class="card-header" id="headingOne{{ $service->id }}">
                                                <section class="mb-0 mt-0">
                                                    <div role="menu" class="collapsed p-0" data-toggle="collapse" data-target="#iconAccordion{{ $service->id }}" aria-expanded="true" aria-controls="iconAccordion{{ $service->id }}">
                                                        <div class="container d-flex py-2">
                                                            <div class="accordion-icon p-0">
                                                                <label class="switch s-outline s-outline-primary  mb-4 mr-2">
                                                                    <input class="service-check" name="service[]" value="{{ $service->id }}" type="checkbox">
                                                                    <span class="slider round"></span>
                                                                </label>
                                                            </div>
                                                        <div class="text-center">
                                                           {{ $service->service_name }}
                                                        </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>

                                            <div id="iconAccordion{{ $service->id }}" class="collapse card-body-wrapper" aria-labelledby="headingOne{{ $service->id }}" data-parent="#iconsAccordion">
                                                <div class="card-body">

                                                    <div class="n-chk d-flex flex-column">
                                                        
                                                        @forelse ($service->service_component as $component)
                                                            
                                                            @if ($component->vehicle_type_id === $vehicle->vehicle_type_id)
                                                                <label class="new-control new-checkbox mb-2 checkbox-primary">
                                                                    <input type="checkbox" name="service_{{ $service->id }}[]" value="{{  $component->id }}" data-amount="{{ $component->amount }}" class="service-type-check new-control-input">
                                                                    <span class="new-control-indicator"></span>{{ $component->title }}
                                                                </label>
                                                            @else
                                                                @continue
                                                            @endif
                                                        @empty
                                                            <p>No Service components added</p>
                                                        @endforelse
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @empty
                                        
                                    @endforelse

                                    

                                </div>
                            </div>
                            
                          <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                          <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Generate Invoice</button>
                          </div>
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

    <script>
        
        $(".service-type-check").on("click", function(){
            if($(this).is(":checked")){
               const parentCheckBox = $(this).closest(".card-body-wrapper").prev().find('input.service-check');
               if(!parentCheckBox.is(":checked")){  //parent not checked
                parentCheckBox.prop('checked', true);
               }
            }
        });

        $(".service-check").on("click", function (){
            if(!$(this).is(":checked")){
                const inputEls = $(this).closest('.card-header').next().find(".card-body input[type=checkbox]");
                inputEls.each(function(){
                    if($(this).is(":checked")){
                        $(this).prop('checked', false);
                    }
                })
            }
        })
    </script>
@endsection