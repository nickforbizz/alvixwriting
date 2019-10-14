<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}


	<link href="{{ asset('assets/writersBay/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/writersBay/css/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('assets/writersBay/css/datepicker3.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/writersBay/css/styles.css') }}" rel="stylesheet">
{{--     
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css"> --}}
                                     
    


    <style>
        .tb_data{
            cursor: pointer;
        }.crd{
            padding: 200px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            color: red !important;
        }.td-none{
            text-decoration: none !important;
        }.mt-2{ margin-top: 2rem;}
        .ddoc{    
            padding: 1rem;
            min-width: 13rem;
        }.h6{
            min-height: 6rem !important;
        }.active-tb{
            color: black;
            background-color: #9fd2f9 !important;
        }
        .nav-tabs{
            border-bottom: 1px solid #ab9b9b;
        }
        .selectables>div:not(:last-child){
            margin-right: 2rem !important;
        }

    </style>
    @yield('top-styles')

</head>
<body>
    <div id="appy"> 
        <?php
        $pf = "public/";
        $profileadmin = '';

        if(!empty(Auth::guard('admin')->user()->adminMediaProfiles)){
            $profileadmin = str_replace($pf, '', Auth::guard('admin')->user()->adminMediaProfiles()->first()->media_link);

        }else{
            $profileadmin= str_replace($pf, '','public/adminProfileImg/default.png'); 
        }
        ?>

        <!-- Navbar lumino   -->

        <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span></button>
                            <a class="navbar-brand" href="{{ route('Admin.home') }}">
                                {{ config('app.name', 'WritersBay') }}
                            </a>
                            <notification-component></notification-component>
             
                    </div>
                </div>
                <!-- /.container-fluid -->
        </nav>

        <div class="container-fluid"> 
            <!--/The sidebar-->
            <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
                    <div class="profile-sidebar">
                        <div class="profile-userpic">
                                @if($profileadmin == '' || $profileadmin == null)
                                <img src="{{ asset('assets/writersBay/img/3d_graffiti-wallpaper-2560x1440.jpg') }}"
                                     alt="User Profile"  class="img-responsive" id="default-imgPrf"/>
                                @else

                                    <img src="{{ asset( 'storage/'.$profileadmin)}}"
                                        alt="User Profile"  class="img-responsive" id="default-imgPrf"/>
                                @endif
                        </div>
                        <div class="profile-usertitle">
                            @if (Auth::guard('admin')->user())
                            <div class="profile-usertitle-name">{{ Auth::guard('admin')->user()->username }}</div>
                            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>

                            @endif
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="divider"></div>
                    {{-- <form role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </form> --}}
                    <ul class="nav menu">
                        <li class="active"><a href="{{ route('Admin.home') }}"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
                        <li class="parent "><a data-toggle="collapse" href="#assg">
                            <em class="fa fa-navicon">&nbsp;</em> Assignments <span data-toggle="collapse" href="#assg" class="icon pull-right"><em class="fa fa-plus"></em></span>
                            </a>
                            <ul class="children collapse" id="assg">
                                <li><a class="" href="{{ route('Admin.viewAssg') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> View Orders
                                </a></li>
                                <li><a class="" href="{{ route('Admin.onProgress') }}">
                                        <span class="fa fa-arrow-right">&nbsp;</span>  Progress Orders
                                    </a></li>
                                <li><a class="" href="{{ route('Admin.underReview') }}">
                                        <span class="fa fa-arrow-right">&nbsp;</span> Order Review
                                    </a></li>
                                <li><a class="" href="{{ route('Admin.uploadAssg') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> Upload Order
                                </a>
                                </li><li><a class="" href="{{ route('Admin.onRevision') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> Order Revision
                                </a></li>
                                </li><li><a class="" href="{{ route('Admin.revisionreview') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> Revision Review
                                </a></li>
                                <li><a class="" href="{{ route('Admin.pendingPay') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> Order Pending Pay
                                </a></li>
                            </ul>
                        </li>
                        <li class="parent "><a data-toggle="collapse" href="#users">
                            <em class="fa fa-user">&nbsp;</em> Writers <span data-toggle="collapse" href="#users" class="icon pull-right"><em class="fa fa-plus"></em></span>
                            </a>
                            <ul class="children collapse" id="users">
                                <li><a class="" href="{{ route('Admin.viewUsers') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> View Writers
                                </a></li>
                                @if (Auth::guard('admin')->user()->role->name == 'superadmin')
                                <li><a class="" href="{{ route('Admin.editUsers') }}">
                                    <span class="fa fa-arrow-right">&nbsp;</span> Edit Writers
                                </a></li>
                                    @endif
                            </ul>
                        </li>
                        {{-- <li><a href="charts.html"><em class="fa fa-bar-chart">&nbsp;</em> Charts</a></li>
                        <li><a href="elements.html"><em class="fa fa-toggle-off">&nbsp;</em> UI Elements</a></li>
                        <li><a href="panels.html"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li> --}}
                    @if (Auth::guard('admin')->user()->role->name == 'superadmin')
                    <li><a href="{{ route('Admin.roles')}}"><em class="fa fa-forumbee">&nbsp;</em> Roles</a></li>
                    <li><a href="{{ route('Admin.categories')}}"><em class="fa fa-bookmark-o">&nbsp;</em> Categories</a></li>

                    <li class="parent "><a data-toggle="collapse" href="#admins">
                        <em class="fa fa-user-plus">&nbsp;</em> Admins <span data-toggle="collapse" href="#admins" class="icon pull-right"><em class="fa fa-plus"></em></span>
                        </a>
                        <ul class="children collapse" id="admins">
                            <li><a class="" href="{{ route('Admin.viewAdmins') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> View Admins
                            </a></li>
                            <li><a class="" href="{{ route('Admin.editAdmins') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Edit Admins
                            </a></li>
                            <li><a class="" href="{{ route('Admin.addAdmins') }}">
                                <span class="fa fa-arrow-right">&nbsp;</span> Add Admin
                            </a></li>
                        </ul>
                    </li>
                    @endif
                    <li><a href="{{ route('Admin.approveWriters')}}"><em class="fa fa-user-plus">&nbsp;</em> New Writers</a></li>
                    <li><a href="{{ route('Admin.settings')}}"><em class="fa fa-cog">&nbsp;</em> Settings</a></li>



                    <li><a href="{{ route('Admin.logout')}}"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
                    </ul>
                </div>
            <!--/.sidebar-->

                <main class="py-2">

                    @yield('content')


                    @component('utils.modal_wrapper', ["title"=>" This is where additional Information is displayed"])
    
                    @endcomponent
                </main>


        </div>
        <!-- .container -->
    </div>

    <script>
        // window.onerror = function(){
        // return true;
        // }
    
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('assets/bootstrap4/jquery.1.11.1.js') }}"></script> 
     <!-- <script src="{{ asset('assets/bootstrap4/js/bootstrap.min.js') }}"></script>  -->
    <script src="{{ asset('assets/writersBay/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/writersBay/js/custom.js') }}"></script>
     
    {{-- <script src="js/bootstrap-datepicker.js"></script> --}}
    <script src="{{ asset('assets/writersBay/js/chart.min.js') }}"></script>
	<script src="{{ asset('assets/writersBay/js/chart-data.js') }}"></script>
	{{-- {{-- <script src="{{ asset('assets/writersBay/js/easypiechart.js') }}"></script> --}}
    

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    {{-- sweet alerts --}}

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script>
        const s = ''
        
        $("#startDate").attr('min', new Date().toJSON().slice(0,19));
        $(document).ready(function() {
            // $('#example').DataTable();

        });


        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

        //    function ajax
        function sendFormData(url, postdata){
            $.ajax({
                url: url,
                data: postdata, 
                method: 'post',
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    setTimeout(function () {
                        location.reload()
                    }, 1500);
                    alert("success Delivery  "+data);
                    console.log(data);
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }


    </script>
    @yield('bottom-scripts')

</body>
</html>
