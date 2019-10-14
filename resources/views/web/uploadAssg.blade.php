@extends('web.layoutsWeb.appWriter')
@section('top-styles')
    <style>
        #drop-area {
            border: 2px dashed #ccc;
            border-radius: 20px;
            /*width: 480px;*/
            font-family: sans-serif;
            /*margin: 100px auto;*/
            padding: 20px;
        }#drop-area.highlight {
             border-color: purple;
         }
    </style>
    @endsection
@section('content')


    <!-- ________________________Lumino________________________________________________________ -->


    <!-- body -sideNav and main -->


        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
            <div class="row">
                <ol class="breadcrumb">
                    
                    <li>
                        <a href="{{ route('Web.home') }}">
                        <em class="fa fa-home"></em>
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('Web.home') }}">Dashboard </a>
                    </li>
                    <li class="">
                        <a href="{{ route('Web.progressAssg') }}">Onprogress assignment >> </a>
                    </li>
                    <li class="">
                        <a >Upload assignment  </a>
                    </li>
                </ol>
            </div><!--/.row-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="pull-right arriveOrders">New Orders</div>
                <h3 class="page-header">Upload <i class="text-info"> {{ $order->title }} </i> </h3>
                </div>
                <div class="col-12">
                    <!-- /.panel-heading -->
                    @if($errors)
                        <ul>
                        @foreach($errors as $err)
                                <li>{{$err}}</li>
                         @endforeach
                        </ul>
                    @endif

                <div class="panel-body">
                        <form class="form-horizontal" id="upload-assg-writer" action="{{ route('Web.submitAssg') }}" method="POST" enctype="multipart/form-data" >

                                {{ csrf_field() }}

                                <input type="hidden" name="writer_id" id="writer_id" value="{{ Auth::guard('web')->user()->id }}">
                                <input type="hidden" name="onprogress_id"  value="{{ $onprogress }}">
                                <input type="hidden" name="onrevision_id"  value="{{ $onrevision }}">

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="images">Documents:</label>
                                        <div class="col-sm-10">
                                        <div id="drop-area">
                                            <input type="file" name="docs[]" multiple class="form-control" id="images" placeholder="Enter File">
                                            <div id="gallery"></div>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="upload_comments">Comments:</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="upload_comment" id="upload_comments" cols="30" rows="5" placeholder="Type the description">I have completed assignment</textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>
                            </form>

                </div>
                <!-- /.panel-body -->
                </div>
            </div><!--/.row-->


        </div>
        <!--/.main-->
    <!-- ________________________Lumino ends____________________________________________________ -->

@endsection

@section('bottom-scripts')
    <script>
      $(document).ready(function () {
         // Take Order
         $(document).on("click",'.'+tag, function () {
                var order_id = $(this).attr("data-id");
                var writer_id ={{ Auth::guard('web')->user()->id  }}
         });

    });

    function xg_data(tag) {
        $.ajax({
            url:'/web/takeOrder/' + order_id+'/'+writer_id,
            method: 'get',
            success: function (data) {
                // data = JSON.parse(data);
                console.log(data);


                $("#edit").html('');

                if (data.code === 1) {
                    $("#edit").html(`
                    @component('utils.successModal',["code"=>"Order Taken"])

                    @endcomponent
                    `)
                    location.reload();
                } else if(data.code === -1){
                    let errs = $.map(data.errs, function(value, index) {
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
        })

    }


    //drag and drop

      let dropArea = document.getElementById('drop-area')
      ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
          dropArea.addEventListener(eventName, preventDefaults, false)
      })

      function preventDefaults (e) {
          e.preventDefault()
          e.stopPropagation()
      }
      ;['dragenter', 'dragover'].forEach(eventName => {
          dropArea.addEventListener(eventName, highlight, false)
      })

      ;['dragleave', 'drop'].forEach(eventName => {
          dropArea.addEventListener(eventName, unhighlight, false)
      });

      function highlight(e) {
          dropArea.classList.add('highlight')
      }

      function unhighlight(e) {
          dropArea.classList.remove('highlight')
      }
      dropArea.addEventListener('drop', handleDrop, false)

      function handleDrop(e) {
          let dt = e.dataTransfer
          let files = dt.files

          handleFiles(files)
      }
      function handleFiles(files) {
          ([...files]).forEach(uploadFile)
      }
      function previewFile(file) {
          let reader = new FileReader()
          reader.readAsDataURL(file)
          reader.onloadend = function() {
              let img = document.createElement('img')
              img.src = reader.result
              document.getElementById('gallery').appendChild(img)
          }
      }
      function handleFiles(files) {
          files = [...files]
          files.forEach(uploadFile)
          files.forEach(previewFile)
      }





    </script>
@endsection
