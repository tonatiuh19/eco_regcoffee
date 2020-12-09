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
                <h1>Mis Posts</h1>
                <?php
                    $sql = "SELECT a.id_users_posts, a.is_deleted, a.text, a.date FROM users_posts as a WHERE a.id_user='".$_SESSION["user_param"]."' AND a.is_deleted=0";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo '<div class="row justify-content-center p-2">';
                        echo '  <button type="button" class="btn btn-success text-white " data-toggle="modal" data-target="#nuevoPost"><i class="fas fa-plus-circle"></i> Agregar Post</button>';
                        echo '</div>';
                        echo '<div class="row justify-content-center">';
                        while($row = $result->fetch_assoc()) {
                            echo '<div class="card col-sm-10 m-1 p-3">
                                    <div class="card-body">
                                        <div class="float-right">
                                            <button class="btn btn-outline-danger p-1 m-1" data-toggle="modal" data-target="#cancelPost'.$row["id_users_posts"].'"><i class="far fa-eye-slash" data-toggle="tooltip" data-placement="top" title="Desactivar"></i></button>
                                        </div>
                                        <p class="font-italic">'.$row["text"].'</p>';
                                        $date = date_create($row["date"]);
                                        $mysqltime = date_format($date, 'd-m-Y G:i a');
                                        echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
                                        
									echo '</div>
                                </div>';
                            echo '<div class="modal fade" id="cancelPost'.$row["id_users_posts"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-body">
                                    <h5>¿Estas seguro?</h5>
                                    <form action="cancelPost/" method="post">
                                        <input type="hidden" name="post_cancel" value="'.$row["id_users_posts"].'">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success text-white">Si</button>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>';
                        }
                        echo '</div>';
                    } else {
                        echo '<div class="card col-12">
								<div class="card-body">
									<h5 class="card-title">Aun no tienes Posts</h5>
                                    <button type="button" class="btn btn-success text-white" data-toggle="modal" data-target="#nuevoPost"><i class="fas fa-plus-circle"></i> Agregar Post</button>
								</div>
							</div>';
                    }
                ?>
            </div>
            <div class="modal fade" id="nuevoPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-body">
                        <form action="newPost/" method="post">
                            <div class="form-group">
                                <?php
                                    echo '<label for="exampleFormControlTextarea1" class="strong">¿Que traes en mente '.$_SESSION["uname"].'?</label>';
                                ?>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="nPost" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success text-white float-right"><i class="fas fa-arrow-circle-up"></i> Publicar</button>
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
$session_value=basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
	var myTitle='<?php echo $session_value;?>';
	document.title = 'Regalame un Cafe';
</script>
<script type="text/javascript">
  activateNavbarItem("navPosts");
</script>