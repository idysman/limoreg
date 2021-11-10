    {{-- {{ dd($total_invoices) }} --}}
    @extends('layouts.app')

    @section("pageStyles")
        <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
        <link href="{{ asset("assets/css/apexcharts.css") }}" rel="stylesheet" type="text/css">
        <link href="{{ asset("assets/css/dash_1.css") }}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
        <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @endsection

    @section('content')
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="page-header">
                <div class="page-title">
                    <h3>System Analytics</h3>
                </div>
            </div>

            <div class="row layout-top-spacing">

                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-one">
                        <div class="widget-heading">
                            <h6 class="">Vehicles</h6>
                        </div>
                        <div class="w-chart">
                            <div class="w-chart-section">
                                <div class="w-detail">
                                    <p class="w-title">Total Vehicles</p>
                                    <p class="w-stats">{{ $vehicles }}</p>
                                </div>
                                <div class="w-chart-render-one">
                                    <div id="total-users"></div>
                                </div>
                            </div>

                            <div class="w-chart-section">
                                <div class="w-detail">
                                    <p class="w-title">Your Registrations</p>
                                    <p class="w-stats">{{ $yourReg }}</p>
                                </div>
                                <div class="w-chart-render-one">
                                    <div id="paid-visits"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
                    <div class="widget widget-card-four">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">
                                    <h6 class="value">{{ $invoices }}</h6>
                                    <p class="">Total Invoices</p>
                                </div>
                                <div class="w-info">
                                    <h6 class="value">{{ $yourInvoice }}</h6>
                                    <p class="">Your Invoices</p>
                                </div>
                                <div class="">
                                  <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" width="24" height="24" viewBox="0 0 24 24"><path d="M17 7h-10v1h10v-1zm0 2h-10v1h10v-1zm-4 2h-6v1h6v-1zm9.042 4.638c.06.255-.277.414-.391.144-.136-.33-.356-1.734-.547-3.146-.103-.756-1.107-.663-1.104.118.003 1.215.002 2.228 0 4.027-.002 1.535.697 1.565 1.213 3.287.088.296.164.618.226.933l2.561-.895c-.893-1.747-.462-3.126-.373-4.255.122-1.543-.288-1.693-2.192-3.548.114.816.352 2.265.607 3.335zm-19.477-3.334c-1.904 1.854-2.314 2.005-2.192 3.548.089 1.128.52 2.507-.373 4.254l2.562.894c.062-.314.138-.637.226-.933.515-1.721 1.214-1.752 1.212-3.287-.002-1.8-.003-2.812 0-4.027.003-.781-1.002-.874-1.104-.118-.19 1.412-.411 2.816-.547 3.146-.113.271-.45.111-.391-.144.255-1.069.493-2.518.607-3.333zm2.435 4.696l.004-2h13.992l.004 2h-14zm-2-5.819v-6.681c0-.828.672-1.5 1.5-1.5h15c.828 0 1.5.672 1.5 1.5v6.681c-.138-.04-.282-.065-.436-.065-.41-.001-.812.166-1.102.457-.289.29-.449.686-.463 1.118v-7.691h-13.999v7.689c-.014-.432-.174-.827-.463-1.117-.29-.291-.691-.457-1.102-.457-.152 0-.296.026-.435.066z"/></svg>
                                  </div>
                                </div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $invoices > 0 ? ($yourInvoice/$invoices * 100) : 0 }}%" aria-valuenow=" {{  $invoices > 0 ? ($yourInvoice/$invoices * 100) : 0  }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->role === 1)
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                        <div class="row widget-statistic">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-followers">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        </div>
                                        <p class="w-value">{{ $users }}</p>
                                        <h5 class="">Users</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-referral">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users" width="24" height="24" viewBox="0 0 24 24"><path d="M13.473 7.196c-.425-.439-.401-1.127.035-1.552l4.461-4.326c.218-.211.498-.318.775-.318.282 0 .563.11.776.331l-6.047 5.865zm-7.334 11.021c-.092.089-.139.208-.139.327 0 .25.203.456.455.456.115 0 .229-.042.318-.128l.748-.729-.633-.654-.749.728zm8.212-6.482l-2.57 2.481c-.824.799-1.607 1.328-2.705 1.79.496-1.084 1.05-1.852 1.873-2.65l2.569-2.479-1.049-1.083-2.564 2.485c-1.378 1.336-2.08 2.63-2.73 4.437l1.133 1.169c1.824-.593 3.14-1.255 4.518-2.591l2.563-2.486-1.038-1.073zm7.878-7.243l-5.527 5.359-1.239-1.279 5.529-5.361c.824-.803 2.087.456 1.237 1.281zm-.643-3.036c-.572 0-1.156.209-1.64.678l-6.604 6.405 3.326 3.434 6.604-6.403c.485-.47.728-1.094.728-1.719 0-1.426-1.181-2.395-2.414-2.395zm-3.586 12.01v7.534h-16v-12h8.013l2.058-2h-12.071v16h20v-11.473l-2 1.939z"/></svg>
                                        </div>
                                        <p class="w-value">{{ $services }}</p>
                                        <h5 class="">Services</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                <div class="widget widget-one_hybrid widget-engagement">
                                    <div class="widget-heading">
                                        <div class="w-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link" height="24" viewBox="0 0 24 24"><path d="M11 11v-3h1.247c.882 0 1.235.297 1.828.909.452.465 1.925 2.091 1.925 2.091h-5zm-1-3h-2.243c-.688 0-1.051.222-1.377.581-.316.348-.895.948-1.506 1.671 1.719.644 4.055.748 5.126.748v-3zm14 5.161c0-2.823-2.03-3.41-2.794-3.631-1.142-.331-1.654-.475-3.031-.794-.55-.545-2.052-2.036-2.389-2.376l-.089-.091c-.666-.679-1.421-1.269-3.172-1.269h-7.64c-.547 0-.791.456-.254.944-.534.462-1.944 1.706-2.34 2.108-1.384 1.402-2.291 2.48-2.291 4.603 0 2.461 1.361 4.258 3.179 4.332.41 1.169 1.512 2.013 2.821 2.013 1.304 0 2.403-.838 2.816-2h6.367c.413 1.162 1.512 2 2.816 2 1.308 0 2.409-.843 2.82-2.01 1.934-.056 3.181-1.505 3.181-3.829zm-18 4.039c-.662 0-1.2-.538-1.2-1.2s.538-1.2 1.2-1.2 1.2.538 1.2 1.2-.538 1.2-1.2 1.2zm12 0c-.662 0-1.2-.538-1.2-1.2s.538-1.2 1.2-1.2 1.2.538 1.2 1.2-.538 1.2-1.2 1.2zm2.832-2.15c-.399-1.188-1.509-2.05-2.832-2.05-1.327 0-2.44.868-2.836 2.062h-6.328c-.396-1.194-1.509-2.062-2.836-2.062-1.319 0-2.426.857-2.829 2.04-.586-.114-1.171-1.037-1.171-2.385 0-1.335.47-1.938 1.714-3.199.725-.735 1.31-1.209 2.263-2.026.34-.291.774-.432 1.222-.43h5.173c1.22 0 1.577.385 2.116.892.419.393 2.682 2.665 2.682 2.665s2.303.554 3.48.895c.84.243 1.35.479 1.35 1.71 0 1.196-.396 1.826-1.168 1.888z"/></svg>
                                        </div>
                                        <p class="w-value">{{ $vehicle_types }}</p>
                                        <h5 class="">Vehicle Types</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-chart-three">
                        <div class="widget-heading">
                            <div class="">
                                <h5 class="">Total Invoices Generated Per Month</h5>
                            </div>

                            <div class="dropdown  custom-dropdown">
                                <a class="dropdown-toggle" href="#" role="button" id="uniqueVisitors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                </a>

                                {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="uniqueVisitors">
                                    <a class="dropdown-item" href="javascript:void(0);">View</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                </div> --}}
                            </div>
                        </div>

                        <div class="widget-content">
                            <div id="uniqueVisits"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('pageScripts')
    <script src="{{ asset("assets/js/apexcharts.min.js") }}"></script>
    <script>
        // const data = [58, 44, 55, 57, 56, 61, 58, 63, 60, 66, 56, 63];
        const total_invoices = {{ json_encode($total_invoices) }};
        const  your_invoices= {{ json_encode($your_invoices) }};


        // console.log(your_invoices);

    </script>
    <script src="{{ asset("assets/js/dash_1.js") }}"></script>

@endsection
