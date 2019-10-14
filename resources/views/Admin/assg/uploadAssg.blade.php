@extends('Admin.layouts.app')

@section('content')



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="{{ route('Admin.home') }}">
                <em class="fa fa-home"></em>
            </a></li>
            <li class="active">Dashboard/uploadAssignments</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row" style="margin-top:30px">
        <div class="col-md-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Create New Order</a></li>
                    @if (Auth::guard('admin')->user()->role->name == 'superadmin')

                    <li><a data-toggle="tab" href="#order_formats">Add New Formats</a></li>
                    <li><a data-toggle="tab" href="#paper_types">Add Paper Type</a></li>
                    <li><a data-toggle="tab" href="#order_languages">Add Languages</a></li>
                    @endif
                </ul>
                {{-- nav nav-tabs ends --}}
            <!-- Tables  -->
            <div class="tab-content">


                <div id="home" class="tab-pane fade in active">
                    <div class="panel-body">
                            <form class="form-horizontal" id="upload-assg">
        
                                {{ csrf_field() }}
        
                                

                                <div class="row selectables">
                                    
                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="title">Title:</label>
                                        <div class="">
                                            <input type="text" name="title"class="form-control" id="title" placeholder="Enter Title" xrequired>
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="deadline">Deadline:</label>
                                        <div class="">
                                            <input type="datetime-local" class="form-control" name="deadline" id="startDate" placeholder="Enter deadline" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row selectables">
                                        <div class="form-group col-sm-6">
                                            <label class="control-label" for="pages">Pages:</label>
                                            <div class="">
                                                <input type="number" class="form-control" name="pages" id="pages" placeholder="Enter pages" xrequired>
                                            </div>
                                        </div>
                    
                                            
                                        <div class="form-group col-sm-6">
                                            <label class="control-label" for="amount">Amount:</label>
                                            <div class="">
                                                <input type="number" class="form-control" name="amount" id="amount" placeholder="Enter amount Ksh/=" xrequired>
                                            </div>
                                        </div>
                                </div>

                                {{-- selectables --}}
                                <div class="row selectables">

                                    <div class="form-group col-sm-3">
                                        <label class="control-label" for="category">Category:</label>
                                        <div class="">
                                            <select name="category_id" class="form-control" id="category" xrequired>
                                                <option disabled selected>Select Category</option>
                                                @foreach (\App\Models\Category::where('active', 1)->get() as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>
                                


                                    <div class="form-group col-sm-3">
                                        <label class="control-label " for="order_format">Format:</label>
                                        <div class="">
                                            <select name="order_format_id" class="form-control" id="order_format" xrequired>
                                                <option disabled selected>Select Order Format</option>
                                                @foreach (\App\Models\OrderFormat::where('active', 1)->get() as $of)
                                                    <option value="{{ $of->id }}">{{ $of->name }}</option>
                                                    
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

             

                                    <div class="form-group col-sm-3">
                                        <label class="control-label " for="paper_type">Paper Type:</label>
                                        <div class="">
                                            <select name="paper_type_id" class="form-control" id="paper_type" xrequired>
                                                <option disabled selected>Select Paper Type</option>
                                                @foreach (\App\Models\PaperType::where('active', 1)->get() as $pt)
                                                    <option value="{{ $pt->id }}">{{ $pt->name }}</option>
                                                    
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-group col-sm-3">
                                        <label class="control-label " for="lang">Language Type:</label>
                                        <div class="">
                                            <select name="lang_id" class="form-control" id="lang" xrequired>
                                                <option disabled selected>Select Language</option>
                                                @foreach (\App\Models\OrderLanguage::where('active', 1)->get() as $ol)
                                                    <option value="{{ $ol->id }}">{{ $ol->name }}</option>
                                                    
                                                @endforeach
                                                
                                            </select>
                                        </div>
                                    </div>

                                </div>
        
        

                                <div class="row">

                                    <div class="form-group col-sm-5">
                                        <label class="control-label" for="description">Description:</label>
                                        <div class="">
                                            <textarea class="form-control" name="description" id="description" cols="30" rows="6" placeholder="Type the description"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-1"></div>

                                    <div class="form-group col-sm-6">
                                        <label class="control-label" for="instructions">Instructions:</label>
                                        <div class="">
                                            <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="10" placeholder="Type the instructions"></textarea>
                                        </div>
                                    </div>
                                    
                                </div>
        
                                <h4> <b>Additional Information</b>  </h4> <hr>
                                <div class="form-group">
                                    <label class="control-label" for="images">Documents:</label>
                                    <div class="">
                                        <input type="file" name="docs[]" multiple class="form-control" id="images" placeholder="Enter images" Xrequired>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label" for="notes">Admin Notes:</label>
                                    <div class="">
                                        <textarea class="form-control" name="notes" id="notes" cols="30" rows="4" placeholder="Type the notes"></textarea>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                <div class="col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                </div>

                <div id="order_formats" class="tab-pane fade">
                    
                    <orderrequirement-component
                        id="order_formats"
                    ></orderrequirement-component>
               
                </div>


                <div id="paper_types" class="tab-pane fade">

                    <orderrequirement-component
                        id="paper_types"                    
                    ></orderrequirement-component>

                </div>


                <div id="order_languages" class="tab-pane fade">

                    <orderrequirement-component
                        id="order_languages"                    
                    ></orderrequirement-component>

                </div>
            </div>

            {{-- tab-content ends --}}

            
            <!-- Tables-->
        </div>

    </div>
</div>
@endsection

@section('bottom-scripts')
    <script>
    $(document).ready(function (){
        $('#upload-assg').submit(function (event) {
            event.preventDefault();
            // alert()
            var formData = new FormData($(this)[0]);
			$.ajax({
				url:"{{ route('Admin.createOrder') }}",
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
                            alert(errs)
                    }else if(data.code == 1){
                        alert("success");

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
