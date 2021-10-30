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
                <h3>Create Payment invoice</h3>
            </div>
        </div>

        <div class="row  layout-top-spacing">
            <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-2 mx-4">
                                <h4>Generate Renewal invoice</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route("invoice.generate") }}" class="px-4">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Vehicle Owner</label>
                                        <input type="text" name="owner_name" class="form-control @error('vehicle_owner') is-invalid @enderror"  value="Joseph Johnson" id="vehicle_owner" placeholder="User's First Name *" required>
                                        
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
                                        <input type="text"value="jenkin@gmail.com" name="owner_email" class="form-control  @error('owner_email') is-invalid @enderror" id="rsurname" placeholder="Vehicle Owner Email*" required>

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
                                    <input type="text" value="080993576" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror" id="rMiddlename" placeholder="Owner's Phone Number" required>

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
                                    <input type="text" name="engine_number" class="form-control @error('engine_number') is-invalid @enderror"  value="ENGS987638022" id="vehicle_owner" placeholder="Engine's Number*" required>
                                    
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
                                    <input type="text"value="ENGS987638022" name="chassis_number" class="form-control  @error('chassis_number') is-invalid @enderror" id="rsurname" placeholder="Vehicle Owner Email*" required>

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
                                <input type="text" value="BAU-36-GJW" name="plate_number" class="form-control @error('plate_number') is-invalid @enderror" id="rMiddlename" placeholder="Plate Number" required>

                                @error('owner_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       </div>


                            <div class="form-group">

                                <label class="mb-2">Select Services </label>
                         
                                <div id="iconsAccordion" class="accordion-icons">
                                    <div class="card mb-4">
                                        <div class="card-header" id="headingOne3">
                                            <section class="mb-0 mt-0">
                                                <div role="menu" class="collapsed p-0" data-toggle="collapse" data-target="#iconAccordionOne" aria-expanded="true" aria-controls="iconAccordionOne">
                                                    <div class="container d-flex py-2">
                                                        <div class="accordion-icon p-0">
                                                            <label class="switch s-outline s-outline-primary  mb-4 mr-2">
                                                                <input class="service-check" type="checkbox">
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                       <div class="text-center">
                                                        Vehicle Licsense
                                                       </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>

                                        <div id="iconAccordionOne" class="collapse card-body-wrapper" aria-labelledby="headingOne3" data-parent="#iconsAccordion">
                                            <div class="card-body">

                                                <div class="n-chk d-flex flex-column">
                                                    <label class="new-control new-checkbox mb-2 checkbox-primary">
                                                      <input type="checkbox" name="serviceTypes{{ 1 }}[]" value="1" data-amount="200" class="service-type-check new-control-input">
                                                      <span class="new-control-indicator"></span>Primary
                                                    </label>

                                                    <label class="new-control new-checkbox checkbox-primary">
                                                        <input type="checkbox" name="serviceTypes{{ 2}}[]" value="1" data-amount="200" class="new-control-input service-type-check">
                                                        <span class="new-control-indicator"></span>Secondar
                                                      </label>
                                                </div>
                                                
                                                </p>

                                                <p class="">
                                                2. 
                                                </p> 
                                            </div>
                                        </div>
                                </div>

                                    <div class="card">
                                        <div class="card-header" id="headingTwo3">
                                            <section class="mb-0 mt-0">
                                                <div role="menu" class="collapsed" data-toggle="collapse" data-target="#iconAccordionTwo" aria-expanded="false" aria-controls="iconAccordionTwo">
                                                    <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg></div>
                                                    Collapsible Group Item #2  <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                </div>
                                            </section>
                                        </div>
                                        <div id="iconAccordionTwo" class="collapse" aria-labelledby="headingTwo3" data-parent="#iconsAccordion">
                                            <div class="card-body">
                                                <ul class="list-unstyled">
                                                    <li><a href="javascript:void(0);" class="">Apple</a></li>
                                                    <li><a href="javascript:void(0);" class="">Orange</a></li>
                                                    <li><a href="javascript:void(0);" class="">Banana</a></li>
                                                    <li><a href="javascript:void(0);" class="">list</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingThree8">
                                            <section class="mb-0 mt-0">
                                                <div role="menu" class="" data-toggle="collapse" data-target="#iconAccordionThree" aria-expanded="false" aria-controls="iconAccordionThree">
                                                    <div class="accordion-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layout"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg></div>
                                                    Collapsible Group Item #3 <div class="icons"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></div>
                                                </div>
                                            </section>
                                        </div>
                                        <div id="iconAccordionThree" class="collapse show" aria-labelledby="headingThree8" data-parent="#iconsAccordion">
                                        <div class="card-body">
                                            <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>

                                            <button class="btn btn-primary mt-4">Accept</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                           {{-- <div class="form-row">
                                <div class="col-sm-4">
                                    <div class="form-group mb-4">
                                        <label for="name">Owner's Phone Number</label>
                                        <input type="text" value="080993576" name="owner_phone" class="form-control @error('owner_phone') is-invalid @enderror" id="rMiddlename" placeholder="Owner's Phone Number" required>

                                        @error('owner_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" value="{{ old("email") }}" class="form-control @error('email') is-invalid @enderror" id="rEmail" placeholder="User's Email address *" required>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                           </div>
                            <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label for="name">Phone Number</label>
                                        <input type="number" value="{{ old("phone") }}" name="phone" class="form-control @error('phone') is-invalid @enderror" required id="rPhone" placeholder="User's Phone Number*">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="d-block">User's Role</label>
                                        <select required name="role" class="selectpicker @error('role') is-invalid @enderror">
                                            <option value="2">Agent</option>
                                            <option value="3">Inspector</option>
                                        </select>
                                        @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                          <div class="form-row">
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label for="name">Password</label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required  placeholder="Password *">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="rConfirmPassword" required placeholder="Confirm Password *">
                                </div>
                           </div>
                          </div> --}}
                            
                          <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                          <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Register User</button>
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