@extends('web.layoutsWeb.appWriter')
@section('top-styles')
    <style>

        .ddoc{
            float: right;
            padding: 7px;
            background-color: antiquewhite;
            color: black;
        }
        .md{
            margin-bottom: 10px;
        }
        .box-shadow{
            box-shadow: 3px 3px 20px -8px grey;
        }
    </style>
    @endsection

@section('content')
<div class="col-12 main">
    <div class="row">
        <div class="col-12" style="position: fixed;
        width: -webkit-fill-available;
        z-index: 22;">
            <div class="pull-right" style="margin: 20px;
            font-size: x-large;">
               <a href="{{ route('Web.home') }}">
                 <em class="fa fa-home">&nbsp;</em> Home
               </a>
            </div>
            <ol class="breadcrumb" style="font-size:30px">
                <li><a href="{{ route('Web.home') }}">
                    <em class="fa fa-refresh"></em>
                </a></li>
                <li class="active"><a href="{{ route('Web.orders') }}">Available Orders</a></li>
            </ol>
        </div>
    </div><!--/.row-->



     <br> <br>
    <div class="row container-fluid">
        <div style="margin:40px"></div>
        <div class="XXallOrder ">
        <div class="XXmainOrder col-md-8 col-sm-12">
            <h3> Order Details</h3>
            <hr>

            <div class="box-shadow" style="padding: 10px">

                <div>
                    <h4><b>Title</b></h4>
                    {{ $order->title }}
                </div>

                <div>
                    <h4><b>Description</b> </h4>
                    {{ $order->description }}
                </div>


                <div>
                    <h4><b>Medias</b></h4>

                    @php( $idd = \App\Models\MediaFilesAssg::where('assg_id',$order->id)->where('status', 1)->get())
                    @if( !$idd->isEmpty())
                        <ul class="list-group">
                        @foreach(\App\Models\MediaFilesAssg::where('assg_id',$order->id)->where('status', 1)->get() as $media)
                            <div class="md">
                                <li class="list-group-item">{{ $media->name }} <span class="badge ddoc"> <a href="{{ route('Web.downloadOrder', ['order_id'=>$order->id]) }}">Download</a> </span></li>
                                <li class="list-group-item">Type<span class="badge"> {{ $media->type }} </span></li>
                            </div>
                        @endforeach
                        </ul>
                    @else
                    <p class="lead">No Media for this Order</p>
                    @endif
                </div>

                <div class="row">
                    
                    <div class="col-sm-12 shadow">



                        @if(\App\Models\Onprogressassignment::where('status',1)
                        ->where('active', 1)
                        ->where('writer_id', Auth::guard('web')
                                            ->user()
                                            ->id)
                        ->count() 
                        > 2)

                            <hr>
                        <div class="pull-right" style="margin-right:20px;">

                        <button class="btn btn-warning" disabled>Cant Take order</button>

                        </div>
                        <p class="">Finish the assignment on progress first</p>

                        @else
                            <div class="pull-right" style="margin-right:20px;">

                                <button class="btn btn-success take-order"  data-id="{{ $order->id }}">Take</button>

                            </div>
                        @endif

                    </div>
                </div>

            </div>

       
        </div>

        <!-- .XXmainOrder -->




        <div class="XXorderSide2 col-md-4 col-sm-12">
            <h3>Additional Details</h3>
            <hr>

            <div class="box-shadow" style="padding: 10px">

                <div>
                    <h5><b>Required Pages</b></h5>
                    {{ $order->pages }}
                </div>

                <div>
                    <h5><b>Amount</b></h5>
                    {{ $order->amount }}
                </div>


                <div>
                    <h5><b>Date Posted</b></h5>
                    {{ $order->created_at->diffForHumans() }}
                </div>


                <div>
                    <h5><b>Deadline</b></h5>
                    {{ $order->deadline }}
                </div>

                <div>
                    <h5><b>Paper Format</b></h5>
                    {{ $order->OrderFormat->name }}
                </div>

                <div>
                    <h5><b>Paper Type</b></h5>
                    {{ $order->PaperType->name }}
                </div>
                
                <div>
                    <h5><b>Language</b></h5>
                    {{ $order->OrderLanguage->name }}
                </div>
            </div>
          
        </div>
        <!-- .XXorderSide2 -->


        </div>
        <div class="col-md-10 col-md-offset-1">


        </div>
    </div>

</div>
@endsection


@section('bottom-scripts')
    <script>

        $(document).ready(function () {
            // Take Order
            $(document).on("click",".take-order", function () {
                // alert();
                var order_id = $(this).attr("data-id");
                var writer_id = '{{ Auth::guard('web')->user()->id  }}'


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
                                `);
                            // location.reload();
                            window.location = ('/web/progressAssg');
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
                });
                // .ajax
            });
            //.take-order
        });

    </script>
@endsection
