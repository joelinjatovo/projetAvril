
<div class="panel panel-default">
  <div class="panel-body">
      <div class="row">
          <div class="col-md-12">
              <div class="col-md-3">
                  <img style="width:100%;" class="map-info-image" id="lettrineImage" src="{{$item->imageUrl()}}" title="La cité royale de Loches" />
                  <h4>{{$item->name}}</h4>
                  <h6><i class="fa fa-envelop"></i>{{$item->email}}</h6>
              </div>
              <div class="col-md-9">
                  @if($item->location)
                  <p>{{$item->location->toString()}}</p>
                  @endif
                  <p>{{$item->get_meta('orga_description')?$item->get_meta('orga_description')->value:''}}</p>
              </div>
          </div>
          <div class="col-md-12">
              <a href="{{route('contact', $item)}}" class="btn btn-default pull-right">@lang('app.contact')</a>
          </div>
      </div>
  </div>
</div>
