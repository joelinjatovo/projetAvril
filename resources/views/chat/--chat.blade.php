@extends('layouts.backend')

@section('subcontent')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">messenger</div>

            <div class="panel-body">
                <ul class="messages">
                @foreach ($items as $item)
                    <li>{{ $item->message}} </li>
                @endforeach
                </ul>
                <br >
                <form method="post" action="">
                    {{ csrf_field() }}
                    <input type="hidden" id="user_from" name="user_from" value="{{$from->id}}">
                    <input type="hidden" id="user_to" name="user_to" value="{{$to->id}}">
                    <input type="hidden" id="date" name="date" value="{{time()}}">
                    <input type="text" class="form-control" id="message" name="message">
                    <br >
                    <input type="submit" id="sendMessage" value="send" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$("#sendMessage").on("click",function(e){
    e.preventDefault();
    var user_from= $("#user_from").val();
    var user_to= $("#user_to").val();
    var message= $("#message").val();
    var token= '{{csrf_token()}}';
    $.ajax({
        type:"POST",
        url:"{{route('chat.with', $to)}}",
        data: {"user_from": user_from,"user_to": user_to,"message":message,"_token":token},
        before:function(){
            $('#sendMessage').addClass('hidden');
        },
        success:function(res){
            $('.messages').append('<li>'+res.content+'</li>');
            $('#sendMessage').removeClass('hidden');
        }
    });
});

    
function check_demande($url) {
    $.ajax({
        url: $url,
        ifModified:true,
        success: function(res){
            $('#demandes').html(res.content); //span où tu veux que ce nombre apparaisse
        }
    });
    setTimeout(check_demande, 5000);
}
</script>
@endsection