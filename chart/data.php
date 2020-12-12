<?php
header('Content-Type: application/json');
session_start();
require_once('../admin/cn.php');

//$sqlQuery = "SELECT student_id,student_name,marks FROM tbl_marks ORDER BY student_id";
$sqlQuery = "SELECT DATE(date) as x, COUNT(*) as y FROM visitors_users WHERE id_user=".$_SESSION["user_param"]." AND date >= date_sub(curdate(), interval 7 day) GROUP BY DAY(date)";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>