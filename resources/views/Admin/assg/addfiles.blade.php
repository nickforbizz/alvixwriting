@extends('Admin.layouts.app')

@section('content')


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
           
            <li class="active">
                <a href="{{ route('Admin.home') }}">Dashboard  </a>
            </li>
            <li class="active">
                <a href="{{ route('Admin.onProgress') }}">onProgress >> </a>
            </li>
        </ol>
    </div>
    <div class="row">

            <div class="panel panel-default col-md-12">
                    <div class="panel-heading">
                        <h3> + Add files </h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form class="form-horizontal" id="upload-assg">
    
                            {{ csrf_field() }}
    
                            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::guard('admin')->user()->id }}">
    
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="title">Title:</label>
                                <div class="col-sm-10">
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $assg->title }}" required disabled>
                                </div>
                            </div>
        
    
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pages">Pages:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="pages" id="pages" value="{{ $assg->pages }}"  required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="startDate">Deadline:</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" min="{{ \Carbon\Carbon::now() }}" name="deadline" id="startDate" value="{{ $assg->deadline }}"  required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="amount">Amount:</label>
                                <div class="col-sm-10">Ksh
                                    <input type="number" class="form-control" name="amount" id="amount" value="{{ $assg->amount }}"  required>
                                </div>
                            </div>
    
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="description">Description:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="description" id="description" cols="30" rows="10" value="{{ $assg->description }}" >{{ $assg->description }}</textarea>
                                </div>
                            </div>
    
                            <h4> <b>Additional Information</b>  </h4> <hr>
                            <div class="form-group">
                                <label class="control-label col-sm-2" for="images">Documents:</label>
                                <div class="col-sm-10">
                                    <input type="file" name="docs[]" multiple class="form-control" id="images" placeholder="Enter images" required>
                                </div>
                            </div>
    
                            <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->

    </div>
</div>

@endsection



@section('bottom-scripts')
    <script>
    $(document).ready(function (){
        $("#upload-assg").on("submit", function (event) {
			event.preventDefault();
            var formData = new FormData($(this)[0]);
			$.ajax({
				url:'/admin/updateAssg/' + {{ $assg->id }},
				method: 'post',
                processData:false,
                contentType: false,
                cache: false,
                // headers: {'Content-Type': 'application/x-www-form-urlencoded'},
				data: formData,
				success: function (data) {
                    $("#upload-assg")[0].reset();

                    console.log(data);


                    if (data.code == 0) {
                        $("#edit").html(`
                        @component('utils.uploadAssgModal',["code"=>"0"])

		                @endcomponent
                        `)

                    } else if(data.code == -1) {
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
                    }else if(data.code == 1){
                        $("#edit").html(`
                        @component('utils.successModal',["code"=>"1"])

		                @endcomponent
                        `)
                    }else{
                        alert("Fatal Error Occured");
                    }
					$("#myModal").modal();
				},error: function (data) {
					$("#edit").html(`
                        @component('utils.uploadAssgModal',["code"=>"500"])

		                @endcomponent
                        `)
                        console.log(data);

                    $("#myModal").modal();
				}
			})
		});
    })

    </script>
@endsection