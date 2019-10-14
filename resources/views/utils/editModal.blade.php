@if ($code == "edit_user")
    <div>

        <input type="hidden" name="user_id" value="${data.data.id}">

        <div class="form-group col-md-12">
            <label for="email">Email:</label>
            <input type="text" name="email" class="form-control" value="${data.data.email}"  id="email" required>
        </div>

        <div class="form-group col-md-3">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" value="${data.data.username}"  id="username" required>
        </div>

        {{csrf_field() }}

        <div class="form-group col-md-3">
            <label for="fname">First Name:</label>
            <input type="text" name="fname" class="form-control"  id="fname" value="${data.data.fname}"  required>
        </div>

        <div class="form-group col-md-3">
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" class="form-control"  id="lname" value="${data.data.lname}"  required>
        </div>

        <div class="form-group col-md-3">
            <label for="sname">Sur Name:</label>
            <input type="text" name="sname" class="form-control"  id="sname" value="${data.data.sname}"  required>
        </div>

        <div class="form-group col-md-3">
            <label for="mobile">Mobile Number:</label>
            <input type="text" name="mobile" class="form-control"  id="mobile" value="${data.data.mobile}"  required>
        </div>

        <div class="form-group col-md-3">
            <label for="national_id">National ID:</label>
            <input type="number" name="national_id" class="form-control"  id="national_id" value="${data.data.national_id}"  required>
        </div>

        <div class="form-group col-md-4">
            <label for="roles">Edit Role:</label>
            <input list="roles" name="roles" class="form-control" placeholder="${data.data.roles}" required>
            <datalist id="roles">
                @foreach (App\Models\Role::where('status', 1)->get() as $roles)
                <option value="{{ $roles->id }}">Name: {{ $roles->name }}</option>
                @endforeach
            </datalist>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success">
                </div>
            </div>
        </div>
    </div>
@elseif($code == "edit_role")

    <div>

        <input type="hidden" name="role_id" value="${data.data.id}">

        <div class="form-group col-md-12">
            <label for="name">Name Cannot be edited:</label>
            <input type="text" name="name" class="form-control" value="${data.data.name}"  id="name" disabled required>
        </div>

        <div class="form-group col-md-12">
            <label for="description">description:</label>
            <textarea name="description"  class="form-control"  id="description" cols="30" rows="10" required>${data.data.description}</textarea>
        </div>

        {{csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success">
                </div>
            </div>
        </div>
    </div>

@elseif($code == "edit_category")

    <div>

        <input type="hidden" name="category_id" value="${data.data.id}">

        <div class="form-group col-md-12">
            <label for="name">Name :</label>
            <input type="text" name="name" class="form-control" value="${data.data.name}"  id="name" required>
        </div>

        <div class="form-group col-md-12">
            <label for="description">description:</label>
            <textarea name="description"  class="form-control"  id="description" cols="30" rows="10" required>${data.data.description}</textarea>
        </div>

        {{csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success">
                </div>
            </div>
        </div>
    </div>

@elseif($code == 'confirmReject')
    <div class="jumbotron">
            <h2 class="text-warning">Confirm Wether you want to reject giving reason</h2>
            <p class="lead">click close button at the bottom to Cancel Reject</p>
        <p class="lead" >
        {{--<div class="col-xs-4">--}}
            {{--<label for="ex3">Reason</label>--}}
            {{--<input class="form-control" id="ex3" type="text">--}}
        {{--</div>--}}
        <div class="form-group col-md-12">
            <label for="reason_revised">Reason:</label>
            <textarea name="reason_revised" class="form-control" id="reason_revised" cols="30" rows="10" required></textarea>
        </div>

        <input type="hidden" name="review_id" value="${id}">
        <input type="hidden" name="writer_id" value="${writer_id}">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success rejectSend">
                </div>
            </div>
        </div>
        </p>
    </div>

@elseif($code == 'verifypayment')
    <div class="jumbotron">
        <h3>Verify Payment of Order </h3>
        <hr>
        <input type="hidden" id="order" name="order" value="${o}">
        <p class="lead">
            <div class="well bg-secondary">Click Yes to Approve Pay</div>
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin:20px;">
                    <input type="submit" class="btn btn-lg btn-success payVerified" value="Yes">
                </div>
            </div>
        </div>
            <div class="well bg-secondary">Click close <b>Below</b> to avoid Pay</div>
        </p>
    </div>
@elseif($code == 'DownloadFiles')
    <div class="jumbotron">
        <h3>Available Files</h3>
        <input type="hidden" id="order" name="order" value="">
        <p class="lead">
        <div class="row">
            <div class="col-md-12">
                <ul class="list-group" id="files" style="text-align: -webkit-auto !important;color: red;">

                </ul>

            </div> 
        </div>
        </p>
    </div>



@elseif($code == "edit_writers_profile")

    <div>


        <div class="form-group col-md-4 col-sm-6">
            <label for="fname">First Name :</label>
            <input type="text" name="fname" class="form-control" value="{{ Auth::guard('web')->user()->fname }}"  id="fname" required>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="lname">Last Name :</label>
            <input type="text" name="lname" class="form-control" value="{{ Auth::guard('web')->user()->lname }}"  id="lname" required>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="username">Username :</label>
            <input type="text" name="username" class="form-control" value="{{ Auth::guard('web')->user()->username }}"  id="username" required>
        </div>

        <div class="form-group col-md-6 col-sm-6">
            <label for="email">Email :</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::guard('web')->user()->email }}"  id="email" required>
        </div>

        <div class="form-group col-md-6 col-sm-6">
            <label for="mobile">Mobile :</label>
            <input type="number" name="mobile" class="form-control" value="{{ Auth::guard('web')->user()->mobile }}"  id="mobile" required>
        </div>

        <div class="form-group col-md-12">
            <label for="bio">Bio:</label>
            <textarea name="bio"  class="form-control"  id="bio" cols="30" rows="6" required>{{ Auth::guard('web')->user()->bio }}</textarea>
        </div>

        {{csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success">
                </div>
            </div>
        </div>
    </div>



@elseif($code == "edit_admin_profile")

    <div>


        <div class="form-group col-md-4 col-sm-6">
            <label for="fname">First Name :</label>
            <input type="text" name="fname" class="form-control" value="{{ Auth::guard('admin')->user()->fname }}"  id="fname" required>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="lname">Last Name :</label>
            <input type="text" name="lname" class="form-control" value="{{ Auth::guard('admin')->user()->lname }}"  id="lname" required>
        </div>

        <div class="form-group col-md-4 col-sm-6">
            <label for="username">Username :</label>
            <input type="text" name="username" class="form-control" value="{{ Auth::guard('admin')->user()->username }}"  id="username" required>
        </div>

        <div class="form-group col-md-6 col-sm-6">
            <label for="email">Email :</label>
            <input type="email" name="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}"  id="email" required>
        </div>

        <div class="form-group col-md-6 col-sm-6">
            <label for="mobile">Mobile :</label>
            <input type="number" name="mobile" class="form-control" value="{{ Auth::guard('admin')->user()->mobile }}"  id="mobile" required>
        </div>

        <div class="form-group col-md-12">
            <label for="bio">Bio:</label>
            <textarea name="bio"  class="form-control"  id="bio" cols="30" rows="6" required>{{ Auth::guard('admin')->user()->bio }}</textarea>
        </div>

        {{csrf_field() }}

        <div class="row">
            <div class="col-md-12">
                <div class="pull-right" style="margin-right:30px;">
                    <input type="submit" class="btn btn-lg btn-success">
                </div>
            </div>
        </div>
    </div>

@endif
{{--this website was made by Wainaina Nicholas Waruingi of Mombex Ent contact him through +254707722247 or email nickforbiz@gmail.com--}}