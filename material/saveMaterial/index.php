<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["video"])){
        $video = 1;
    }else{
        $video = 0;
    }

    if(isset($_POST["writter"])){
        $writter = 1;
    }else{
        $writter = 0;
    }

    if(isset($_POST["developer"])){
        $developer = 1;
    }else{
        $developer = 0;
    }

    if(isset($_POST["podcaster"])){
        $podcaster = 1;
    }else{
        $podcaster = 0;
    }

    if(isset($_POST["artist"])){
        $artist = 1;
    }else{
        $artist = 0;
    }

    if(isset($_POST["influencer"])){
        $influencer = 1;
    }else{
        $influencer = 0;
    }

    if(isset($_POST["otro"])){
        $otro = 1;
    }else{
        $otro = 0;
    }
    
	$idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO users_categories (id_user, date, video, writter, developer, podcaster, artist, influencer, other)
    VALUES ('$idUser', '$today','$video', '$writter', '$developer', '$podcaster', '$artist', '$influencer', '$otro')";

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