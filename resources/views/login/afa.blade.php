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

@section('content')<div class="main-slider-wrapper clearfix content corps">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="page-title aligncenter">Australian Francophone Agents</h3>
            <div id="content">
                <div role="main">
                    <div id="breadcrumbs" class="group font-size-14">
                        <div class="breadcrumb">
                            <a href="accueil.php">Home</a>
                            <span class="aquo">&gt;</span>
                            Australian francophone agents
                        </div>
                    </div>

                    <div id="entry" class="group">
                        <h4 class="page-title aligncenter">PropertyHQ – Create an Automated Account</h4><br>
                        <div class="hasfloat aligncenter">
                            <b>
                            Get your properties automatically sent to PropertyHQ.com platform from your CRM System.
                            This means there is no extra work needed from your side for having your properties
                            listed with us. Simply fill in the form below and our staff will contact your CRM to
                            organise the feed.
                            </b>
                        </div>
                        <div class="hasfloat">

                            <form class="zoowidget-form" method="post" action="inscrire" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <input type="hidden" name="type" value="AFA">
                                <fieldset>
                                    <legend>Business Details</legend>
                                    <ol>
                                        <li>
                                            <label for="form_agency_name">Business Name *</label>
                                            <input type="text" name="nom" id="nom" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_street_address">Street Address *</label>
                                            <input type="text" name="adresse" id="adresse" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_suburb">Suburb *</label>
                                            <input type="text" name="ville" id="ville" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_state">State *</label>
                                            <input type="text" name="etat" id="etat" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_postcode">Postcode *</label>
                                            <input type="text" name="codePostal" id="codePostal" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_agency_email">Business Email *</label>
                                            <input type="text" name="email" id="email" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_agency_phone">Business Phone *</label>
                                            <input type="text" name="numero" id="numero" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_agency_website">Website URL</label>
                                            <input type="text" name="websiteUrl" id="websiteUrl" value="">
                                        </li>
                                    </ol>
                                </fieldset>
                                <fieldset>
                                    <legend>Business Logo</legend>
                                        <ol>
                                            <li>
                                                <label for="form_agency_logo">Business Logo</label>
                                                <input type="file" name="logo" id="logo" value="">
                                            </li>
                                        </ol>
                                </fieldset>
                                <fieldset>
                                    <legend>Contact Details</legend>
                                    <ol>
                                        <li>
                                            <label for="form_contact_name">Contact Name</label>
                                            <input type="text" name="contactNom" id="contactNom" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_contact_email">Contact Email</label>
                                            <input type="text" name="contactEmail" id="contactEmail" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_contact_mobile">Contact Mobile</label>
                                            <input type="text" name="contactMobile" id="contactMobile" value="" required>
                                        </li>
                                    </ol>
                                </fieldset>
                                <fieldset>
                                    <legend>Operability</legend>
                                    <ol>
                                        <li>
                                            <b>State of legal operation of your present office * : </b><br><br>
                                            <select name="etatOperation" id="etatOperation">
                                                <option value="SA"> &nbsp; South Australia</option>
                                                <option value="WA"> &nbsp; Western Australia</option>
                                                <option value="NSW"> &nbsp; New South Wales</option>
                                                <option value="QLD"> &nbsp; Queensland</option>
                                                <option valu="TAS"> &nbsp; Tasmania</option>
                                                <option value="VIC"> &nbsp; Victoria</option>
                                            </select>
                                        </li>
                                        <li>
                                            <b>Language : </b><br><br>
                                            <select name="lang" id="lang">
                                                <option value="fr"> &nbsp; French</option>
                                                <option value="eng"> &nbsp; English</option>
                                            </select>
                                        </li>

                                    </ol>
                                </fieldset>

                                <fieldset>
                                    <legend>Range of operation of your present office * </legend>
                                    <ol>
                                        <li>
                                            <label for="operabilite">Range of operation of your present office</label>
                                            <select name="operabilite" id="operabilite">
                                                <option value="10"> &nbsp; 10 km</option>
                                                <option value="25"> &nbsp; 25 km</option>
                                                <option value="50"> &nbsp; 50 km</option>
                                                <option value="100"> &nbsp; 100 km</option>
                                                <option value="250"> &nbsp; 250 km</option>
                                                <option value="tout"> &nbsp; all over the State of legal operation</option>
                                            </select>
                                        </li>
                                    </ol>
                                </fieldset>

                                <fieldset>
                                    <legend>Presentation of the Agency * </legend>
                                    <ol>
                                        <li>
                                            <textarea class="form-control" name="presentation" id="presentation" onkeyup="textLimit(this, 2000);">
                                            </textarea>
                                        </li>
                                    </ol>
                                </fieldset>

                                <fieldset>
                                    <legend>CRM Provider</legend>
                                    <ol>
                                        <li>
                                            <label for="form_crm_name">CRM Provider Name</label>
                                            <input type="text" name="crmName" id="crmName" value="" required>
                                        </li>
                                        <li>
                                            <label for="form_crm_email">CRM Provider Email</label>
                                            <input type="text" name="crmEmail" id="crmEmail" value="" required>
                                        </li>
                                        <li>
                                            <em class="help-block">(*) Required field</em>
                                        </li>
                                    </ol>
                                </fieldset>

                                <fieldset>
                                    <ol>
                                        <li>
                                            <a type="button" class="pull-left btn btn-danger btn-lg text-center" href="/">Abandonner</a>
                                        </li>
                                        <li>
                                            <input type="submit" class="pull-right btn btn-danger btn-lg text-center" name="btnSubmit" id="btnSubmit" value="SUBMIT">
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
