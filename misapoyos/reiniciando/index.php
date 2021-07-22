<?php
require_once('../../admin/cn.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {	
    $idPayment = $_POST["idPayment"];
    $today = date("Y-m-d H:i:s");
    echo "Cargando...";
    $sqlt = "UPDATE payments SET id_conekta='pending', status='pending', amount='pending', description='pending', period_end_date='pending', date='".$today."' WHERE id_payments=".$idPayment."";

        if ($conn->query($sqlt) === TRUE) {
            $sqle = "DELETE FROM payments_complete WHERE id_payments=".$idPayment."";

            if ($conn->query($sqle) === TRUE) {
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.location.href='../';
                </SCRIPT>");
            } else {
                echo "Error deleting record: " . $conn->error;
                header('Location: ../algosaliomal/');
            }
          
        } else {
          echo "Error updating record: " . $conn->error;
          header('Location: ../algosaliomal/');
        }
}
	
else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
}

?>
