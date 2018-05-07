$(document).ready(function(){
	$("#text-box").keyup(function(e){
		if (e.keyCode == 13 && $("#text-box").val() != "") {
			var text = $("#text-box").val();
			$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
	            }
	        })
			$.ajax({
				type: 'POST',
				url: location.href,
				data: {message:text},
				success:function(){
					$('#messeges').load(location.href + " #messeges>*","");
					$("#text-box").val("");
				}
			});
		}
	});
	setInterval(function(){
		$('#messeges').load(location.href + " #messeges>*","");
	},1500);
});