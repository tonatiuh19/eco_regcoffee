<?php
require_once('../admin/header.php');
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="site-section bg-primary-light">
  <div class="container py-5">
    
          <div class="row text-center" id="myFansButtons">
            <?php
            $uName = $_SESSION['uname'];
            $sqlw = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.price, b.id_user, b.name, b.last_name, b.about, b.creation, b.extra FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=4 AND b.user_name='" . $uName . "'";
            $resultw = $conn->query($sqlw);

            if ($resultw->num_rows > 0) {
              // output data of each row
              while ($roww = $resultw->fetch_assoc()) {
                $idCoffe = $roww["id_extra"];
                
              }
              //echo '<button type="button" class="btn btn-warning btn-lg col-sm-3 p-1 p-3 text-dark btnFans" onclick="getSummary(' . $idCoffe . ')"><i class="fas fa-mug-hot"></i> Mis Cafes</button>';
              echo '<script type="text/javascript">
                                    $(document).ready(function(){
                                      function loadData(page){
                                      $.ajax({
                                        url  : "../misfans/extras.php",
                                        type : "POST",
                                        cache: false,
                                        data : {page_no:page, extraid:"' . $idCoffe . '"},
                                        beforeSend: function () {
                                          $("#imageLoading").show();
                                        },
                                        complete: function () {
                                          $("#imageLoading").hide();
                                        },
                                        success: function (response) {
                                          $("#table-data").html(response);
                                        },
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
            $sql = "SELECT id_extra, title, description, confirmation, limit_slots, price, question, subsciption FROM extras WHERE id_user='" . $idUser . "' AND active=1 AND active <>2 order by subsciption desc";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              echo '<div class="col-sm-4 p-1">
                <button type="button" class="btn btn-warning col-12 text-dark btnFans" onclick="getSummary(' . $idCoffe . ')"><i class="fas fa-gifts"></i> Mis cafes</button>
                </div>';
              while ($row = $result->fetch_assoc()) {
                echo '<div class="col-sm-4 p-1">
                <button type="button" class="btn btn-outline-warning col-12 text-dark btnFans" onclick="getSummary(' . $row["id_extra"] . ')"><i class="fas fa-gifts"></i> ' . $row["title"] . '</button>
                </div>';
              }
            }
            ?>

    </div>
    <p></p>
    <div class="row text-center">
      <script>
        $(document).ready(function() {
          $("#imageLoading").hide();
        });
      </script>
      <div class="col-sm-12">
        <i class="fas fa-spinner fa-spin fa-2x" id="imageLoading"></i>
      </div>
    </div>
    <div class="row">
      <div id="table-data" class="col-sm-12"></div>
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

  activateNavbarItem("navFans");
</script>