//Openpay - Start
function setTooltip(message) {
  $("#tt").tooltip("hide").attr("data-original-title", message).tooltip("show");
}

//Openpay - End

$("#txtCardNumber").mask("9999 9999 9999 9999");

Conekta.setPublicKey("key_FY1HspAsYFUjC2B14xFqeCQ");
var validated = false;
var conektaSuccessResponseHandler = function (token) {
  var $form = $("#card-form");
  //Inserta el token_id en la forma para que se envíe al servidor
  $form.append(
    $('<input type="hidden" name="conektaTokenId" id="conektaTokenId">').val(
      token.id
    )
  );
  $form.get(0).submit(); //Hace submit
};
var conektaErrorResponseHandler = function (response) {
  var $form = $("#card-form");
  $("#alertBank").show();
  $("#pay-button").prop("disabled", false);
  $("#endLabelPaying").hide();
  $("#endLabelPay").show();
  $form.find(".card-errors").text(response.message_to_purchaser);
  $form.find("button").prop("disabled", false);
};

//jQuery para que genere el token después de dar click en submit
$(function () {
  $("#card-form").submit(function (event) {
    var $form = $(this);
    $("#alertBank").hide();
    $("#pay-button").prop("disabled", true);
    $("#endLabelPay").hide();
    $("#endLabelPaying").show();

    var form = $("#card-form");
    if (form[0].checkValidity() === false) {
      event.preventDefault();
      event.stopPropagation();
      validated = false;
    } else {
      validated = true;
    }
    form.addClass("was-validated");
    // Previene hacer submit más de una vez
    $form.find("button").prop("disabled", true);

    if (validated) {
      Conekta.Token.create(
        $form,
        conektaSuccessResponseHandler,
        conektaErrorResponseHandler
      );
    } else {
      $("#pay-button").prop("disabled", false);
      $("#endLabelPay").show();
      $("#endLabelPaying").hide();
    }

    return false;
  });
});
