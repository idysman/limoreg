@extends("layouts.app")

@section("pageStyles")
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/datatables.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/dt-global_style.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("assets/css/datatable/custom_dt_html5.css") }}">

 
@endsection

@section("content")
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="page-header">
                <div class="page-title my-2">
                    <h3>Manage all Users</h3>
                </div>
            </div>
            
            <div class="row layout-top-spacing" id="cancel-row">
            
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-primary p-2 mr-4" href="{{ route('users.create') }}">Add New User</a>
                       </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Other Names</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->first_name }}</td>
                                            <td>{{ $user->first_name . " ".$user->surname }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->status === 1)
                                                    <span class="badge badge-primary">Active</span>
                                                @else
                                                    <span class="badge badge-warning">Deactivated</span>
                                                @endif
                                            </td>
                                            <td>{{  $user->role === 1 ? "Admin" : ($user->role === 2 ? "Agent": "Inspector") }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-dark btn-sm">Open</button>
                                                    <button type="button" class="btn btn-dark btn-sm dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuReference1">
                                                    <a class="dropdown-item" href="{{ route('users.edit', $user) }}">Edit</a>
                                                    <a class="dropdown-item" href="#">View</a>
                                                        <form  action="{{ route("users", $user) }}" method="POST">
                                                            @csrf
                                                            @method("PATCH")
                                                            <input class="form-item" value="{{ $user->status === 1 ? "Disable" : "Enable" }}" type="submit"/>
                                                        </form>
                                                        
                                                        <form  action="{{ route("users", $user) }}" method="POST">
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
                                        <td class="text-center" colspan="7"><span class="text-danger text-center">Vehicle types are not added yet</span>
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