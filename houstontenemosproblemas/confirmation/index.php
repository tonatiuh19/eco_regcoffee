<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $subject = test_input($_POST["subject"]);
    $type = test_input($_POST["type"]);
    $what = test_input($_POST["what"]);
	  $idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO support (id_user, date, support_type, subject, what)
    VALUES ('$idUser', '$today', '$type', '$subject', '$what')";

    if (mysqli_query($conn, $sql)) {
      $sqls = "SELECT id_support FROM support WHERE id_user=".$idUser." AND date='".$today."' AND subject='".$subject."'";
      $results = $conn->query($sqls);
      
      if ($results->num_rows > 0) {
        // output data of each row
        while($rows = $results->fetch_assoc()) {
          $supportNo = $rows["id_support"];
        }
        echo ("<SCRIPT LANGUAGE='JavaScript'>
          $('#exampleModalCenter').modal('show');
         </SCRIPT>");
      }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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
     
        <h5 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-tools fa-2x"></i><br>Soporte creado</h5>
        <p>Enseguida nos pondremos en contacto contigo.</p>
        <?php
          echo '<p class="bg-dark text-white p-2">Numero de caso: '.$supportNo.'</p>';
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