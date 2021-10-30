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
                        <form method="POST" action="{{ route("services", $service->id) }}" class="px-4">
                            @csrf
                            @method("PUT")

                            <div class="form-group mb-4">
                                <label for="name">Service Name</label>
                                <input type="text" name="service_name" class="form-control @error('title') is-invalid @enderror " value="{{ $service->service_name}}" id="title" placeholder="Service Name" required>
                                    
                                @error('service_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="name">Service item code</label>
                                
                                <input type="text" name="item_code" class="form-control @error('item_code') is-invalid @enderror " value="{{ $service->item_code}}" id="title" placeholder="Service item code" required>
                                    
                                @error('item_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label for="name">Description </label>
                                <textarea value="" name="description" class="form-control  @error('description') is-invalid @enderror" id="description" placeholder="">
                                    {{ $service->description }}
                                </textarea>
                                <small>An optional vehicle type description.</small>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            
                          <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                          <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Update Service</button>
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