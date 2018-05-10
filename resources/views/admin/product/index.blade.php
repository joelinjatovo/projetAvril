@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            <div class="page-header">
                <h3>{{$item->title}}</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        @include('includes.alerts')
                        <div class="widget-content">
                            <div class="widget-body">
                                <div id="accounForm" class="form-horizontal">
                                    <div class="row-fluid">
                                        <div class="span12">
                                            <div class="control-group no-margin-bootom">
                                                <label class="control-label label-left">
                                                    <img src="{{$item->imageUrl(true)}}" class="thumbnail" width="96" height="96">
                                                </label>
                                                <div class="controls">
                                                    <h3>@lang('app.reference') : {{$item->reference}}</h3> 
                                                    <h4>@lang('app.status') : {{$item->status}}</h4> 
                                                    @if($item->category)
                                                    <h4>@lang('app.category') : <a href="{{route('admin.category.show', $item->category)}}">{{$item->category->title}}</a></h4> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12 form-dark">
                                            <fieldset>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="section-form">
                                                        <h4>@lang('app.description')</h4>
                                                    </li>
                                                    <li class="control-group">
                                                        {!!$item->content!!}
                                                    </li>
                                                </ul>
                                            </fieldset>
                                            <fieldset>
                                                <legend class="section-form">@lang('app.admin.location')</legend>
                                                <ul class="form-list label-left list-bordered dotted">
                                                    <li class="control-group">
                                                        <label for="adresse" class="control-label">@lang('app.admin.address')
                                                        </label>
                                                        <div class="controls controls-row">
                                                            {{$item->location?$item->location->address:''}}
                                                        </div>
                                                        <div class="controls margin-s0">
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="cite" class="control-label">@lang('app.admin.city')
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->city:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="paysList" class="control-label">@lang('app.admin.country')
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->country:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="etatList" class="control-label">@lang('app.admin.state')
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->state:''}}
                                                        </div>
                                                    </li>
                                                    <li class="control-group">
                                                        <label for="zipCode" class="control-label">@lang('app.admin.zip') / @lang('app.admin.postalCode')
                                                        </label>
                                                        <div class="controls">
                                                            {{$item->location?$item->location->postCode:''}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

