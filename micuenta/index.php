<?php
session_start();
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
                            <form>
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label"><i class="fab fa-paypal"></i> Paypal</label>
                                    <div class="col-sm-6">
                                        <input type="text" readonly class="form-control" id="inputPaypal" placeholder="Correo electronico, numero de celular de cuenta">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioActivePaypal" value="Activo" disabled>
                                        <label class="form-check-label" for="exampleRadios3">
                                            Activo
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label"><i class="fas fa-money-check-alt"></i> CLABE</label>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control" id="inputClabeBank" placeholder="Banco">
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" readonly class="form-control" id="inputClabeBankNumber" placeholder="CLABE">
                                    </div>
                                    <div class="col-sm-4">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioActiveClabe" value="Activo" disabled>
                                        <label class="form-check-label" for="exampleRadios3">
                                            Activo
                                        </label>
                                    </div>
                                </div>
                                <button class="btn btn-success text-white" id="savemodifyPayment"><i class="fas fa-check-circle"></i> Guardar</button>
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