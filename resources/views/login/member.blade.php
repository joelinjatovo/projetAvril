@extends('layouts.app')

@section('style')
<style>
.modal {
    display: none;
    overflow: scroll;
    position: fixed;
    top: 0px;
}
</style>
@endsection

@section('content')
<div id="myModal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title">{{$page->title}}</h4>
          </div>
          <div class="modal-body">
              <p>{{$page->content}}</p>
          </div>
          <div class="modal-footer">
              <a type="button" class="pull-left btn btn-primary" href="javascript:history.back()">Abandonner</a>
              <a type="button" class="btn btn-primary" href="#section1" id="custom-close">Continuer</a>
          </div>
      </div>
  </div>
</div>

<div id="property-single" style="margin-top: 160px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12" id="section1">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">Accueil</a></li>
                                <li class="breadcrumb-item active">Inscription en qualité de Membre</li>
                            </ol>
                        </div>
                    </div>

                    <div class="content-box-large">
                        <div class="panel-heading">
                            <div class="panel-title">Inscription en Qualité de Membre</div>
                        </div>
                        <div class="panel-body">
                            @include('includes.alerts')
                            <div class="row">
                                <label for="type" class="col-sm-3 control-label">Type de membre *</label>
                                <div class="col-md-3">
                                    <select name="type" class="form-control" id="type" style="background-color:#ebeee7;" required>
                                        <option value="person" selected>Particulier</option>
                                        <option value="organization">Organisation</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <form class="form-horizontal" role="form" id="particulierForm" action="{{$action}}" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="type" value="person">
                                <fieldset>
                                    <legend>Login Information</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="name">Login *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="email">Adresse Email *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="language" class="col-sm-3 control-label" for="language">Langage *</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="language">
                                                <option value="fr">Français</option>
                                                <option value="en">Anglais</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="country" class="col-sm-3 control-label">Pays *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country">
                                                <option value="0">@lang('app.select_country')</option>
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}"> {{$country->content}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="image">Avatar</label>
                                        <div class="col-md-9">
                                            <input type="file" class="btn btn-default" name="image" id="image">
                                            <p class="help-block">
                                                Choisissez un avatar pour représenter votre profil
                                            </p>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>User Information</legend>
                                    <div class="form-group">
                                        <label for="firstname" class="col-sm-3 control-label">Nom *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="firstname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="lastname">Prénom *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control"  name="lastname" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <p class="help-block">
                                                <em>(*) Champ obligatoire</em>
                                            </p>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="newsletter" id="newsletter" checked="checked"> M'inscrire à la Newsletter
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="allow_sharing" id="allow_sharing"> J'autorise le partage et la commercialisation de mes information avec les partenaires du site www.investirenaustralie.com
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                                    </div>
                                </div>
                            </form>

                            <form class="form-horizontal" role="form" action="{{$action}}" id="organisationForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="type" value="organization">
                                <fieldset>
                                    <legend>Login Information</legend>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="name">Login *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom d'utilisateur" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="email">Adresse Email *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="you@exemple.com" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="language" class="col-sm-3 control-label" for="language">Langage *</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="language">
                                                <option value="fr">Français</option>
                                                <option value="en">Anglais</option>
                                            </select>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Bussiness Detail</legend>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="image">Logo de l'organsation *</label>
                                        <div class="col-md-9">
                                            <input type="file" class="btn btn-default" name="image">
                                            <p class="help-block">
                                                Choisissez le logo de votre organisation
                                            </p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="orga_name" class="col-sm-3 control-label">Nom de l'organisation</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="orga_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="orga_presentation" >Présentation de l'organisation *</label>
                                        <div class="col-sm-9">
                                            <textarea  class="form-control" name="orga_presentation" rows="10" required></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Localisation</legend>
                                    <div class="form-group">
                                        <label for="country" class="col-sm-3 control-label">Pays *</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="country">
                                                <option value="0">@lang('app.select_country')</option>
                                                @foreach($countries as $country)
                                                    @if($country->prefixPhone)
                                                        <option value="{{$country->id}}"> {{$country->content}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="state">Etat (Si fédéral)</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="area_level_1" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="locality">Ville *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="locality" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="postalCode">Code postal *</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="postalCode" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>Contact Information</legend>
                                    <div class="form-group">
                                        <label for="prefixPhone" class="col-sm-3 control-label">Contact Mobile *</label>
                                        <div class="col-md-3">
                                            <select class="form-control" name="prefixPhone">
                                                <option value="0">@lang('app.select_phone')</option>
                                                @foreach($countries as $country)
                                                    @if($country->prefixPhone)
                                                    <option value="{{$country->prefixPhone}}"> {{$country->prefixPhone}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control"  name="phone" placeholder="3-333-333" required>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <div class="checkbox">
                                            <p class="help-block">
                                                <em>(*) Champ obligatoire</em>
                                            </p>
                                        </div>
                                        <div class="checkbox">
                                            <label for="newsletter">
                                                <input type="checkbox" name="newsletter" id="newsletter" checked="checked">@lang('app.form.register.newsletter')
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="allow_sharing" id="allow_sharing">@lang('app.form.register.shareinfo')
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary">@lang('app.btn.register')</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/myJs.js')}}"></script>
<script type="text/javascript">
    $(window).on('load',function(){
        $('#myModal').modal('show');
    });
    //fermeture du modal
    $("#custom-close").on('click', function() {
        $('#myModal').modal('hide');
    });
</script>
<script type="text/javascript">
    $('body').scrollspy({
        target: '#navbar-collapsible',
        offset: 50
    });
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000);
                return false;
            }
        }
    });
</script>
@endsection
