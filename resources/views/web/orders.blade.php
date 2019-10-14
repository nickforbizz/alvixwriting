@extends('web.layoutsWeb.appWriter')

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
    <div class="row">
        <div style="margin:40px"></div>
        <div class="col-md-10 col-md-offset-1">

            @foreach (App\Models\Assignment::where('active', 1)->latest()->get() as $order)

                <div class="panel panel-default" style="background-color:#b9c4c8">
                    <div class="panel-heading" style="background-color:#d3e1db">
                        <div class="pull-right">
                            <h6>
                                <b> Deadline </b>
                                <p style="font-size: 15px">
                                <i> {{ \Carbon\Carbon::parse($order->deadline)->diffForhumans() }} </i>
                                </p>
                            </h6>

                        </div>
                        <h4> <b>Title</b> {{ $order->title }}</h4>
                    </div>
                    <div class="panel-body" style="padding:0px 10px 5px 15px !important;">
                        <div class="text-important" style="padding-top: 10px"><b>Amount</b>   Ksh:{{ $order->amount }}</div>
                        <h4> <b>Description</b> </h4>
                        <p class="">{{ $order->description }}</p>
                        <div class="row">
                        <div class="col-12">
                            {{--<div class="pull-right" style="margin-right:20px;">--}}
                            {{--<button class="btn btn-success take-order" data-id="{{ $order->id }}">View</button>--}}
                            {{--</div>--}}
                            <div class="pull-right" style="margin:0 20px 20px;">
                                <a href="{{ url('web/orderDetails/'.$order->id) }}">
                                <button type="button" class="btn btn-success" data-togglen="collapse"  data-target="#order-more{{ $order->id }}">View</button>
                                </a>

                            </div>
                        </div>
                    </div>
                        {{--collapse later--}}
                    <div class="row">
                        <div class="col-12">
                            <div id="order-more{{ $order->id }}" class="collapse" style="padding:30px 20px 5px 15px !important;">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

</div>
@endsection

