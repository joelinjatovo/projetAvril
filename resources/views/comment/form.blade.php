@if(Auth::check())
<div id="respond" class="comment-respond contact-form"> 
    <h4 id="reply-title" class="comment-reply-title">Laissez un commentaire</h4> 
    <form action="#" method="post" id="commentform" class="comment-form">
        {{csrf_field()}}
        <p class="form-content"><textarea id="comment" name="content" placeholder="Commentaire" cols="45" rows="8" aria-required="true" required="required"></textarea></p> 
        <p id="submit-comment" class="comment-submit btn btn-default btn-lg" onclick="postComment();">Poster un Commentaire</p> 
    </form>                             
</div>
<script>
function postComment(){
    $.ajax({
        url: '<?php echo route('comment.store', ['blog'=>$item]); ?>',
        type: "post",
        data: "{'_token':'{{csrf_token()}}', 'content':$('#comment').val()}",
        beforeSend: function()
        {
            $('.ajax-load').show();
        }
    }).done(function(data)
    {
        if(data.html == ""){
            norecord = true;
            $('.ajax-load').html("No more records found");
            return;
        }
        $('.ajax-load').hide();
        $(".commentlist").append('<li>'+data.html+'</li>');
    }).fail(function(jqXHR, ajaxOptions, thrownError)
    {
        $('.ajax-load').html("Server not responding....");
    });
}
</script>
@else
<div id="respond" class="comment-respond contact-form"> 
    <h4 id="reply-title" class="comment-reply-title">Connectez-vous pour laisser un commentaire</h4> 
    <a class="btn btn-default btn-lg" href="{{route('login')}}">Connectez</a>                          
</div>
@endif