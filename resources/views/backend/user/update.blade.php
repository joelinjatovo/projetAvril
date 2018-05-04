@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('profile.edit')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <fieldset>
            <legend>Login Information</legend>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="name">Login *</label>
                <div class="col-sm-9">
                    <input name="name" value="{{$item->name}}" type="text" class="form-control" id="name" placeholder="Votre nom d'utilisateur" disabled>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="email">Adresse Email *</label>
                <div class="col-sm-9">
                    <input name="email" value="{{$item->email}}" type="text" class="form-control" id="email" placeholder="you@exemple.com" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="language" class="col-sm-3 control-label" for="language">Langage *</label>
                <div class="col-sm-9">
                    <select name="language" class="form-control" id="language">
                        <option value="fr" {{$item->name=='fr'?'selected':''}}>Français</option>
                        <option value="en" {{$item->name=='en'?'selected':''}}>Anglais</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Business Details</legend>
            <div class="form-group">
                <label for="orga_name" class="col-sm-3 control-label">Business Name *</label>
                <div class="col-sm-9">
                    <input  name="orga_name" value="{{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}" type="text" class="form-control" id="orga_name" placeholder="Business Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="orga_email" class="col-sm-3 control-label">Business Email *</label>
                <div class="col-sm-9">
                    <input name="orga_email" type="text" value="{{$item->get_meta('orga_email')?$item->get_meta('orga_email')->value:''}}" class="form-control" id="orga_email" placeholder="Business Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="orga_phone" class="col-sm-3 control-label">Business Phone *</label>
                <div class="col-sm-9">
                    <input name="orga_phone" value="{{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}" type="text" class="form-control" id="orga_phone" placeholder="Business Phone" required>
                </div>
            </div>
            <div class="form-group">
                <label for="orga_website" class="col-sm-3 control-label">Website URL *</label>
                <div class="col-sm-9">
                    <input name="orga_website" value="{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}" type="text" class="form-control" id="orga_website" placeholder="Business Website" required>
                </div>
            </div>
            <div class="form-group">
                <label for="orga_presentation" class="col-sm-3 control-label">Business Presentation *</label>
                <div class="col-sm-9">
                    <textarea  class="form-control" id="orga_presentation" name="orga_presentation" placeholder="Business Presentation" rows="5">{{$item->get_meta('orga_presentation')?$item->get_meta('orga_presentation')->value:''}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Logo *</label>
                <div class="col-md-3">
                    <input type="file" class="form-control" id="image" name="image" >
                </div>
            </div>
            <div class="form-group">
                <label for="orga_operation_state" class="col-sm-3 control-label">State of legal operation of your present office *</label>
                <div class="col-sm-9">
                    <select class="form-control" name="orga_operation_state" id="orga_operation_state">
                        <option value="south"> South Australia</option>
                        <option value="western"> Western Australia</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="orga_operation_range" class="col-sm-3 control-label">Range of operation of your present office *</label>
                <div class="col-sm-9">
                    <select class="form-control" name="orga_operation_range" id="orga_operation_range">
                        <option value="10"> 10km</option>
                        <option value="25"> 25km</option>
                        <option value="50"> 50km</option>
                        <option value="100"> 100km</option>
                        <option value="250"> 250km</option>
                    </select>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Locality Information</legend>
            <div class="form-group">
                <label for="street" class="col-sm-3 control-label">Street Address *</label>
                <div class="col-sm-9">
                    <input value="{{$item->location?$item->location->street:''}}" type="text" class="form-control" id="street" name="street" placeholder="Street Address" required>
                </div>
            </div>
            <div class="form-group">
                <label for="suburb" class="col-sm-3 control-label">Suburb *</label>
                <div class="col-sm-9">
                    <input value="{{$item->location?$item->location->suburb:''}}" type="text" class="form-control" id="suburb" name="suburb" placeholder="Suburb" required>
                </div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-3 control-label">State *</label>
                <div class="col-sm-9">
                    <input value="{{$item->location?$item->location->state:''}}" type="text" class="form-control" id="state" name="state" placeholder="State" required>
                </div>
            </div>
            <div class="form-group">
                <label for="postCode" class="col-sm-3 control-label">Postal Code *</label>
                <div class="col-sm-9">
                    <input value="{{$item->location?$item->location->postalCode:''}}" type="text" class="form-control" id="postCode" name="postalCode" placeholder="Postal Code" required>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Contact Details</legend>
            <div class="form-group">
                <label for="contact_name" class="col-sm-3 control-label">Contact Name *</label>
                <div class="col-sm-9">
                    <input  value="{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}" type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Contact Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="contact_email" class="col-sm-3 control-label">Contact Email *</label>
                <div class="col-sm-9">
                    <input value="{{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:''}}" type="text" class="form-control" id="contact_email" name="contact_email" placeholder="Contact Email" required>
                </div>
            </div>
            <div class="form-group">
                <label for="contact_phone" class="col-sm-3 control-label">Contact Phone *</label>
                <div class="col-sm-9">
                    <input value="{{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:''}}" type="text" class="form-control" id="contact_phone" name="contact_phone" placeholder="Contact Phone" required>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>CRM Provider</legend>
            <div class="form-group">
                <label for="crm_name" class="col-sm-3 control-label">CRM Provider Name</label>
                <div class="col-sm-9">
                    <input value="{{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}" type="text" class="form-control" id="crm_name" name="crm_name" placeholder="CRM Provider Name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="crm_email" class="col-sm-3 control-label">CRM Provider Email</label>
                <div class="col-sm-9">
                    <input value="{{$item->get_meta('v')?$item->get_meta('crm_email')->value:''}}" type="text" class="form-control" id="crm_email" name="crm_email" placeholder="CRM Provider Email" required>
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
@endsection

