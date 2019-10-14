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
                            <a href="{{ route('Web.home') }}">Dashboard >> </a>
                        </li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-right arriveOrders">
                         New Orders
                    </div>
                    <h3 class="page-header">Assignments Pending-Payment:</h3>
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
                                    <th>Completed At</th>
                                    <th>Category</th>
                                    <th>Pages </th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\AssgPendingPayment::where('status', 1)
                                            ->where('active', 1)
                                            ->where('writer_id', Auth::guard('web')->user()->id)
                                            ->get() as $pending_pay)
                                <tr class="tb_data" data-id=' {{ $pending_pay->id }}'>
                                    <td> {{ $loop->iteration  }}</td>
                                    <td> {{ $pending_pay->onreviewassignment->onprogressassignment->assignment->title }} </td>
                                    <td> {{ $pending_pay->created_at->diffForhumans()}} </td>
                                    <td> {{ $pending_pay->onreviewassignment->onprogressassignment->assignment->category->name }} </td>
                                    <td> {{ $pending_pay->onreviewassignment->onprogressassignment->assignment->pages }} </td>
                                    <td> {{ $pending_pay->onreviewassignment->onprogressassignment->assignment->words }} </td>
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



    });

    function xg_data(order_id, writer_id) {
        $.ajax({
            url:'/web/payOrder/' + order_id+'/'+writer_id,
            method: 'get',
            success: function (data) {
                // data = JSON.parse(data);
                console.log(data);


                $("#edit").html('');

                if (data.code == 1) {
                    $("#edit").html(`
                    @component('utils.successModal',["code"=>"Order Paid"])

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
