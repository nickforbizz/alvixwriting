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
            <li> Revisions </li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
        <!-- Tables  -->
            <div class="panel panel-default col-md-12">
                <div class="panel-heading">
                   Revision Assignments
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>#id</th>
                                    <th>Title</th>
                                    <th>Deadline</th>
                                    <th>Created At </th>
                                    <th>Writer </th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($revisions as $on_revision)
                            <tr class="tb_data" data-id='{{ $on_revision->id }}'>
                                 <td> {{ $loop->iteration }}</td>
                                 <td> {{ $on_revision->onreviewassignment->onprogressassignment->assignment->title }} </td>
                                 <td> {{ $on_revision->onreviewassignment->onprogressassignment->assignment->deadline }} </td>
                                 <td> {{ $on_revision->created_at->diffForHumans() }} </td>
                                 <td> {{ $on_revision->writer->username }} </td>
                                 <td> 
                                    <button class="btn btn-important">
                                        <a href="{{ route('Admin.order',[$on_revision->onreviewassignment->onprogressassignment->assignment->id]) }}">View Order</a>
                                    </button>
                                </td>
                                <td> 
                                    <button class="btn btn-important">
                                        <a href="{{ route('Admin.order',[$on_revision->onreviewassignment->onprogressassignment->assignment->id]) }}">Reassign Order</a>
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
