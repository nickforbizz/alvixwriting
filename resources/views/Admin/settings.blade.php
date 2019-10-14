@extends('Admin.layouts.app')
@section('top-styles')
    <style>
        #profileImgCard{
            width: 300px;
            padding: 10px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            text-align: center;
            display: flex;
            flex-direction: column-reverse;
        }#profileImgCard>img{
             height: 210px;
             width: 200px;
             padding: 10px 0 0 ;
             border-radius: 50%;
             margin: auto;
         }#userDetails{
              padding: 10px 0 20px 0;
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
          }#edit-writer-imgProfile, #output, #im-prf{
               display: none;
           }#upload_form_img>label{
                background-color: #30a5ff;
                padding: 10px;
                cursor: pointer;
                color: white;
                border-radius: 10px;
            }#user-bio{margin: 15px 0 20px 0;}#user-bio>.panel-heading, .pd{background-color: #30a5ff !important;}.ddtail{
                                                                                                                      /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);                                                                                                                                                         box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);*/
                                                                                                                      margin-left: 20px
                                                                                                                  }
    </style>
@endsection
@section('content')

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="{{ route('Admin.home') }}">
                        <em class="fa fa-home"></em>
                    </a></li>
                    <li class="active">Dashboard/Settings</li>
                </ol>
            </div>
            <!--/.row-->
        <div class="jumbotron" style="margin-bottom: 0">

            settings
        </div>



        <div id="userDetails">
            <div class="col-md-4" id="profileImgCard">
                    @if($profileadmin == '' || $profileadmin == null)
                    <img src="{{ asset('assets/writersBay/img/3d_graffiti-wallpaper-2560x1440.jpg') }}"
                         alt="User Profile"  class="img-responsive" id="default-imgPrf"/>
                    @else
    
                    <img src="{{ asset( 'storage/'.$profileadmin)}}"
                         alt="User Profile"  class="img-responsive" id="default-imgPrf"/>
                    @endif
                <img id="output"  class="img-responsive"/>

                {{--<button class="btn btn-info btn-sm"></button>--}}
                <form id="upload_form_img" enctype="multipart/form-data" >
                    <label for="im-prf">Change profile</label>
                    <input type="file" name="img_prf"  accept="image/*" id="im-prf"  onchange="loadFile(event)"> <br>

                    <button  type="submit" class="btn btn-info btn-sm" id="edit-writer-imgProfile">Save</button>

                </form>
            </div>

            <div class="col-md-7  ddtail">
                <div class="list-group">
                    <a href="#" class="list-group-item active pd">Profile Details</a>
                    <a href="#" class="list-group-item">Name <span class="badge"> {{ Auth::guard('admin')->user()->fname  }}  {{Auth::guard('admin')->user()->lname}}</span> </a>
                    <a href="#" class="list-group-item">Username  <span class="badge" > {{Auth::guard('admin')->user()->username}} </span> </a>
                    <a href="#" class="list-group-item">Email  <span class="badge">{{Auth::guard('admin')->user()->email}}</span> </a>
                    <a href="#" class="list-group-item">Edit Profile
                        <span class="badge">
                            <button class="btn btn-info btn-xs"  id="profedit" data-route="{{ url( 'writers_show/'.Auth::guard('admin')->user()->id ) }}">Edit</button>
                        </span>
                    </a>
                </div>
            </div>



            <div class="row">

                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-primary" id="user-bio">
                        <div class="panel-heading">My Bio</div>
                        <div class="panel-body">{{Auth::guard('admin')->user()->bio}}</div>
                    </div>
                </div>

            </div>



        </div>




    </div>

@endsection

@section('bottom-scripts')
    <script>
        $(document).ready(function () {

            $("#profedit").on("click",function () {
                let getwriter = $(this).attr('data-route');
                console.log(getwriter);
                $("#edit").html(`
                    @component('utils.editModal',["code"=>"edit_admin_profile"])

                        @endcomponent
                    `)
                $("#myModal").modal();

                $("#update").on("submit", function (event) {
                    event.preventDefault();
                    $.ajax({
                        url:'{{ url('admin/adminUpdate/'.Auth::guard('admin')->user()->id) }}',
                        method: 'post',
                        data:$("#update").serializeArray(),
                        success: function (data) {
                            // data = JSON.parse(data);
                            console.log(data);
                            alert("Update Succesful");
                            setTimeout(function () {
                                location.reload()
                            }, 1500)
                        },
                        error:function (err) {
                            alert("something Went Wrong")
                        }

                    })
                })




            });
            $("#upload_form_img").on("submit", function (event) {
                event.preventDefault();
                let formd = new FormData(this);
                let url = ' {{ route('Admin.updateAdminImg') }} ';
                sendFormData(url, formd);
            })
        }); // doc ready

        //js

        let loadFile = function(event) {
            $("#default-imgPrf").hide();
            $("#output, #edit-writer-imgProfile").fadeIn();
            let output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection

