@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">
                <a href="{{ route('Admin.home') }}">Dashboard </a>
            </li>
            <li> Progress Review Orders </li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- Tables  -->
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                    All Assignments Under Review
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Pages</th>
                                    <th>Writer</th>
                                    <th>Comment</th>
                                    <th>Time Uploaded </th>
                                    <th colspan="4">Action </th>
                                    
                                </tr>
                            </thead>
                            <tbody>

                            @foreach (App\Models\Onreviewassignment::where('status', 1)->where('active', 1)->get() as $assgReview)
                             <tr class="tb_data" data-id='{{ $assgReview->id }}' >
                                 <td> {{ $loop->iteration }}</td>
                                 <td> {{ $assgReview->OnprogressAssignment->Assignment->title }} </td>
                                 <td> {{ $assgReview->OnprogressAssignment->Assignment->category->name }} </td>
                                 <td> {{ $assgReview->OnprogressAssignment->Assignment->pages }} </td>
                                 <td> {{ $assgReview->writer->username }} </td>
                                 <td> {{ $assgReview->upload_comment }} </td>
                                 <td> {{ $assgReview->created_at->diffForHumans() }} </td>
                                 
                                 <td>
                                     <button class="btn btn-success confirm" data-id='{{ $assgReview->id }}' data-writer="{{ $assgReview->writer->id }}">Confirm</button>
                                 </td>
                                 <td>
                                     <button class="btn btn-danger reject" data-id='{{ $assgReview->id }}' data-writer="{{ $assgReview->writer->id }}">Reject</button>
                                 </td>
                                 <td> 
                                    <button class="btn btn-important">
                                        <a href="{{ route('Admin.order',[$assgReview->OnprogressAssignment->Assignment->id]) }}" class="td-none">View Order</a> 
                                    </button>
                                </td>
                                <td> 
                                    <button class="btn btn-important">
                                        <a href="{{ route('Admin.order',[$assgReview->OnprogressAssignment->Assignment->id]) }}" class="td-none">Writers Work</a> 
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
            $('.confirm').on('click', function () {
                let confirm_id = $(this).attr('data-id');
                let writer_id = $(this).attr('data-writer');
                x_data('confirmOrder', confirm_id, writer_id);
                // console.log(confirm_id)
            });
            $('.reject').on('click', function () {
                let reject_id = $(this).attr('data-id');
                let writer_id = $(this).attr('data-writer');

                whyReject('rejectOrder', reject_id, writer_id);

                // {{--x_data('rejectOrder', reject_id, writer_id,);--}}

            });
            $('#update').submit(function (event) {
                event.preventDefault();
                    $.ajax({
                        url:"{{url('/admin/rejectOrder')}}",
                        method: 'post',
                        data: $("#update").serializeArray(),
                        success: function (data) {
                            console.log(data);
                            if (data.code == 1) {
                                $("#edit").html(`
                                        @component('utils.successModal',["code"=>"user_edited"])
                                        @endcomponent
                                    `);
                                // $(this).attr('data-id').fadeOut();
                                $("#submit_btn").hide();
                                setTimeout(() => {
                                    location.reload();
                                }, 1400);
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
                });

                $("#myModal").modal("hide");
            })

        });

        function x_data(url='', id='', writer_id=''){
            $.ajax({
                url:''+url+'/' + id +'/'+writer_id,
                method: 'get',
                success: function (data) {
                    // data = JSON.parse(data);
                    console.log(data);


                    $("#edit").html('');

                    if (data.code == 1) {
                        $("#edit").html(`
                            @component('utils.successModal',["code"=>"Success"])

                                @endcomponent
                            `)
                        $(id).fadeOut();

                        alert("success");
                        setInterval(() => {
                            location.reload();
                            
                        }, 1500);
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
        // end x-data()
        function whyReject(url='', id='', writer_id='') {
            $('#edit').html(
                `
                 @component('utils.editModal', ['code'=>'confirmReject'])
                 @endcomponent
                `
            );
            $("#myModal").modal();
            // alert("some");


        }

 
    </script>
@endsection
