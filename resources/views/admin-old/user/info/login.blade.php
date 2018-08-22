<div class="widget widget-simple">
    <div class="widget-content">
        <div class="widget-body">
            <fieldset>
                <legend>@lang('app.login_info')</legend>
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
                            <p><strong>@lang('app.form.language')</strong>: {{$item->language=='en'?'English':'Français'}}</p>
                            <p><strong>@lang('app.user.ontrial')</strong>: {{$item->onTrial()?'oui':'non'}}</p>
                            <p><strong>@lang('app.user.trial_end_at')</strong>: {{$item->trial_ends_at}}</p>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<!-- // Widget -->