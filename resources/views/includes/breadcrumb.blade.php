<div id="breadcrumb" class="main-slider-wrapper clearfix content corps">
    <div id="site-banner" class="text-center clearfix">
        <div class="container">
            <h1 class="title wow slideInLeft">{{$slot}}</h1>
            <ol class="breadcrumb wow slideInRight">
                <li><a href="{{route('home')}}">@lang('app.home')</a></li>
                <li class="active">{{$slot}}</li>
            </ol>
        </div>
    </div>
</div>