

@extends('Admin.layouts.app')



@section('content')
   


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Dashboard/Approve/Writers</li>
        </ol>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            New Writers Pending Approval
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Bio</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($writers_pending as $writer)
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $writer->fname }}</td>
                                <td>{{ $writer->lname }}</td>
                                <td>{{ $writer->email }}</td>
                                <td>{{ $writer->bio }}</td>
                                <td>
                                    <button class="btn btn-important">
                                        <a href="{{ url('admin/veiwWritersTest/', [$writer->id]) }}">View Test</a> 
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
</div>


@endsection