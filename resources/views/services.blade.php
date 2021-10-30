@extends("layouts.app")

@section("pageStyles")
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/datatables.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/dt-global_style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/custom_dt_html5.css") }}">

    <style>
        .form-item {
            font-size: 12px;
            font-weight: 700;
            color: #888ea8;
            border:none;
            background:none;
            padding-top: 11px;
            padding-bottom: 11px;
            border-radius: 5px;
            text-align: left;
        }
        .form-item:hover{
            background:#f1f2f3;
            width:100%;
            display:block;
            padding-left:8px
           
        }
                                                        
    </style>
@endsection

@section("content")
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="page-header">
                <div class="page-title my-2">
                    <h3>Manage Services</h3>
                </div>
            </div>
            
            <div class="row layout-top-spacing" id="cancel-row">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                       <div class="d-flex justify-content-end">
                            <button class="btn btn-primary p-2" data-toggle="modal" data-target="#vehicleTypeModal">Add Service</button>
                       </div>

                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Service Name</th>
                                        <th>Item code</th>
                                        <th>Description</th>
                                        <th>date Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($services as $service)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $service->service_name }}</td>
                                            <td>{{ $service->item_code }}</td>
                                            <td>{{  empty($service->description) ? "No description": $service->description}}</td>
                                            <td>{{ $service->created_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                    <a class="dropdown-item" href="{{ route('services.edit', $service) }}">Edit</a>
                                                    <a class="dropdown-item" href="#">View</a>
                                                        
                                                        <form  action="{{ route("services", $service) }}" method="POST">
                                                            @csrf
                                                            @method("DELETE")
                                                            <input class="form-item" class="dropdown-item" value="Delete" type="submit"/>
                                                        </form>
                                                   
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6"><span class="text-danger text-center">No Service is not added yet</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            </div>

            {{-- Serivces modal --}}

            <div id="modalVerticallyCentered" class="col-lg-12 layout-spacing">
                    <!-- Modal -->
                    <div class="modal fade" id="vehicleTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalCenterTitle">Add New Service</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route("services.store") }}" class="px-4">
                                        @csrf
                                        <div class="form-group mb-4">
                                            <label for="service-name">Service Name</label>
                                            <input type="text" name="service_name" class="form-control @error('service_name') is-invalid @enderror " value="{{ old("service_name") }}" id="service-name" placeholder="Service Name" required>
                                                
                                            @error('service_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="service-name">Service item code</label>
                                            <input type="text" name="item_code" class="form-control @error('item_code') is-invalid @enderror" value="{{ old("item_code") }}" id="item-code" placeholder="Item code" required>
                                                
                                            @error('item_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="name">Description </label>
                                            <textarea value="" name="description" class="form-control  @error('description') is-invalid @enderror" id="description" placeholder="">
                                                {{ old("description") }}
                                            </textarea>
                                            <small>An optional service description.</small>
        
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                  
                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Cancel</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
            </div>
    
@endsection

@section("pageScripts")
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset("assets/js/datatable/datatables.js") }}"></script>

    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset("assets/js/datatable/button-ext/dataTables.buttons.min.js") }}"></script>
    <script src="{{ asset("assets/js/datatable/button-ext/jszip.min.js") }}"></script>    
    <script src="{{ asset("assets/js/datatable/button-ext/buttons.html5.min.js") }}"></script>
    <script src="{{ asset("assets/js/datatable/button-ext/buttons.print.min.js")}}"></script>
    
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7 
        } );
    </script>
    <!-- END PAGE LEVEL SCRIPTS -->
@endsection