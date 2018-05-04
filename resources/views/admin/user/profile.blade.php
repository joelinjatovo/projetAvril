@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <div id="page-content" class="page-content tab-content overflow-y">
        <div id="TabTop1" class="tab-pane padding-bottom30 active fade in">
            @include('includes.notification')
            <div class="page-header">
                <h3>Profil administrateur</h3>
            </div>
            <div class="row-fluid">
                <div class="grider">
                    <div class="widget widget-simple">
                        <div class="widget-header">
                            <h4>Profil administrateur</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

