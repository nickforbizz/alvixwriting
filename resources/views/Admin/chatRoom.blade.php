@extends('Admin.layouts.app')

@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ route('Admin.home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Dashboard/ChatRoom</li>
                </ol>
            </div>
            <!--/.row-->
            <div class="row" style="margin-top:20px">


                <div class="col-md-12">
                    <div class="panel panel-default chat">
                        <div class="panel-heading">
                             Chat With This Writer
                            <ul class="pull-right panel-settings panel-button-tab-right">
                                <li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
                                        <em class="fa fa-user"></em>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>

                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
                        <div class="panel-body">

                            @foreach(\App\Models\Chat::where('status', 1)->get() as $chat)
                                @if(\App\Models\ChatsAdmin::where('chat_id', $chat->id)->where('writer_id',$id)->first())

                                    <ul>
                                        <li class="left clearfix"><span class="chat-img pull-right">
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
                                @elseif(\App\Models\ChatsUser::where('chat_id', $chat->id)->where('writer_id', $id)->first())

                                    <ul>
                                        <li class="left clearfix"><span class="chat-img pull-left">
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
                            <form id="AdminChart">
                                <div class="input-group">
                                    <input id="btn-input" type="text" name="chat" class="form-control input-md" placeholder="Type your message here..." /><span class="input-group-btn">
                                        <button class="btn btn-primary btn-md" id="btn-chat">Send</button>
                                </span></div>

                            </form>
                        </div>
                    </div>

            @component('utils.modal_wrapper', ["title"=>" Charts"])

            @endcomponent

    </div>

@endsection
@section('bottom-scripts')
<script !src="">
    $("#AdminChart").on("click", function (event) {
        event.preventDefault();
        $.ajax({
            url:"{{route('Admin.AdminMsg')}}",
            method: 'post',
            data: $("#AdminChart").serializeArray(),
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