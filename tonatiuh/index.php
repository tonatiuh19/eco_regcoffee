<?php
session_start(); 
if(!isset($_SESSION['email'])) 
{ 
	require_once('../admin/main_fan.php');
} else{
	require_once('../mipagina/');
}
?>