$(document).ready(function(){
    $('#alertExist').hide();
    $("#username").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("username");
      if(username != ''){
         $("#uname_response").show();
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                $('#alertExist').show();
                element.classList.remove("border-success");
                element.classList.add("border-danger");
               }else{
                element.classList.add("border-success");
                element.classList.remove("border-danger");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
      }
    });
});