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
                        $today = date("Y-m-d H:i:s");
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
                <div class="card">
                  <div class="card-body">
                    <h1>Mi cuenta</h1>
                    <p>
                        <a href="../micuenta" class="btn btn-primary active"><i class="fas fa-cog"></i> General</a>
                        <a href="../notificaciones/" class="btn btn-primary"><i class="fas fa-bell"></i> Notificaciones</a>
                        <a href="../perfil/" class="btn btn-primary"><i class="fas fa-user"></i> Perfil</a>
                    </p>
                    <hr>
                    <p>
                        <button class="btn btn-danger float-right" id="cancelmodifyPayment"><i class="fas fa-times-circle"></i> Cancelar</button>
                        <button class="btn btn-primary float-right" id="modifyPayment"><i class="fas fa-pencil-alt"></i> Modificar</button>
                        
                        <h3>¿En donde depositamos tu dinero?</h3>
                        <p>
                            <form action="savePayment/" method="post">
                                <?php

                                  $sqlx = "SELECT t.id_users_payment, a.max_date, a.id_users_payment_type, t.id_user, t.value, t.place FROM users_payment as t INNER JOIN (SELECT id_users_payment_type,MAX(date) as max_date FROM users_payment WHERE id_users_payment_type=1 or id_users_payment_type=2 GROUP BY id_users_payment_type) as a ON a.max_date = t.date WHERE t.id_user='".$_SESSION["user_param"]."'";
                                  $resultx = $conn->query($sqlx);
                                  
                                  if ($resultx->num_rows > 0) {
                                    
                                    $sqly = "SELECT t.id_users_payment, a.max_date, t.id_users_payment_type, a.id_user FROM users_payment as t INNER JOIN (SELECT id_user,MAX(date) as max_date FROM users_payment WHERE id_user='".$_SESSION["user_param"]."' GROUP BY id_user) as a ON a.max_date = t.date";
                                    $resulty = $conn->query($sqly);
                                    
                                    if ($resulty->num_rows > 0) {
                                      // output data of each row
                                      while($rowy = $resulty->fetch_assoc()) {
                                        if($rowy["id_users_payment_type"]=="1"){
                                          $activePaypal =  true;
                                          $activeBank =  false;
                                        }else if($rowy["id_users_payment_type"]=="2"){
                                          $activePaypal =  false;
                                          $activeBank =  true;
                                        }
                                      }
                                    } else {
                                      echo "0 results";
                                    }

                                    while($rowx = $resultx->fetch_assoc()) {
                                      if($rowx["id_users_payment_type"]=="1"){
                                        $placePaypal = $rowx["place"];
                                        $valuePaypal = $rowx["value"];
                                      }else if($rowx["id_users_payment_type"]=="2"){
                                        $placeBank = $rowx["place"];
                                        $valueBank = $rowx["value"];
                                      }
                                    }
                                    echo '<div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><i class="fab fa-paypal"></i> Paypal</label>
                                    <div class="col-sm-6">';
                                        if(!isset($valuePaypal)){
                                          echo '<input type="text" readonly class="form-control" id="inputPaypal" name="paypalValue" placeholder="Correo electronico, numero de celular de cuenta">';
                                        }else{
                                          echo '<input type="text" readonly class="form-control" id="inputPaypal" name="paypalValue" value="'.$valuePaypal.'">';
                                        }
                                        
                                        echo '<input type="hidden" name="paypalPlace" value="Paypal">
                                    </div>
                                    <div class="col-sm-4">';
                                        if($activePaypal){
                                          echo '<input class="form-check-input" type="radio" checked name="exampleRadios" id="radioActivePaypal" value="ActivoPaypal" disabled>';
                                        }else{
                                          echo '<input class="form-check-input" type="radio" name="exampleRadios" id="radioActivePaypal" value="ActivoPaypal" disabled>';
                                        }
                                        echo '<label class="form-check-label" for="exampleRadios3">
                                            Activo
                                        </label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fas fa-money-check-alt"></i> CLABE</label>
                                        <div class="col-sm-3">';
                                          if(!isset($placeBank)){
                                            echo '<input type="text" readonly class="form-control" name="bankPlace" id="inputClabeBank" placeholder="Banco">';
                                          }else{
                                            echo '<input type="text" readonly class="form-control" name="bankPlace" id="inputClabeBank" value="'.$placeBank.'">';
                                          }
                                            
                                        echo '</div>
                                        <div class="col-sm-3">';
                                            if(!isset($valueBank)){
                                              echo '<input type="text" readonly class="form-control" name="bankValue" id="inputClabeBankNumber" placeholder="CLABE">';
                                            }else{
                                              echo '<input type="text" readonly class="form-control" name="bankValue" id="inputClabeBankNumber" value="'.$valueBank.'">';
                                            }
                                            
                                        echo '</div>
                                        <div class="col-sm-4">';
                                          if($activeBank){
                                            echo '<input class="form-check-input" type="radio" checked name="exampleRadios" id="radioActiveClabe" value="ActivoBank" disabled>';
                                          }else{
                                            echo '<input class="form-check-input" type="radio" name="exampleRadios" id="radioActiveClabe" value="ActivoBank" disabled>';
                                          }
                                            echo '<label class="form-check-label" for="exampleRadios3">
                                                Activo
                                            </label>
                                        </div>
                                    </div>';
                                  } else {
                                    echo '<div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><i class="fab fa-paypal"></i> Paypal</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly class="form-control" id="inputPaypal" name="paypalValue" placeholder="Correo electronico, numero de celular de cuenta">
                                        <input type="hidden" name="paypalPlace" value="Paypal">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input" required type="radio" name="exampleRadios" id="radioActivePaypal" value="ActivoPaypal" disabled>
                                        <label class="form-check-label" for="exampleRadios3">
                                            Activo
                                        </label>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fas fa-money-check-alt"></i> CLABE</label>
                                        <div class="col-sm-3">
                                            <input type="text" readonly class="form-control" name="bankPlace" id="inputClabeBank" placeholder="Banco">
                                        </div>
                                        <div class="col-sm-3">
                                            <input type="text" readonly class="form-control" name="bankValue" id="inputClabeBankNumber" placeholder="CLABE">
                                        </div>
                                        <div class="col-sm-4">
                                            <input class="form-check-input" required type="radio" name="exampleRadios" id="radioActiveClabe" value="ActivoBank" disabled>
                                            <label class="form-check-label" for="exampleRadios3">
                                                Activo
                                            </label>
                                        </div>
                                    </div>';
                                  }
                                ?>
                                
                                <button class="btn btn-success text-white" id="savemodifyPayment"><i class="fas fa-check-circle" type="submit"></i> Guardar</button>
                            </form>
                        </p>
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
</script>