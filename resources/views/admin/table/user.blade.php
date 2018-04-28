<div class="widget widget-simple widget-table">
    <table id="exampleDTA" class="table boo-table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Id <span class="column-sorter"></span></th>
                <th scope="col">Image</th>
                <th scope="col">Login</th>
                <th scope="col">E-mail <span class="column-sorter"></span></th>
                <th scope="col">Role<span class="column-sorter"></span></th>
                <th scope="col">Type<span class="column-sorter"></span></th>
                <th scope="col">Status<span class="column-sorter"></span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $client)
            <tr>
                <td>{{$client->id}}</td>
                <td><img class="thumb" width="50" src="{{$client->imageUrl()}}"></td>
                <td>{{$client->name}}</td>
                <td>{{$client->email}}</td>
                <td>{{$client->role}}</td>
                <td>{{$client->type}}</td>
                <td>{{$client->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>