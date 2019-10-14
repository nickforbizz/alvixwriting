@extends('web.layoutsWeb.appWriter')
@section('top-styles')
    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }
        .flocat-right{
            float: right;
        }
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }#chat_body{
             height: 250px;
             overflow-y: scroll;
         }/* width */
        ::-webkit-scrollbar {
            width: 3px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }
    </style>
@endsection
@section('content')
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/web/roleit') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
    @endif
    <div id="chat">
        <div class="panel panel-default">
            <div class="panel-heading">Chat App
            <div class="badge badge-pill badge-primary">@{{ numberOfUsers }}</div>
            </div>
            <div class="panel-body">
                <ul class="list-group"  id="chat_body" v-chat-scroll>

                    <div class="badge badge-pill badge-primary">@{{ typing }}</div>

                    <chat-component
                    v-for="value,index in chat.message"
                    :key=value.index
                    :color='chat.color[index]'
                    :user = 'chat.user[index]'
                    :time = 'chat.time[index]'
                    >
                        @{{ value }}
                    </chat-component>

                </ul>
                <div class="form-group">
                    <label for="usr">Type Your Message:</label>
                    <input
                            type="text"
                            class="form-control"
                            id="usr"
                            placeholder="Type here ..."
                            v-model="message"
                            @keyup.enter='send'
                    >
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row">--}}

        {{--<br>--}}

        {{--<div class="content col-md-12">--}}

            {{--<div class="links">--}}
                {{--@if (Route::has('login'))--}}
                    {{--@auth--}}
                        {{--<a href="{{ url('/web/roleit') }}">Home</a>--}}
                    {{--@else--}}
                        {{--<a href="{{ route('login') }}">Login</a>--}}

                        {{--@if (Route::has('register'))--}}
                            {{--<a href="{{ route('register') }}">Register</a>--}}
                        {{--@endif--}}
                    {{--@endauth--}}
                {{--@endif--}}
            {{--</div>--}}
        {{--</div>--}}

     {{--</div>--}}
</div>
@endsection
