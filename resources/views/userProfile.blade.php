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
                <h3>Your Profile</h3>
            </div>
        </div>

        <div class="row layout-spacing">

            <!-- Content -->
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 layout-top-spacing">

                <div class="user-profile layout-spacing">
                    <div class="widget-content widget-content-area">
                        <h3 class="">User Information</h3>
                        <div class="text-center user-info">
                            <img src="{{ asset('assets/img/profile.png') }}" class="px-3" width="150px" alt="avatar">
                        </div>
                        <div class="user-info-list" style="padding:0;">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <strong>Name: </strong> {{ $user->first_name . "". $user->surname}}
                                </li>
                                <li class="contacts-block__item">
                                    <strong>Email: </strong> {{ $user->email }}
                                </li>
                                <li class="contacts-block__item">
                                    <strong>Phone: </strong>{{ $user->phone }}
                                </li>
                                
                                <li class="contacts-block__item">
                                    <strong>Role: </strong> {{ $user->role === 1 ? "SuperAdmin": ($user->role === 2 ? "Agent": "Inspector") }}
                                </li>
                                <li class="contacts-block__item">
                                    <strong>Date Registered: </strong>{{ $user->created_at }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
          
        </div>
        </div>

</div>

@endsection
