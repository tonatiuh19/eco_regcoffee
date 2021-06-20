<?php
require_once('../admin/header.php');
if ($_SESSION["utype"] == "2") {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='../misapoyos/';
  </SCRIPT>");
}
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

  :checked+label {
    border-color: #ddd;
  }

  :checked+label:before {
    content: "✓";
    background-color: grey;
    transform: scale(1);
  }

  :checked+label img {
    transform: scale(0.9);
    /* box-shadow: 0 0 5px #333; */
    z-index: -1;
  }
</style>
<div class="site-section bg-primary-light">
  <div class="container">
    <div class="row py-5">
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
            <h5>Selecciona una o mas categorias:</h5>
            <form action="saveMaterial/" method="post">
              <ul class="ulu text-center">
                <?php
                $idUser = $_SESSION["user_param"];
                $sql = "SELECT a.id_users_categories, a.date, a.video, a.writter, a.developer, a.podcaster, a.artist, a.influencer, a.other FROM users_categories as a INNER JOIN (SELECT id_user, MAX(date) as max_date FROM users_categories WHERE id_user=" . $idUser . " GROUP by id_user) as b on a.date=b.max_date";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  // output data of each row
                  while ($row = $result->fetch_assoc()) {
                    if ($row["video"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox1" name="video" checked />
                                      <label for="myCheckbox1"><i class="fas fa-video"></i> Video creador</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox1" name="video" />
                                      <label for="myCheckbox1"><i class="fas fa-video"></i> Video creador</label>
                                  </li>';
                    }

                    if ($row["writter"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox2" name="writter" checked />
                                      <label for="myCheckbox2"><i class="fas fa-pencil-alt"></i> Escritor</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox2" name="writter" />
                                      <label for="myCheckbox2"><i class="fas fa-pencil-alt"></i> Escritor</label>
                                  </li>';
                    }

                    if ($row["developer"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox3" name="developer" checked />
                                      <label for="myCheckbox3"><i class="fas fa-code"></i> Developer</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox3" name="developer" />
                                      <label for="myCheckbox3"><i class="fas fa-code"></i> Developer</label>
                                  </li>';
                    }

                    if ($row["podcaster"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox4" name="podcaster" checked />
                                      <label for="myCheckbox4"><i class="fas fa-microphone"></i> Podcaster</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox4" name="podcaster" />
                                      <label for="myCheckbox4"><i class="fas fa-microphone"></i> Podcaster</label>
                                  </li>';
                    }

                    if ($row["artist"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox5" name="artist" checked />
                                      <label for="myCheckbox5"><i class="fas fa-film"></i> Artista</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox5" name="artist" />
                                      <label for="myCheckbox5"><i class="fas fa-film"></i> Artista</label>
                                  </li>';
                    }

                    if ($row["influencer"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox6" name="influencer" checked />
                                      <label for="myCheckbox6"><i class="fas fa-heart"></i> Influencer</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox6" name="influencer" />
                                      <label for="myCheckbox6"><i class="fas fa-heart"></i> Influencer</label>
                                  </li>';
                    }

                    if ($row["other"] == "1") {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox7" name="otro" checked />
                                      <label for="myCheckbox7"><i class="fas fa-magic"></i> Otro</label>
                                  </li>';
                    } else {
                      echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox7" name="otro" />
                                      <label for="myCheckbox7"><i class="fas fa-magic"></i> Otro</label>
                                  </li>';
                    }
                  }
                } else {
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox1" name="video" />
                                      <label for="myCheckbox1"><i class="fas fa-video"></i> Video creador</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox2" name="writter" />
                                      <label for="myCheckbox2"><i class="fas fa-pencil-alt"></i> Escritor</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox3" name="developer" />
                                      <label for="myCheckbox3"><i class="fas fa-code"></i> Developer</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox4" name="podcaster" />
                                      <label for="myCheckbox4"><i class="fas fa-microphone"></i> Podcaster</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox5" name="artist" />
                                      <label for="myCheckbox5"><i class="fas fa-film"></i> Artista</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox6" name="influencer" />
                                      <label for="myCheckbox6"><i class="fas fa-heart"></i> Influencer</label>
                                  </li>';
                  echo '<li class="liu">
                                      <input type="checkbox" id="myCheckbox7" name="otro" />
                                      <label for="myCheckbox7"><i class="fas fa-magic"></i> Otro</label>
                                  </li>';
                }
                ?>
              </ul>
              <button type="submit" class="btn btn-success text-white" id="savemodifyMaterial">
                <i class="fas fa-check-circle"></i> Actualizar
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
$session_value = basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
  var myTitle = '<?php echo $session_value; ?>';
  document.title = 'Regalame un Cafe';

  activateNavbarItem("navAstronaut");
</script>