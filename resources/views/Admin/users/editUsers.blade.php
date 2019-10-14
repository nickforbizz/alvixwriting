@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Dashboard/editUsers</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- Tables  -->
            <div class="panel panel-default col-md-12">
                @if (Auth::guard('admin')->user()->role->name == 'superadmin')
                <div class="panel-heading">
                    Edit Users
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
                                @foreach (App\Models\User::where('status', 1)->get() as $user)
                                <tr class="tb_data" data-id=' {{ $user->id }}'>
                                    <td> {{ $user->id }}</td>
                                    <td> {{ $user->username }} </td>
                                    <td> {{ $user->fname }} </td>
                                    <td> {{ $user->lname }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->mobile }} </td>
                                    <td> {{ $user->roles }} </td>
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
    @component('utils.modal_wrapper', ["title"=>"Edit This User"])

    @endcomponent
</div>
@endsection


@section('bottom-scripts')

<script>
	$(document).ready(function(){
        // get update
		$(document).on("click",".tb_data", function () {
			var user_id = $(this).attr("data-id");
			$.ajax({
				url:'/admin/getUser/' + user_id,
				method: 'get',
				success: function (data) {
                    // data = JSON.parse(data);
                    console.log(data.code);


					$("#edit").html('');

                    if (data.code == 1) {
                        $("#edit").html(`
                        @component('utils.editModal',["code"=>"edit_user"])

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
				url:"{{url('/admin/editUser')}}",
				method: 'post',
				data: $("#update").serializeArray(),
				success: function (data) {
                    $("#submit_btn").show();

                    console.log(data);

                    if (data.code == 1) {
                        $("#edit").html(`
                        @component('utils.editModal',["code"=>"user_edited"])

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
