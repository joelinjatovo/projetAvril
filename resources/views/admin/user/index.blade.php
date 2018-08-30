@extends('layouts.lte')

@section('content')
<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      @include('admin/user/inc/profile-image', ['user'=>$item])

      <!-- About Me Box -->
      @include('admin/user/inc/profile-about')
    </div>
    <!-- /.col -->
    
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#observations" data-toggle="tab">@lang('app.observations')</a></li>
          
          @if($item->hasRole('member'))
          <li><a href="#orders" data-toggle="tab">@lang('app.orders')</a></li>
          <li><a href="#purchases" data-toggle="tab">@lang('app.purchases')</a></li>
          <li><a href="#favorites" data-toggle="tab">@lang('app.favorites')</a></li>
          @endif
          
          @if($item->hasRole('apl'))
          <li><a href="#customers" data-toggle="tab">@lang('app.customers')</a></li>
          <li><a href="#orders" data-toggle="tab">@lang('app.orders')</a></li>
          <li><a href="#sales" data-toggle="tab">@lang('app.sales')</a></li>
          @endif
          
          @if($item->hasRole('seller'))
          <li><a href="#products" data-toggle="tab">@lang('app.products')</a></li>
          <li><a href="#orders" data-toggle="tab">@lang('app.orders')</a></li>
          <li><a href="#sales" data-toggle="tab">@lang('app.sales')</a></li>
          @endif
          
          @if($item->hasRole('afa'))
          <li><a href="#orders" data-toggle="tab">@lang('app.orders')</a></li>
          <li><a href="#sales" data-toggle="tab">@lang('app.sales')</a></li>
          @endif
          
        </ul>
        <div class="tab-content">
          <div class="active tab-pane" id="observations">
            <!-- Post -->
            @foreach($item->observations as $observation)
            <div class="post">
              @if($observation->author)
              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{$observation->author->imageUrl()}}" alt="user image">
                    <span class="username">
                      <a href="#">{{$observation->author->fullname()}}</a>
                      <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                    </span>
                <span class="description">{{$observation->created_at?$observation->created_at->diffForHumans():''}}</span>
              </div>
              @endif
              <!-- /.user-block -->
              <p>{{$observation->content}}</p>
            </div>
            @endforeach
            <!-- /.post -->
            
            <!-- Post Form -->
            <div class="post">
               <form class="form-horizontal" method="post" action="{{route('admin.user.observe', ['user'=>$item])}}">
                  {{csrf_field()}}
                  <input type="text" class="form-control" name="content" value="{{old('content')}}" placeholder="Tapez votre observation">
              </form>
            </div>
            <!-- /.post Form -->
            
          </div>
          <!-- /.tab-pane -->
          
          @if($item->hasRole('member'))
          <div class="tab-pane" id="orders">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'ordered')->get()
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="purchases">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'paid')->get()
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="favorites">
            @include('admin.table.product',[
                'products'=>$item->favorites
            ])
          </div>
          <!-- /.tab-pane -->
          @endif
          
          @if($item->hasRole('apl'))
           <div class="tab-pane" id="customers">
            <!-- Customers -->
            @foreach($item->customers as $user)
            <div class="post">
              <div class="user-block">
                <img class="img-circle img-bordered-sm" src="{{$user->imageUrl()}}" alt="user image">
                    <span class="username">
                      <a href="#">{{$user->fullname()}}</a>
                      <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
                    </span>
                <span class="description">{{$user->created_at?$user->created_at->diffForHumans():''}}</span>
              </div>
              <!-- /.user-block -->
            </div>
            @endforeach
            <!-- /.post -->
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="orders">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'ordered')->get()
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="sales">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'paid')->get()
            ])
          </div>
          <!-- /.tab-pane -->
         @endif
          
         @if($item->hasRole('seller'))
          <div class="tab-pane" id="products">
            @include('admin.table.product',[
                'products'=>$item->products
            ])
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="orders">
            @include('admin.table.product',[
                'products'=>$item->products()->where('products.status', 'ordered')->get()
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="sales">
            @include('admin.table.product',[
                'products'=>$item->products()->where('products.status', 'paid')->get()
            ])
          </div>
          <!-- /.tab-pane -->
         @endif
          
         @if($item->hasRole('afa'))
          <div class="tab-pane" id="orders">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'ordered')->get()
            ])
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="sales">
            @include('admin.table.order',[
                'orders'=>$item->orders()->where('status', 'paid')->get()
            ])
          </div>
          <!-- /.tab-pane -->
         @endif
          
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

