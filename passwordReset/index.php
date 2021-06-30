<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/style.css">
<link href="../../css/fontawesome/css/all.css" rel="stylesheet">
<meta http-equiv="Content-Type"
    content="text/html; charset=utf-8"
    />
<?php
require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idUser = test_input($_POST["idUser"]);
    $type = test_input($_POST["typee"]);
    $todayVisit = date("Y-m-d H:i:s");
    
    if($type == "2"){
        $newPwd = test_input($_POST["newPwd"]);
        $sql = "UPDATE users SET pwd='$newPwd' WHERE id_user=".$idUser."";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                    
                            <h4 class="modal-title w-100 text-success" id="exampleModalLongTitle"><i class="fas fa-lock fa-3x"></i></h4>
                            <h4>Contraseña actualizada</h4>
                            <p>Inicia sesión ahora con estas credenciales</p>
                            <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Volver</a>
                        </div>
                    </div>
                    </div>
                </div>';
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
    }else if($type == "1"){
        $codeTo = test_input($_POST["codeTo"]);

        $sql = "SELECT t.code FROM users_code as t INNER JOIN (SELECT id_user,MAX(date) as max_date FROM users_code WHERE id_user=".$idUser." GROUP BY id_user) as a ON a.max_date = t.date";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $code = $row["code"];
            }
            if($codeTo == $code){
                echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                    
                            <form action="../passwordReset/" method="post" id="formDigit">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Escribe tu nueva contraseña:</label>
                                    <input type="password" name="newPwd" class="form-control mb-3" id="exampleInputPassword1" placeholder="" required>
                                    <input type="hidden" name="idUser" value="'.$idUser.'">
                                    <input type="hidden" name="typee" value="2">
                                </div>
                                <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Regresar</a>
                                <button type="submit" class="btn btn-success text-white">Actualizar <i class="fas fa-check-square"></i></button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>';
            }else{
                echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                    
                            <h4 class="modal-title w-100 text-danger" id="exampleModalLongTitle"><i class="fas fa-times-circle fa-3x"></i></h4>
                            <h4>Codigo incorrecto</h4>
                            
                            <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Reintentar</a>
                        </div>
                    </div>
                    </div>
                </div>';
            }
        } else {
            echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                    
                            <h4 class="modal-title w-100 text-danger" id="exampleModalLongTitle"><i class="fas fa-times-circle fa-3x"></i></h4>
                            <h4>Codigo incorrecto</h4>
                            
                            <a href="../" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Reintentar</a>
                        </div>
                    </div>
                    </div>
                </div>';
        }
        $conn->close();
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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
    $('#exampleModalCenter').modal({
        backdrop: 'static',
        keyboard: false
    });
</script>