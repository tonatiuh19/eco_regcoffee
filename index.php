<?php
require_once('admin/cn.php');
session_start();

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = rtrim($actual_link, "/");
preg_match("/[^\/]+$/", $url, $matches);
$last_word = $matches[0];
$uName = $last_word;

$sql = "SELECT a.id_user FROM users as a WHERE a.user_name='" . $uName . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  require_once('admin/main_fan.php');
} else {
  require_once('admin/main.php');
}
