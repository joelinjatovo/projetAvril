@extends('layouts.app')

@section('content')

@if($item->id==1)
    @include('includes.slider')
@else
    @component('includes.breadcrumb')
        {{$item->title()}}
    @endcomponent
@endif

<div id="property-single">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                @if(!empty($item->content()))
                <section class="property-contents common">
                    <header class="section-header home-section-header">
                       <h4 class="wow slideInRight">{{$item->title()}}</h4>
                    </header>
                    <div class="row">
                        <div class="property-single-metax">{!!$item->content()!!}</div>
                        @if(Auth::check()&&Auth::user()->isAdmin())
                        <a href="{{route('admin.page.update',$item)}}" class="more pull-right"><i class="fa fa-pencil"></i> @lang('app.btn.edit')</a> 
                        @endif
                    </div>
                </section>
                @endif
                @foreach($item->childs as $child)
                <section class="property-contents common" id="page-{{$child->id}}">
                    <header class="section-header home-section-header">
                       <h4 class="wow slideInRight">{{$child->title()}}</h4>
                    </header>
                    <div class="row">
                        <div class="property-single-metax">{!!$child->content()!!}</div>
                        @if(Auth::check()&&Auth::user()->isAdmin())
                        <a href="{{route('admin.page.update',$child)}}" class="more pull-right"><i class="fa fa-pencil"></i> @lang('app.btn.edit')</a> 
                        @endif
                    </div>
                </section>
                    @foreach($child->pubs as $pub)
                    <section class="widget property-meta-wrapper clearfix">
                        <h4 class="title wow slideInLeft">{{$pub->title}}</h4>
                        <div class="content-box-large box-with-header">
                            <a target="_blank" href="{{$pub->links?$pub->links:'#'}}"><img src="{{$pub->imageUrl()}}" class="img-rounded" alt="Cinque Terre" width="604" height="236"></a>
                        </div>
                    </section>
                    @endforeach
                @endforeach
           </div>
           <div class="col-lg-4 col-md-5">
                @include('includes.sidebar')
           </div>
        </div>
    </div>
</div>


<!-- Derniers Produits -->
<div class="container">
  <header class="section-header text-center">
     <div class="container">
       <h4 class="pull-left">Derniers Produits</h4>
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
