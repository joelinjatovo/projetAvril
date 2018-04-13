@if(Session::has('success')) 
            <div class="alert alert-success">
                <strong>Succès ! </strong> {!!Session::get('success')!!}
            </div>
@endif

@if(Session::has('error')) 
            <div class="alert alert-danger">
                <strong>Erreur ! </strong> {!!Session::get('error')!!}
            </div>
@endif

@if(Session::has('remarque')) 
            <div class="alert alert-warning">
                <strong>Attention ! </strong> {!!Session::get('warning')!!}
            </div>
@endif
