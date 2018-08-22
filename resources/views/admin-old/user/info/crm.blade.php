<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.orga_info')</legend>
                <div class="col-sm-12">
                    <p><strong>@lang('app.crm.name')</strong>: {{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}</p>
                    <p><strong>@lang('app.crm.email')</strong>: {{$item->get_meta('crm_email')?$item->get_meta('crm_email')->value:''}}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->