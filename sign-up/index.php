<?php
session_start();
require_once('../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$mail_i = test_input($_POST["email"]);
	$username = test_input($_POST["usernametxt"]);
    $pwd = test_input($_POST["password"]);
    $today = date("Y-m-d H:i:s");

    $sql = "SELECT email FROM users WHERE email='".$mail_i."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('¡Este correo ya existe!')
			window.location.href='../';
			</SCRIPT>");
    } else {
        $sql = "INSERT INTO users (user_name, email, pwd, date)
        VALUES ('$username', '$mail_i', '$pwd', '$today')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION["email"] = $mail_i;
            $_SESSION["uname"] = $username;

            $folder_path = "../".$username."/";
            if (!file_exists($folder_path)) {
                if(mkdir($folder_path, 0777, true)){
                    if(copy("../template/index.php", "../".$username."/index.php")){
                        echo ("<SCRIPT LANGUAGE='JavaScript'>
                        window.location.href='../';
                        </SCRIPT>");
                    }else{
                        echo "Houston tenemos problemas";
                    }
                }else{
                    
                }
            }else{
                echo "Houston tenemos problemas";
            }
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    $conn->close();

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