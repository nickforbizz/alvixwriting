@extends('web.layoutsWeb.app')

@section('top-styles')
    <style>
        .card{
            background-color:#275083d1;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 90px 0px 50px 30px;
        }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card jumbotron">
                <div class="card-header"> <b> Register </b></div>

                {{-- return error messages to user incase they happen --}}

                @include('utils.flash-message')

                <div class="card-body">
                    <form method="POST" action="{{ route('registerUser') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group ">
                                    <label for="lname" class=" col-form-label text-md-right">First Name</label>
                                    <input id="fname" type="text" class="form-control" name="fname" placeholder="fname" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="lname" class=" col-form-label text-md-right">Last  Name</label>
                                    <input id="lname" type="text" class="form-control" name="lname" placeholder="lname" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="sname" class="col-form-label text-md-right">Surame</label>
                                    <input id="sname" type="text" class="form-control" name="sname" placeholder="sname" required autofocus>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="email" class="col-form-label text-md-right">Email address</label>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="email" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="password" class="col-form-label text-md-right">Password</label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="password" min="6" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="password-confirm" class="col-form-label text-md-right">Confirm Password</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="password_confirmation"  required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="username" class="col-form-label text-md-right">Username</label>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="username" required>
                                </div>
                            </div>


                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="national_id" class="col-form-label text-md-right">National ID</label>
                                    <input id="national_id" type="number" class="form-control" name="national_id" placeholder="national_id" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="age" class="col-form-label text-md-right">age</label>
                                    <input id="age" type="number" class="form-control" name="age" min="15" placeholder="age" required>
                                </div>
                            </div>


                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="gender" class="col-form-label text-md-right">Gender</label>
                                    <section  class="form-control" name="gender" required>
                                        <option value="" selected readonly>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                    </section>
                                    {{-- <input id="gender" type="text" class="form-control" name="gender" placeholder="gender" required> --}}
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="mobile" class="col-md-4 col-form-label text-md-right">mobile</label>
                                    <input id="mobile" type="number" class="form-control" name="mobile" min="1" placeholder="mobile" required>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="address" class="col-md-4 col-form-label text-md-right">address</label>
                                    <input id="address" type="text" class="form-control" name="address" placeholder="address" required>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <input type="submit" class="btn btn-info btn-lg" value='Regester'/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
