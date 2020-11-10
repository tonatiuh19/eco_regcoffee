<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['checkCoffe']) && $_POST['checkCoffe'] == '1') 
    {
        $coffe = "1";
    }
    else
    {
        $coffe = "0";
    }    

    if (isset($_POST['checkFan']) && $_POST['checkFan'] == '1') 
    {
        $fan = "1";
    }
    else
    {
        $fan = "0";
    }   
	$idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users_notification (id_user, new_supporter, new_coffe, date)
    VALUES ('$idUser', '$fan', '$coffe', '$today')";

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