<div class="widget widget-simple widget-table">
    <table id="exampleDTA" class="table boo-table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Images <span class="column-sorter"></span></th>
                <th scope="col">References <span class="column-sorter"></span></th>
                <th scope="col">Nom du produit</th>
                <th scope="col">Date de la vente <span class="column-sorter"></span></th>
                <th scope="col">Prix<span class="column-sorter"></span></th>
                <th scope="col">TMA<span class="column-sorter"></span></th>
                <th scope="col">Status<span class="column-sorter"></span></th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><img class="thumb" width="50" src="{{$product->imageUrl()}}"></td>
                <td>{{$product->reference}}</td>
                <td>{{$product->title}}</td>
                <td>{{$product->created_at}}</td>
                <td>{{$product->currency}} {{$product->price}} </td>
                <td>{{$product->tma}} % ({{$product->currency}} {{$product->price*($product->tma/100)}} )</td>
                <td>{{$product->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- // DATATABLE - DTA -->
</div>