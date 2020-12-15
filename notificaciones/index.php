<?php
require_once('../admin/header.php');
if($_SESSION["utype"] == "2"){
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='../misapoyos/';
  </SCRIPT>");
}
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
                      <a href="../notificaciones/" class="btn btn-primary active"><i class="fas fa-bell"></i> Notificaciones</a>
                      <a href="../perfil/" class="btn btn-primary"><i class="fas fa-user"></i> Perfil</a>
                      <a href="../material/" class="btn btn-primary">¿Que tipo de material creas, desarrollas, imaginas, etc?</a>
                    </p>
                    <hr>
                    <p>
                      <button class="btn btn-danger float-right" id="cancelmodifyNotifications"><i class="fas fa-times-circle"></i> Cancelar</button>
                      <button class="btn btn-primary float-right" id="modifyNotifications"><i class="fas fa-pencil-alt"></i> Modificar</button>
                      <h3>¿Que notificaciones quieres recibir?</h3>
                      <p></p>
                      
                      <form action="saveNotification/" method="post">
                        <?php
                          $sql = "SELECT t.id_users_notification, a.max_date, t.new_supporter, t.new_coffe FROM users_notification as t INNER JOIN (SELECT id_user,MAX(date) as max_date FROM users_notification WHERE id_user='".$_SESSION["user_param"]."' GROUP BY id_user) as a ON a.max_date = t.date";
                          $result = $conn->query($sql);
                          
                          if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                              if($row["new_coffe"]=="1"){
                                $newCoffe = true;
                              }else {
                                $newCoffe = false;
                              }

                              if($row["new_supporter"]=="1"){
                                $newSupporter = true;
                              }else{
                                $newSupporter = false;
                              }
                            }
                            
                          echo '<hr>
                          <div class="form-check">';
                            if($newSupporter){
                              echo '<input class="form-check-input" checked type="checkbox" value="1" name="checkFan" id="checkFan" onclick="checkingNotifications()" disabled>';
                            }else{
                              echo '<input class="form-check-input" type="checkbox" value="1" name="checkFan" id="checkFan" onclick="checkingNotifications()" disabled>';
                            }
                            
                            echo '<label class="form-check-label" for="defaultCheck1">
                              Nuevos Fans
                            </label>
                          </div>
                          <div class="form-check">';
                            if($newCoffe){
                              echo '<input class="form-check-input" checked type="checkbox" value="1" name="checkCoffe" id="checkCoffe" onclick="checkingNotifications()" disabled>';
                            }else{
                              echo '<input class="form-check-input" type="checkbox" value="1" name="checkCoffe" id="checkCoffe" onclick="checkingNotifications()" disabled>';
                            }
                            echo '<label class="form-check-label" for="defaultCheck2">
                              Nuevos cafes, membresias a "close friends", 1:1 zoom, e-books, etc.
                            </label>
                          </div>';
                          } else {
                            echo "0 results";
                          }
                        ?>
                        <p></p>
                        <button class="btn btn-success text-white" id="savemodifyNotifications"><i class="fas fa-check-circle" type="submit"></i> Guardar</button>
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