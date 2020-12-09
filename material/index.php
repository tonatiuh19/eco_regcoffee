<?php
require_once('../admin/header.php');
?>
<style>
.ulu {
  list-style-type: none;
}

.liu {
  display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
</style>
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
                        <a href="../perfil/" class="btn btn-primary"><i class="fas fa-user"></i> Perfil</a>
                        <a href="../material/" class="btn btn-primary active">¿Que tipo de material creas, desarrollas, imaginas, etc?</a>
                    </p>
                    
                      <hr>
                      <p>
                        <form action="saveMaterial/" method="post"> 
                            <ul class="ulu text-center">
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox1" />
                                    <label for="myCheckbox1"><i class="fas fa-video"></i> Video creador</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox2" />
                                    <label for="myCheckbox2"><i class="fas fa-pencil-alt"></i> Escritor</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox3" />
                                    <label for="myCheckbox3"><i class="fas fa-code"></i> Developer</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox3" />
                                    <label for="myCheckbox3"><i class="fas fa-microphone"></i> Podcaster</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox3" />
                                    <label for="myCheckbox3"><i class="fas fa-film"></i> Artista</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox3" />
                                    <label for="myCheckbox3"><i class="fas fa-heart"></i> Influencer</label>
                                </li>
                                <li class="liu">
                                    <input type="checkbox" id="myCheckbox3" />
                                    <label for="myCheckbox3"><i class="fas fa-magic"></i> Otro</label>
                                </li>
                            </ul>
                            <button type="button" class="btn btn-success text-white" id="savemodifyMaterial" data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-check-circle" type="submit"></i> Actualizar
                            </button>
                          
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