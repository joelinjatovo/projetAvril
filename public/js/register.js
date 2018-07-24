$(function(){
  var acceptation = 0;
    $(".jm").change(function(){
        if($(this).attr("type") == "checkbox"){
            acceptation++;
            if(acceptation == 5){
                $(".btnNextProcedure").attr("href","subscriptionAPL");
            }
        }else{
            acceptation--;
            $(".btnNextProcedure").removeAttr("href");
        }
    });

    $(".btnNextProcedure").click(function(){
        if(acceptation == 5){
            $(".help-block").css("color","#f2f2f2");
        }else{
            $(".help-block").css("color","#ff3300");
        }
    });

    function handleSelectectType($element){
      if($element.val() == "person"){
        $("#particulierForm").show();
        $("#organisationForm").hide();
      }else if($element.val() == "organization"){
        $("#particulierForm").hide();
        $("#organisationForm").show();
      }
    }
    
    $("#type").change(function(){
        handleSelectectType($(this));
    });
    
    handleSelectectType($("#type"));

    $("#newsletter").on('change',function(){
        $("#newsletter").val($(this).is(":checked"));
    });

    $("#allow_sharing").on('change',function(){
        $("#allow_sharing").val($(this).is(":checked"));
    });

});
