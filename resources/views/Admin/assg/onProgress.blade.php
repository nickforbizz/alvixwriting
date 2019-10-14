@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
                <li>
                    <a href="{{ route('Admin.home') }}">
                    <em class="fa fa-home"></em>
                    </a>
                </li>
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
                   On Progress Assignments
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="dataTable_wrapper">
                        <table  id="example" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th> Category</th>
                                    <th>Pages</th>
                                    <th>Amount </th>
                                    <th>Date Posted </th>
                                    <th>Writer</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach (App\Models\Onprogressassignment::where('status', 1)
                                        ->where('active', 1)
                                        ->latest()
                                        ->get() as $on_progress)


                            @if ( $on_progress->Assignment->admin_id == Auth::guard('admin')->user()->id)
                            
                                <tr class="tb_data" data-id='{{ $on_progress->id }}'>
                                    <td> {{ $loop->iteration }}</td>
                                    <td> {{ $on_progress->Assignment->title }} </td>
                                    <td> {{ $on_progress->Assignment->category->name }} </td>
                                    <td> {{ $on_progress->Assignment->pages }} </td>
                                    <td> {{ $on_progress->Assignment->amount }} </td>
                                    <td> {{ $on_progress->created_at->diffForHumans() }} </td>
                                    <td> {{ $on_progress->writer->username }} </td>
                                    <td> 
                                        <button class="btn btn-important">
                                            <a href="{{ route('Admin.order',[$on_progress->Assignment->id]) }}" class="td-none">View Order</a>
                                        </button>
                                    </td>
                                    <td> 
                                            <button class="btn btn-important">
                                                <a href="{{ route('Admin.addfiles',[$on_progress->Assignment->id]) }}" class="td-none">Add File(s)</a>
                                            </button>
                                    </td>
                                </tr>
                            @endif
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
