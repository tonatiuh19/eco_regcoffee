<?php
require_once('../admin/header.php');
?>
    <div class="site-section bg-primary-light">
      <div class="container">
        
        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <?php
                      echo '<button id="copy" class="btn btn-primary float-right" data-clipboard-text="regalameuncafe.com/'.$_SESSION['uname'].'"><i class="fas fa-clone"></i> Copiar link</button>';
                    ?>
                    <h5 class="card-title">
                      <span class="fa-stack">
                        <i class="fas fa-square fa-stack-2x"></i>
                        <i class="fas fa-user-astronaut fa-stack-1x fa-inverse"></i>
                      </span>
                      <?php
                        echo $_SESSION['uname'];
                      ?>
                      </h5>
                    <?php
                      echo '<p class="card-text">regalameuncafe.com/'.$_SESSION['uname'].'</p>';
                    ?>
                  </div>
                </div>
              </div>
        </div>
        <p></p>
        <div class="row">
              <div class="col-sm-12">
              <h1>Mis extras</h1>
              <p>
                    <a href="../misextras" class="btn btn-primary active"><i class="fas fa-gifts"></i> Extras</a>
                    <a href="../misfans/" class="btn btn-primary"><i class="fas fa-hand-holding-usd"></i> Compromisos</a>
              </p>
                    <?php
                        $idUser = $_SESSION["user_param"];
                        $sqlx = "SELECT id_extra, title, description, confirmation, limit_slots, price, question, subsciption FROM extras WHERE id_user='".$idUser."' AND active=1 AND active <>2 order by subsciption desc";
                        $resultx = $conn->query($sqlx);
                        
                        if ($resultx->num_rows > 0) {
                            echo '<hr>';
                            echo '<div class="row justify-content-center">';
                            while($rowx = $resultx->fetch_assoc()) {
                                echo '<div class="card col-sm-3 m-1 p-3">
                                        <div class="card-body">
                                            <div class="float-right">
                                                <button class="btn btn-outline-primary p-1 m-1" data-toggle="modal" data-target="#edit'.$rowx["id_extra"].'"><i class="fas fa-pencil-alt" data-toggle="tooltip" data-placement="top" title="Editar"></i></button>
                                                <button class="btn btn-outline-danger p-1 m-1" data-toggle="modal" data-target="#cancel'.$rowx["id_extra"].'"><i class="far fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Desactivar"></i></button>
                                            </div>
                                            <h5 class="card-title">'.$rowx["title"].'</h5>';
                                            if($rowx["subsciption"]=="1"){
                                                echo '<p><span class="btn btn-outline-dark btn-sm p-1">Subscripcion</span></p>';
                                            }
                                            echo '<h6 class="card-subtitle mb-2 text-muted">Precio: '.$rowx["price"].'</h6>';
                                            
                                            echo '<button class="btn btn-dark btn-sm p-1"><i class="far fa-copy"></i> Copiar link directo</button>';
                                            echo '</div>
                                    </div>
                                    <div class="modal fade" id="cancel'.$rowx["id_extra"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                            <div class="modal-body">
                                                <h5>¿Estas seguro?</h5>
                                                <form action="deactivateExtra/" method="post">
                                                    <input type="hidden" name="extra_cancel" value="'.$rowx["id_extra"].'">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success text-white">Si</button>
                                                </form>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    <div class="modal fade right" id="edit'.$rowx["id_extra"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-full-width" role="document">
                                            <div class="modal-content-full-width modal-content">
                                                <div class="modal-header-full-width modal-header text-center bg-dark text-white">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel"><i class="fas fa-magic"></i> '.$rowx["title"].'</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-times-circle text-white"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="saveExtra/" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                                                                <input type="text" class="form-control" name="title_ex" value="'.$rowx["title"].'">
                                                                <input type="hidden" name="edit" value="1">
                                                                <input type="hidden" name="extra_edit" value="'.$rowx["id_extra"].'">
                                                            </div>
                                                            <div class="col">
                                                                <label><b>Precio</b></label>
                                                                <input type="textbox" value="'.$rowx["price"].'" class="form-control currency" name="price_ex" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>¿Que descripcion le pondrias?</b></label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description_ex" rows="3" required>'.$rowx["description"].'</textarea>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="confirmation_ex" rows="3" required>'.$rowx["confirmation"].'</textarea>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>¿Esto es una subcripcion mensual?</b> <button type="button" class="btn btn-dark btn-xs p-1" data-toggle="tooltip" data-placement="top" title="Se cobrara mensualmente"><i class="fas fa-question"></i></button></label>
                                                            <select class="form-control" name="subs_ex" required>';
                                                                if($rowx["subsciption"]=="1"){
                                                                    echo '<option value="0">No</option>';
                                                                    echo '<option value="1" selected>Si</option>';
                                                                }else{
                                                                    echo '<option value="0">No</option>';
                                                                    echo '<option value="1">Si</option>';
                                                                }
                                                                
                                                            echo '</select>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                                                            <input type="text" class="form-control" name="question_ex" value="'.$rowx["question"].'">
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>Limite de lugares:</b> <span class="small">(Opcional)</span></label><bR>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="checkLimit" onclick="limitsFunc()">
                                                                <label class="form-check-label" for="defaultCheck1">
                                                                    No hay limite
                                                                </label>
                                                                <script> function limitsFunc() {var checkBox = document.getElementById("checkLimit"); if (checkBox.checked == true){document.getElementById("limitInput").disabled = true; } else {document.getElementById("limitInput").disabled = false; } } </script>
                                                            </div>';
                                                            if($rowx["limit_slots"] == "0"){
                                                                echo '<input type="number" class="form-control" id="limitInput" name="limit_ex" value="">';
                                                            }else{
                                                                echo '<input type="number" class="form-control" id="limitInput" name="limit_ex" value="'.$rowx["limit_slots"].'">';
                                                            }
                                                            
                                                        echo '</div>
                                                        <div class="form-group files">
                                                            <label><b>Incluye una imagen a tu extra o sustituyela:</b> <span class="small">(Opcional)</span></label>
                                                            <input type="file" class="form-control" name="fileToUpload" accept="image/jpeg, image/png">
                                                        </div>
                                                </div>
                                                <div class="modal-footer-full-width  modal-footer">
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success text-white"><i class="fab fa-gratipay"></i> Actualizar</button>
                                                    </form>
                                                </div>
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
                            <i class="fas fa-hand-holding-heart fa-2x"></i><br><h4><b>Añade un extra a tu economia</b></h4>
                            <h5>Elige una plantilla o comienza desde cero</h5>
                        </div>
                    </div>
                    <p>
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-warning btn-lg col-sm-3 m-1 p-3" data-toggle="modal" data-target="#desdeCero"><i class="fas fa-plus-square"></i> Añadir desde cero</button>
                                <!-- Modal -->
                            <div class="modal fade right" id="desdeCero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-full-width" role="document">
                                    <div class="modal-content-full-width modal-content">
                                        <div class="modal-header-full-width modal-header text-center bg-dark text-white">
                                            <h5 class="modal-title w-100" id="exampleModalLabel"><i class="fas fa-magic"></i> Hazlo tuyo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times-circle text-white"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="saveExtra/" method="post" enctype="multipart/form-data">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                                                        <input type="text" class="form-control" name="title_ex" placeholder="Ej. Consulta creativa">
                                                    </div>
                                                    <div class="col">
                                                        <label><b>Precio</b></label>
                                                        <input type="textbox" placeholder="Ej. $450.00" class="form-control currency" name="price_ex" autocomplete="off" required>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label><b>¿Que descripcion le pondrias?</b></label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="description_ex" rows="3" required></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="confirmation_ex" rows="3" required></textarea>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label><b>¿Esto es una subcripcion mensual?</b> <button type="button" class="btn btn-dark btn-xs p-1" data-toggle="tooltip" data-placement="top" title="Se cobrara mensualmente"><i class="fas fa-question"></i></button></label>
                                                    <select class="form-control" name="subs_ex" required>
                                                        <option value="0">No</option>
                                                        <option value="1">Si</option>
                                                    </select>
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                                                    <input type="text" class="form-control" name="question_ex" placeholder="Ej. ¿Cual es tu id de instagram?">
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <label><b>Limite de lugares:</b> <span class="small">(Opcional)</span></label><bR>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="checkLimit" onclick="limitsFunc()">
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            No hay limite
                                                        </label>
                                                        <script> function limitsFunc() {var checkBox = document.getElementById("checkLimit"); if (checkBox.checked == true){document.getElementById("limitInput").disabled = true; } else {document.getElementById("limitInput").disabled = false; } } </script>
                                                    </div>
                                                    <input type="number" class="form-control" id="limitInput" name="limit_ex" placeholder="Ej. 15 lugares">
                                                </div>
                                                
                                                <div class="form-group files">
                                                    <label><b>Incluye una imagen a tu extra:</b> <span class="small">(Opcional)</span></label>
                                                    <input type="file" class="form-control" name="fileToUpload" accept="image/jpeg, image/png">
                                                </div>
                                        </div>
                                        <div class="modal-footer-full-width  modal-footer">
                                                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-success text-white"><i class="fab fa-gratipay"></i> Empezar</button>
                                                </form>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                        <?php
                            $sql = "SELECT id_extra, title, description, confirmation, limit_slots, price, question, subsciption FROM extras WHERE id_user=1";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo '';
                                while($row = $result->fetch_assoc()) {
                                    echo '<button type="button" class="btn btn-success btn-lg text-white col-sm-3 m-1 p-3" data-toggle="modal" data-target="#d'.$row["id_extra"].'"><i class="fas fa-plus-square"></i> '.$row["title"].'</button>
                                    <!-- Modal -->
                                    <div class="modal fade right" id="d'.$row["id_extra"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-full-width" role="document">
                                            <div class="modal-content-full-width modal-content">
                                                <div class="modal-header-full-width modal-header text-center bg-dark text-white">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel"><i class="fas fa-medal"></i> '.$row["title"].'</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-times-circle text-white"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="saveExtra/" method="post" enctype="multipart/form-data">
                                                        <div class="form-row">
                                                            <div class="col">
                                                                <label><b>¿Cual es el titulo de lo que ofreces?</b></label>
                                                                <input type="text" class="form-control" name="title_ex" value="'.$row["title"].'">
                                                            </div>
                                                            <div class="col">
                                                                <label><b>Precio</b></label>
                                                                <input type="textbox" value="'.$row["price"].'" class="form-control currency" name="price_ex" autocomplete="off" required>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>¿Que descripcion le pondrias?</b></label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="description_ex" rows="3" required>'.$row["description"].'</textarea>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>El siguiente mensaje aparecera despues que tu fan realiza el pago:</b></label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea1" name="confirmation_ex" rows="3" required>'.$row["confirmation"].'</textarea>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>¿Esto es una subcripcion mensual?</b> <button type="button" class="btn btn-dark btn-xs p-1" data-toggle="tooltip" data-placement="top" title="Se cobrara mensualmente"><i class="fas fa-question"></i></button></label>
                                                            <select class="form-control" name="subs_ex" required>';
                                                                if($row["subsciption"]=="1"){
                                                                    echo '<option value="0">No</option>';
                                                                    echo '<option value="1" selected>Si</option>';
                                                                }else{
                                                                    echo '<option value="0">No</option>';
                                                                    echo '<option value="1">Si</option>';
                                                                }
                                                                
                                                            echo '</select>
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>Haz una pregunta:</b> <span class="small">(Opcional)</span></label>
                                                            <input type="text" class="form-control" name="question_ex" value="'.$row["question"].'">
                                                        </div>
                                                        <br>
                                                        <div class="form-group">
                                                            <label><b>Limite de lugares:</b> <span class="small">(Opcional)</span></label>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" value="" id="checkLimit'.$row["id_extra"].'" onclick="limitsFunc'.$row["id_extra"].'()">
                                                                <label class="form-check-label" for="defaultCheck1">
                                                                    No hay limite
                                                                </label>
                                                                <script> function limitsFunc'.$row["id_extra"].'() {var checkBox = document.getElementById("checkLimit'.$row["id_extra"].'"); if (checkBox.checked == true){document.getElementById("limitInput'.$row["id_extra"].'").disabled = true; } else {document.getElementById("limitInput'.$row["id_extra"].'").disabled = false; } } </script>
                                                            </div>
                                                            <input type="number" class="form-control" id="limitInput'.$row["id_extra"].'" name="limit_ex" value="'.$row["limit_slots"].'">
                                                        </div>
                                                        
                                                        <div class="form-group files">
                                                            <label><b>Incluye una imagen a tu extra:</b> <span class="small">(Opcional)</span></label>
                                                            <input type="file" class="form-control" name="fileToUpload" accept="image/jpeg, image/png">
                                                        </div>
                                                </div>
                                                <div class="modal-footer-full-width  modal-footer">
                                                        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-success text-white"><i class="fab fa-gratipay"></i> Empezar</button>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        ?>
                    </div>    
                    </p>
              </div>
        </div>


      </div>
    </div>

<?php
require_once('../admin/footer.php');
$session_value=basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
	var myTitle='<?php echo $session_value;?>';
	document.title = 'Regalame un Cafe';
</script>