<?php
require_once('../admin/header.php');
?>
    <div class="site-section bg-primary-light">
      <div class="container">
        
        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                  <button id="copyLink" class="btn btn-primary float-right"  onclick="copyLinkToClipboard('#linkToCopy')"><i class="fas fa-clone"></i> Copiar link</button>
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
                      echo '<p class="card-text" id="linkToCopy">regalameuncafe.com/'.$_SESSION['uname'].'</p>';
                    ?>
                  </div>
                </div>
              </div>
        </div>
        <p></p>
        <div class="row">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <h1>Mi cuenta</h1>
                    <p>
                      <a href="../micuenta" class="btn btn-primary"><i class="fas fa-cog"></i> General</a>
                      <a href="../notificaciones/" class="btn btn-primary"><i class="fas fa-bell"></i> Notificaciones</a>
                      <a href="../perfil/" class="btn btn-primary active"><i class="fas fa-user"></i> Perfil</a>
                      <a href="../material/" class="btn btn-primary">¿Que tipo de material creas, desarrollas, imaginas, etc?</a>
                    </p>
                    <button class="btn btn-danger float-right" id="cancelmodifyProfile"><i class="fas fa-times-circle"></i> Cancelar</button>
                      <button class="btn btn-primary float-right" id="modifyProfile"><i class="fas fa-pencil-alt"></i> Modificar</button>
                      <hr>
                      <p>
                        <form action="saveProfile/" method="post"> 
                          <?php
                            $sql = "SELECT email, name, last_name, user_name, phone FROM users WHERE id_user='".$_SESSION["user_param"]."'";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                              // output data of each row
                              while($row = $result->fetch_assoc()) {
                                if($row["name"] == ''){
                                  $name='Aun no tienes nombre';
                                }else{
                                  $name=$row['name'];
                                }
                                if($row["last_name"] == ''){
                                  $lname='Aun no tienes apellido';
                                }else{
                                  $lname=$row['last_name'];
                                }
                                if($row["phone"] == ''){
                                  $phone='Aun no tienes telefono';
                                }else{
                                  $phone=$row['phone'];
                                }
                                $email=$row['email'];
                              }
                              echo '<div class="form-group">
                              <label for="exampleInputEmail1">Correo electronico</label>
                              <input type="email" class="form-control" name="correo" id="correo" aria-describedby="emailHelp" value="'.$email.'" disabled>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" class="form-control" name="pwd" id="pwd" value="Password" disabled>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="'.$name.'" disabled>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" value="'.$lname.'" disabled>
                              </div>
                              <div class="form-group">
                                <label for="exampleInputPassword1">Telefono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value="'.$phone.'" disabled>
                              </div>';
                            } else {
                              echo "0 results";
                            }
                          ?>
                          <button type="button" class="btn btn-success text-white" id="savemodifyProfile" data-toggle="modal" data-target="#exampleModal">
                          <i class="fas fa-check-circle" type="submit"></i> Guardar
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <div class="form-group">
                                    <input type="password" name="pwd_confirm" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingresa la contraseña actual" required>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                <button class="btn btn-success text-white"><i class="fas fa-check-circle" type="submit"></i> Guardar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <p></p>
                          
                        </form>
                      </p>
                  </div>
                </div>
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
  
  activateNavbarItem("navAstronaut");
</script>