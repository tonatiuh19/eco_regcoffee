<?php
session_start();
if (isset($_SESSION["user_param"])) {
    if ($_SESSION["utype"] == "2") {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../misapoyos/';
        </SCRIPT>");
    }
    header("Location: ../" . $_SESSION["uname"], true, 301);
    exit();
} else {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='../';
            </SCRIPT>");
}
