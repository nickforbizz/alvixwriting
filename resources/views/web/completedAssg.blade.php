@extends('web.layoutsWeb.appWriter')

@section('content')


    <!-- ________________________Lumino________________________________________________________ -->


    <!-- body -sideNav and main -->


        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Writer_Portal/Completed</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-right arriveOrders">New Orders</div>
                    <h3 class="page-header">Completed Assignments:</h3>
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (App\Models\CompletedAssignment::where('status', 1)
                                            ->where('active', 1)
                                            ->where('writer_id', Auth::guard('web')->user()->id)
                                            ->get() as $review)
                                <tr class="tb_data" data-id=' {{ $review->id }}'>
                                    <td> {{ $loop->iteration  }}</td>
                                    <td> {{ $review->assgPendingPayment->onreviewassignment->onprogressassignment->assignment->title }} </td>
                                    <td> {{ $review->assgPendingPayment->onreviewassignment->onprogressassignment->assignment->deadline }} </td>
                                    <td> {{ $review->assgPendingPayment->onreviewassignment->onprogressassignment->assignment->category }} </td>
                                    <td> {{ $review->assgPendingPayment->onreviewassignment->onprogressassignment->assignment->pages }} </td>
                                    <td> {{ $review->assgPendingPayment->onreviewassignment->onprogressassignment->assignment->words }} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->






                    <div class="container">
                       {{--  <h2>Activate Modal with JavaScript</h2>
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-info btn-lg" id="myBtn">Open Modal</button>
 --}}
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Modal Header</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Some text in the modal.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>








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

        $(document).ready(function(){
            $("#myBtn").click(function(){
                alert("ewdewd");
                $("#myModal").modal();
            });
        });

      $(document).ready(function () {
         // Take Order
             {{--$(document).on("click",'.'+tag, function () {--}}
                    {{--var order_id = $(this).attr("data-id");--}}
                    {{--var writer_id = {{ Auth::guard('web')->user()->id  }}--}}
             {{--});--}}

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
{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}