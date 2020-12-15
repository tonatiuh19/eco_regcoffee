<?php
session_start(); 
if(isset($_SESSION["user_param"])) 
{
    if($_SESSION["utype"] == "2"){
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../misapoyos/';
        </SCRIPT>");
    } 
	require_once('../admin/main_fan.php');
} else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='../';
            </SCRIPT>");
}
?>