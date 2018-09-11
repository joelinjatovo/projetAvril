@extends('layouts.lte')

@section('content')
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-green',
          'count' =>$count['products'],
          'title' =>__('app.products'),
          'icon'  =>'ion ion-stats-bars',
          'link'  =>route('seller.products'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-aqua',
          'count' =>$count['orders'],
          'title' =>__('app.orders'),
          'icon'  =>'ion ion-bag',
          'link'  =>route('seller.orders'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-aqua',
          'count' =>$count['sales'],
          'title' =>__('app.sales'),
          'icon'  =>'ion ion-bag',
          'link'  =>route('seller.sales'),
       ])
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
       @include('components.small-box', [
          'class' =>'bg-yellow',
          'count' =>$count['favorites'],
          'title' =>__('app.favorites'),
          'icon'  =>'ion ion-person-add',
          'link'  =>route('admin.user.list'),
       ])
    </div>
    <!-- ./col -->
</div>
<!-- /.row -->

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <section class="col-lg-6 connectedSortable">
      <!-- PRODUCT LIST -->
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Recently Added Products
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['products'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{route('seller.products')}}" class="uppercase">View All Products</a>
          @endslot
      @endcomponent
      <!-- PRODUCT LIST -->
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Recently Ordered Products
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['orders'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{route('seller.orders')}}" class="uppercase">View All Orders</a>
          @endslot
      @endcomponent
      
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Recently Saled Products
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['sales'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{route('seller.sales')}}" class="uppercase">View All Sales</a>
          @endslot
      @endcomponent
      
    </section>
    <!-- Right col -->
    <section class="col-lg-6 connectedSortable">
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Favorites Products
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['favorites'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{url(auth()->user()->role.'/favorites')}}" class="uppercase">View All Favorites</a>
          @endslot
      @endcomponent
      @component('components.box', ['button'=>true, 'class'=>'box-primary'])
          @slot('title')
              Searches
          @endslot
          
          <ul class="products-list product-list-in-box">
            @each('components.list.product', $recent['pins'], 'product')
          </ul>
          
          @slot('footer')
              <a href="{{url(auth()->user()->role.'/searches')}}" class="uppercase">View All Searches</a>
          @endslot
      @endcomponent
    </section>
</div>
@endsection