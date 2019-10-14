@extends('Admin.layouts.app')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ route('Admin.home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Dashboard/Roles</li>
                </ol>
            </div>
            <!--/.row-->
            <div class="row" style="margin-top:20px">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Roles
                            <div class="pull-right">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" href="#collapjserole"><em class="fa fa-toggle-up"></em></a>
                                    </h4>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div id="collapserole" class="panel-collapse collapse show">
                            <div class="panel-body">
                                <form id="addRole">

                                    <div class="form-group col-md-12">
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name"  id="name" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="description">description:</label>
                                        <textarea name="description"  class="form-control"  id="description" cols="20" rows="5" placeholder="Type Description" required></textarea>
                                    </div>

                                    {{csrf_field() }}

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-right" style="margin-right:30px;">
                                                <input type="submit" class="btn btn-sm btn-success">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:30px">
                <div class="col-md-12">
                    <!-- Tables  -->
                    <div class="panel panel-default">

                        <div class="panel-heading">
                            Edit Roles
                        </div>
                        @if (Auth::guard('admin')->user()->role->name == 'superadmin')
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>#id</th>
                                            <th>name</th>
                                            <th>Description</th>
                                            <th>created_at</th>
                                            <th>updated_at</th>
                                            <th>Edit</th>
                                            <th>Del</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (App\Models\Role::where('status', 1)->get() as $role)
                                        <tr class="tb_data" >
                                            <td> {{ $role->id }}</td>
                                            <td> {{ $role->name }} </td>
                                            <td> {{ $role->description }} </td>
                                            <td> {{ ($role->created_at->diffForHumans()) }} </td>
                                            <td> {{ ($role->updated_at->diffForHumans()) }} </td>
                                            <td> <button class="btn btn-info btn-sm edit-role" data-id=' {{ $role->id }}'>Edit</button> </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm del-role" data-id=' {{ $role->id }}'>Del</button>
                                            </td>
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

                                <div class="crdj">
                                    <div class="alert alert-waning">
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
            @component('utils.modal_wrapper', ["title"=>" Roles"])

            @endcomponent

    </div>

@endsection

@section('bottom-scripts')
<script>
        $(document).ready(function(){
            // get update
            $(document).on("click",".edit-role", function () {
                var role_id = $(this).attr("data-id");
                $.ajax({
                    url:'/admin/getRole/' + role_id,
                    method: 'get',
                    success: function (data) {
                        // data = JSON.parse(data);
                        console.log(data.data.description);


                        $("#edit").html('');

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.editModal',["code"=>"edit_category"])

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
                    url:"{{url('/admin/editRole')}}",
                    method: 'post',
                    data: $("#update").serializeArray(),
                    success: function (data) {
                        $("#submit_btn").show();

                        console.log(data);

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.successModal',["code"=>"user_edited"])

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

            // add role
            $("#addRole").on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url:"{{url('/admin/addRole')}}",
                    method: 'post',
                    data: $("#addRole").serializeArray(),
                    success: function (data) {
                        $("#submit_btn").show();

                        console.log(data);

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.successModal',["code"=>"role_added"])

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

            //del role
            $(document).on("click", ".del-role", function () {
                id = $(this).attr("data-id");
                viewVerify(id);
            })

        });

        function callServer(formId, url) {
            $("#"+formId).on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url:"{{url('/"+ url +"')}}",
                    method: 'post',
                    data: $("#"+formId).serializeArray(),
                    success: function (data) {
                        $("#submit_btn").show();

                        console.log(data);

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.successModal',["code"=>"role_added"])

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
        }

        function getData(url, id, type="") {
            $.ajax({
                url:'/'+url+'/' + id,
                method: 'get',
                success: function (data) {
                    // data = JSON.parse(data);
                    console.log(data);
                        $("#edit").html('');
                    if (type == "delRole") {
                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.successModal',["code"=>"edit_role"])

                            @endcomponent
                            `)
                            $("#submit_btn").hide();
                        }
                    }else{

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.editModal',["code"=>"edit_role"])

                            @endcomponent
                            `)
                            $("#submit_btn").hide();
                        }else {
                            $("#edit").html(`<div class="text-center"> <h3>Error Updating...</h3> <p>Bye</p></div>`);
                            $("#submit_btn").hide();
                        }
                    }

                    $("#myModal").modal();
                },
                error: function (err) {console.log(err);}
            });
        }

        function verify(verify, id) {
            console.log(verify+'/'+id);

            if (verify == 0) {
                getData("admin/delRole", id,  "delRole");
            } else {
                $("#edit").html(`
                <p class="lead">Role not deleted</p>
                `)
            }
                $("#myModal").modal();
        }
        function viewVerify(id){
            $("#edit").html(`
            @component('utils.VerifyModal',["code"=>"role_added"])
            @endcomponent
            `)
            $("#myModal").modal();

        }
    </script>

@endsection
