<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');

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

        echo ("<SCRIPT LANGUAGE='JavaScript'>
        $('#exampleModalCenter').modal('show');
        </SCRIPT>");
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