@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content">
        <section>
            <div class="page-header">
                <h3>@lang('app.login')</h3>
            </div>
            @include('includes.alerts')
            <form method="post" action="{{route('config.login.update')}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div class="span6">
                            <label for="title[fr]">Titre</label>
                            <input id="title[fr]" class="input-block-level" type="text" name="title[fr]" 
                                value="{{old('title.fr')?old('title.fr'):$item->get_meta_array('title', 'fr', '')}}"
                                   >
                        </div>
                        <div class="span6">
                            <label for="title[en]">Title</label>
                            <input id="title[en]" class="input-block-level" type="text" name="title[en]" 
                                value="{{old('title.en')?old('title.en'):$item->get_meta_array('title', 'en', '')}}">
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div class="span6">
                            <label for="content[fr]">Contenu</label>
                            <textarea id="content[fr]" class="input-block-level" type="text" name="content[fr]">{{old('content.fr')?old('content.fr'):$item->get_meta_array('content', 'fr', '')}}</textarea>
                        </div>
                        <div class="span6">
                            <label for="content[en]">Content</label>
                            <textarea id="content[en]" class="input-block-level" type="text" name="content[en]">{{old('content.en')?old('content.en'):$item->get_meta_array('content', 'en', '')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div class="span6">
                            <label for="address[fr]">Adresse</label>
                            <textarea id="address[fr]" class="input-block-level" type="text" name="address[fr]">{{old('address.fr')?old('address.fr'):$item->get_meta_array('address', 'fr', '')}}</textarea>
                        </div>
                        <div class="span6">
                            <label for="address[en]">Address</label>
                            <textarea id="address[en]" class="input-block-level" type="text" name="address[en]" >{{old('address.en')?old('address.en'):$item->get_meta_array('address', 'en', '')}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row-fluid">
                    <div class="span12 well well-nice">
                        <div class="span6">
                            <label for="contact[fr]">Contact</label>
                            <textarea id="contact[fr]" class="input-block-level" type="text" name="contact[fr]">{{old('contact.fr')?old('contact.fr'):$item->get_meta_array('contact', 'fr', '')}}</textarea>
                        </div>
                        <div class="span6">
                            <label for="contact[en]">Contact</label>
                            <textarea id="contact[en]" class="input-block-level" type="text" name="contact[en]" >{{old('contact.en')?old('contact.en'):$item->get_meta_array('contact', 'en', '')}}</textarea>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">@lang('app.btn.save')</button>
                <button type="reset" class="btn btn-default">@lang('app.btn.cancel')</button>
            </form>
        </section>
    </div>
</div>

@endsection