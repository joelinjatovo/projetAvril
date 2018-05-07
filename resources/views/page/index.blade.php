@extends('layouts.app')

@section('content')
@if($item->id==1)
    @include('includes.slider')
@else
    @component('includes.breadcrumb')
        {{$item->title}}
    @endcomponent
@endif
<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <section class="property-contents common">
                    <div class="entry-title clearfix">
                        <h4 class="pull-left">{{$item->title}}</h4>
                    </div>
                    <p>{!!$item->content!!}</p>
                </section>

                @foreach($item->childs as $child)
                <section class="property-contents common text-center">
                    <header class="section-header home-section-header">
                       <h4 class="wow slideInRight">{{$child->title}}</h4>
                    </header>
                    <div class="row">
                        <div class="property-single-metax">{!!$child->content!!}</div>
                    </div>
                </section>
                @endforeach
           </div>
           <div class="col-lg-4 col-md-5">
                @include('page.sidebar')
           </div>
        </div>
    </div>
</div>


       <!-- ARTICLE ENREGISTREES -->
<div class="container">
  <header class="section-header text-center">
     <div class="container">
       <h4 class="pull-left">Derniers Produits </h4>
     </div>
  </header>
   <div class="row">
       @php $i = 0; @endphp
       @foreach($recentProducts as $product)
           @if($i%3 === 0)
           <div class="col-lg-12">
           @endif
           <div class="col-lg-4 col-sm-6 layout-item-wrap mix a0">
                @include('product.single', ['item'=>$product])
           </div>
           @php $i++; @endphp
           @if($i%3 === 0)
           </div>
           @endif
       @endforeach
       @if(($i%3) > 0)
            </div>
       @endif
   </div>
</div>

   <!-- ARTICLE ENREGISTREES -->
<div class="container">
 <header class="section-header text-center">
     <div class="container">
       <h4 class="pull-left">Derniers Articles</h4>
     </div>
 </header>
   <div class="row">
       @php $i = 0; @endphp
       @foreach($blogs as $blog)
           @if($i%3 === 0)
           <div class="col-lg-12">
           @endif
           <div class="col-lg-4 col-sm-6 layout-item-wrap mix a0">
                @include('blog.single',  ['item'=>$blog])
           </div>
           @php $i++; @endphp
           @if($i%3 === 0)
           </div>
           @endif
       @endforeach
       @if(($i%3) > 0)
            </div>
       @endif
   </div><!-- /row -->
</div>
@endsection
