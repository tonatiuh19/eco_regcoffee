<?php
session_start();
require_once('../../admin/cn.php');
require_once("../../pagando/Openpay.php");
date_default_timezone_set('America/Mexico_City');

Openpay::setId('mklwynufmke2y82injra');
Openpay::setApiKey('sk_e8bd01b6ec2f434089ddf536725654bb');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $title = test_input($_POST["title_ex"]);
    $price = test_input($_POST["price_ex"]);
    $description = test_input($_POST["description_ex"]);
    $confirmation = test_input($_POST["confirmation_ex"]);
    $question = test_input($_POST["question_ex"]);
    $subcri = test_input($_POST["subs_ex"]);
    $isLimit = test_input($_POST["flipswitch"]);
    $idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");
    if ($isLimit != 'on') {
        $limit = '-1';
    } else {
        $limit = test_input($_POST["limit_ex"]);
    }

    $sql = "INSERT INTO extras (title, id_user, description, confirmation, limit_slots, price, question, subsciption, date, active)
        VALUES ('$title', '$idUser', '$description', '$confirmation', '$limit', '$price', '$question', '$subcri', '$today', '3')";

    if ($conn->query($sql) === TRUE) {

        if ($subcri == '1') {
            $sql1 = "SELECT id_extra FROM extras WHERE id_user='" . $idUser . "' AND date='" . $today . "' AND title='" . $title . "'";
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
                // output data of each row
                while ($row1 = $result1->fetch_assoc()) {
                    $idExtra = $row1["id_extra"];
                }


                $openpay = Openpay::getInstance('mklwynufmke2y82injra', 'sk_e8bd01b6ec2f434089ddf536725654bb');
                $mon = trim($price, '$');
                $mon = str_replace(',', '', $mon);
                $planDataRequest = array(
                    'amount' => $mon,
                    'status_after_retry' => 'cancelled',
                    'retry_times' => 2,
                    'name' => "Extra: " . $idExtra,
                    'repeat_unit' => 'month',
                    'trial_days' => '0',
                    'repeat_every' => '1',
                    'currency' => 'MXN'
                );

                $plan = $openpay->plans->add($planDataRequest);
                $sql2 = "UPDATE extras SET subsciption_id='" . $plan->id . "' WHERE id_extra=" . $idExtra . "";

                if ($conn->query($sql2) === TRUE) {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                                        $('#exampleModalCenter').modal('show');
                                        </SCRIPT>");
                } else {
                    echo "Error updating record: " . $conn->error;
                    header('Location: ../algosaliomal/');
                }
            }
        } else {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
                                    $('#exampleModalCenter').modal('show');
                                    </SCRIPT>");
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header('Location: ../algosaliomal/');
    }
} else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

function test_input($data)
{
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

                <h5 class="modal-title w-100 mb-3" id="exampleModalLongTitle"><i class="fas fa-glass-cheers fa-2x"></i><br>¡Felicidades!</h5>
                <p>Una vez aprobado, tu extra será visible en tu pagina y disponible para ser comprado.</p>
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