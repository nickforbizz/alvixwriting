@extends('Admin.layouts.app')

@section('content')

        <!-- ________________________Lumino________________________________________________________ -->
         <!-- body -sideNav and main -->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                <h1 class="page-header">Dashboard </h1>
                </div>
            </div><!--/.row-->

            <div class="panel panel-container">
                <div class="row">
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-teal panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-paper-plane-o"></em>
                                <div class="large">
                                    {{ \App\Models\Assignment::where('status', 1)
                                                                ->count()
                                     }}
                                </div>
                                <div class="text-muted">Uploaded Assignments</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-blue panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-clipboard color-orange"></em>
                                <div class="large">
                                    {{ \App\Models\Completedassignment::where('status', 1)
                                                                ->where('active', 1)
                                                                ->count()
                                     }}
                                </div>
                                <div class="text-muted">Completed Assignments</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-orange panel-widget border-right">
                            <div class="row no-padding"><em class="fa fa-xl fa-folder-open color-teal"></em>
                                <div class="large">
                                    {{ \App\Models\Onrevisionassignment::where('status', 1)
                                                                ->where('active', 1)
                                                                ->count()
                                     }}
                                </div>
                                <div class="text-muted">Revised Assignments</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                        <div class="panel panel-red panel-widget ">
                            <div class="row no-padding"><em class="fa fa-xl fa-paypal color-red"></em>
                                <div class="large">
                                    {{ \App\Models\AssgPendingPayment::where('status', 1)
                                                                ->where('active', 1)
                                                                ->count()
                                     }}
                                </div>
                                <div class="text-muted">Assignments Pending Payment</div>
                            </div>
                        </div>
                    </div>
                </div><!--/.row-->
            </div>

            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>New Orders</h4>
                            <div class="easypiechart" id="easypiechart-blue" data-percent="
                                @if(\App\Models\Assignment::where('status', 1)->count()  > 0)
                                    {{
                                     
                                     round((\App\Models\Assignment::where('status', 1)->where('active', 1)->count() ) /
                                     (\App\Models\Assignment::where('status', 1)->count() ) *100)
                                    }}
                                @endif
                                " >
                                <span class="percent">
                                    @if(\App\Models\Assignment::where('status', 1)->count()  > 0)
                                    {{
                                        
                                        round( (\App\Models\Assignment::where('status', 1)->where('active', 1)->count() ) /
                                        (\App\Models\Assignment::where('status', 1)->count() ) *100)
                                    }}%
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Comments</h4>
                            <div class="easypiechart" id="easypiechart-orange" data-percent="
                                @if(\App\Models\Chat::where('status', 1)->count()  > 0)
                                     {{
                                     
                                     round((\App\Models\ChatsAdmin::where('status', 1)->where('active', 1)->where('writer_id', Auth::guard('admin')->user()->id)->count() ) /
                                     (\App\Models\Chat::where('status', 1)->count() ) *100)
                                     }}
                                @endif
                                    ">
                                <span class="percent">
                                    @if(\App\Models\Chat::where('status', 1)->count()  > 0)
                                     {{
                                     
                                     round((\App\Models\ChatsAdmin::where('status', 1)->where('active', 1)->where('writer_id', Auth::guard('admin')->user()->id)->count() ) /
                                     (\App\Models\Chat::where('status', 1)->count() ) *100)
                                    }}%
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Active Writers</h4>
                            <div class="easypiechart" id="easypiechart-teal" data-percent="
                                @if(\App\Models\Writer::where('status', 1)->count() > 0)
                                    {{
                                   round( (\App\Models\Writer::where('status', 1)->where('active', 1)->count()) /
                                    (\App\Models\Writer::where('status', 1)->count()) *100)
                                     }}
                                @endif
                                        ">
                                <span class="percent">
                                    @if(\App\Models\Writer::where('status', 1)->count() > 0)
                                    {{
                                    
                                    round((\App\Models\Writer::where('status', 1)->where('active', 1)->count()) /
                                    (\App\Models\Writer::where('status', 1)->count()) *100)
                                    }}%
                                @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Visitors</h4>
                            <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27%</span></div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default chat">
                        <div class="panel-heading">
                            Click Writer Icon to select Chat ggs

                        </div>
                        <div class="panel-body">
                            <div><b>Search a user to communicate with:</b> <br>
                                <input type="search" list="writer_chat" placeholder="Type in here...">
                            </div>

                            <datalist id="writer_chat">
                                    @foreach(\App\Models\Writer::where('status', 1)->get() as $w)
                                    <option value="{{ $w->id }}" class="fa fa-user"  onclick="console.log(this)">
                                        {{-- <a href="{{ route('Admin.webMsg', ['id'=>$w->id]) }}"> --}}
                                            {{ $w->username }}
                                        {{-- </a> --}}
                                    </option>
                                @endforeach
                            </datalist>

                            <ul class="list-group">
                                
                            </ul>

                        </div>
                        <div class="panel-footerh">

                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Send Writers Alerts
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
                        <div class="panel-body">
                            <ul class="todo-list">
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-1" />
                                        <label for="checkbox-1">Make coffee</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-2" />
                                        <label for="checkbox-2">Check emails</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-3" />
                                        <label for="checkbox-3">Reply to Jane</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-4" />
                                        <label for="checkbox-4">Make more coffee</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-5" />
                                        <label for="checkbox-5">Work on the new design</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                                <li class="todo-list-item">
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox-6" />
                                        <label for="checkbox-6">Get feedback on design</label>
                                    </div>
                                    <div class="pull-right action-buttons"><a href="#" class="trash">
                                        <em class="fa fa-trash"></em>
                                    </a></div>
                                </li>
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="btn-input" type="text" class="form-control input-md" placeholder="Add new Alert" /><span class="input-group-btn">
                                    <button class="btn btn-primary btn-md" id="btn-todo">Add</button>
                            </span></div>
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
