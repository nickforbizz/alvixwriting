

<script>

        function showMessage(content) {
            setTimeout(() => {
                
                Swal.fire({
                    position: 'center',
                    title: content,
                    animation: false,
                    customClass: {
                        popup: 'animated tada'
                    }
                });

            }, 1500)
        
        }
        
        </script>
@if ($message = Session::get('success'))
<script>
    showMessage(`
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    `)
</script>
    
@endif


@if ($message = Session::get('errors'))
<script>
    showMessage(`
    <div class="alert alert-danger alert-block">
        <strong>{{ $message }}</strong>
    </div>
    `)
</script>
    
@endif


@if ($message = Session::get('warning'))
<script>
    showMessage(`
    <div class="alert alert-warning alert-block">
        <p> There are some errors in the form</p>
        <strong>{{ $message }}</strong>
    </div>
    `)
</script>

@endif


@if ($message = Session::get('info'))
<script>
    showMessage(`
    <div class="alert alert-info alert-block">
        <strong>{{ $message }}</strong>
    </div>
    `)
</script>
    
@endif


@if ($errors->any())
    <script>
        showMessage(`
        <div class="alert alert-danger">
            Please check the form below for errors
        </div>
        `)
    </script>
@endif

