@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Dashboard/Edit/Admins</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- Tables  -->
            <div class="panel panel-default col-md-12">

                @if (Auth::guard('admin')->user()->role->name == 'superadmin')
                <div class="panel-heading">
                    Edit Admins
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Mobile </th>
                                    <th>Roles </th>
                                    <th>Edit </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr class="tb_data" data-id=' {{ $admin->id }}'>
                                    <td> {{ $admin->id }}</td>
                                    <td> {{ $admin->username }} </td>
                                    <td> {{ $admin->fname }} </td>
                                    <td> {{ $admin->lname }} </td>
                                    <td> {{ $admin->email }} </td>
                                    <td> {{ $admin->mobile }} </td>
                                    <td> {{ $admin->role->name }} </td>
                                    <td> <button class="btn btn-primary btn-sm">Edit</button> </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->

                @else
                    <div class="panel-body">
                        <div class="crd">
                            <div class="alert alert-dangerh">
                                <strong> <h2>Sorry!</h2> </strong>
                                 <p class="lead">Only Users with privillages <i>like <b>SuperAdmin</b> </i> can edit Users </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <!-- /.panel -->
            <!-- Tables-->
        </div>
    </div>

</div>
@endsection


@section('bottom-scripts')

<script>



	$(document).ready(function(){
        // get update
		$(document).on("click",".tb_data", function () {
			var admin_id = $(this).attr("data-id");
            console.log(admin_id)
			$.ajax({
				url:'/admin/getAdmin/' + admin_id,
				method: 'get',
				success: function (data) {
                    // data = JSON.parse(data);
                    console.log(data);


					$("#edit").html('');

                    if (data.code == 1) {
                        $("#edit").html(`
                        @component('utils.editAdminModal',["code"=>"edit_admin"])

                        @endcomponent
                        `)
                        $("#submit_btn").hide();
                    }else {
                        $("#edit").html(`<div class="text-center"> <h3>Error Updating...</h3> <p>Bye</p></div>`);
                        $("#submit_btn").hide();
                    }
					$("#myModal").modal();
				},
				error: function (err) {console.log(err);}
			})
		});
		// Update
		$("#update").on("submit", function (event) {
			event.preventDefault();
			$.ajax({
				url:"{{url('/admin/editAdmin')}}",
				method: 'post',
				data: $("#update").serializeArray(),
				success: function (data) {
                    $("#submit_btn").show();

                    console.log(data);

                    if (data.code == 1) {
                        $("#edit").html(`
                        @component('utils.successModal',["code"=>"edit_admin"])

                        @endcomponent
                        `)
                        $("#submit_btn").hide();
                    } else if(data.code == -1){
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
                    } else {
                        $("#edit").html(`<div class="text-center"> <h3>Error Updating...</h3> <p>Bye</p></div>`);
                        $("#submit_btn").hide();
                    }
					$("#myModal").modal();
				},error: function (data) {
					$("#edit").html(`<div class="text-center"> <h3>ERROR Updating...</h3> <p>Bye</p></div>`);
                    $("#submit_btn").hide();
                    console.log(data);

				}
			})
		});

    });
</script>
@endsection
