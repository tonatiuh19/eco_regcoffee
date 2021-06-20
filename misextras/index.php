<?php
require_once('../admin/header.php');
if ($_SESSION["utype"] == "2") {
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../misapoyos/';
    </SCRIPT>");
}
?>
<link rel="stylesheet" href="./css/toggle.css">
<link rel="stylesheet" href="./css/main.css">

<div class="site-section bg-primary-light">
    <div class="container">
        <div class="row py-5">
            <div class="col-sm-12">
                <h1>Mis extras</h1>
                <div class="col-sm-12">
                    <a href="../misextras" class="btn btn-primary active"><i class="fas fa-gifts"></i> Extras</a>
                    <a href="../misfans/" class="btn btn-primary"><i class="fas fa-hand-holding-usd"></i> Compromisos</a>
                    <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#newExtra"><i class="fas fa-plus-square"></i> Añadir extra</button>
                </div>
                <?php
                $idUser = $_SESSION["user_param"];
                $sqlx = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.id_user, a.limit_slots, a.price, a.question, a.subsciption, a.subsciption_id, a.active, a.date FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE b.id_user=" . $idUser . " and (a.active=1 or a.active=3)";
                $resultx = $conn->query($sqlx);

                if ($resultx->num_rows > 0) {
                    echo '<hr>';
                    echo '<div class="row">';
                    while ($rowx = $resultx->fetch_assoc()) {

                        echo '<div class="col-sm-6">
                        <div class="card m-1">
                          <div class="card-body">
                            <div class="float-end">
                                
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit' . $rowx["id_extra"] . '"><i class="fas fa-pen"></i></button>
                                <div class="modal fade" id="edit' . $rowx["id_extra"] . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Editar: ' . $rowx["title"] . '</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="saveExtra/" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                                                <input type="text" class="form-control" name="title_ex" value="' . $rowx["title"] . '" required>
                                                <input type="hidden" name="extra_edit" value="' . $rowx["id_extra"] . '">
                                            </div>
                                            <div class="mb-3">
                                            <label><b>Precio</b></label>
                                            <input type="textbox" value="' . $rowx["price"] . '" class="form-control currency" name="price_ex" autocomplete="off" required>
                                            </div>
                                            <div class="mb-3">
                                                <label><b>¿Que descripcion le pondrias?</b></label>
                                                <textarea class="form-control"  name="description_ex" rows="3" required>' . $rowx["description"] . '</textarea>
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                                                <textarea class="form-control"  name="confirmation_ex" rows="3" required>' . $rowx["confirmation"] . '</textarea>
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <label><b>¿Esto es una subcripcion mensual?</b> </label>
                                                <select class="form-control" name="subs_ex" required>';
                        if ($rowx["subsciption"] == "1") {
                            echo '<option value="0">No</option>';
                            echo '<option value="1" selected>Si</option>';
                        } else {
                            echo '<option value="0">No</option>';
                            echo '<option value="1">Si</option>';
                        }

                        echo '</select>
                                            <span class="badge bg-success mt-1">
                                                <i class="fas fa-exclamation-circle"></i> Se cobrara mensualmente a tu fan
                                            </span>
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                                                <input type="text" class="form-control" name="question_ex" value="' . $rowx["question"] . '">
                                            </div>
                                            <br>
                                            <div class="mb-3">
                                                <label class="mb-1"><b>¿Existe algun limite de usuarios?</b> <span class="small">(Opcional)</span></label>
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-3 mt-2">
                                                            <div class="flipswitch mb-1">';
                        if ($rowx["limit_slots"] >= '0') {
                            echo '<input type="checkbox" name="flipswitch" class="flipswitch-cb checkSlots' . $rowx["id_extra"] . '" style="display:none" id="fs' . $rowx["id_extra"] . '" onclick="limitSlotsFunc' . $rowx["id_extra"] . '()" checked>';
                        } else {
                            echo '<input type="checkbox" name="flipswitch" class="flipswitch-cb checkSlots' . $rowx["id_extra"] . '" style="display:none" id="fs' . $rowx["id_extra"] . '" onclick="limitSlotsFunc' . $rowx["id_extra"] . '()">';
                        }

                        echo '<label class="flipswitch-label" for="fs' . $rowx["id_extra"] . '">
                                                                    <div class="flipswitch-inner"></div>
                                                                    <div class="flipswitch-switch"></div>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-9">';
                        if ($rowx["limit_slots"] >= '0') {
                            echo '<input type="number" class="form-control" id="limitInput' . $rowx["id_extra"] . '" name="limit_ex" min="1" value="' . $rowx["limit_slots"] . '">';
                        } else {
                            echo '<input type="number" class="form-control noLimit" id="limitInput' . $rowx["id_extra"] . '" name="limit_ex" min="1" value="1">';
                        }

                        echo '</div>
                                                    </div>

                                                    <script>
                                                    function limitSlotsFunc' . $rowx["id_extra"] . '() {
                                                        let checkBox = document.querySelector(".checkSlots' . $rowx["id_extra"] . '");
                                                        let text = document.getElementById("limitInput' . $rowx["id_extra"] . '");
                                                    
                                                        if (checkBox.checked == true){
                                                          text.style.display = "block";
                                                        } else {
                                                          text.style.display = "none";
                                                        }
                                                    }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancel' . $rowx["id_extra"] . '"><i class="far fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Desactivar"></i></button>

                                <div class="modal fade" id="cancel' . $rowx["id_extra"] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de querer cancelar: ' . $rowx["title"] . '?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Me equivoque</button>
                                            <form method="post" action="./deactivateExtra/index.php">
                                                <input type="hidden" name="extra_cancel" value="' . $rowx["id_extra"] . '">
                                                <button type="submit" class="btn btn-danger">Ya cancélalo</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title fw-bold">
                                ' . $rowx["title"] . '
                            </h5>
                            <h6 class="fw-bold">Precio: <i class="fas fa-dollar-sign"></i> 
                            ' . number_format((float)$rowx["price"], 2, '.', '') . '</h6>';

                        if ($rowx["active"] == '3') {
                            echo '<span class="badge bg-danger">Pendiente de aprobación</span>';
                        }

                        if ($rowx["limit_slots"] >= '1') {
                            echo '<span class="badge bg-warning text-dark ms-1">
                                Lugares: ' . $rowx["limit_slots"] . '
                              </span>';
                        }

                        if ($rowx["limit_slots"] == '-1') {
                            echo '<span class="badge bg-warning text-dark ms-1">
                                Sin limite de lugares
                              </span>';
                        }

                        if ($rowx["subsciption"] == '1') {
                            echo '<span class="badge bg-dark ms-1">Suscripcion</span>';
                        }

                        echo '
                            <p class="card-text">
                              ' . $rowx["description"] . '
                            </p>
                
                            <button class="btn btn-primary">Entrar</button>
                          </div>
                        </div>
                      </div>';
                    }
                    echo '</div>';
                }
                ?>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-sm-8 m-1 p-3 text-center">
                        <i class="fas fa-hand-holding-heart fa-2x"></i><br>
                        <h4><b>Añade un extra a tu economia</b></h4>
                        <h5>Elige una plantilla o comienza desde cero</h5>
                    </div>
                </div>
                <p>
                <div class="row">
                    <div class="col-sm-4">
                        <button type="button" class="btn btn-warning col-12 m-1" data-bs-toggle="modal" data-bs-target="#newExtra"><i class="fas fa-plus-square"></i> Añadir desde cero</button>
                    </div>

                    <?php
                    $sqlf = "SELECT id_extra, title, description, confirmation, limit_slots, price, question, subsciption FROM extras WHERE id_user=1";
                    $resultf = $conn->query($sqlf);

                    if ($resultf->num_rows > 0) {
                        // output data of each row
                        while ($rowf = $resultf->fetch_assoc()) {
                            echo '<div class="col-sm-4">
                            <button type="button" class="btn btn-outline-warning text-dark col-12 m-1" data-bs-toggle="modal" data-bs-target="#newExtra' . $rowf['id_extra'] . '"><i class="fas fa-plus-square"></i> ' . $rowf['title'] . '</button>
                          
                            <div class="modal fade" id="newExtra' . $rowf['id_extra'] . '" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">' . $rowf['title'] . '</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="./newExtra/" method="post" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                                                <input type="text" class="form-control" name="title_ex" placeholder="Ej. Consulta creativa" value="' . $rowf['title'] . '" required>
                                            </div>
                                            <div class="mb-3">
                                                <label><b>Precio</b></label>
                                                <input type="textbox" placeholder="Ej. 450.00" class="form-control currency" name="price_ex" autocomplete="off" value="' . $rowf['price'] . '" required>
                                            </div>
                        
                                            <div class="mb-3">
                                                <label><b>¿Que descripcion le pondrias?</b></label>
                                                <textarea class="form-control" name="description_ex" rows="3" required>' . $rowf['description'] . '</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                                                <textarea class="form-control" name="confirmation_ex" rows="3" required>' . $rowf['confirmation'] . '</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label><b>¿Esto es una subcripcion mensual?</b> <span class="small">(Opcional)</span></label>
                                                <select class="form-control" name="subs_ex" required>';

                            if ($rowf["subsciption"] == "1") {
                                echo '<option value="0">No</option>';
                                echo '<option value="1" selected>Si</option>';
                            } else {
                                echo '<option value="0">No</option>';
                                echo '<option value="1">Si</option>';
                            }
                            echo '</select>
                                                <span class="badge bg-success mt-1">
                                                    <i class="fas fa-exclamation-circle"></i> Se cobrara mensualmente a tu fan
                                                </span>
                                            </div>
                                            <div class="mb-3">
                                                <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                                                <input type="text" class="form-control" name="question_ex" placeholder="Ej. ¿Cual es tu id de instagram?" value="' . $rowf['question'] . '">
                                            </div>
                                            <div class="mb-3">
                                                <label class="mb-1"><b>¿Existe algun limite de usuarios?</b> <span class="small">(Opcional)</span></label>
                                                <div class="form-check">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-sm-3 mb-1">
                                                                <div class="flipswitch">';

                            if ($rowf["limit_slots"] >= '0') {
                                echo '<input type="checkbox" name="flipswitch" class="flipswitch-cb checkSlots' . $rowf["id_extra"] . '" style="display:none" id="fs' . $rowf["id_extra"] . '" onclick="limitSlotsFunc' . $rowf["id_extra"] . '()" checked>';
                            } else {
                                echo '<input type="checkbox" name="flipswitch" class="flipswitch-cb checkSlots' . $rowf["id_extra"] . '" style="display:none" id="fs' . $rowf["id_extra"] . '" onclick="limitSlotsFunc' . $rowf["id_extra"] . '()">';
                            }
                            echo '<label class="flipswitch-label" for="fs' . $rowf["id_extra"] . '">
                                                                        <div class="flipswitch-inner"></div>
                                                                        <div class="flipswitch-switch"></div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-9">';
                            if ($rowf["limit_slots"] >= '0') {
                                echo '<input type="number" class="form-control" id="limitInput' . $rowf["id_extra"] . '" name="limit_ex" min="1" value="' . $rowf["limit_slots"] . '">';
                            } else {
                                echo '<input type="number" class="form-control noLimit" id="limitInput' . $rowf["id_extra"] . '" name="limit_ex" min="1" value="1">';
                            }
                            echo '</div>
                                                            <script>
                                                                function limitSlotsFunc' . $rowf["id_extra"] . '() {
                                                                    let checkBox = document.querySelector(".checkSlots' . $rowf["id_extra"] . '");
                                                                    let text = document.getElementById("limitInput' . $rowf["id_extra"] . '");
                                                                
                                                                    if (checkBox.checked == true){
                                                                    text.style.display = "block";
                                                                    } else {
                                                                    text.style.display = "none";
                                                                    }
                                                                }
                                                            </script>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>';
                        }
                    } else {
                        echo "0 results";
                    }
                    ?>

                </div>
                </p>
            </div>
        </div>


    </div>
</div>

<div class="modal fade" id="newExtra" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="staticBackdropLabel">Creando Magia <i class="fas fa-magic"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="./newExtra/" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                        <input type="text" class="form-control" name="title_ex" placeholder="Ej. Consulta creativa" required>
                    </div>
                    <div class="mb-3">
                        <label><b>Precio</b></label>
                        <input type="textbox" placeholder="Ej. 450.00" class="form-control currency" name="price_ex" autocomplete="off" required>
                    </div>

                    <div class="mb-3">
                        <label><b>¿Que descripcion le pondrias?</b></label>
                        <textarea class="form-control" name="description_ex" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                        <textarea class="form-control" name="confirmation_ex" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label><b>¿Esto es una subcripcion mensual?</b> <span class="small">(Opcional)</span></label>
                        <select class="form-control" name="subs_ex" required>
                            <option value="0">No</option>
                            <option value="1">Si</option>
                        </select>
                        <span class="badge bg-success mt-1">
                            <i class="fas fa-exclamation-circle"></i> Se cobrara mensualmente a tu fan
                        </span>
                    </div>
                    <div class="mb-3">
                        <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                        <input type="text" class="form-control" name="question_ex" placeholder="Ej. ¿Cual es tu id de instagram?">
                    </div>
                    <div class="mb-3">
                        <label class="mb-1"><b>¿Existe algun limite de usuarios?</b> <span class="small">(Opcional)</span></label>
                        <div class="form-check">
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-3 mb-1">
                                        <div class="flipswitch">
                                            <input type="checkbox" name="flipswitch" class="flipswitch-cb checkSlotsNew" id="fs" onclick="limitSlotsFunc()">
                                            <label class="flipswitch-label" for="fs">
                                                <div class="flipswitch-inner"></div>
                                                <div class="flipswitch-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control noLimit" id="limitInputNew" name="limit_ex" min="1" value="1">
                                    </div>
                                    <script>
                                        function limitSlotsFunc() {
                                            let checkBox = document.querySelector(".checkSlotsNew");
                                            let text = document.getElementById("limitInputNew");

                                            if (checkBox.checked == true) {
                                                text.style.display = "block";
                                            } else {
                                                text.style.display = "none";
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require_once('../admin/footer.php');
$session_value = basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
    var myTitle = '<?php echo $session_value; ?>';
    document.title = 'Regalame un Cafe';

    activateNavbarItem("navExtras");
</script>