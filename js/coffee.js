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
   $('#cancelmodifyPayment').hide();
   $('#savemodifyPayment').hide();
   $("#modifyPayment").click(function(evt){
      $('#cancelmodifyPayment').show();
      $('#savemodifyPayment').show();
      document.getElementById("inputPaypal").removeAttribute("readonly");
      document.getElementById("inputClabeBank").removeAttribute("readonly");
      document.getElementById("inputClabeBankNumber").removeAttribute("readonly");
      document.getElementById("radioActivePaypal").removeAttribute("disabled");
      document.getElementById("radioActiveClabe").removeAttribute("disabled");
      
   });

   $("#cancelmodifyPayment").click(function(evt){
      document.getElementById("inputPaypal").setAttribute("readonly", '');
      document.getElementById("inputClabeBank").setAttribute("readonly", '');
      document.getElementById("inputClabeBankNumber").setAttribute("readonly", '');
      document.getElementById("radioActivePaypal").setAttribute("disabled", '');
      document.getElementById("radioActiveClabe").setAttribute("disabled", '');
      $('#cancelmodifyPayment').hide();
      $('#savemodifyPayment').hide();
   });

   $('#cancelmodifyNotifications').hide();
   $('#savemodifyNotifications').hide();
   $("#modifyNotifications").click(function(evt){
      document.getElementById("checkFan").removeAttribute("disabled");
      document.getElementById("checkCoffe").removeAttribute("disabled");
      $('#cancelmodifyNotifications').show();
      $('#savemodifyNotifications').show();
   });

   $("#cancelmodifyNotifications").click(function(evt){
      document.getElementById("checkFan").setAttribute("disabled", '');
      document.getElementById("checkCoffe").setAttribute("disabled", '');
      $('#cancelmodifyNotifications').hide();
      $('#savemodifyNotifications').hide();
   });

   $('#cancelmodifyProfile').hide();
   $('#savemodifyProfile').hide();
   $("#modifyProfile").click(function(evt){
      document.getElementById("correo").removeAttribute("disabled");
      document.getElementById("pwd").removeAttribute("disabled");
      document.getElementById("nombre").removeAttribute("disabled");
      document.getElementById("apellido").removeAttribute("disabled");
      document.getElementById("telefono").removeAttribute("disabled");
      $('#cancelmodifyProfile').show();
      $('#savemodifyProfile').show();
   });

   $("#cancelmodifyProfile").click(function(evt){
      document.getElementById("correo").setAttribute("disabled", '');
      document.getElementById("pwd").setAttribute("disabled", '');
      document.getElementById("nombre").setAttribute("disabled", '');
      document.getElementById("apellido").setAttribute("disabled", '');
      document.getElementById("telefono").setAttribute("disabled", '');
      $('#cancelmodifyProfile').hide();
      $('#savemodifyProfile').hide();
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


$('#copy').tooltip({
   trigger: 'click',
   placement: 'bottom'
 });
 
 function setTooltip(message) {
   $('#copy').tooltip('hide')
     .attr('data-original-title', message)
     .tooltip('show');
 }
 
 function hideTooltip() {
   setTimeout(function() {
     $('#copy').tooltip('hide');
   }, 1000);
 }
 
 // Clipboard
 var clipboard = new ClipboardJS('#copy');
 
 clipboard.on('success', function(e) {
      setTooltip('Link copiado ;)');
      hideTooltip();
  
 });
 
 clipboard.on('error', function(e) {
     setTooltip('Failed!');
     hideTooltip();
   
 });

 function checkingNotifications(){
   
   /*if (document.getElementById("checkAllNotifications").checked == true){
      document.getElementById("checkCoffe").checked = true;
      document.getElementById("checkFan").checked = true;
   } */

   /*if (document.getElementById("checkCoffe").checked == true && document.getElementById("checkFan").checked){
      document.getElementById("checkAllNotifications").checked = true;
   }

   if (!document.getElementById("checkCoffe").checked == true || !document.getElementById("checkFan").checked){
      document.getElementById("checkAllNotifications").checked = false;
   }*/

 }


  