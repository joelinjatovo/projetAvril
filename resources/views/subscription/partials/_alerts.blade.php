@if (session('cardError'))
<div class="error-stripe" role="alert">
        {{ session('cardError') }}
    </div>
@endif
@if (session('invalidRequest'))
<div class="error-stripe" role="alert">
        {{ session('invalidRequest') }}
    </div>
@endif
@if (session('apiConnectionError'))
<div class="error-stripe" role="alert">
        {{ session('apiConnectionError') }}
    </div>
@endif
@if (session('generalError'))
<div class="error-stripe" role="alert">
        {{ session('generalError') }}
    </div>
@endif