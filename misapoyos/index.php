<?php
require_once('../admin/header.php');
date_default_timezone_set('America/Mexico_City');
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="site-section bg-primary-light">
	<div class="container">
        <div class="row pt-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                <h2 class="fw-bold">A quien apoyas</h2>
                <p>Tu apoyo haciendose realidad</p>
            </div>
        </div>
        <div class="row pb-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Cafes</a>
                  </li>
                  <?php
                        $sql = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description, a.question_answer, d.question, e.id_payments_complete 
                          FROM payments as a 
                          INNER JOIN users as b on a.email_user=b.email 
                          INNER JOIN users as c on c.id_user=a.id_user 
                          INNER JOIN extras as d on d.id_extra=a.id_extra 
                          LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
                          WHERE a.status='paid' and d.active=1 and d.subsciption=0 and b.id_user=".$_SESSION["user_param"]."";
                        
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            echo '<li class="nav-item">
                            <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Extras</a>
                          </li>';
                        }
                        $sqly = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, d.id_extra, a.id_conekta, a.email_user, a.description, a.question_answer, d.question, e.id_payments_complete, a.customer_id, d.subsciption_id 
                        FROM payments as a INNER JOIN users as b on a.email_user=b.email 
                        INNER JOIN users as c on c.id_user=a.id_user 
                        INNER JOIN extras as d on d.id_extra=a.id_extra 
                        LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
                        WHERE (a.status='paid' or a.status='pending' or a.status='cancelled') and d.active=1 and d.subsciption=1 and b.id_user=".$_SESSION["user_param"]."";
                        
                        $resulty = $conn->query($sqly);
                        
                        if ($resulty->num_rows > 0) {
                            echo '<li class="nav-item">
                            <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Suscripciones</a>
                          </li>';
                        }
                  ?>
                </ul>
              </div>
              <div class="card-body pb-5">
           
                <div class="tab-content">
                  <div class="tab-pane active" id="description" role="tabpanel">
                        <div class="container">
                          <div class="row text-center">
                            <p id="imageLoading"><i class="fas fa-spinner fa-spin fa-2x"></i></p>
                            <script>
                              $(document).ready(function() {
                                $("#imageLoading").hide();
                              });
                            </script>
                          </div>
                          <div class="row">
                            <div id="table-data-description"></div>
                          </div>
                        </div>
                    
                    
                    <?php
                      echo '<script type="text/javascript">
                      $(document).ready(function(){
                        function loadData(page){
                        $.ajax({
                          url  : "./pagination.php",
                          type : "POST",
                          cache: false,
                          data : {page_no:page, userId:"' . $_SESSION["user_param"] . '"},
                          beforeSend: function(){
                        $("#imageLoading").show();
                        },
                        complete: function(){
                          $("#imageLoading").hide();
                        },
                          success:function(response){
                          $("#table-data-description").html(response);
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
                    ?>
                  </div>
                  
                  <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
                      <div class="container">
                        <div class="row text-center">
                          <p id="imageLoadingExtras"><i class="fas fa-spinner fa-spin fa-2x"></i></p>
                          <script>
                              $(document).ready(function() {
                                $("#imageLoadingExtras").hide();
                              });
                          </script>
                        </div>
                        <div class="row">
                          <div id="table-data-history"></div>
                        </div>
                      </div>
                    <?php
                      echo '<script type="text/javascript">
                      $(document).ready(function(){
                        function loadData(page){
                        $.ajax({
                          url  : "./paginationExtras.php",
                          type : "POST",
                          cache: false,
                          data : {page_no:page, userId:"' . $_SESSION["user_param"] . '"},
                          beforeSend: function(){
                        $("#imageLoading").show();
                        },
                        complete: function(){
                          $("#imageLoadingExtras").hide();
                        },
                          success:function(response){
                          $("#table-data-history").html(response);
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
                    ?>
                  </div>
                  
                  <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                    <div class="container">
                        <div class="row text-center">
                          <p id="imageLoadingDeals"><i class="fas fa-spinner fa-spin fa-2x"></i></p>
                          <script>
                              $(document).ready(function() {
                                $("#imageLoadingDeals").hide();
                              });
                          </script>
                        </div>
                        <div class="row">
                          <div id="table-data-deals"></div>
                        </div>
                      </div>
                    <?php
                      echo '<script type="text/javascript">
                      $(document).ready(function(){
                        function loadData(page){
                        $.ajax({
                          url  : "./paginationSubs.php",
                          type : "POST",
                          cache: false,
                          data : {page_no:page, userId:"' . $_SESSION["user_param"] . '"},
                          beforeSend: function(){
                        $("#imageLoading").show();
                        },
                        complete: function(){
                          $("#imageLoadingDeals").hide();
                        },
                          success:function(response){
                          $("#table-data-deals").html(response);
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
                    ?>
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
?>
<script type="text/javascript">
  activateNavbarItem("navAstronaut");
</script>