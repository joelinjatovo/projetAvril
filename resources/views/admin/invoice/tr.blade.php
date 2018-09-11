
<tr>
    <td class="product-name">
        {{$invoice->title}}
    </td>
    <td class="product-price"><span>{{$invoice->currency}}</span> {{$invoice->amount}}</td>
    <td><span class="label label-success">{{$invoice->type}}</span></td>
    <td>{{$invoice->order_id}}</td>
    <td>{{$invoice->from->fullname()}}</td>
    <td>{{$invoice->to->fullname()}}</td>
    <td>
        <div class="btn-group pull-right">
              <a class="btn btn-default" href="{{route('admin.invoice.show', $invoice)}}">@lang('app.btn.view')</a>
        </div>
    </td>
</tr>
