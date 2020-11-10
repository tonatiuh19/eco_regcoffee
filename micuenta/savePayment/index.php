<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $activo = test_input($_POST["exampleRadios"]);
    if($activo=="ActivoPaypal"){
        $value = test_input($_POST["paypalValue"]);
        $place = test_input($_POST["paypalPlace"]);
        $type = "1";
    }else if($activo=="ActivoBank"){
        $value = test_input($_POST["bankValue"]);
        $place = test_input($_POST["bankPlace"]);
        $type = "2";
    }
	$idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users_payment (id_user, id_users_payment_type, value, place, date)
    VALUES ('$idUser', '$type', '$value', '$place', '$today')";

    if (mysqli_query($conn, $sql)) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
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