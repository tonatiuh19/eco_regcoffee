<?php
// define variables and set to empty values
session_start();
require_once('../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = test_input($_POST["email_i"]);
	$pwd = test_input($_POST["pwd_i"]);


	$todayVisit = date("Y-m-d H:i:s");
	
	$sql = "SELECT email, user_name, id_user FROM users WHERE email='$email' AND pwd='$pwd'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
		while($row = $result->fetch_assoc()) {	
            $_SESSION["user_param"] = $row["id_user"];
            $_SESSION["uname"] = $row["user_name"];
			if (isset($_SESSION["user_param"])){
				echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.location.href='../';
                        </SCRIPT>");
			}
		}
	} else{
		echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('El email y contraseña que escribiste no coinciden')
			window.location.href='../';
			</SCRIPT>");
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
