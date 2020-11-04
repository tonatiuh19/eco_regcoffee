<?php
session_start();
require_once('cn.php');

if(isset($_POST['username'])){
    $sql = "SELECT user_name FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "1";
    } else {
        echo "0";
    }
    $conn->close();
}

?>