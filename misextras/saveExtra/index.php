<?php
session_start();
require_once('../../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if( isset($_POST['edit']) )
    {
        $edit = test_input($_POST["edit"]);
        $editId = test_input($_POST["extra_edit"]);

        $sqlz = "UPDATE extras  SET active='0' WHERE id_extra='".$editId."'";

        if ($conn->query($sqlz) === TRUE) {
            //echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
    
    if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) 
    {
        if (($_FILES["fileToUpload"]["type"] == "image/jpeg") || ($_FILES["fileToUpload"]["type"] == "image/jpg") || ($_FILES["fileToUpload"]["type"] == "image/png"))
        {
           
            $title = test_input($_POST["title_ex"]);
            $price = test_input($_POST["price_ex"]);
            $description = test_input($_POST["description_ex"]);
            $confirmation = test_input($_POST["confirmation_ex"]);
            $question = test_input($_POST["question_ex"]);
            $limit = test_input($_POST["limit_ex"]);
            $subcri = test_input($_POST["subs_ex"]);
            $idUser = $_SESSION["user_param"];
            $uname = $_SESSION["uname"];
            $today = date("Y-m-d H:i:s");

            $sql = "INSERT INTO extras (title, id_user, description, confirmation, limit_slots, price, question, subsciption, date)
            VALUES ('$title', '$idUser', '$description', '$confirmation', '$limit', '$price', '$question', '$subcri', '$today')";

            if ($conn->query($sql) === TRUE) {
                $sqla = "SELECT id_extra FROM extras WHERE id_user='".$idUser."' AND date='".$today."' AND title='".$title."'";
                $resulta = $conn->query($sqla);

                if ($resulta->num_rows > 0) {
                // output data of each row
                    while($rowa = $resulta->fetch_assoc()) {
                        $idExtra = $rowa["id_extra"];
                    }
                    $folder_path = '../../'.$uname.'/extras/'.$idExtra.'/';
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
                        if( isset($_POST['edit']) )
                        {
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                            window.location.href='../';
                            </SCRIPT>");
                        }else{
                            echo ("<SCRIPT LANGUAGE='JavaScript'>
                            $('#exampleModalCenter').modal('show');
                            </SCRIPT>");
                        }
                    }

                } else {
                echo "0 results";
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
        $title = test_input($_POST["title_ex"]);
        $price = test_input($_POST["price_ex"]);
        $description = test_input($_POST["description_ex"]);
        $confirmation = test_input($_POST["confirmation_ex"]);
        $question = test_input($_POST["question_ex"]);
        $limit = test_input($_POST["limit_ex"]);
        $subcri = test_input($_POST["subs_ex"]);
        $idUser = $_SESSION["user_param"];
        $today = date("Y-m-d H:i:s");

        $sql = "INSERT INTO extras (title, id_user, description, confirmation, limit_slots, price, question, subsciption, date)
        VALUES ('$title', '$idUser', '$description', '$confirmation', '$limit', '$price', '$question', '$subcri', '$today')";

        if ($conn->query($sql) === TRUE) {
            if( isset($_POST['edit']) )
            {          
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                window.location.href='../';
                </SCRIPT>");
            }else{
                echo ("<SCRIPT LANGUAGE='JavaScript'>
                $('#exampleModalCenter').modal('show');
                </SCRIPT>");
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
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
<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body text-center">
     
        <h5 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-glass-cheers fa-2x"></i><br>¡Felicidades!</h5>
        <p>Ahora tu extra es visible en tu pagina y disponible para ser comprado.</p>
        <a href="../fan/" class="btn btn-warning">Verlo en mi pagina</a>
        <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
      
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>