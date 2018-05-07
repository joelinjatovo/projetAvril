@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default">
            <div id="messages" class="panel panel-default">
                <div class="panel-heading message-list">Chatbox</div>
                @if ($items)
                    @foreach ($items as $item)
                        <div class="panel-body">
                            {{$item->message}}
                        </div>
                    @endforeach
                @endif
            </div>
            <input type="hidden" id="token" name="_token" value="{{csrf_token()}}">
            <input type="text" id="text-box" class="form-control" rows="3" placeholder="Type something here...">
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel panel-default">
                <div class="panel-heading">Connected</div>
                @if (isset($sessions))
                    @foreach ($sessions as $session)
                        <div class="panel-body">
                            {{$session->user->name}}
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('js/ajax-chat.js')}}"></script>
@endsection