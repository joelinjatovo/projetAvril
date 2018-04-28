@extends('layouts.app')

@section('content')
<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <section class="widget property-meta-wrapper common">
                  <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                      <div class="item active">
                        <img src="{{asset('images/Surfers_Paradise.jpg')}}" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="{{asset('images/caroussel-image-1.jpg')}}" alt="..." style="width:100%;">
                      </div>
                      <div class="item">
                        <img src="{{asset('images/caroussel-image-2.jpg')}}" alt="..." style="width:100%;">
                      </div>
                    </div>
                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </section>

                <section class="property-meta-wrapper common">
                    @include('includes.alerts')
                    <div class="row">
                        <div class="col-sm-12">
                          <a href="#" class="btn btn-warning col-sm-6"><i class="fa fa-envelope-open-o"></i> contacter l'administrateur</a>
                          <a href="#" class="btn btn-success col-sm-6"><i class="fa fa-envelope-open-o"></i> contacter l'APL</a>
                        </div>
                    </div>
                    <form method="post" action="{{route('shop.add', ['product'=>$item])}}" class="form-inline">
                        {{csrf_field()}}
                      <div class="form-group mx-sm-3 mb-2 col-md-12">
                          <input type="checkbox" name="is_default" value="true" {{(old('is_default'))?'checked':''}}>Choisir comme APL par defaut
                      </div>
                      <div class="form-group mx-sm-3 mb-2 col-md-6">
                        <label for="apl" class="sr-only">Password</label>
                        <select class="form-control" id="apl" name="apl">
                            <option>@lang('app.select_one')</option>
                            @foreach($apls as $apl)
                            <option value="{{$apl->id}}" {{(old('apl')==$apl->id)?'selected':''}}>{{$apl->name}}</option>
                            @endforeach
                        </select>
                      </div>
                      <button type="submit" class="btn btn-primary mb-2  col-md-6">@lang('app.i_want_buy_this_item')</button>
                    </form> 
                    <div class="row">
                        <div class="col-sm-12">
                          <a href="{{route('label.store', ['product'=>$item,'type'=>'saved'])}}" class="btn btn-info col-sm-6"><i class="fa fa-floppy-o" aria-hidden="true"></i> Sauvegarder</a>
                          <a href="{{route('label.store', ['product'=>$item,'type'=>'starred'])}}" class="btn btn-info col-sm-6"><i class="fa fa-floppy-o" aria-hidden="true"></i> Ajouter aux favoris</a>
                        </div>
                    </div>
                </section>
                
                
                <section class="property-meta-wrapper common">
                    <h3 class="entry-title">@lang('app.detail')</h3>
                    <div class="property-single-meta">
                        <ul class="clearfix">
                            <li><span>Réference_ID:</span> {{$item->reference}}</li>
                            <li><span>Publication du</span> {{$item->created_at}}</li>
                            <li><span>Prix:</span>{{$item->price}}</li>
                            @if($item->location)
                            <li><span>Adresse:</span> {{$item->location->toString()}}</li>
                            @endif
                        </ul>
                    </div>
                </section>
                <section class="property-contents common">
                    <div class="entry-title clearfix">
                        <h4 class="pull-left">@lang('app.description') </h4><a class="pull-right print-btn" href="javascript:window.print()">Print This Property <i class="fa fa-print"></i></a>
                    </div>
                    <p>{{$item->content}}</p>
                </section>
                <section class="property-nearby-places common">
                    <h4 class="entry-title">Agglomérations</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56365.45787293253!2d153.422381!3d-27.998757!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b910fe19fd1c2b7%3A0x502a35af3dea680!2sSurfers+Paradise+Queensland+4217%2C+Australie!5e0!3m2!1sfr!2sus!4v1509962436469" width="700" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                </section>
            </div>
            <div class="col-lg-4 col-md-5">
                @include('product.sidebar')
            </div>
        </div>
    </div>

    <div id="blog-listing" class="grid-style">
        <section id="property-listing">
            <header class="section-header text-center">
                <div class="container">
                    <h2 class="pull-left">Produits enregistrés</h2>
                </div>
            </header>

            <div class="container section-layout">
                <div class="row">
                    <!-- start section products -->
                    @foreach($products as $product)
                    <div class="col-lg-4 col-sm-6 layout-item-wrap">
                        @include('product.single', ['item'=>$product])
                    </div>
                    @endforeach
                    <!-- end section products -->
                </div>
            </div>
        </section>
    </div>
@endsection