<?php
session_start();
require_once('../../admin/cn.php');
require_once('../../pagando/Openpay.php');
date_default_timezone_set('America/Mexico_City');

Openpay::setId('mklwynufmke2y82injra');
Openpay::setApiKey('sk_e8bd01b6ec2f434089ddf536725654bb');

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
            $sqlu = "SELECT a.id_payments, a.brand, a.card_number, a.bank_name, a.customer_id, a.card_id, b.subsciption_id FROM payments as a
            INNER JOIN extras as b on b.id_extra=a.id_extra
            WHERE a.id_payments=".$idPayment."";
            $resultu = $conn->query($sqlu);

            if ($resultu->num_rows > 0) {
            // output data of each row
                while($rowu = $resultu->fetch_assoc()) {
                    $subs_id = $rowu["subsciption_id"];
                    $card_id = $rowu["card_id"];
                    $customer_id = $rowu["customer_id"];
                }
            } 

            $openpay = Openpay::getInstance('mklwynufmke2y82injra', 'sk_e8bd01b6ec2f434089ddf536725654bb');
            $subscriptionDataRequest = array(
                'plan_id' => $subs_id,
                'card_id' => $card_id);
            
            try {
                    //Openpay::setProductionMode(false);
                $customer = $openpay->customers->get($customer_id);
                $subscription = $customer->subscriptions->add($subscriptionDataRequest);
                $status=1;

            } catch (OpenpayApiTransactionError $e) {
                    /*echo 'ERROR on the transaction: ' . $e->getMessage() .
                        ' error code: ' . $e->getErrorCode() .
                        ', error category: ' . $e->getCategory() .
                        ', HTTP code: '. $e->getHttpCode() .
                        ', request ID: ' . $e->getRequestId();*/
                $status=2;
                    
            } catch (OpenpayApiRequestError $e) {
                    //echo 'ERROR on the request: ' . $e->getMessage();
                $status=3;
                        
            } catch (OpenpayApiConnectionError $e) {
                    //echo 'ERROR while connecting to the API: ' . $e->getMessage();
                $status=4;
                        
            } catch (OpenpayApiAuthError $e) {
                    
                $status=5;
                        
            } catch (OpenpayApiError $e) {
                    //echo 'ERROR on the API: ' . $e->getMessage();
                $status=6;
                    
            } catch (Exception $e) {
                $status=7;
            }

            if ($status==1) {
                $sqlt = "UPDATE payments SET id_openpay='".$subscription->id."', status='completed', amount='".$subscription->transaction->amount."', description='".$subscription->transaction->description."', period_end_date='".$subscription->period_end_date."' WHERE id_payments=".$idPayment."";

                if ($conn->query($sqlt) === TRUE) {
                  echo ("<SCRIPT LANGUAGE='JavaScript'>
                    $('#exampleModalCenter').modal('show');
                </SCRIPT>");
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