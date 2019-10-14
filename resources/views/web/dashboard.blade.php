@extends('web.layoutsWeb.appWriter')

@section('content')


    <!-- ________________________Lumino________________________________________________________ -->


    <!-- body -sideNav and main -->


        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Writer Portal</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    {{-- <div class="pull-right arriveOrders">New Orders</div> --}}
                    <h1 class="page-header">Writer's Portal  </h1>
                </div>
            </div><!--/.row-->


            <div class="panel panel-container">
                <div class="row">
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-teal panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-paper-plane-o"></em>
                                <div class="large">
                                    {{ $completedorders }}
                                        
                                </div>
                                <div class="text-muted">Completed Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-blue panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-clipboard color-orange"></em>
                                <div class="large"> 
                                        {{ $totalassgonprogress }} 
                                </div>
                                <div class="text-muted">Onprogress Orders </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-folder-open color-teal"></em>
                                <div class="large">
                                    {{ $totalrevisionassg }}
                                        
                                </div>
                                <div class="text-muted">Revision Orders</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-red panel-widget ">
                            <div class="row no-padding"><em class="fa fa-xl fa-paypal color-red"></em>
                                <div class="large">
                                    {{ $review_assg }}
                                        
                                </div>
                                <div class="text-muted">Review Orders</div>
                            </div>
                        </div>
                    </div>
                </div><!--/.row-->
            </div>

            <div class="row">
                <div class="col-xs-6 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>New Orders</h4>
                            <div class="easypiechart" id="easypiechart-blue"
                                 data-percent="
                                     {{
                                        $neworders
                                     }}
                                      " >
                                <span class="percent">
                                    {{
                                        $neworders
                                     }} %
                                </span></div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Comments</h4>
                            <div class="easypiechart" id="easypiechart-orange"
                                 data-percent="
                                 {{ $totalusercomments }}
                                            " >
                                <span class="percent">
                                 {{ $totalusercomments }}
                                 %
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!--/.row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default chat">
                        <div class="panel-heading">
                            Chat With Admin
                            <ul class="pull-right panel-settings panel-button-tab-right">
                                <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                    <em class="fa fa-cogs"></em>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <ul class="dropdown-settings">
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 1
                                                </a></li>

                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <div class="panel-body" >
                            @foreach(\App\Models\Chat::where('status', 1)->get() as $chat)
                                @if(\App\Models\ChatsAdmin::where('chat_id', $chat->id)->first())

                                    <ul v-chat-scroll>
                                        <li class="left clearfix"><span class="chat-img pull-left">
                                            <img src="{{ asset('assets/writersBay/img/3d_graffiti_background_i-wallpaper-2560x1600.jpg') }}" alt="User Avatar" height="40px" width="40px" class="img-circle" />
                                            </span>

                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font"> {{ \App\Models\ChatsAdmin::where('chat_id', $chat->id)->first()->admin->username }}
                                                    </strong>
                                                    <small class="text-muted"> {{ \App\Models\ChatsAdmin::where('chat_id', $chat->id)->first()->updated_at->diffForHumans() }}</small>
                                                </div>
                                                <p> {{ $chat->body}} </p>
                                            </div>

                                        </li>
                                    </ul>
                                @elseif(\App\Models\ChatsUser::where('chat_id', $chat->id)->where('writer_id', Auth::guard('web')->user()->id)->first())

                                    <ul>
                                        <li class="left clearfix"><span class="chat-img pull-right">
                                            <img src="{{ asset('assets/writersBay/img/3d_graffiti_background_i-wallpaper-2560x1600.jpg') }}" alt="User Avatar" height="40px" width="40px" class="img-circle" />
                                            </span>

                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font"> {{ \App\Models\ChatsUser::where('chat_id', $chat->id)->first()->writer->username }}
                                                    </strong>
                                                    <small class="text-muted"> {{ \App\Models\ChatsUser::where('chat_id', $chat->id)->first()->updated_at->diffForHumans() }}</small>
                                                </div>
                                                <p> {{ $chat->body}} </p>
                                            </div>

                                        </li>
                                    </ul>
                                @endif
                            @endforeach
                        </div>
                        <div class="panel-footer">
                            <form id="webChart">
                            <div class="input-group">
                                <input id="btn-input" type="text" name="chatUser" class="form-control input-md" placeholder="Type your message here..."  required/>
                                <span class="input-group-btn">
                                    <input class="btn btn-primary btn-md" type="submit" id="btn-chat">Send</input>
                                </span>
                                </div>
                            </form>
                            </div>

                    </div>

                </div><!--/.col-->


                <div class="col-md-6">
                    <div class="panel panel-default ">
                        <div class="panel-heading">
                            Timeline
                            <ul class="pull-right panel-settings panel-button-tab-right">
                                <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                    <em class="fa fa-cogs"></em>
                                </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <ul class="dropdown-settings">
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 1
                                                </a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 2
                                                </a></li>
                                                <li class="divider"></li>
                                                <li><a href="#">
                                                    <em class="fa fa-cog"></em> Settings 3
                                                </a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <div class="panel-body timeline-container">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-badge"><em class="glyphicon glyphicon-pushpin"></em></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge primary"><em class="glyphicon glyphicon-link"></em></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge"><em class="glyphicon glyphicon-camera"></em></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer at sodales nisl. Donec malesuada orci ornare risus finibus feugiat.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-badge"><em class="glyphicon glyphicon-paperclip"></em></div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">Lorem ipsum dolor sit amet</h4>
                                        </div>
                                        <div class="timeline-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div><!--/.col-->
                <div class="col-sm-12">
                    <p class="back-link">WritersBay<a href="https://www.medialoot.com">@mombex</a></p>
                </div>
            </div><!--/.row-->
        </div>
        <!--/.main-->
    <!-- ________________________Lumino ends____________________________________________________ -->

@endsection
@section('bottom-scripts')
    <script !src="">
        $("#webChart").on("click", function (event) {
            event.preventDefault();
            $.ajax({
                url:"{{route('Web.webMsg')}}",
                method: 'post',
                data: $("#webChart").serializeArray(),
                success: function (data) {
                    $("#submit_btn").show();

                    console.log(data);

                    if (data.code == 1) {
                        $("#edit").html(`
                                @component('utils.successModal',["code"=>"user_edited"])

                                @endcomponent
                            `);
                        let att = $("#order").val();
                        location.reload();
                        $("#myModal").modal("hide");
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
        })

    </script>
@endsection
{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}
<!--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com-->