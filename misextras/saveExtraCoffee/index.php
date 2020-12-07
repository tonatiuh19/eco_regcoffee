<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $editId = test_input($_POST["extra_edit"]);

    $sqlz = "UPDATE extras SET active='0' WHERE id_extra=".$editId."";

    if ($conn->query($sqlz) === TRUE) {
        //echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $name       = $_FILES['fileToUpload']['name'];  
    $temp_name  = $_FILES['fileToUpload']['tmp_name']; 
    
    if(isset($name) && !empty($name)) 
    {
        if (($_FILES["fileToUpload"]["type"] == "image/jpeg") || ($_FILES["fileToUpload"]["type"] == "image/jpg") || ($_FILES["fileToUpload"]["type"] == "image/png"))
        {
           
            $price = test_input($_POST["price_ex"]);
            $description = test_input($_POST["description_ex"]);
            $creation = test_input($_POST["creation"]);
            $confirmation = test_input($_POST["confirmation_ex"]);
            $idUser = $_SESSION["user_param"];
            $uname = $_SESSION["uname"];
            $today = date("Y-m-d H:i:s");

            $sql = "INSERT INTO extras (title, id_user, description, confirmation, price, date, active)
            VALUES ('Coffee', '$idUser', '¡Me estas invitando un cafe!', '$confirmation', '$price', '$today', '2')";

            if ($conn->query($sql) === TRUE) {
                $folder_path = '../../'.$uname.'/profile/';
                if (!file_exists($folder_path)) {
                    mkdir($folder_path, 0777, true);
                }else{
                    $files = glob($folder_path.'*'); // get all file names
                    foreach($files as $file){ // iterate files
                      if(is_file($file))
                        unlink($file); // delete file
                    }
                }

                $filename = basename($_FILES['fileToUpload']['name']);
                $newname = $folder_path . $filename;

                if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $newname))
                {
                    $sql5 = "UPDATE users SET about='$description', creation='$creation' WHERE id_user=".$idUser."";

                    if ($conn->query($sql5) === TRUE) {

                        $sqlt = "SELECT id_extra FROM extras WHERE id_user='".$idUser."' AND date='".$today."' AND price='".$price."'";
                        $resultt = $conn->query($sqlt);

                        if ($resultt->num_rows > 0) {
                        // output data of each row
                            while($rowt = $resultt->fetch_assoc()) {
                                $idExtra = $rowt["id_extra"];
                            }
                            $sqlu = "UPDATE payments SET id_extra='".$idExtra."' WHERE id_extra=".$editId."";

                            if ($conn->query($sqlu) === TRUE) {
                                echo ("<SCRIPT LANGUAGE='JavaScript'>
                                window.location.href='../../comolovemifan/';
                                </SCRIPT>");
                            } else {
                                echo "Error updating record: " . $conn->error;
                            }
                        } else {
                            echo "0 results";
                        }
                        
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        else
        {
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Solo se permiten archivos PNG & JPG.')
            window.location.href='../';
            </SCRIPT>");
        }
    }else{
        $price = test_input($_POST["price_ex"]);
        $description = test_input($_POST["description_ex"]);
        $creation = test_input($_POST["creation"]);
        $confirmation = test_input($_POST["confirmation_ex"]);
        $idUser = $_SESSION["user_param"];
        $uname = $_SESSION["uname"];
        $today = date("Y-m-d H:i:s");

        $sql = "INSERT INTO extras (title, id_user, description, confirmation, price, date, active)
        VALUES ('Coffee', '$idUser', '¡Me estas invitando un cafe!', '$confirmation', '$price', '$today', '2')";

        if ($conn->query($sql) === TRUE) {
            
            $sql5 = "UPDATE users SET about='$description', creation='$creation' WHERE id_user=".$idUser."";

            if ($conn->query($sql5) === TRUE) {
                $sqlt = "SELECT id_extra FROM extras WHERE id_user='".$idUser."' AND date='".$today."' AND price='".$price."'";
                $resultt = $conn->query($sqlt);

                if ($resultt->num_rows > 0) {
                        // output data of each row
                    while($rowt = $resultt->fetch_assoc()) {
                        $idExtra = $rowt["id_extra"];
                    }
                    $sqlu = "UPDATE payments SET id_extra='".$idExtra."' WHERE id_extra=".$editId."";

                    if ($conn->query($sqlu) === TRUE) {
                        echo ("<SCRIPT LANGUAGE='JavaScript'>
                                window.location.href='../../comolovemifan/';
                                </SCRIPT>");
                    } else {
                        echo "Error updating record: " . $conn->error;
                    }
                } else {
                    echo "0 results";
                }
            } else {
                echo "Error updating record: " . $conn->error;
            }
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.location.href='../../comolovemifan/';
        </SCRIPT>");
}

function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>