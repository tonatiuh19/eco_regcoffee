<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idPost = test_input($_POST["post_cancel"]);

    $sql = "UPDATE users_posts SET is_deleted='1' WHERE id_users_posts='".$idPost."'";

    if ($conn->query($sql) === TRUE) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../';
        </SCRIPT>");
    } else {
        echo "Error updating record: " . $conn->error;
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