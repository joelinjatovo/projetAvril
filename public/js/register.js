$(function(){
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
