$(document).ready(function(){
	$("#text-box").keyup(function(e){
		if (e.keyCode == 13 && $("#text-box").val() != "") {
			var text = $("#text-box").val();
			$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('#token').val()
	            }
	        })
			$.ajax({
				type: 'POST',
				url: location.href,
				data: {message:text},
				success:function(res){
					//$('#messages').load(location.href + " #message>*","");
					$("#text-box").val("");
					$("#messages").append(res.content);
				}
			});
		}
	});
	setInterval(function(){
		$('#messeges').load(location.href + " #messeges>*","");
	},1500);
});