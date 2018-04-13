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
                @include('includes.notification')
                <!-- end notification -->
                <h3>Réseaux Sociaux <small>. Social Media</small></h3>
            </div>
            <div class="row-fluid margin-bottom40">
                <div class="span7 well well-nice">
                    <fieldset>
                        <legend>Liens Réseaux sociaux et noms des fonts correspondants</legend>
                        <form method="post" action="{{route('config.social.update')}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <label for="urlFacebook"><i class="fontello-icon-facebook-2" aria-hidden="true"></i> Facebook <a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a><a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlFacebook" class="input-block-level span8" type="text" name="facebook" value="{{social('facebook.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-facebook-2"></i></span>
                            <input class="span3" type="text" name="font-facebook" value="{{social('facebook.font')}}" />

                            <label for="urlTwitter"><i class="fontello-icon-twitter-2" aria-hidden="true"></i> Twitter <a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlTwitter" class="input-block-level span8" type="text" name="twitter" value="{{social('twitter.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-twitter-2"></i></span>
                            <input class="span3" type="text" name="font-twitter" value="{{social('twitter.font')}}" />

                            <label for="urlGoogle"><i class="fontello-icon-googleplus-rect-1" aria-hidden="true"></i> Google+ <a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlGoogle" class="input-block-level span8" type="text" name="googleplus" value="{{social('googleplus.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-googleplus-rect-1"></i></span>
                            <input class="span3" type="text" name="font-googleplus" value="{{social('googleplus.font')}}" />

                            <label for="urlLinkedin"><i class="fontello-icon-linkedin-2" aria-hidden="true"></i> Linkedin<a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlLinkedin" class="input-block-level span8" type="text" name="linkedin" value="{{social('linkedin.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-linkedin-2"></i></span>
                            <input class="span3" type="text" name="font-linkedin" value="{{social('linkedin.font')}}" />

                            <label for="urlTumlr"><i class=" fontello-icon-tumblr" aria-hidden="true"></i> Tumblr<a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlTumblr" class="input-block-level span8" type="text" name="tumblr" value="{{social('tumblr.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-tumblr"></i></span>
                            <input class="span3" type="text" name="font-tumblr" value="{{social('tumblr.font')}}" />

                            <label for="urlYoutube"><i class="fontello-icon-youtube" aria-hidden="true"></i> Youtube<a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlLinkedin" class="input-block-level span8" type="text" name="youtube" value="{{social('youtube.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-youtube"></i></span>
                            <input class="span3" type="text" name="font-youtube" value="{{social('youtube.font')}}" />

                            <label for="urlTumlr"><i class="fontello-icon-pinterest" aria-hidden="true"></i> Pinterest<a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlLinkedin" class="input-block-level span8" type="text" name="pinterest" value="{{social('pinterest.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-pinterest"></i></span>
                            <input class="span3" type="text" name="font-pinterest" value="{{social('pinterest.font')}}" />

                            <label for="urlTumlr"><i class="fontello-icon-vimeo-1" aria-hidden="true"></i> Vimeo<a class="fontello-icon-trash-1" href="#" style="float:right;margin-bottom: 5px">Supprimer</a> <a class="fontello-icon-back-in-time" href="#" style="float:right;margin-bottom: 5px">Reset</a></label>
                            <input id="urlLinkedin" class="input-block-level span8" type="text" name="vimeo" value="{{social('vimeo.value')}}">&nbsp;&nbsp;
                            <span class="add-on"><i class="fontello-icon-vimeo-1"></i></span>
                            <input class="span3" type="text" name="font-vimeo" value="{{social('vimeo.font')}}" />

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