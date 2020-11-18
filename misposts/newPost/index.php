<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $post = test_input($_POST["nPost"]);
    $idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users_posts (id_user, text, date)
    VALUES ('$idUser', '$post', '$today')";
    
    if ($conn->query($sql) === TRUE) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
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