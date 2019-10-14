@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                    <em class="fa fa-home"></em>
                </a></li>
            <li class="active">Dashboard/FileDowload/Assignmentfile</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
            <!-- Tables  -->
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                     Assignments Files
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="list-group">
                        <a href="#" class="list-group-item active">Download This Document.</a>
                        <a href="{{ url('admin/download/'.$id) }}" class="list-group-item">Download <span class="badge"> <em class="fa fa-download"></em> </span></a>
                    </div>

                    {{--{{ $id }}--}}

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

        {{--id = {{$id}}--}}

        // $.ajax({
        //     url: 'download/'+id,
        //     method: 'get',
        //     success: function (data) {
        //         console.log(data);
        //         window.location = data;
        //     },error: function (data) {
        //         console.log(data);
        //         window.location = data;
        //
        //         alert("Could not download the File")
        //     }
        // })
    </script>
@endsection