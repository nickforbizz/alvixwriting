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
                    <li> Assignments Onprogress </li>
                    
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Assignments you are working on:</h3>
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
                                    <th>Category</th>
                                    <th>Pages </th>
                                    <th>Amount</th>
                                    <th colspan="3" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\OnprogressAssignment::where('status', 1)
                                            ->where('active', 1)
                                            ->where('returned', 0)
                                            ->where('writer_id', Auth::guard('web')->user()->id)
                                            ->get() as $order_progress)
                                <tr class="tb_data" data-id=' {{ $order_progress->id }}'>
                                    <td> {{ $loop->iteration  }}</td>
                                    <td> {{ $order_progress->assignment->title }} </td>
                                    <td> {{ \Carbon\Carbon::parse($order_progress->assignment->deadline)->diffForhumans() }} </td>
                                    <td> {{ $order_progress->assignment->category->name }} </td>
                                    <td> {{ $order_progress->assignment->pages }} </td>
                                    <td>Ksh {{ $order_progress->assignment->amount }} </td>

                                    <td>
                                        <button class="btn btn-important btn-sm upload-order" data-id="{{ $order_progress->assignment->id }}">
                                         <a href="{{ route('Web.uploadAssg',['type'=>'onprogress','id'=>$order_progress->assignment->id]) }}">Upload</a>
                                        </button>
                                    </td>
                                    <td> 
                                        <button class="btn btn-secondary btn-sm " data-id="{{ $order_progress->assignment->id }}">
                                         <a href="{{ route('Web.orderfile',['id'=>$order_progress->assignment->id]) }}" class="text-white">View Order</a>                                        
                                        </button>
                                     </td>
                                    @if ($order_progress->created_at > \Carbon\Carbon::now()->subMinutes(10)->toDateTimeString())
                                        <td> 
                                            <button class="btn btn-primary btn-sm cancel-order" data-id="{{ $order_progress->id }}">
                                                Return Order
                                                {{-- <a href="{{ route('Web.returnOrder',['id'=>$order_progress->id]) }}" class="text-white"></a>                                         --}}
                                         
                                            </button> 
                                        </td>
                                    @else
                                        <td>cant return</td>
                                    @endif

                                    
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
            $(document).on("click",'.'+tag, function () {
                    var order_id = $(this).attr("data-id");
                    var writer_id = {{ Auth::guard('web')->user()->id  }}
                    xg_data(order_id, writer_id);
            });
  
        });
        
        $(".cancel-order").click(function () {
            let id = ($(this).attr("data-id"));
            $("#edit").html(`
                <p class="well">Are you sure you want to return this order</p>
                <button class="btn btn-warning btn-sm reject-order">Yes</button> 
                <button class="btn btn-primary btn-sm" data-dismiss="modal">No</button> 
            `);
            $("#myModal").modal()
            $(".reject-order").click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/web/cancelOrder/'+ id,
                    method: 'get',
                    success: function(data){
                        console.log("order returned");
                        alert("order returned");
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },error: function (err) {
                        console.log(err);
                        alert("Fatal Error Occurred");
                    }
                })
                
            })
        });

    function xg_data(order_id, writer_id) {
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
