@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div class="row-fluid page-head">
        <h2 class="page-title">@lang('app.message')</h2>
    </div>
    @include('includes.alerts')
    <div class="">
        <div class="widget widget-simple">
            <div class="widget-content">
                <div class="widget-body">
                    <form action="{{route('admin.mail.compose')}}" method="post" id="commentform" class="contact-form" >
                        {{ csrf_field() }}
                        <ul class="form-list label-left list-bordered dotted" style="padding:0px;">
                            <li class="control-group">
                                <label for="role">Selectionner ROLE</label>
                                <div class="controls">
                                    <select id="role" name="role" class="selectpicker input-block-level">
                                        <option value="admin">Admin</option>
                                        <option value="apl">APL</option>
                                        <option value="afa">AFA</option>
                                        <option value="member">Member</option>
                                        <option value="seller">Seller</option>
                                    </select>
                                </div>
                            </li>
                            <li class="control-group">
                                <label for="users">Selectionner utilisateurs</label>
                                <div class="controls">
                                    <select id="users" name="users[]" class="selectpicker input-block-level" multiple>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </li>
                            <li class="control-group">
                                <label for="subject" class="control-label">@lang('app.subject')</label>
                                <div class="controls">
                                    <input id="subject" class="input-block-level" name="subject" type="text" placeholder="@lang('app.subject') *" aria-required="true" required="required">
                                </div>
                            </li>
                            <li class="control-group">
                                <label for="message">@lang('app.message')</label>
                                <div class="controls">
                                    <textarea id="message" class="input-block-level ckeditor" rows="10" name="content" placeholder="@lang('app.message')" ></textarea>
                                </div>
                            </li>
                            <li class="control-group">
                                <div class="controls">
                                    <input type="submit" class="btn btn-green" value="@lang('app.btn.send')" >
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <!-- // Widget -->
    </div>
</div>
@endsection
