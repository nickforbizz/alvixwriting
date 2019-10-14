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
                    <a href="{{ route('Admin.home') }}">Dashboard  </a>
                </li>
                <li class="">
                    <a href="{{ route('Admin.onProgress') }}">onProgress >> </a>
                </li>
        </ol>
    </div>
    <div class="row">

        <div class="">
            <h2>Details of the Order</h2> <hr>
            <div class="well">
                <p> <b>Title:</b> <span class="text-uppercase">{{ $assg->title }}</span></p>
                <p> <b>Category:</b> <span class="text-uppercase">{{ $assg->category->name }}</span></p> 
                <p> <b>Type:</b> <span class="text-uppercase">{{ $assg->paperType->name }}</span></p>
                <p> <b>Format:</b> <span class="text-uppercase">{{ $assg->orderFormat->name }}</span></p>
                <p> <b>Language:</b> <span class="text-uppercase">{{ $assg->orderLanguage->name }}</span></p>
                <p> <b>Pages:</b> <span class="text-uppercase">{{ $assg->pages }}</span></p>
                <p> <b>words:</b> <span class="text-uppercase">{{ $assg->words }}</span></p>
                <p> <b>Amount:</b> <span class="text-uppercase">{{ $assg->amount }}</span></p>
                <p> <b>Deadline:</b> <span class="text-uppercase">{{ \Carbon\Carbon::parse($assg->deadline)->diffForhumans() }}</span></p>
                <p> <b>Description: </b><span class="text-justify">{{ $assg->description }}</span></p>
            </div>
            <div>
                    <h4><b>Available Files</b></h4> <hr>
    
                    @php( $idd = \App\Models\MediaFilesAssg::where('assg_id',$assg->id)->where('status', 1)->get())
                    @if( !$idd->isEmpty())
                        <ul class="list-group files">
                            <div class="row">
                                @foreach(\App\Models\MediaFilesAssg::where('assg_id',$assg->id)->where('status', 1)->get() as $media)
                                    <div class="col-sm-1" style="margin-top: 4rem; text-align:center">
                                        {{ $loop->iteration }}.
                                    </div>
                                    <div class="md col-sm-11 mt-2">
                                        <li class="list-group-item h6" ><b>Filename: </b> <i>{{ $media->name }} </i> <span class="badge ddoc"> <a href="{{ route('Admin.download',[$media->id]) }}">Download</a> </span></li>
                                        <li class="list-group-item"> <b>Type: </b>  <i> {{ $media->type }} </i></li>
                                    </div>
                                @endforeach
                            </div>
                        </ul>
                    @else
                    <p class="lead">No Files</p>
                    @endif
                </div>
        </div>

    </div>
</div>

@endsection