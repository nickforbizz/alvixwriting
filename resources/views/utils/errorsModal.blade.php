@if ($code == 0)

    <div class="text-center">
        <h3>  Error Occored. Try Again or Contact Developers</h3>
        <hr>
        <p class="lead"> ${data} </p>
        <div class="pull-right">Code 0</div>
    </div>

@elseif($code == 1)

    <div class="text-center">
        <h3>Error Occored. Try Again or Contact Developers</h3>
        <hr>
        <p class="lead"> ${data} </p>
    </div>

@elseif($code == -1)

    <div class="text-center">
        <h3>Try Again or Contact Developers</h3>
        <h4>This Errors Occurred. </h4>
        <hr>
        <p class="lead">
            <ul class="list-group" id="errors" style="text-align: -webkit-auto !important;color: red;">

            </ul>
        </p>
        {{-- <div class="pull-right">Code -1</div> --}}
    </div>

@else

    <div class="text-center">
        <h3>Error Occored. Try Again or Contact Developers</h3>
        <hr>
        <p class="lead"> <h3>Code 500</h3> </p>
        <div class="">Code 500</div>
    </div>

@endif
