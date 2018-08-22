<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.user_info')</legend>
                <div class="col-sm-12">
                    <p><strong>@lang('app.person.first_name')</strong>: {{$item->get_meta('first_name')?$item->get_meta('first_name')->value:''}}</p>
                    <p><strong>@lang('app.person.last_name')</strong>: {{$item->get_meta('last_name')?$item->get_meta('last_name')->value:''}}</p>
                    <p><strong>@lang('app.person.phone')</strong>: {{$item->get_meta('phone')?$item->get_meta('phone')->value:''}}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->