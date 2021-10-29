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
                <h3>Edit User's Data</h3>
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
                        <form method="POST" action="{{ route("update.user", $user) }}" class="px-4">
                            @csrf
                            @method("PUT")
                            <div class="form-row">
                            <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label for="name">First Name</label>
                                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"  value="{{ $user->first_name }}" id="rFirstname" placeholder="User's First Name *" required>
                                    
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                           <div class="col-sm-6">
                                <div class="form-group mb-4">
                                    <label for="name">Surname</label>
                                    <input type="text"value="{{$user->surname }}" name="surname" class="form-control  @error('surname') is-invalid @enderror" id="rsurname" placeholder="User's Surname*" required>

                                    @error('surname')
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
                                        <label for="name">Middlename</label>
                                        <input type="text" value="{{ $user->middle_name }}" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" id="rMiddlename" placeholder="User's Middlename *" required>

                                        @error('middle_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                         @enderror
                                    </div>
                            </div>
                                <div class="col-sm-6">
                                    <div class="form-group mb-4">
                                        <label for="name">Email</label>
                                        <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" id="rEmail" placeholder="User's Email address *" required>

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
                                        <input type="number" value="{{ $user->phone }}" name="phone" class="form-control @error('phone') is-invalid @enderror" required id="rPhone" placeholder="User's Phone Number*">
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
                                            <option value="2" {{ (int) $user->role === 2 ? "selected": ""  }}>Agent</option>
                                            <option value="3" {{ (int) $user->role === 3 ? "selected": ""  }}>Inspector</option>
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
                                        <input type="password" name="password" value="" class="form-control @error('password') is-invalid @enderror" required  placeholder="Password *">
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
                                    <input type="password" name="password_confirmation" value="" class="form-control" id="rConfirmPassword" required placeholder="Confirm Password *">
                                </div>
                           </div>
                          </div>
                            
                          <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                          <div class="form-row m-auto">
                            <button type="submit" class="btn btn-primary my-4 w-50 py-3 ">Update User</button>
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