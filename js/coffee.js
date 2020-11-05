$(document).ready(function(){
    $('#alertExist').hide();
    $("#username").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("username");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
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
                  document.getElementById("comenzarBtn").setAttribute("disabled", '');
               }else{
                  $('#alertExist').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtn").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

    $("#username").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("username");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
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
                  document.getElementById("comenzarBtn").setAttribute("disabled", '');
               }else{
                  $('#alertExist').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtn").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

    //Modal
    $('#alertExistModal').hide(); 
    $("#usernameModal").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModal");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
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
                  $('#alertExistModal').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
               }else{
                  $('#alertExistModal').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModal").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
      }
    });

    $("#usernameModal").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModal");
      var comenzarBtn = document.getElementById("comenzarBtn");
      
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
                  $('#alertExistModal').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModal").setAttribute("disabled", '');
               }else{
                  $('#alertExistModal').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModal").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_response").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtn").setAttribute("disabled", '');
      }
    });

});


$("#username").change(function() {
   $("#usernametxt").val($("#username").val());
});

$("#usernametxt").change(function() {
   $("#username").val($("#usernametxt").val());
});

$("#username").keyup(function() {
   $("#usernametxt").val($("#username").val());
});

$("#usernametxt").keyup(function() {
   $("#username").val($("#usernametxt").val());
});