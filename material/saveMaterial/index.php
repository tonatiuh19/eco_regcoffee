<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = array();

    if (isset($_POST["video"])) {
        $video = 1;
        array_push($a, "1");
    } else {
        $video = 0;
    }

    if (isset($_POST["writter"])) {
        $writter = 1;
        array_push($a, "2");
    } else {
        $writter = 0;
    }

    if (isset($_POST["developer"])) {
        $developer = 1;
        array_push($a, "3");
    } else {
        $developer = 0;
    }

    if (isset($_POST["podcaster"])) {
        $podcaster = 1;
        array_push($a, "4");
    } else {
        $podcaster = 0;
    }

    if (isset($_POST["artist"])) {
        $artist = 1;
        array_push($a, "5");
    } else {
        $artist = 0;
    }

    if (isset($_POST["influencer"])) {
        $influencer = 1;
        array_push($a, "6");
    } else {
        $influencer = 0;
    }

    if (isset($_POST["otro"])) {
        $otro = 1;
        array_push($a, "7");
    } else {
        $otro = 0;
    }

    $idUser = $_SESSION["user_param"];
    $today = date("Y-m-d H:i:s");

    /**/

    $sqlx = "UPDATE users_categories SET active=0 WHERE id_user=" . $idUser . "";

    if ($conn->query($sqlx) === TRUE) {
        foreach ($a as $value) {
            $sql = "INSERT INTO users_categories (id_user, id_categories, date) VALUES ('$idUser', '$value', '$today')";

            if (mysqli_query($conn, $sql)) {
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }


    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../';
    </SCRIPT>");
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
