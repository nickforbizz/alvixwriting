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
                    <a href="{{ route('Admin.home') }}">Dashboard >> </a>
                </li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- Tables  -->
                        <div class="panel panel-default col-md-12">
                            <div class="panel-heading">
                               Pending Payment Assignments
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>#id</th>
                                                <th>Writer </th>
                                                <th>Title</th>
                                                <th> Category</th>
                                                <th>Pages</th>
                                                <th>Amount paid</th>
                                                <th>Time Verified </th>
                                                <th>Payment</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach (App\Models\AssgPendingPayment::where('status', 1)
                                         ->where('active', 1)
                                            ->get() as $pending_pay)
										<tr class="tb_data" id="p{{ $pending_pay->id }}" data-id='{{ $pending_pay->id }}'>
											 <td> {{ $loop->iteration }}</td>
											 <td> {{ $pending_pay->onreviewassignment->onprogressassignment->writer->username }} </td>
											 <td> {{ $pending_pay->onreviewassignment->onprogressassignment->Assignment->title }} </td>
											 <td> {{ $pending_pay->onreviewassignment->onprogressassignment->Assignment->category->name }} </td>
											 <td> {{ $pending_pay->onreviewassignment->onprogressassignment->Assignment->pages }} </td>
											 <td> {{ $pending_pay->onreviewassignment->onprogressassignment->Assignment->amount }} </td>
											 <td> {{ $pending_pay->created_at->diffForHumans() }} </td>
                                            <td>
                                                <button class="btn btn-info pay"  data-id=' {{ $pending_pay->id }}'>pay</button>
                                            </td>
                                            <td> 
                                                <button class="btn btn-important">
                                                    <a href="{{ route('Admin.order',[$pending_pay->onreviewassignment->onprogressassignment->Assignment->id]) }}">View Order</a>
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
                        <!-- /.panel -->
            <!-- Tables-->
        </div>
    </div>
</div>
@endsection
@section('bottom-scripts')
    <script !src="">
        $(document).ready(function () {
            // Take OrderpayVerified
            $(document).on("click",'.pay', function () {
                var order_id = $(this).attr("data-id");
                verifyPay(order_id)

            });
            // Pay Order
            $(document).on("click",'.payVerified', function () {
                // Update
                $("#update").on("submit", function (event) {
                    event.preventDefault();
                    $.ajax({
                        url:"{{route('Admin.payOrder')}}",
                        method: 'post',
                        data: $("#update").serializeArray(),
                        success: function (data) {
                            $("#submit_btn").show();

                            console.log(data);

                            if (data.code == 1) {
                                $("#edit").html(`
                                @component('utils.successModal',["code"=>"user_edited"])

                                 @endcomponent
                                    `);
                                let att = $("#order").val();
                                location.reload();
                                $("#myModal").modal("hide");
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
                //end update


            });
            // end
        })
        function verifyPay(o) {
            $('#edit').html(`
            @component('utils.editModal', ['code'=>'verifypayment'])
                    @endcomponent
                `)
            $('#myModal').modal();
        }
    </script>
@endsection
{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}
<!--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com-->