@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div class="form-horizontal">
        <div class="form-group">
            <a href="{{route('profile.edit')}}" class="btn btn-info">Modifier Profile</a>
            <a href="{{route('avatar.edit')}}"  class="btn btn-warning">Modifier Avatar</a>
            <a href="{{route('password.edit')}}"  class="btn btn-success">Modifier Mot de passe</a>
            <a href="{{route('location.edit')}}" class="btn btn-info">Modifier Localisation</a>
        </div>
        <div class="col-sm-12">
            <fieldset>
                <legend>Login Information</legend>
                <div class="col-sm-12">
                    <div class="col-sm-9">
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Langage</label>
                            <div class="col-sm-9">{{$item->language=='en'?'Anglais':'Français'}}</div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <section class="widget">
                            <img src="{{$item->imageUrl(false)}}" alt="{{$item->name}}"  width="100%">
                        </section>
                    </div>
                </div>
            </fieldset>
        </div>
        @if($item->apl && $item->hasRole('member'))
        <div class="col-sm-12">
            <fieldset>
                <legend>APL Information</legend>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Login</label>
                            <div class="col-sm-9">{{$item->apl->name}}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email">Adresse Email</label>
                            <div class="col-sm-9">{{$item->apl->email}}</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="email">Type</label>
                            <div class="col-sm-9">{{$item->apl->type}}</div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        @endif
        @if($item->hasRole('member') && $item->type == 'person')
        <div class="col-sm-12">
            <fieldset>
                <legend>Person Details</legend>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-9">{{$item->get_meta('firstname')?$item->get_meta('firstname')->value:''}}</div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-9">{{$item->get_meta('lastname')?$item->get_meta('lastname')->value:''}}</div>
                    </div>
                    <div class="form-group">
                        <label for="phone" class="col-sm-3 control-label">Phone</label>
                        <div class="col-sm-9">{{$item->get_meta('phone')?$item->get_meta('phone')->value:''}}</div>
                    </div>
                </div>
            </fieldset>
        </div>
        @else
        <div class="col-sm-12">
            <fieldset>
                <legend>Business Details</legend>
                <div class="col-sm-12">
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
                    @if($item->hasRole('afa'))
                    <div class="form-group">
                        <label for="orga_operation_state" class="col-sm-3 control-label">State of legal operation of your present office</label>
                        <div class="col-sm-9">{{$item->get_meta('orga_operation_state')?$item->get_meta('orga_operation_state')->value:''}}</div>
                    </div>
                    <div class="form-group">
                        <label for="orga_operation_range" class="col-sm-3 control-label">Range of operation of your present office</label>
                        <div class="col-sm-9">{{$item->get_meta('orga_operation_range')?$item->get_meta('orga_operation_range')->value:''}}</div>
                    </div>
                    @endif
                </div>
            </fieldset>
        </div>
        @endif
        <div class="col-sm-12">
            <fieldset>
                <legend>Locality Information</legend>
                <div class="col-sm-12">
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
                </div>
            </fieldset>
        </div>
        <div class="col-sm-12">
            <fieldset>
                <legend>Contact Details</legend>
                <div class="col-sm-12">
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
                </div>
            </fieldset>
        </div>
        <div class="col-sm-12">
            <fieldset>
                <legend>CRM Provider</legend>
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="crm_name" class="col-sm-3 control-label">CRM Provider Name</label>
                        <div class="col-sm-9">{{$item->get_meta('crm_name')?$item->get_meta('crm_name')->value:''}}</div>
                    </div>
                    <div class="form-group">
                        <label for="crm_email" class="col-sm-3 control-label">CRM Provider Email</label>
                        <div class="col-sm-9">{{$item->get_meta('v')?$item->get_meta('crm_email')->value:''}}</div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection

