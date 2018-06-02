@extends('layouts.backend')

@section('subcontent')
<div class="row">
     <div class="panel panel-default">
         <div class="panel-heading"><h3>{{$title}}</h3></div>
        <div class="panel-body">
          <ul class="list-group">
            @if($item->product)
              <li class="list-group-item clearfix">
                  <div class="pull-left">
                      <h4>{{$item->product->title}}</h4>
                      <p><strong>Quantity:</strong> {{$item->quantity}}</p>
                      <p><strong>Price:</strong> ${{$item->price}}</p>
                  </div>
                  <div class="pull-right">
                      <span class="badge">{{$item->tma}} $</span>
                  </div>
              </li>
            @endif
            @if(\Auth::user()->hasRole('apl')&&$item->author)
              <li class="list-group-item clearfix">
                  <div>
                      <h4>@lang('app.customer')</h4>
                      <p><strong>{{$item->author->name}}</strong></p>
                  </div>
              </li>
            @endif
            @if(!\Auth::user()->hasRole('member')&&$item->product&&$item->product->seller)
              <li class="list-group-item clearfix">
                  <div>
                      <h4>@lang('app.seller')</h4>
                      <p><strong>{{$item->product->seller->name}}</strong></p>
                  </div>
              </li>
            @endif
            @if($item->apl)
              <li class="list-group-item clearfix">
                  <div>
                      <h4>@lang('app.apl')</h4>
                      <p><strong>{{$item->apl->name}}</strong></p>
                  </div>
                  <div>
                    @if($item->status=='ordered')
                        @if($item->apl_paid_at)
                            <span class="label label-info">@lang('app.paid')</span>
                            <span class="pull-right label label-default">{{$item->apl_paid_at->diffForHumans()}}</span>
                        @else
                            <span class="label label-warning">@lang('app.not_paid')</span>
                        @endif
                    @endif
                  </div>
              </li>
            @endif
            @if(!\Auth::user()->hasRole('member')&&$item->afa)
              <li class="list-group-item clearfix">
                  <div>
                      <h4>@lang('app.afa')</h4>
                      <p><strong>{{$item->afa->name}}</strong></p>
                  </div>
                  <div>
                    @if($item->status=='ordered')
                        @if($item->afa_paid_at)
                            <span class="badge badge-info">@lang('app.paid')</span>
                            <span class="pull-right label label-default">{{$item->afa_paid_at->diffForHumans()}}</span>
                        @else
                            <span class="label label-warning">@lang('app.not_paid')</span>
                        @endif
                    @endif
                  </div>
              </li>
            @endif
          </ul>
        </div>
    </div>
</div>
@endsection
