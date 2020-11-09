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
                    <a href="../micuenta" class="btn btn-primary"><i class="fas fa-cog"></i> General</a>
                    <a href="../notificaciones/" class="btn btn-primary"><i class="fas fa-bell"></i> Notificaciones</a>
                    <a href="../perfil/" class="btn btn-primary active"><i class="fas fa-user"></i> Perfil</a>
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