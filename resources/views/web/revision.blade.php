@extends('web.layoutsWeb.appWriter')

@section('content')


    <!-- ________________________Lumino________________________________________________________ -->


    <!-- body -sideNav and main -->


        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                        <li>
                            <a href="{{ route('Web.home') }}">
                            <em class="fa fa-home"></em>
                            </a>
                        </li>
                        <li class="active">
                            <a href="{{ route('Web.home') }}">Dashboard  </a>
                        </li>
                        <li class="active">
                            Revision
                        </li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-right arriveOrders">New Orders</div>
                    <h3 class="page-header">Assignments Under Revision:</h3>
            <p class="lead"> Note that you are warned upon revision, This decreases your ratings</p>

                </div>
                <div class="col-12">
                    <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Title</th>
                                    <th>Deadline</th>
                                    <th>Warning</th>
                                    <th>Rejected at</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($revisions as $on_revision)
                                <tr class="tb_data" data-id=' {{ $on_revision->id }}'>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $on_revision->onreviewassignment->onprogressassignment->assignment->title }} </td>
                                    <td> {{ \Carbon\Carbon::parse($on_revision->onreviewassignment->onprogressassignment->assignment->deadline)->diffForhumans() }} </td>
                                    <td  class="bg-danger"> at level {{ $on_revision->warn }} </td> 
                                    <td> {{ $on_revision->created_at->diffForhumans() }} </td>

                                    <td>
                                        <button class="btn btn-important btn-sm upload-order" data-id="{{ $on_revision->id }}">
                                            <a href="{{ route('Web.uploadAssg',['type'=>'onrevision','id'=>$on_revision->id]) }}">Upload</a>
                                        </button>
                                    </td>
                                    <td> 
                                        <button class="btn btn-secondary btn-sm " data-id="{{ $on_revision->onreviewassignment->onprogressassignment->assignment->id }}">
                                            <a href="{{ route('Web.orderfile',['id'=>$on_revision->onreviewassignment->onprogressassignment->assignment->id]) }}" class="text-white">View Order</a>                                        
                                        </button>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->

                </div>
                <!-- /.panel-body -->
                </div>
            </div><!--/.row-->


        </div>
        <!--/.main-->
    <!-- ________________________Lumino ends____________________________________________________ -->

@endsection

@section('bottom-scripts')
    <script>
      $(document).ready(function () {
         // Take Order
         tag = '';
         $(document).on("click",'.'+tag, function () {
                var order_id = $(this).attr("data-id");
                var writer_id = {{ Auth::guard('web')->user()->id  }}
         });

    });

    function xg_data(tag) {
        $.ajax({
            url:'/web/takeOrder/' + order_id+'/'+writer_id,
            method: 'get',
            success: function (data) {
                // data = JSON.parse(data);
                console.log(data);


                $("#edit").html('');

                if (data.code == 1) {
                    $("#edit").html(`
                    @component('utils.successModal',["code"=>"Order Taken"])

                    @endcomponent
                    `)
                    location.reload();
                } else if(data.code == -1){
                    var errs = $.map(data.errs, function(value, index) {
                        return [value];
                    });
                    console.log("some");

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
                }else {
                    $("#edit").html(`<div class="text-center"> <h3>Error Updating...</h3> <p>Bye</p></div>`);
                    $("#submit_btn").hide();
                }
                $("#myModal").modal();
            },
            error: function (err) {
                console.log(err);
                alert("Fatal Error Occurred");
                }
        })

    }
    </script>
@endsection
