<div class="widget widget-simple widget-table">
    <table class="table boo-table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Id <span class="column-sorter"></span></th>
                <th scope="col">Photo<span class="column-sorter"></span></th>
                <th scope="col">Utilisateur<span class="column-sorter"></span></th>
                <th scope="col">Contenu <span class="column-sorter"></span></th>
                <th scope="col">Date <span class="column-sorter"></span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($item->observations as $observation)
            <tr>
                <td>{{$observation->id}}</td>
                <td><img class="thumb" width="50" src="{{$observation->user?$observation->user->imageUrl():''}}"></td>
                <td>{{$observation->user?$observation->user->name:''}}</td>
                <td>{{$observation->excerpt()}}</td>
                <td>{{$observation->created_at->diffForHumans()}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- // DATATABLE - DTA -->
</div>
<div class="widget">
    <form class="form-horizontal" method="post" action="{{route('admin.user.observe', ['user'=>$item])}}">
        {{csrf_field()}}
        <textarea class="form-control" name="content">{{old('content')}}</textarea>
        <input class="btn btn-info" type="submit" value="Sauvegarder">
    </form>
</div>