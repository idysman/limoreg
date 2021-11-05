@extends("layouts.app")

@section("pageStyles")
     <!--  BEGIN CUSTOM STYLE FILE  -->
     <link href="{{ asset('assets/css/user-profile.css') }}" rel="stylesheet" type="text/css" />
     <!--  END CUSTOM STYLE FILE  -->
@endsection

@section("content")

<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="page-header">
            <div class="page-title">
                <h3>Profile</h3>
            </div>
        </div>

        <div class="row layout-spacing">

            <!-- Content -->
            <div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

                <div class="user-profile layout-spacing">
                    <div class="widget-content widget-content-area">
                        <div class="d-flex justify-content-between">
                            <h3 class="">Owner Info</h3>
                            <a href="{{ route('vehicles.edit',$vehicle->id) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                        </div>
                        <div class="text-center user-info">
                            <img src="{{ asset('assets/img/car.png') }}" class="px-3" width="150px" alt="avatar">
                            <p class="">{{ $vehicle->owner_fname." ".$vehicle->owner_surname }}</p>
                        </div>
                        <div class="user-info-list">

                            <div class="">
                                <ul class="contacts-block list-unstyled">
                                    <li class="contacts-block__item">
                                       <strong>ID Type: </strong> {{ $vehicle->owner_identification }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>ID No: </strong> {{ $vehicle->identification_no }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>Address: </strong>{{ $vehicle->address }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>Email: </strong>{{ $vehicle->owner_email }}</a>
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>Phone Number: </strong> {{ $vehicle->owner_phone }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>TIN: </strong> {{ $vehicle->tin ?? "" }}
                                    </li>
                                    <li class="contacts-block__item">
                                        <strong>Phone Number: </strong> {{ $vehicle->iirs_id ?? "" }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

                <div class="bio layout-spacing ">
                    <div class="widget-content widget-content-area">
                        <h3 class="">Car Details</h3>

                        <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Key</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Plate Number</td>
                                    <td>{{ $vehicle->plate_number }}</td>
                                </tr>
                                <tr>
                                    <td>Engine Number</td>
                                    <td>{{ $vehicle->engine_number }}</td>
                                </tr>
                                <tr>
                                    <td>Engine Capacity</td>
                                    <td>{{ $vehicle->engine_capacity }}</td>
                                </tr>
                                <tr>
                                    <td>Fuel Type</td>
                                    <td>{{ $vehicle->fuel_type }}</td>
                                </tr>
                                <tr>
                                    <td>Odometer</td>
                                    <td>{{$vehicle->odometer }}</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>{{ $vehicle->color }}</td>
                                </tr>
                                <tr>
                                    <td>Tank Capacity</td>
                                    <td>{{ $vehicle->tank_capacity }}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $vehicle->category }}</td>
                                </tr>
                                <tr>
                                    <td>Chassis Number</td>
                                    <td>{{ $vehicle->chassis_number }}</td>
                                </tr>
                                <tr>
                                    <td>Model</td>
                                    <td>{{ $vehicle->model }}</td>
                                </tr>
                                <tr>
                                    <td>Production Year</td>
                                    <td>{{ $vehicle->year_of_manufacture }}</td>
                                </tr>
                            </tbody>
                        </table>



                    </div>
                </div>

            </div>

        </div>
        </div>

</div>

@endsection
