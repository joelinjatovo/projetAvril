<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.login_info')</legend>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-4">
                            <section class="widget">
                                <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
                            </section>
                        </div>
                        <div class="col-sm-8">
                            <p><strong>@lang('app.form.login')</strong>: {{$item->name}}</p>
                            <p><strong>@lang('app.form.email')</strong>: {{$item->email}}</p>
                            <p><strong>@lang('app.form.first_name')</strong>: {{$item->get_meta('first_name')?$item->get_meta('first_name')->value:''}}</p>
                            <p><strong>@lang('app.form.last_name')</strong>: {{$item->get_meta('last_name')?$item->get_meta('last_name')->value:''}}</p>
                            <p><strong>@lang('app.form.language')</strong>: {{$item->language=='en'?'English':'Français'}}</p>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->