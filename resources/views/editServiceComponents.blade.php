@extends("layouts.app")

@section("pageStyles")
     <!--  BEGIN CUSTOM STYLE FILE  -->
     <link href="{{ asset("assets/css/scrollspyNav.css") }}" rel="stylesheet" type="text/css" />
     <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/bootstrap-select.min.css") }}">
     <!--  END CUSTOM STYLE FILE  --> 
@endsection

@section("content")

<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title my-2">
                <h3>Edit Service</h3>
            </div>
        </div>

        <div class="row  layout-top-spacing">
            <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12 my-2 mx-4">
                                {{-- <h4>Update information</h4> --}}
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <form method="POST" action="{{ route("services_comp", $component->id) }}" class="px-4">
                            @csrf
                            @method("PUT")

                            <div class="form-group mb-4">
                                <label for="title">Service component title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror " value="{{ $component->title }}" id="title" placeholder="Type description" required>
                                    
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="vehicle-type">Vehicle type</label>
                                <select class="form-control" name="vehicle_type" id="vehicle-type">
                                    @forelse ($vehicle_types as $type)
                                        <option value="{{ $type->id }}" {{ $type->id === $component->vehicle_type_id ? "selected" :"" }}>{{ $type->title }}</option>
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
                            <div class="form-group mb-4">
                                <label for="title">Service</label>
                                <select class="form-control" name="service" id="vehicle-type">
                                    @forelse ($services as $service)
                                        <option value="{{ $service->id }}" {{ $service->id === $component->service_id ? "selected" :"" }}>{{ $service->service_name }}</option>
                                    @empty
                                        <option value="">No Service Available</option>
                                    @endforelse
                                </select>
                                
                                @error('service_item')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="tit">Service component amount (₦)</label>
                                <input type="number" name="amount" class="form-control @error('amount') is-invalid @enderror " value="{{ $component->amount }}" id="title" placeholder="Type description" required>
                                
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                          <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                          <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Update Component</button>
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
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection