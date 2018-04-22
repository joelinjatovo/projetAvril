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
<div class="main-slider-wrapper clearfix content corps">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title aligncenter">SELLER - SUBSCRIPTION FORM</h3>
                <div id="content">
                    <div role="main">
                        <div id="breadcrumbs" class="group font-size-14">
                            <div class="breadcrumb">
                                <a href="https://www.propertyhq.com.au/">Accueil</a>
                                <span class="aquo">&gt;</span> Seller - Subscription form</div>
                            </div>
                            <div id="entry" class="group">
                                <div class="hasfloat aligncenter">
                                    <b>
                                        Get your properties automatically sent to PropertyHQ.com platform
                                        from your CRM System. This means there is no extra work needed from your side
                                        for having your properties listed with us. Simply fill in the form below and
                                        our staff will contact your CRM to organise the feed
                                    </b>
                                </div>
                                <div class="hasfloat">
                                <form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                                            <div class="col-sm-9">
                                                <select class="form-control" id="language" name="language">
                                                    <option value="fr">Français</option>
                                                    <option value="en">Anglais</option>
                                                </select>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Business Details</legend>
                                        <div class="form-group">
                                            <label for="type" class="col-sm-3 control-label">Type of Business *</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="type" id="type">
                                                    <option value="builder"> Builder</option>
                                                    <option value="developer"> Developer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_name" class="col-sm-3 control-label">Business Name *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="orga_name" name="orga_name" placeholder="Business Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_email" class="col-sm-3 control-label">Business Email *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="orga_email" name="orga_email" placeholder="Business Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_phone" class="col-sm-3 control-label">Business Phone *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="orga_phone" name="orga_phone" placeholder="Business Phone" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_website" class="col-sm-3 control-label">Website URL *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="orga_website" name="orga_website" placeholder="Business Website" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="orga_presentation" class="col-sm-3 control-label">Business Presentation *</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="orga_presentation" name="orga_presentation" placeholder="Business Presentation" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="col-sm-3 control-label">Logo *</label>
                                            <div class="col-md-3">
                                                <input type="file" class="form-control" id="image" name="image" >
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Locality Information</legend>
                                        <div class="form-group">
                                            <label for="street" class="col-sm-3 control-label">Street Address *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="street" name="street" placeholder="Street Address" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="suburb" class="col-sm-3 control-label">Suburb *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="suburb" name="suburb" placeholder="Suburb" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="state" class="col-sm-3 control-label">State *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="state" name="state" placeholder="State" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="postCode" class="col-sm-3 control-label">Post Code *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="postCode" name="postCode" placeholder="Post Code" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Contact Details</legend>
                                        <div class="form-group">
                                            <label for="contact_name" class="col-sm-3 control-label">Contact Name *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_email" class="col-sm-3 control-label">Contact Email *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_phone" class="col-sm-3 control-label">Contact Email *</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact Phone" required>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>CRM Provider</legend>
                                        <div class="form-group">
                                            <label for="crm_name" class="col-sm-3 control-label">CRM Provider Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="crm_name" name="crm_name" placeholder="CRM Provider Name" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="crm_email" class="col-sm-3 control-label">CRM Provider Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="crm_email" name="crm_email" placeholder="CRM Provider Email" required>
                                            </div>
                                        </div>
                                        <em class="help-block">(*) Required field</em>
                                    </fieldset>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-primary">Valider mon inscription</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
