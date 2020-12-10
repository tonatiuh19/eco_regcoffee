<?php
session_start(); 
if(!isset($_SESSION["user_param"])) 
{ 
	require_once('../admin/main_fan.php');
} else{
	echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.location.href='../comolovemifan/';
            </SCRIPT>");
}
?>