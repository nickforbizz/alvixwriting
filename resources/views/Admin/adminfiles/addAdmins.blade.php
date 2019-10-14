@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- penel  -->
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                    Add Admins
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                <form method="POST" id="regester-admin">
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
                                <input id="password" type="password" class="form-control" name="password" placeholder="password" required>
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
                                <input id="national_id" type="text" class="form-control" name="national_id" placeholder="national_id" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="age" class="col-form-label text-md-right">age</label>
                                <input id="age" type="number" class="form-control" name="age" placeholder="age" required>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="gender" class="col-form-label text-md-right">Gender</label>
                                <input id="gender" type="text" class="form-control" name="gender" placeholder="gender" required>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="mobile" class="col-md-4 col-form-label text-md-right">mobile</label>
                                <input id="mobile" type="number" class="form-control" name="mobile" placeholder="mobile" required>
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
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            <!-- penel-->
        </div>
    </div>

</div>
@endsection

@section('bottom-scripts')
    <script>
    $(document).ready(function (){
        $("#regester-admin").on("submit", function (event) {
			event.preventDefault();
			$.ajax({
				url:"{{ route('Admin.registerAdmin') }}",
				method: 'post',
				data: $("#regester-admin").serializeArray(),
				success: function (data) {

                    if (data.code == 0) {
                        $("#edit").html(`
                            <div class="alert alert-danger " id="myAlert">
                                <strong>Error!</strong> This alert box  indicate an error 0 ocurred.
                            </div>
                        `)

                    } else if(data.code == -1) {
                        // var errors = JSON.parse(data.errors);
                        var errs = $.map(data.errs, function(value, index) {
                            return [value];
                        });
                        $("#edit").html(`
                            @component('utils.errorsModal',["code"=>"-1"])

                            @endcomponent
                        `);
                        errs.forEach(element => {
                            $("#errors").append(`
                                @component('utils.errorsModalArray', ["code"=>"errorsArray"])

                                @endcomponent
                            `);
                        });

                    }else if(data.code == 1){
                        $("#edit").html(`
                        @component('utils.successModal',["code"=>"1"])

		                @endcomponent
                        `)
                    }
					$("#myModal").modal();
				},error: function (data) {
					$("#edit").html(`
                        @component('utils.errorsModal',["code"=>"500"])

		                @endcomponent
                        `)
                        console.log(data);

                    $("#myModal").modal();
				}
			})
		});
    })

    </script>
@endsection
