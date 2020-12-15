<?php
require_once('../admin/header.php');
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <div class="site-section bg-primary-light">
      <div class="container">
        <?php
        if($_SESSION["utype"] == "2"){
          echo ("<SCRIPT LANGUAGE='JavaScript'>
          window.location.href='../misapoyos/';
          </SCRIPT>");
        }
          $sql = "SELECT t.id_users_payment, a.max_date, t.id_users_payment_type, a.id_user FROM users_payment as t INNER JOIN (SELECT id_user,MAX(date) as max_date FROM users_payment WHERE id_user='".$_SESSION["user_param"]."' GROUP BY id_user) as a ON a.max_date = t.date";
          $result = $conn->query($sql);
          
          if (!($result->num_rows > 0)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Registra tu usuario de <i class="fab fa-paypal"></i> Paypal o tu <i class="fas fa-money-check-alt"></i> Clabe interbancaria</strong> para que tus cafes se vuelvan realidad <a href="../micuenta/" class="text-danger">aqui</a>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            
          }
        ?>
        
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
                <div class="row justify-content-center" id="myFansButtons">
                  <?php
                  $uName = $_SESSION['uname'];
                    $sqlw = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.price, b.id_user, b.name, b.last_name, b.about, b.creation, b.extra FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=2 AND b.user_name='".$uName."'";
                    $resultw = $conn->query($sqlw);
                    
                    if ($resultw->num_rows > 0) {
                      // output data of each row
                      while($roww = $resultw->fetch_assoc()) {
                        $idCoffe = $roww["id_extra"];
                      }
                      echo '<button type="button" class="btn btn-warning btn-lg col-sm-3 m-1 p-3 text-dark btnFans" onclick="getSummary('.$idCoffe.')"><i class="fas fa-mug-hot"></i> Mis Cafes</button>';
                      echo '<script type="text/javascript">
                                  $(document).ready(function(){
                                    function loadData(page){
                                    $.ajax({
                                      url  : "../misfans/extras.php",
                                      type : "POST",
                                      cache: false,
                                      data : {page_no:page, extraid:"'.$idCoffe.'"},
                                      success:function(response){
                                      $("#table-data").html(response);
                                      }
                                    });
                                    }
                                    loadData();
                                    
                                    // Pagination code
                                    $(document).on("click", ".pagination li a", function(e){
                                    e.preventDefault();
                                    var pageId = $(this).attr("id");
                                    loadData(pageId);
                                    });
                                  });
                            </script>';
                      }
                  ?>
                    <?php
                        $idUser = $_SESSION["user_param"];
                        $sql = "SELECT id_extra, title, description, confirmation, limit_slots, price, question, subsciption FROM extras WHERE id_user='".$idUser."' AND active=1 AND active <>2 order by subsciption desc";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo '<button type="button" class="btn btn-outline-warning btn-lg col-sm-3 m-1 p-3 text-dark btnFans" onclick="getSummary('.$row["id_extra"].')"><i class="fas fa-gifts"></i> '.$row["title"].'</button>';
                            }
                        }
                        echo '<a href="../misextras/" class="btn btn-outline-success btn-lg col-sm-3 m-1 p-3"><i class="fas fa-plus"></i> Nuevo extra</a>';
                    ?>
                </div>    
            </div>
            
        </div>
        <p></p>
        <div class="row justify-content-center">
          <script>
          $(document).ready(function() {
            $("#imageLoading").hide();
          });
          </script>
          <i class="fas fa-spinner fa-spin fa-2x" id="imageLoading"></i>
          <div id="table-data" class="col-sm-12"></div>
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
  
  activateNavbarItem("navFans");
</script>