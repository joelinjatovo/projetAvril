<table class="table table-striped table-hover items-list">
    <thead>
        <tr>
            <th scope="col">Publicités<span class="column-sorter"></span></th>
            <th scope="col">Liens<span class="column-sorter"></span></th>
            <th scope="col">Pages Liées<span class="column-sorter"></span></th>
            <th scope="col">Date de publication <span class="column-sorter"></span></th>
            <th scope="col">Auteur <span class="column-sorter"></span></th>
            <th scope="col" class="pull-right">Actions </th>
        </tr>
    </thead>
    <tbody>
      @foreach($pubs as $pub) 
        <tr>
            <td class="item">
                 <a  href="{{route('admin.pub.show', $pub)}}">
                  <div class="item-img">
                    <img src="{{$pub->imageUrl()}}" alt="pub Image">
                  </div>
                  <div class="item-info">
                    <span class="item-title">
                        {{$pub->title}}
                    </span>
                    <span class="item-description">
                      {{$pub->excerpt()}}
                    </span>
                  </div>
                 </a>
            </td>
            <td>{{$pub->links}}</td>
            <td>{{count($pub->pages)}}</td>
            <td>{{$pub->created_at->diffForHumans()}}</td>
            <td><a href="{{route('admin.user.show', $pub->author)}}">{{$pub->author->name}}</a></td>
            <td>
               <div class="btn-group pull-right">
                    <a href="{{route('admin.pub.edit', $pub)}}" class="btn btn-small btn-default btn-update">@lang('app.btn.edit')</a>
                    @if(isset($page))
                    <a href="{{route('admin.pub.detach', ['pub'=>$pub, 'page'=>$page])}}" class="btn btn-small btn-default btn-detach">@lang('app.btn.detach')</a>
                    @endif
                    <a href="{{route('admin.pub.delete', $pub)}}" class="btn btn-small btn-danger btn-delete"><i class="fa fa-trash-o"></i></a>
               </div>
            </td>
        </tr>
       @endforeach
    </tbody>
</table>
