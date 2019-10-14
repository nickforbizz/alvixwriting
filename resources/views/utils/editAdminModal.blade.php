@if ($code == "edit_admin")
    <div>

        <input type="hidden" name="admin_id" value="${data.data.id}">

        <div class="form-group col-md-12">
            <label for="email">Email d:</label>
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
@elseif($code == "user_edited")

    <div class="alert alert-success">Data Edited Successfully</div>

@endif
