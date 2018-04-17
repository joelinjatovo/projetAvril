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

                                <form class="zoowidget-form" method="post" action="inscrire" enctype="multipart/form-data">

                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="type" value="Vendeur">

                                    <fieldset>
                                        <legend>Type of Business</legend>
                                        <ol>
                                            <li>
                                            <select name="typeVendeur" id="typeVendeur">
                                                <option value="Builder"> &nbsp; Builder</option>
                                                <option value="Developer"> &nbsp; Developer</option>
                                            </select>
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Business Details</legend>
                                        <ol>
                                            <li>
                                                <label for="form_agency_name">Business Name *</label>
                                                <input type="text" name="nom" id="form_agency_name" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_street_address">Street Address *</label>
                                                <input type="text" name="adresse" id="adresse" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_suburb">Suburb *</label>
                                                <input type="text" name="ville" id="form_suburb" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_state">State *</label>
                                                <input type="text" name="etat" id="form_state" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_postcode">Postcode *</label>
                                                <input type="text" name="codePostal" id="form_postcode" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_agency_email">Business Email *</label>
                                                <input type="text" name="email" id="form_agency_email" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_agency_phone">Business Phone *</label>
                                                <input type="text" name="numeroTelephone" id="form_agency_phone" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_agency_website">Website URL</label>
                                                <input type="text" name="websiteUrl" id="form_agency_website" value="">
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Business Logo</legend>
                                        <ol>
                                            <li>
                                                <label for="form_agency_logo">Business Logo</label>
                                                <input type="file" name="logo" id="form_agency_logo" value="">
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Contact Details</legend>
                                        <ol>
                                            <li>
                                                <label for="form_contact_name">Contact Name *</label>
                                                <input type="text" name="contactNom" id="form_contact_name" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_contact_email">Contact Email *</label>
                                                <input type="text" name="conctactEmail" id="form_contact_email" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_contact_mobile">Contact Mobile *</label>
                                                <input type="text" name="contactNumero" id="form_contact_mobile" value="" required>
                                            </li>
                                        </ol>
                                    </fieldset>
                                    <fieldset>
                                        <legend>CRM Provider</legend>
                                        <ol>
                                            <li>
                                                <label for="form_crm_name">CRM Provider Name</label>
                                                <input type="text" name="crmProviderName" id="crmProviderName" value="" required>
                                            </li>
                                            <li>
                                                <label for="form_crm_email">CRM Provider Email</label>
                                                <input type="text" name="crmProviderEmail" id="crmProviderEmail" value="" required>
                                            </li>
                                            <li>
                                                <em class="help-block">(*) Required field</em>
                                                <input type="submit" name="btnSubmit" id="btnSubmit" value="Submit">
                                            </li>
                                        </ol>
                                    </fieldset>
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
