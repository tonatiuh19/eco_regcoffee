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
    $('#endLabelPay').hide();
    $('#endLabelPaying').show();
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
       $('#endLabelPay').show();
       $('#endLabelPaying').hide();
    }
    
 };
 
 var error_callbak = function(response) {
    var desc = response.data.description != undefined ?
       response.data.description : response.message;
    alert("ERROR [" + response.status + "] " + desc);
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
    $('#endLabelPaying').hide();
    $('#endLabelPay').show();
 
    $('#tt').tooltip({
       trigger: 'click',
       placement: 'bottom'
    });
     
 };
 
 function setTooltip(message) {
    $('#tt').tooltip('hide')
      .attr('data-original-title', message)
      .tooltip('show');
 }
 
 //Openpay - End

 $('#txtCardNumber').mask("9999 9999 9999 9999");