@extends('layouts.admin')

@section('content')
<div id="main-content" class="main-content container-fluid">
    <!-- // page head -->
    <div id="page-content" class="page-content">
        <div class="navbar navbar-page">
            <!-- /navbar-inner -->
        </div>
        <!-- /navbar -->
        
        <section>
            @include('includes.alerts')
            <div class="row-fluid margin-bottom40">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Information du site</legend>
                        <form method="post" action="{{route('config.paiement.update')}}">
                          <input type="hidden" name="_token" value="{{csrf_token()}}">
                          @foreach($titles as $key=>$value)
                            <label for="{{$key}}">{{$value}}</label>
                            <input id="{{$key}}" name="{{$key}}" class="input-block-level" type="text"
                                 value="{{old($key)?old($key):($item->get_meta($key)?$item->get_meta($key)->value:'')}}">
                            @endforeach
                          <button type="submit" class="btn btn-primary">Sauvegarder</button>
                          <button type="reset" class="btn btn-default">Annuler</button>
                        </form>
                    </fieldset>
                </div>
            </div>
        </section>
    </div>
</div>

@endsection