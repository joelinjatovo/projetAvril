$(function(){
  var acceptation = 0;
  $(".jm").change(function(){
    if($(this).attr("type") == "checkbox"){
      acceptation++;
      if(acceptation == 5){
        $(".btnNextProcedure").attr("href","subscriptionAPL");
      }
    }
    else{
      acceptation--;
      $(".btnNextProcedure").removeAttr("href");
    }
  });

  $(".btnNextProcedure").click(function(){
    if(acceptation == 5){
      $(".help-block").css("color","#f2f2f2");
    }
    else{
      $(".help-block").css("color","#ff3300");
    }
  });

    $("#organisationForm").hide();

    $("#typeMembre").change(function(){
      if($(this).val() == "Particulier"){
        $("#particulierForm").show();
        $("#organisationForm").hide();
      }
      else if($(this).val() == "Organisation"){
        $("#particulierForm").hide();
        $("#organisationForm").show();
      }
    });

    $("#newsletterPart").on('change',function(){
        $("#newsletterPart").val($(this).is(":checked"));
    });

    $("#partageDonnePart").on('change',function(){
        $("#partageDonnePart").val($(this).is(":checked"));
    });

});
