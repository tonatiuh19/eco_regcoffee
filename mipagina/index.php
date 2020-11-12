<?php
require_once('../admin/header.php');
?>
    <div class="site-section bg-primary-light">
      <div class="container">
        <?php
          $sql = "SELECT paypal, clabe FROM users WHERE id_user='".$_SESSION["user_param"]."'";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              
              if($row["paypal"] === NULL && $row["clabe"] === NULL){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Registra tu usuario de <i class="fab fa-paypal"></i> Paypal o tu <i class="fas fa-money-check-alt"></i> Clabe interbancaria</strong> para que tus cafes se vuelvan realidad <a href="../micuenta/" class="text-danger">aqui</a>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
              }
            }
          }
        ?>
        
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
                    <?php
                      $sql1 = "SELECT id_users_extras, id_creator, email_fan, id_extra FROM users_extras WHERE id_creator='".$_SESSION["user_param"]."'";
                      $result1 = $conn->query($sql1);
                      
                      if ($result1->num_rows > 0) {
                        // output data of each row
                        while($row1 = $result1->fetch_assoc()) {
                          echo $row1["email_fan"];
                        }
                      } else {
                        echo '<div class="row mb-3">
                        <div class="col-lg-7 text-center mx-auto">
                          <!--<h2 class="section-heading">Diseñado para personas, no para empresas</h2>
                          <p>Comparte contenido exclusivo o simplemente brinda una forma de respaldar tu trabajo</p>-->
                          <h2 class="section-heading"><i class=""></i></h2>
                          <h2>Aun no te regalan cafes <i class="far fa-dizzy"></i></h2>
                          <h2 class="mb-4 section-heading">Aqui tienes algunos tips:</h2>
                          <ul class="list-unstyled mb-3">
                            <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en redes sociales.</li>
                            <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu descripcion en Youtube.</li>
                            <li><i class="far fa-hand-point-right"></i> Incluye tu link en tu read-me en tus repositorios de Git.</li>
                            <li> <i class="far fa-hand-point-right"></i> Incluye tu link en todos lados! donde lo necesites <i class="fas fa-heart text-danger"></i>.</li>
                          </ul>
                          <p>
                            <button id="copy_" class="btn btn-primary" data-clipboard-text="regalameuncafe.com/'.$_SESSION['uname'].'"><i class="fas fa-clone"></i> Copiar link</button>
                            <a href="#generarBoton" class="btn btn-primary"><i class="fas fa-code"></i> Crea un boton</a>
                          </p>
                        </div>
                      </div>';
                      }
                    ?>
                    
                  </div>
                </div>
              </div>
        </div>
        <p></p>
        <div class="row" id="generarBoton">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-6"><button class="btn btn-primary bouton-image monBouton">Éditer</button></div>
                    <div class="col-sm-6">
                      For example, <code>&lt;section&gt;</code> should be wrapped as inline.
                    </div>
                </div>
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