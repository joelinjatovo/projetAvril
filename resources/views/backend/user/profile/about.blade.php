<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">A propos de moi</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <strong><i class="fa fa-book margin-r-5"></i> @lang('app.description')</strong>
      <p class="text-muted">{{$item->meta('orga_desc')}}</p>
      
      @if($item->location)
      <hr>
      <strong><i class="fa fa-map-marker margin-r-5"></i> @lang('app.location')</strong>
      <p class="text-muted">
          {{$item->location->toString()}}
      </p>
      @endif
    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->