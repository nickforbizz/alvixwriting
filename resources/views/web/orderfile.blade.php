@extends('web.layoutsWeb.appWriter')

@section('content')


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('Web.home') }}">
                <em class="fa fa-home"></em>
                </a>
            </li>
            <li class="active">
                <a href="{{ route('Web.home') }}">Dashboard</a>
            </li>
            <li>
                <a href="{{ route('Web.progressAssg') }}">Onprogress >> </a>
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



    {{-- comment if this order has been taken by a user --}}
    @if ($assg->taken == 1)

        <div class="row">
                <div class="col-sm-10 col-sm-offset-" id="logout">
                    <div class="page-header">
                        <h3 class="reviews">Order comments</h3>
                    
                    </div>
                    <div class="comment-tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="active"><a href="#comments-logout" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Comments</h4></a></li>
                            <li><a href="#add-comment" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Add comment</h4></a></li>
                        </ul>            
                        <div class="tab-content">
                            <div class="tab-pane active" id="comments-logout">                
                                <ul class="media-list">
                                    @foreach ($comments as $comment)
                                        
                                        @if ($comment->posted_by == 'writer')
                                            {{-- user --}}
                                            <li class="media">
                                                <a class="pull-left" href="#">
                                                <img class="media-object img-circle" height="80px" width="80px" src="{{ asset( 'storage/'.$userprofile)}}" alt="profile">
                                                </a>
                                                <div class="media-body">
                                                <div class="well well-lg">
                                                    <h4 class="media-heading text-lowercase reviews"> @ {{ Auth::guard('web')->user()->username }} </h4>

                                                    <p class="media-comment">
                                                        {{ $comment->comment }}
                                                    </p>
                                                    <div class="pull-right"><span class="glyphicon glyphicon-calendar"></span>Posted: <i>{{ $comment->created_at->diffForhumans() }}</i> </div>
                                                    <a href="#add-comment" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                                </div>              
                                                </div>
                                    
                                            </li>
                                        @else
                                            {{-- admin --}}
                                            <li class="media">
                                                <a class="pull-right" href="#">
                                                    <img class="media-object img-circle" height="80px" width="80px" src="{{ asset('storage/'.$adminprofile) }}" alt="profile">
                                                </a>
                                                <div class="media-body">
                                                    <div class="well well-lg">
                                                        <h4 class="media-heading text-lowercase reviews"> @ {{ $comment->admin->username }} </h4>

                                                        <p class="media-comment">
                                                            {{ $comment->comment }}
                                                        </p>
                                                        <div class="pull-right"><span class="glyphicon glyphicon-calendar"></span>Posted: <i>{{ $comment->created_at->diffForhumans() }}</i> </div>
                                                        <a href="#add-comment" role="tab" data-toggle="tab"><span class="glyphicon glyphicon-share-alt"></span> Reply</a>
                                                    </div>              
                                                </div>
                                    
                                            </li>  
                                        @endif
                                        

                                    @endforeach                            
                                </ul> 
                            </div>
                            <div class="tab-pane" id="add-comment">
                                <form action="{{ route('Web.orderComments') }}" method="post" class="form-horizontal" id="commentForm" role="form"> 
                                    
                                    <input type="hidden" name="order_id" value="{{ $assg->id }}">
                                    <input type="hidden" name="posted_by" value="writer">
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">Comment</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" name="addComment" id="addComment" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="uploadMedia" class="col-sm-2 control-label">Attach File</label>
                                        <div class="col-sm-10">                    
                                            <div class="input-group">
                                            <div class="input-group-addon">http://</div>
                                            <input type="text" class="form-control" name="uploadMedia" id="uploadMedia">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">                    
                                            <button class="btn btn-success btn-circle text-uppercase" type="submit" id="submitComment"><span class="glyphicon glyphicon-send"></span> Summit comment</button>
                                        </div>
                                    </div>            
                                </form>
                            </div>
                        
                        </div>
                    </div>
                </div>
        </div>
    @endif   


        </div>

@endsection