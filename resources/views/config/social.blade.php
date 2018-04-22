@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content">
        <div class="navbar navbar-page">
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        
        <section>
            <div class="page-header">
                <!-- Message de notification -->
                @include('includes.alerts')
                <!-- end notification -->
                <h3>Réseaux Sociaux <small>. Social Media</small></h3>
            </div>
            <div class="row-fluid margin-bottom40">
                <div class="span7 well well-nice">
                    <fieldset>
                        <legend>Liens Réseaux sociaux et noms des fonts correspondants</legend>
                        <form method="post" action="{{route('config.social.update')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            @foreach($titles as $key=>$value)
                            <label for="url_{{$key}}">
                                <i class="fontello-icon-{{$key}}" aria-hidden="true"></i> 
                                {{$value}} 
                                <a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a><a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a>
                            </label>
                            
                            <input id="url_{{$key}}" class="input-block-level span8" type="text" name="{{$key}}" 
                                   value="{{old($key)?old($key):($item->get_meta($key)?$item->get_meta($key)->value:'')}}">
                            <span class="add-on"><i class="fontello-icon-{{$key}}"></i></span>
                            <input class="span3" type="text" name="font_{{$key}}" value="{{old($key.'.font')?old($key.'.font'):($item->get_meta($key.'.font')?$item->get_meta($key.'.font')->value:'')}}" />
                            @endforeach

                            <hr class="margin-xxx">

                            <button type="submit" class="btn btn-primary">Sauvegarder</button>
                            <button type="reset" class="btn btn-default">Annuler</button>
                        </form>
                    </fieldset>
                </div>

                <div class="span5">
                    <fieldset>
                        <form method="GET" action="{{route('config.fontawesome')}}">
                        <legend>
                          Information<small>du site</small>
                        </legend>
                              <label for="">Icône du Réseau Social ( FontAwesome )</label>
                              <div class="input-append block"><input class="input-block-level span6" type="text" name="query" placeholder="ex : facebook ou google plus">
                                <button class="btn fontello-icon-link-1" type="submit">Accéder à FontAwesome</button>
                            </div> 
                         </form>
                    </fieldset>
                </div>
            </div>

        </section>
    </div>
</div>
@endsection