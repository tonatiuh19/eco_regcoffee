$( document ).ready(function() {
  document.getElementById("btnPaypal").style.display = "none";
    $("#btnPaypal").click(function(evt){
        $('#apoyar').modal('hide');
        document.getElementById("payment-form").style.display = "none";
        document.getElementById("payment-form-paypal").style.display = "block";
        $('#apoyarSiguiente').modal('show');
        document.getElementById("isPaypal2").value = "1";
    });
});

(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();