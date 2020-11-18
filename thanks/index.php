<?php
session_start();
require_once('../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo $qty = test_input($_POST["qty"]);

   

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