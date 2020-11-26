<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<?php
session_start();
require_once('../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = test_input($_POST["stat"]);
    $uname = test_input($_POST["uname"]);
    $email = test_input($_POST["email"]);
    $description = test_input($_POST["description"]);
    $noteFan = test_input($_POST["noteFan"]);
    $isPublic = test_input($_POST["isPublic"]);
    $today = date("Y-m-d H:i:s");

    $sql = "SELECT id_user FROM users WHERE user_name='".$uname."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $idUser = $row["id_user"];
      }
    } 
    if($status == "1"){
      $uname = test_input($_POST["uname"]);
      $idPay = test_input($_POST["idPay"]);
      $typeB = test_input($_POST["typeB"]);
      $brand = test_input($_POST["brand"]);
      $cardNo = test_input($_POST["cardNo"]);
      $bank = test_input($_POST["bank"]);
      $satusB = test_input($_POST["status"]);
      $date = test_input($_POST["date"]);
      $amount = test_input($_POST["amount"]);
      $amountF = test_input($_POST["amountF"]);
      $amountT = test_input($_POST["amountT"]);
      
      $sqli = "INSERT INTO payments (id_user, id_openpay, type, brand, card_number, bank_name, status, date, amount, amount_fee, amount_tax, description, email_user, note_fan, isPublic_note_fan)
      VALUES ('$idUser', '$idPay', '$typeB', '$brand', '$cardNo', '$bank', '$satusB', '$date', '$amount', '$amountF', '$amountT', '$description', '$email', '$noteFan', '$isPublic')";

      if ($conn->query($sqli) === TRUE) {
        
        $sql1 = "SELECT email FROM users WHERE email='".$email."'";
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
          // output data of each row
          echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-body text-center">
              
                  <h4 class="modal-title w-100" id="exampleModalLongTitle"><img class="masthead-avatar-pay mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" /><br><span class="bg-dark text-white p-1 rounded small">tonatiuh</span><br><b>¡Gracias totales!</b></h4>
                  <p>Revisa tu correo donde encontraras tu recibo de pago y un mensaje especial.</p>
                  
                  <a href="../'.$uname.'" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                
                </div>
              </div>
            </div>
          </div>';
        } else {
          $sql2 = "INSERT INTO users (user_name, email, pwd, date)
          VALUES ('', '$email', '/%Chivas%%%%%%(93)123%/', '$today')";

          if ($conn->query($sql2) === TRUE) {
            echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body text-center">
                
                    <h4 class="modal-title w-100" id="exampleModalLongTitle"><img class="masthead-avatar-pay mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" /><br><span class="bg-dark text-white p-1 rounded small">tonatiuh</span><br><b>¡Gracias totales!</b></h4>
                    <p>Revisa tu correo donde encontraras tu recibo de pago y un mensaje especial.</p>
                    
                    <a href="../'.$uname.'" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                  
                  </div>
                </div>
              </div>
            </div>';
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        }
      } else {
        echo "Error: " . $sqli . "<br>" . $conn->error;
      }
      

    }else{
      $today = date("Y-m-d H:i:s");
      $desc = clean($description);
      $sqli = "INSERT INTO payments (id_user, description, email_user, date, note_fan, isPublic_note_fan)
      VALUES ('$idUser', '".$desc."', '$email', '$today', '$noteFan', '$isPublic')";

      if ($conn->query($sqli) === TRUE) {
        echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body text-center">
          
              <h4 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-sad-tear fa-3x text-danger"></i><br><b>Algo salio mal</b></h4>
              <p>Tu pago no ha sido procesado correctamente. No se tienen los fondos suficientes o hubo un problema de red.</p>
              
              <a href="../'.$uname.'" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Prueba de nuevo</a>
            
            </div>
          </div>
        </div>
      </div>';
      }else {
        echo "Error: " . $sqli . "<br>" . $conn->error;
      }
      
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

function clean($string) {
  $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

  return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>