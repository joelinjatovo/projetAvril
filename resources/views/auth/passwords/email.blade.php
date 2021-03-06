@extends('layouts.app')

@section('content')
@component('includes.breadcrumb')
    @lang('app.reset_password')
@endcomponent
<div id="contact-page" class="contact-page-var-two">
    <div class="container">
        <h3 class="entry-title">@lang('app.contact')</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="contact-form-wrapper">
                    <div class="contents">
                        <p>{!!$item->content!!}</p>
                    </div>
                    @foreach($item->childs as $child)
                    <div class="contact-page-contents clearfix">
                        {!!$child->content!!}
                    </div>
                    @endforeach

                </div>
            </div>
            <div class="col-md-6">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="map-canvas"></div>
</div>
@endsection

@section('script')
<script>
    /*****************************************************
     *Google Maps
     ******************************************************/
    function initializeContactMap()
    {
        var officeLocation = new google.maps.LatLng(-24.841552, 137.33135);
        var contactMapOptions = {
            center: officeLocation,
            zoom: 6,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false
        };
        var contactMap = new google.maps.Map(document.getElementById("map-canvas"), contactMapOptions);
        var contactMarker = new google.maps.Marker({
            position: officeLocation,
            map: contactMap
        });
    }

    window.onload = initializeContactMap();
</script>
@endsection