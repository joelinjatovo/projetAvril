<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.apl')</legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-3">
                            <section class="widget">
                                <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
                            </section>
                        </div>
                        <div class="col-sm-9">
                            <p><strong>@lang('app.form.login')</strong>: {{$item->name}}</p>
                            <p><strong>@lang('app.form.email')</strong>: {{$item->email}}</p>
                            <p><strong>@lang('app.orga.name')</strong>: {{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}</p>
                            <p><strong>@lang('app.orga.desc')</strong>: {{$item->get_meta('orga_desc')?$item->get_meta('orga_desc')->value:''}}</p>
                            <p><strong>@lang('app.orga.phone')</strong>: {{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}</p>
                            <p><strong>@lang('app.orga.website')</strong>: {{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}</p>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->