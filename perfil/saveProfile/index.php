<?php
session_start();
require_once('../../admin/cn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $validate = test_input($_POST["pwd_confirm"]);
    $sql = "SELECT email FROM users WHERE id_user='".$_SESSION["user_param"]."' AND pwd='".$validate."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $correo = test_input($_POST["correo"]);
        $nombre = test_input($_POST["nombre"]);
        $apellido = test_input($_POST["apellido"]);
        $telefono = test_input($_POST["telefono"]);
        $pwd = test_input($_POST["pwd"]);
        $idUser = $_SESSION["user_param"];
        $today = date("Y-m-d H:i:s");

        $sql = "SELECT email FROM users WHERE id_user='".$_SESSION["user_param"]."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $email_old = $row["email"];
        }
            $sqld = "INSERT INTO users_old (id_user, email, date)
            VALUES ('$idUser', '$email_old', '$today')";

            if (mysqli_query($conn, $sqld)) {
                $sqlu = "UPDATE users SET email='$correo', name='$nombre', last_name='$apellido', phone='$telefono', pwd='$pwd' WHERE id_user='".$_SESSION["user_param"]."'";

                if ($conn->query($sqlu) === TRUE) {
                    echo ("<SCRIPT LANGUAGE='JavaScript'>
                    window.location.href='../';
                    </SCRIPT>");
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            } else {
                echo "Error: " . $sqld . "<br>" . mysqli_error($conn);
            }
        } else {
        echo "0 results";
        }

        
        
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
			window.alert('La contraseña escrita no coincide con la actual :(')
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