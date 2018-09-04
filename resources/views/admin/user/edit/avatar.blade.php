@extends('layouts.lte')

@section('content')
<div class="row">
    <form class="form-horizontal" role="form" method="post" action="{{route('avatar.edit')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="col-sm-12">
            <div class="col-sm-4">
                <section class="widget">
                    <img src="{{$item->imageUrl()}}" alt="{{$item->name}}" width="100%">
                </section>
            </div>
            <div class="col-sm-8">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group">
                            <div class="col-md-12">
                                <input type="file" class="form-control" id="image" name="image" >
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                      <div class="pull-right">
                          <button type="submit" class="btn btn-info" name="method" value="draft"><i class="fa fa-database"></i> @lang('app.btn.save')</button>
                      </div>
                    </div>
                    <!-- /.box-footer -->
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

