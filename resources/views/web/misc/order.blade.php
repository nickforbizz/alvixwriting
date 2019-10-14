@extends('web.layoutsWeb.appWriter')

@section('content')


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

    <div class="row">

        <div class="">
            <h2>Details of the Order</h2> <hr>
            <div class="well">
                <p> <b>Title:</b> <span class="text-uppercase">{{ $assg->title }}</span></p>
                <p> <b>Category:</b> <span class="text-uppercase">{{ $assg->category }}</span></p>
                <p> <b>Pages:</b> <span class="text-uppercase">{{ $assg->pages }}</span></p>
                <p> <b>Amount:</b> <span class="text-uppercase">{{ $assg->amount }}</span></p>
                <p> <b>Format:</b> <span class="text-uppercase">{{ $assg->order_format }}</span></p>
                <p> <b>Paper Type:</b> <span class="text-uppercase">{{ $assg->paper_type }}</span></p>
                <p> <b>Language:</b> <span class="text-uppercase">{{ $assg->lang }}</span></p>
                <p> <b>Deadline:</b> <span class="text-uppercase">{{ \Carbon\Carbon::parse($assg->deadline)->diffForhumans() }}</span></p>
                <p> <b>Description: </b><span class="text-justify">{{ $assg->description }}</span></p>
            </div>
            <div>
                    <h4><b>Medias</b></h4>
    
                    @php( $idd = \App\Models\MediaFilesAssg::where('assg_id',$assg->id)->where('status', 1)->get())
                    @if( !$idd->isEmpty())
                        <ul class="list-group">
                        @foreach(\App\Models\MediaFilesAssg::where('assg_id',$assg->id)->where('status', 1)->get() as $media)
                            <div class="md">
                                <li class="list-group-item">{{ $media->name }} <span class="badge ddoc"> <a href="">Download</a> </span></li>
                                <li class="list-group-item">Type<span class="badge"> {{ $media->type }} </span></li>
                            </div>
                        @endforeach
                        </ul>
                    @else
                    <p class="lead">No Media for this assg</p>
                    @endif
                </div>
        </div>

    </div>
</div>

@endsection