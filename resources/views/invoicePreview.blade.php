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
                    <h3>Invoice Preview</h3>
                </div>
            </div>
            
            <div class="row layout-top-spacing" id="cancel-row">
            
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                       <div class="my-3 ml-3">
                       
                        <h5></h5>
                       </div>
                        <div class="table-responsive mb-4 mt-4">
                            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Invoice</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($invoices as $invoice)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{  $invoice['service'].' Invoice' }}</td>
                                            <td>
                                                <form action="{{ route('invoices.download') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Download Invoice</button>
                                                    <input type="hidden" value="{{ $invoice['invoice_id'] }}" name="invoice"/>
                                                </form>
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