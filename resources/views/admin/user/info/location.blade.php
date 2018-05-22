<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.location_info')</legend>
                <div class="col-sm-12">
                    <p><strong>@lang('app.location.country')</strong>: {{$location?$location->country:''}}</p>
                    <p><strong>@lang('app.location.area_level_1')</strong>: {{$location?$location->area_level_1:''}}</p>
                    <p><strong>@lang('app.location.area_level_2')</strong>: {{$location?$location->area_level_2:''}}</p>
                    <p><strong>@lang('app.location.locality')</strong>: {{$location?$location->locality:''}}</p>
                    <p><strong>@lang('app.location.route')</strong>: {{$location?$location->route:''}}</p>
                    <p><strong>@lang('app.location.postalCode')</strong>: {{$location?$location->postalCode:''}}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->