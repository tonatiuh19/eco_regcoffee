<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
require_once("../../pagando/conekta-php/lib/Conekta.php");
\Conekta\Conekta::setApiKey("key_YM6imXFrseD7FoCUZZjKxA");
\Conekta\Conekta::setApiVersion("2.0.0");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idExtra = test_input($_POST["idExtra"]);
    $emailUser = test_input($_POST["email"]);
    $idPayment = test_input($_POST["idPayment"]);
    $subs = test_input($_POST["subs"]);
    $today = date("Y-m-d H:i:s");
    echo "Cargando...";
    if($subs == "1"){
        $sql = "INSERT INTO payments_complete (id_payments, id_extra, email_user, date, subsciption)
        VALUES ('$idPayment', '$idExtra', '$emailUser', '$today', '1')";

        if ($conn->query($sql) === TRUE) {
            $sqlu = "SELECT a.id_users_customer_subs, a.customer_conekta_id, b.subsciption_id FROM users_customer_subs as a
            INNER JOIN extras as b on b.id_extra=a.id_extra
            WHERE a.id_payments=".$idPayment."";
            $resultu = $conn->query($sqlu);

            if ($resultu->num_rows > 0) {
            // output data of each row
                while($rowu = $resultu->fetch_assoc()) {
                    $subs_id = $rowu["subsciption_id"];
                    $customer_id = $rowu["customer_conekta_id"];
                    $id_users_customer_subs = $rowu["id_users_customer_subs"];
                }
            } 

            try {
                $customer = \Conekta\Customer::find($customer_id);
                $subscription = $customer->createSubscription(
                    [
                        'plan' => $subs_id
                    ]
                );
                $status=1;
              } catch (\Conekta\ProccessingError $error){
                echo $error->getMesage();
                $status=2;
              } catch (\Conekta\ParameterValidationError $error){
                echo $error->getMessage();
                $status=2;
              } catch (\Conekta\Handler $error){
                echo $error->getMessage();
                $status=2;
              }

            if ($status==1) {
                $sqlt = "UPDATE payments SET id_conekta='".$subscription->id."', status='paid', amount='0', description='".$subs_id."', card_id='".$subscription->card_id."' WHERE id_payments=".$idPayment."";

                if ($conn->query($sqlt) === TRUE) {

                    $sql = "UPDATE users_customer_subs SET start_date='".$subscription->billing_cycle_start."', end_date='".$subscription->billing_cycle_end."', active='1' WHERE id_users_customer_subs=".$id_users_customer_subs."";

                    if ($conn->query($sql) === TRUE) {
                        echo ("<SCRIPT LANGUAGE='JavaScript'>
                        $('#exampleModalCenter').modal('show');
                    </SCRIPT>");
                    } else {
                        echo "Error updating record: " . $conn->error;
                        header('Location: ../algosaliomal/');
                    }
                  
                } else {
                  echo "Error updating record: " . $conn->error;
                  header('Location: ../algosaliomal/');
                }
            }elseif ($status==2) {
                header('Location: ../algosaliomal/');
            }elseif ($status==3) {
                header('Location: ../algosaliomal/');
            }elseif ($status==4) {
                header('Location: ../algosaliomal/');
            }elseif ($status==5) {
                header('Location: ../algosaliomal/');
            }elseif ($status==6) {
                header('Location: ../algosaliomal/');
            }else{
                header('Location: ../algosaliomal/');
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header('Location: ../algosaliomal/');
        }
    }else{
        $sql = "INSERT INTO payments_complete (id_payments, id_extra, email_user, date)
        VALUES ('$idPayment', '$idExtra', '$emailUser', '$today')";
    
        if ($conn->query($sql) === TRUE) {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                    $('#exampleModalCenter').modal('show');
                </SCRIPT>");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            header('Location: ../algosaliomal/');
        }
    }
    
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../../misfans/';
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
     
        <h5 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-heart fa-2x"></i><br>¡Tu fan lo agradecera por siempre!</h5>
        <?php
            if($subs == "1"){
                echo '<p>Se ha finalizado con exito este entegrable por este mes. Recuerda hacerlo mes con mes.</p>';
            }else{
                echo '<p>Se ha finalizado con exito este entegrable.</p>';
            }
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