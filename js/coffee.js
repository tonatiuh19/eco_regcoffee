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

   $('.currency').blur(function(){
      $('.currency').formatCurrency();
   });

   $('.currency').on('input', function (event) { 
      this.value = this.value.replace(/[^0-9]/g, '');
   });


   document.querySelector("#valueRadioGive").addEventListener("change",function () {
      var frst = document.querySelector("#valueRadioGive").value;
      var priceExtra = $('#hiddenExtra').val();
      var newPrice = frst*priceExtra;
      if(frst == "1"){
         $("#test0").prop("checked", true);
      }else if(frst == "3"){
         $("#test1").prop("checked", true);
      }else if(frst == "5"){
         $("#test2").prop("checked", true);
      }else{
         $('input:radio[name=same-group-name]').each(function () { $(this).prop('checked', false); });
      }
      document.getElementById("amountCoffe").value = newPrice;
      document.getElementById("quantityCoffe").value = frst;
      $("#valueBtnExtra").text(newPrice);
   });

   setTimeout(function() {
      $("#alertPaging").alert('close');
  }, 5000);

   $("#btnPayCreditDebit").click(function(evt){
      $('#apoyar').modal('hide');
      $('#apoyarSiguiente').modal('show');
   
   });

   $('#alertBank').hide();
   document.querySelector("#inputMailFan1").addEventListener("change",function () {
      var frst = document.querySelector("#inputMailFan1").value;
      document.getElementById("inputMailFan2").value = frst;
   });

   document.querySelector("#inputTextFan1").addEventListener("change",function () {
      var frst = document.querySelector("#inputTextFan1").value;
      document.getElementById("inputTextFan2").value = frst;
   });

   $('#inlineRadio1').click(function() {
      if($('#inlineRadio1').is(':checked')) { $("#inlineRadio12").attr('checked', 'checked'); }
   });

   $('#inlineRadio2').click(function() {
      if($('#inlineRadio2').is(':checked')) { $("#inlineRadio22").attr('checked', 'checked'); }
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

 $("[data-toggle=tooltip]").tooltip();

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

$('input[name=same-group-name]').click(function() {
   var valueRadioGive = $('input[name=same-group-name]:checked').val();
   var priceExtra = $('#hiddenExtra').val();
   var newPrice = valueRadioGive*priceExtra;
   document.getElementById("valueRadioGive").value = valueRadioGive;
   document.getElementById("amountCoffe").value = newPrice;
   document.getElementById("quantityCoffe").value = valueRadioGive;
   $("#valueBtnExtra").text(newPrice);
});

//Openpay - Start
$(document).ready(function() {
   OpenPay.setId('mklwynufmke2y82injra');
   OpenPay.setApiKey('pk_7e94dbb7be654ad5ada6cbe87c932f65');
   OpenPay.setSandboxMode(true);
   var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");
   
});

var validated = false;
$('#pay-button').on('click', function(event) {
   event.preventDefault();
   $("#alertBank").hide();
   $("#pay-button").prop( "disabled", true);
   OpenPay.token.extractFormAndCreate('payment-form', success_callbak, error_callbak);        
   var form = $("#payment-form")
   if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      validated = false;
   } else{
      validated = true;
   }
   form.addClass('was-validated')      

});

var success_callbak = function(response) {
   var token_id = response.data.id;
   $('#token_id').val(token_id);
   if(validated){
      $('#payment-form').submit();
   }else{
      $("#pay-button").prop("disabled", false);
   }
   
};

var error_callbak = function(response) {
   var desc = response.data.description != undefined ?
      response.data.description : response.message;
   //alert("ERROR [" + response.status + "] " + desc);
   $("#alertBank").show();
   if(response.status === "422"){
      $("#alertBank").text("El número de tarjeta es invalido");
   }else if(response.status == "400"){
      $("#alertBank").text("La tarjeta es invalida o la fecha de expiración de la tarjeta ha expirado");
   }else if(response.status == "2006"){
      $("#alertBank").text("El código de seguridad de la tarjeta (CVV2) no fue proporcionado");
   }else if(response.status == "412"){
      $("#alertBank").text("El número de tarjeta es invalido");
   }else if(response.status == "2008"){
      $("#alertBank").text("La tarjeta no es valida para pago con puntos");
   }else if(response.status == "2009"){
      $("#alertBank").text("El código de seguridad de la tarjeta (CVV2) es inválido");
   }else if(response.status == "402"){
      $("#alertBank").text("Autenticación 3D Secure fallida");
   }else if(response.status == "422"){
      $("#alertBank").text("Tipo de tarjeta no soportada");
   }else{
      $("#alertBank").text("ERROR [" + response.status + "] " + desc);
   }
   
   $("#pay-button").prop("disabled", false);
};
//Openpay - End

function openRegister(){
   $('#iniciarSesion').modal('hide');
   $('#crearCuenta').modal('show');
}

$('#iniciarSesion').on('hidden.bs.modal', function () {
   window.location.hash = '';
});