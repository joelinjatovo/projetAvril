@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div id="messeges" class="panel panel-default">
                <div class="panel-heading">Chatbox</div>
                @if ($items)
                    @foreach ($items as $item)
                        <div class="panel-body">
                            {{$item->message}}
                        </div>
                    @endforeach
                @endif
            </div>
            <input type="text" id="text-box" class="form-control" rows="3" placeholder="Type something here...">
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/ajax-chat.js')}}"></script>
@endsection