@extends('Admin.layouts.app')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <div class="row">
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('Admin.home') }}">
                        <em class="fa fa-home"></em>
                        </a></li>
                    <li class="active">
                        <a href="{{ route('Admin.home') }}">Dashboard </a>
                    </li>
                    <li> Reasignment Process </li>
                </ol>
            </div>
            <!--/.row-->
            <div class="row" style="margin-top:20px">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Order Reasignment Process
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div id="collapserole" class="panel-collapse collapse show">
                            <div class="panel-body">
                                <form id="reasignOrder">

                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <input type="hidden" name="writer_id" value="{{ $writer->id }}">
                                    <input type="hidden" name="type" value="{{ $type }}">

                                    <input type="hidden" name="reviewrevision_id" value="{{ $review_revision }}">
                                    <input type="hidden" name="reviewprogress_id" value="{{ $review_progress }}">

                                    <div class="form-group col-md-6">
                                        <label for="title">Title:</label>
                                        <input type="text" name="title" class="form-control" readonly value="{{ $order->title }}"  id="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="writer">Current Writer:</label>
                                        <input type="text" name="writer" class="form-control" readonly value="{{ $writer->username }}"  id="name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="deadline">Adjust Deadline:</label>
                                        <input type="datetime-local" name="deadline" class="form-control" min=""  id="startDate" required>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="description">Reasignment Reason:</label>
                                        <textarea name="description"  class="form-control"  id="description" cols="20" rows="5" placeholder="Type here..." required></textarea>
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



    </div>

@endsection

@section('bottom-scripts')
<script>
        $(document).ready(function(){


            // add category
            $("#reasignOrder").on("submit", function (event) {
                event.preventDefault();
                $.ajax({
                    url:"{{url('/admin/reasignOrder')}}",
                    method: 'post',
                    data: $("#reasignOrder").serializeArray(),
                    success: function (data) {
                        $("#submit_btn").show();

                        console.log(data);

                        if (data.code == 1) {
                            $("#edit").html(`
                            @component('utils.successModal',["code"=>"role_added"])

                            @endcomponent
                            `);
                            $("#reasignOrder")[0].reset();
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
