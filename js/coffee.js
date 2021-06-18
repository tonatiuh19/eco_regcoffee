$(document).ready(function(){
   $('#alertExist').hide();
   $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
    
    
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

    $('#alertExistModalCreator').hide(); 
    $("#usernameModalCreator").keyup(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModalCreator");
      
      if(username != ''){
         
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModalCreator').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
               }else{
                  $('#alertExistModalCreator').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModalCreator").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_responseCreator").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
      }
    });

    $("#usernameModalCreator").mouseleave(function(){
      var username = $(this).val().trim();
      var element = document.getElementById("usernameModalCreator");
      
      if(username != ''){
         
         $.ajax({
            url: '../../admin/check.php',
            type: 'post',
            data: {username:username},
            success: function(response){
               // Show response
               //$("#uname_response").html(response);
               
               if(response == "1"){
                  $('#alertExistModalCreator').show();
                  element.classList.remove("border-success");
                  element.classList.add("border-danger");
                  document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
               }else{
                  $('#alertExistModalCreator').hide();  
                  element.classList.add("border-success");
                  element.classList.remove("border-danger");
                  document.getElementById("comenzarBtnModalCreator").removeAttribute("disabled");
               }
            }
         });
      }else{
         $("#uname_responseCreator").hide();
         element.classList.remove("border-success");
         document.getElementById("comenzarBtnModalCreator").setAttribute("disabled", '');
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

   $('#video').on('click', function(){
      
      //remove all class .active
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".video").show();
   });

   $('#all').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter      
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".card").show(); 
   });

   $('#writter').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".writter").show();
   });

   $('#developer').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".developer").show();
   });

   $('#podcaster').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".podcaster").show();
   });

   $('#artist').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#influencer').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.influencer').hide();
      $('.other').hide();
      $(".artist").show();
   });

   $('#influencer').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#other').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.other').hide();
      $(".influencer").show();
   });

   $('#other').on('click', function(){
      
      //remove all class .active
      $('#video').removeClass('active');
      $('#all').removeClass('active');
      $('#writter').removeClass('active');
      $('#developer').removeClass('active');
      $('#podcaster').removeClass('active');
      $('#artist').removeClass('active');
      $('#influencer').removeClass('active');
      // add class .active
      $(this).addClass('active');
      // filter
      $('.video').hide();
      $('.writter').hide();
      $('.developer').hide();
      $('.podcaster').hide();
      $('.artist').hide();
      $('.influencer').hide();
      $(".other").show();
   });
   

   $('.currency').blur(function(){
      $('.currency').formatCurrency();
   });

   $('.currency').on('input', function (event) { 
      this.value = this.value.replace(/[^0-9]/g, '');
   });

   function openPasswordForgotten(){
      $('#iniciarSesion').modal('hide');
      $('#contrasenaOlvidada').modal('show');
   }

   let valueRadioGive = document.getElementById("valueRadioGive");
   if(valueRadioGive){
      
      valueRadioGive.addEventListener("input",function () {
         
         let frst = document.querySelector("#valueRadioGive").value;
         
         var priceExtra = $('#hiddenExtra').val();
         var newPrice = frst*priceExtra;
         if(frst == "1"){
            $("#neutral").prop("checked", true);
         }else if(frst == "3"){
            $("#sad").prop("checked", true);
         }else if(frst == "5"){
            $("#super-sad").prop("checked", true);
         }else{
            $('input:radio[name=rating]').each(function () { $(this).prop('checked', false); });
         }
         document.getElementById("amountCoffe").value = newPrice;
         document.getElementById("quantityCoffe").value = frst;
         $("#valueBtnExtra").text(newPrice);
      });
   }
   

   setTimeout(function() {
      $("#alertPaging").alert('close');
  }, 5000);

   $('#alertBank').hide();

   let inputMailFan1 = document.getElementById("inputMailFan1");
   if(inputMailFan1){

      inputMailFan1.addEventListener("keypress",function () {
         let frst = document.getElementById("inputMailFan1").value;
         document.getElementById("inputMailFan2").value = frst;
      });
      
      inputMailFan1.addEventListener("input",function () {
         let frst = document.getElementById("inputMailFan1").value;
         document.getElementById("inputMailFan2").value = frst;
      });
   }
   
   let inputTextFan1 = document.getElementById("inputTextFan1");
   if(inputTextFan1){
      inputTextFan1.addEventListener("keypress",function () {
         let frst = document.getElementById("inputTextFan1").value;
         document.getElementById("inputTextFan2").value = frst;
      });

      inputTextFan1.addEventListener("input",function () {
         let frst = document.getElementById("inputTextFan1").value;
         document.getElementById("inputTextFan2").value = frst;
      });
   }

   let txtCardNumber = document.getElementById("txtCardNumber");
   if(txtCardNumber){
      txtCardNumber.addEventListener("keypress",function () {
         let frst = document.getElementById("txtCardNumber").value.replace(/\s/g, '').replace(/_/g, '');
         
         document.getElementById("txtCardNumberNoSpaces").value = frst;
      });

      txtCardNumber.addEventListener("input",function () {
         let frst = document.getElementById("txtCardNumber").value.replace(/\s/g, '').replace(/_/g, '');
         
         document.getElementById("txtCardNumberNoSpaces").value = frst;
      });
   }
   

   $('#inlineRadio1').click(function() {
      if($('#inlineRadio1').is(':checked')) { $("#inlineRadio12").attr('checked', 'checked'); }
   });

   $('#inlineRadio2').click(function() {
      if($('#inlineRadio2').is(':checked')) { $("#inlineRadio22").attr('checked', 'checked'); }
   });
   

   $('#preguntaSection').hide();
   $('#endLabelPaying').hide();


   let questionAnswer = document.getElementById("questionAnswer");
   if(questionAnswer){
      document.getElementById("questionAnswer").removeAttribute("required");
   }

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
 

function CheckSession() {
   var session = '<%=Session["uname"] != null%>';
   if (session == false) {
       alert("Your Session has expired");
       window.location = "login.aspx";
   }
}

$('#bologna-list a').on('click', function (e) {
   e.preventDefault()
   $(this).tab('show')
})

$('input[name=rating]').click(function() {
   var valueRadioGive = $('input[name=rating]:checked').val();
   var priceExtra = $('#hiddenExtra').val();
   var newPrice = valueRadioGive*priceExtra;
   document.getElementById("valueRadioGive").value = valueRadioGive;
   document.getElementById("amountCoffe").value = newPrice;
   document.getElementById("quantityCoffe").value = valueRadioGive;
   $("#valueBtnExtra").text(newPrice);
});

function openRegister(){
   $('#iniciarSesion').modal('hide');
   $('#crearCuenta').modal('show');
}

function openInicio(){
   $('#iniciarSesion').modal('show');
   $('#crearCuenta').modal('hide');
}


$(document).on("click", ".browse", function() {
   var file = $(this).parents().find(".file");
   file.trigger("click");
 });
 $('input[type="file"]').change(function(e) {
   var fileName = e.target.files[0].name;
   $("#file").val(fileName);
 
   var reader = new FileReader();
   reader.onload = function(e) {
     // get loaded data and render thumbnail.
     document.getElementById("preview").src = e.target.result;
   };
   // read the image file as a data URL.
   reader.readAsDataURL(this.files[0]);
 });


let btnContainer = document.getElementById("myFansButtons");
if(btnContainer){
// Get all buttons with class="btn" inside the container
   let btns = btnContainer.getElementsByClassName("btnFans");
   if(btns){
   // Loop through the buttons and add the active class to the current/clicked button
      for (var i = 0; i < btns.length; i++) {
         btns[i].addEventListener("click", function() {
         var current = document.getElementsByClassName("btn-warning");
         current[0].className = current[0].className.replace(" btn-warning", "btn-outline-warning");
         this.className += " btn-warning";
         });
      }
   }
}





function getSummary(id)
{
   $.ajax({
      url  : "../misfans/extras.php",
      type : "POST",
      cache: false,
      data : {page_no:1, extraid:id},
      beforeSend: function(){
         $("#imageLoading").show();
      },
      complete: function(){
         $("#imageLoading").hide();
      },
      success:function(response){
         $("#table-data").html(response);
      }
   });
}


function copyToClipboard(element) {
   var $temp = $("<input>");
   $("body").append($temp);
   $temp.val($(element).text()).select();
   document.execCommand("copy");
   $temp.remove();
   setTooltip('¡Copiado!');
   hideTooltip();
}

function copyLinkToClipboard(element) {
   var $temp = $("<input>");
   $("body").append($temp);
   $temp.val($(element).text()).select();
   document.execCommand("copy");
   $temp.remove();
   setTooltipLink('¡Copiado!');
   hideTooltipLink();
}
 
function setTooltipLink(message) {
   $('#copyLink').tooltip('hide')
     .attr('data-original-title', message)
     .tooltip('show');
}
 
function hideTooltipLink() {
   setTimeout(function() {
     $('#copyLink').tooltip('hide');
   }, 1000);
}

function activateNavbarItem(item){
   var element = document.getElementById(item);
   $('.itemActive').removeClass('active');
   element.classList.add("active");
}

$('#filters button').click(function(){
   e.preventDefault();
});