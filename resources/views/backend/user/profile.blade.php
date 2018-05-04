@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div class="form-horizontal">
        <fieldset>
            <legend>Login Information</legend>
            <div class="col-sm-12">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Login</label>
                        <div class="col-sm-9">{{$item->name}}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Adresse Email</label>
                        <div class="col-sm-9">{{$item->email}}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">Type</label>
                        <div class="col-sm-9">{{$item->type}}</div>
                    </div>
                    @if($item->apl)
                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="email">APL</label>
                        <div class="col-sm-9">{{$item->apl->name}}</div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Langage</label>
                        <div class="col-sm-9">{{$item->language=='en'?'Anglais':'Français'}}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <section class="widget">
                        <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}">
                    </section>
                </div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Business Details</legend>
            <div class="form-group">
                <label for="orga_name" class="col-sm-3 control-label">Business Name</label>
                <div class="col-sm-9">{{$item->get_meta('orga_name')?$item->get_meta('orga_name')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="orga_email" class="col-sm-3 control-label">Business Email</label>
                <div class="col-sm-9">{{$item->get_meta('orga_email')?$item->get_meta('orga_email')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="orga_phone" class="col-sm-3 control-label">Business Phone</label>
                <div class="col-sm-9">{{$item->get_meta('orga_phone')?$item->get_meta('orga_phone')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="orga_website" class="col-sm-3 control-label">Website URL</label>
                <div class="col-sm-9">{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="orga_presentation" class="col-sm-3 control-label">Business Presentation *</label>
                <div class="col-sm-9">{{$item->get_meta('orga_presentation')?$item->get_meta('orga_presentation')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="orga_operation_state" class="col-sm-3 control-label">State of legal operation of your present office</label>
                <div class="col-sm-9">South Australia</div>
            </div>
            <div class="form-group">
                <label for="orga_operation_range" class="col-sm-3 control-label">Range of operation of your present office</label>
                <div class="col-sm-9">10km</div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Locality Information</legend>
            <div class="form-group">
                <label for="street" class="col-sm-3 control-label">Street Address</label>
                <div class="col-sm-9">{{$item->location?$item->location->street:''}}</div>
            </div>
            <div class="form-group">
                <label for="suburb" class="col-sm-3 control-label">Suburb</label>
                <div class="col-sm-9">{{$item->location?$item->location->suburb:''}}</div>
            </div>
            <div class="form-group">
                <label for="state" class="col-sm-3 control-label">State *</label>
                <div class="col-sm-9">{{$item->location?$item->location->state:''}}</div>
            </div>
            <div class="form-group">
                <label for="postCode" class="col-sm-3 control-label">Postal Code *</label>
                <div class="col-sm-9">{{$item->location?$item->location->postalCode:''}}</div>
            </div>
        </fieldset>
        <fieldset>
            <legend>Contact Details</legend>
            <div class="form-group">
                <label for="contact_name" class="col-sm-3 control-label">Contact Name *</label>
                <div class="col-sm-9">{{$item->get_meta('orga_website')?$item->get_meta('orga_website')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="contact_email" class="col-sm-3 control-label">Contact Email *</label>
                <div class="col-sm-9">{{$item->get_meta('contact_email')?$item->get_meta('contact_email')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="contact_phone" class="col-sm-3 control-label">Contact Phone *</label>
                <div class="col-sm-9">{{$item->get_meta('contact_phone')?$item->get_meta('contact_phone')->value:''}}</div>
            </div>
        </fieldset>
        <fieldset>
            <legend>CRM Provider</legend>
            <div class="form-group">
                <label for="crm_name" class="col-sm-3 control-label">CRM Provider Name</label>
                <div class="col-sm-9">{{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}</div>
            </div>
            <div class="form-group">
                <label for="crm_email" class="col-sm-3 control-label">CRM Provider Email</label>
                <div class="col-sm-9">{{$item->get_meta('v')?$item->get_meta('crm_email')->value:''}}</div>
            </div>
            <em class="help-block">(*) Required field</em>
        </fieldset>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-primary">Valider mon inscription</button>
            </div>
        </div>
    </div>
</div>
@endsection

