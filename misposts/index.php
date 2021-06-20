<?php
require_once('../admin/header.php');
if ($_SESSION["utype"] == "2") {
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='../misapoyos/';
  </SCRIPT>");
}
date_default_timezone_set('America/Mexico_City');
?>
<div class="site-section bg-primary-light">
  <div class="container">
    <div class="row py-5">
      <div class="col-sm-12">

        <?php
        $sql = "SELECT a.id_users_posts, a.is_deleted, a.text, a.date FROM users_posts as a WHERE a.id_user='" . $_SESSION["user_param"] . "' AND a.is_deleted=0 ORDER by a.date desc";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          echo '<div class="col-sm-12">';
          echo '  <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#newPost"><i class="fas fa-plus-square"></i> Añadir post</button>';
          echo '<h1>Mis Posts</h1>';

          echo '</div>';
          echo '<hr>';
          echo '<div class="row">';
          while ($row = $result->fetch_assoc()) {

            echo '<div class="card mt-1">
            <div class="card-body">
              <div>
                <span class="fst-italic ">' . $row["text"] . '</span>';
            $date = date_create($row["date"]);
            $mysqltime = date_format($date, 'd-m-Y G:i a');
            echo '<p class="fw-light">
                  <i class="fas fa-calendar-alt"></i> ' . $mysqltime . '
                </p>
              </div>
              <div class="float-end">
                <!--<button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#edit' . $row["id_users_posts"] . '"><i class="fas fa-pen"></i></button>-->
                <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#cancel' . $row["id_users_posts"] . '"><i class="far fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Desactivar"></i></button>

                <div class="modal fade" id="cancel' . $row["id_users_posts"] . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Estas seguro de querer cancelar este post?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Me equivoque</button>
                        <form method="post" action="./cancelPost/index.php">
                          <input type="hidden" name="post_cancel" value="' . $row["id_users_posts"] . '">
                          <button type="submit" class="btn btn-danger">Ya quítalo</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>';
          }
          echo '</div>';
        } else {
          echo '<div class=" pt-3 container-center">
          <div class="flex-container-center">
            <div class="row-center">
              <div class="flex-item-center">
                <div class="p-5 mb-4 rounded-3">
                  <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">
                      Pon al tanto a tus fans <i class="far fa-newspaper"></i>
                    </h1>
                    <p class="col-md-8 fs-4">
                      Puedes incluir mensajes en tu pagina y asi tus fans no
                      perderán ninguna noticia tuya. Notas, mensajes, usuario
                      en redes sociales, lo que a ti se te ocurra.
                    </p>
                    <button type="button" class="btn btn-warning float-end" data-bs-toggle="modal" data-bs-target="#newPost"><i class="fas fa-plus-square"></i> Añadir post</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>';
        }
        ?>
      </div>
      <div class="modal fade" id="newPost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <?php
              echo '<h5 class="modal-title" id="staticBackdropLabel">¿Que traes en mente ' . $_SESSION["uname"] . '?</h5>';
              ?>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="newPost/" method="post">
                <div class="mb-3">
                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="nPost" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Publicar</button>
              </form>
            </div>
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
</script>
<script type="text/javascript">
  activateNavbarItem("navPosts");
</script>