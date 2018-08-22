<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.orga_info')</legend>
                <div class="col-sm-12">
                    <p><strong>@lang('app.orga.name')</strong>: {{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}</p>
                    <p><strong>@lang('app.orga.desc')</strong>: {{$item->get_meta('orga_desc')?$item->get_meta('orga_desc')->value:''}}</p>
                    <p><strong>@lang('app.orga.phone')</strong>: {{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}</p>
                    <p><strong>@lang('app.orga.website')</strong>: {{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->