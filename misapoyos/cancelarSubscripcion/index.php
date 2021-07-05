<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idExtra = test_input($_POST["idExtra"]);
    $emailUser = test_input($_POST["emailUser"]);
    $idPayment = test_input($_POST["idPayment"]);
    $subs = "1";
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO payments_complete (id_payments, id_extra, email_user, date, subsciption)
    VALUES ('$idPayment', '$idExtra', '$emailUser', '$today', '$subs')";

    if ($conn->query($sql) === TRUE) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
                $('#exampleModalCenter').modal('show');
            </SCRIPT>");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location: ../algosaliomal/');
    }
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
     
        <h5 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-sad-tear fa-2x"></i><br>Que dificil se me hace, mantenerme...</h5>
        <?php
            echo '<p>Se ha finalizado con exito esta suscribcion.</p><span class="font-weight-bold">Puedes re-activarla cuando quieras</span><br>';
        ?>
        <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>