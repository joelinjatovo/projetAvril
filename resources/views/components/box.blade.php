<div class="box {{isset($class)?$class:''}}">
   
    @if(isset($title))
    <div class="box-header with-border">
      <h3 class="box-title">{{$title}}</h3>

      @if(isset($button) && $button)
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
      @endif
    </div>
    <!-- /.box-header -->
    @endif

    <div class="box-body">
        {{$slot}}
    </div>
    <!-- /.box-body -->

    @if(isset($footer))
    <div class="box-footer text-center">
        {{$footer}}
    </div>
    <!-- /.box-footer -->
    @endif
    
</div>
<!-- /.box -->