@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops! Something went wrong!</strong>
    <br><br>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if(Session::has('info')) 
<div class="alert alert-info">
    <strong>{!!Session::get('info')!!}</strong> 
</div>
@endif

@if(Session::has('error')) 
<div class="alert alert-danger">
    <strong>{!!Session::get('error')!!}</strong> 
</div>
@endif

@if(Session::has('warning')) 
<div class="alert alert-warning">
    <strong>{!!Session::get('warning')!!}</strong> 
</div>
@endif

@if(Session::has('success')) 
<div class="alert alert-success">
    <strong>{!!Session::get('success')!!}</strong>
</div>
@endif