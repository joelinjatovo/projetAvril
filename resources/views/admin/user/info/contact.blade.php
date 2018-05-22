<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.contact_info')</legend>
                <div class="col-sm-12">
                    <p><strong>@lang('app.contact.name')</strong>: {{$item->get_meta('contact_name')?$item->get_meta('contact_name')->value:''}}</p>
                    <p><strong>@lang('app.contact.email')</strong>: {{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:''}}</p>
                    <p><strong>@lang('app.contact.phone')</strong>: {{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:''}}</p>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->