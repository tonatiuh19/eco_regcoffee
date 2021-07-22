<?php
require_once('../admin/header.php');
if($_SESSION["utype"] == "2"){
  echo ("<SCRIPT LANGUAGE='JavaScript'>
  window.location.href='../misapoyos/';
  </SCRIPT>");
}
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<div class="site-section bg-primary-light">
    <div class="container py-5">       
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                       
                        <li class="nav-item">
                            <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">General</a>
                        </li>
                        
                        <?php
                        $sqld = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$_SESSION["user_param"]." and a.status='paid' AND b.subsciption=1 ORDER BY a.date DESC";
                        $resultd = $conn->query($sqld);
                        
                        if ($resultd->num_rows > 0) {
                          // output data of each row
                          /*while($rowd = $resultd->fetch_assoc()) {
                          }*/
                          echo '<li class="nav-item">
                                <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Subscripciones</a>
                            </li>';
                        }
                        ?>
                    </ul>
                    </div>
                    <div class="card-body">

                    
                    <div class="tab-content mt-3">
                        <div class="tab-pane active" id="description" role="tabpanel">
                            <?php
                            /*$sql = "SELECT a.id_payments, a.id_extra, a.amount, a.amount_fee, a.amount_tax, b.title, a.date, c.id_users_pay FROM payments as a INNER JOIN extras as b on a.id_extra=b.id_extra LEFT JOIN users_pay as c on c.id_payments=a.id_payments WHERE a.id_user=".$_SESSION["user_param"]." and a.status='paid' AND b.subsciption=0 ORDER BY a.date DESC";
                            $result = $conn->query($sql);
                            
                            if ($result->num_rows > 0) {
                                echo '<table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Fecha de pago a creador</th>
                                    <th scope="col">Cuenta</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                $x=0;
                              while($row = $result->fetch_assoc()) {
                                $x++;
                                $totalAmount = $row["amount"]-$row["amount_fee"]-$row["amount_tax"];
                                $toDeposit = $totalAmount-(($totalAmount*0.08)+($totalAmount*0.16)+2);
                                $roundToDeposit = number_format((float)$toDeposit, 2, '.', '');
                                echo '<tr>
                                    <th scope="row">'.$x.'</th>
                                    <td>'.$row["title"].'</td>
                                    <td>$ '.$roundToDeposit.'</td>
                                    <td>';
                                    if($row["id_users_pay"]==null){
                                        echo '<span class="btn btn-primary p-1">En proceso</span>';
                                    }else if($row["status"]=="2"){
                                        echo '<span class="btn btn-success p-1">Completo</span>';
                                    }
                                    echo'</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>';
                              }
                              echo '</tbody>
                              </table>';
                            }*/
                            echo '<p id="imageLoadingPayments"><i class="fas fa-spinner fa-spin fa-2x"></i></p><script>
                            $(document).ready(function() {
                              $("#imageLoadingPayments").hide();
                            });
                            </script>';
                            
                        
                            echo '<div id="table-data-payments"></div>';
                            echo '<script type="text/javascript">
                             $(document).ready(function(){
                               function loadDataPay(page){
                                 $.ajax({
                                   url  : "../mispagos/pagination.php",
                                   type : "POST",
                                   cache: false,
                                   data : {page_no:page, username:"'.$_SESSION["user_param"].'", type:1},
                                   beforeSend: function(){
                                    $("#imageLoadingPayments").show();
                                    },
                                    complete: function(){
                                        $("#imageLoadingPayments").hide();
                                    },
                                   success:function(response){
                                     $("#table-data-payments").html(response);
                                   }
                                 });
                               }
                               loadDataPay();
                               
                               // Pagination code
                               $(document).on("click", ".pagination li a", function(e){
                                 e.preventDefault();
                                 var pageId = $(this).attr("id");
                                 loadDataPay(pageId);
                               });
                             });
                           </script>';
                            ?>
                        </div>
                        
                        <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
                            <?php
                            /*if ($resultd->num_rows > 0) {
                                // output data of each row
                                
                                echo '<table class="table">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Fecha de pago a creador</th>
                                    <th scope="col">Cuenta</th>
                                  </tr>
                                </thead>
                                <tbody>';
                                $x=0;
                              while($rowd = $resultd->fetch_assoc()) {
                                $x++;
                                $totalAmount = $rowd["amount"];
                                $toDeposit = $totalAmount-(($totalAmount*0.08)+($totalAmount*0.16)+2);
                                $roundToDeposit = number_format((float)$toDeposit, 2, '.', '');
                                echo '<tr>
                                    <th scope="row">'.$x.'</th>
                                    <td>'.$rowd["title"].'</td>
                                    <td>$ '.$roundToDeposit.'</td>
                                    <td>';
                                    if($rowd["id_users_pay"]==null){
                                        echo '<span class="btn btn-primary p-1">En proceso</span>';
                                    }else if($rowd["status"]=="2"){
                                        echo '<span class="btn btn-success p-1">Completo</span>';
                                    }
                                    echo'</td>
                                    <td></td>
                                    <td></td>
                                </tr>';
                              }
                              echo '</tbody>
                              </table>';
                              }*/
                              if ($resultd->num_rows > 0) {
                                echo '<p id="imageLoadingSub"><i class="fas fa-spinner fa-spin fa-2x"></i></p><script>
                                $(document).ready(function() {
                                $("#imageLoadingSub").hide();
                                });
                                </script>';
                                
                            
                                    echo '<div id="table-data-subs"></div>';
                                    echo '<script type="text/javascript">
                                    $(document).ready(function(){
                                    function loadDataSub(page){
                                        $.ajax({
                                        url  : "../mispagos/pagination.php",
                                        type : "POST",
                                        cache: false,
                                        data : {page_no:page, username:"'.$_SESSION["user_param"].'", type:2},
                                        beforeSend: function(){
                                            $("#imageLoadingSub").show();
                                            },
                                            complete: function(){
                                                $("#imageLoadingSub").hide();
                                            },
                                        success:function(response){
                                            $("#table-data-subs").html(response);
                                        }
                                        });
                                    }
                                    loadDataSub();
                                    
                                    // Pagination code
                                    $(document).on("click", ".pagination li a", function(e){
                                        e.preventDefault();
                                        var pageId = $(this).attr("id");
                                        loadDataSub(pageId);
                                    });
                                    });
                                </script>';
                            }
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
$session_value=basename(dirname(__FILE__));
$conn->close();
?>
<script type="text/javascript">
	var myTitle='<?php echo $session_value;?>';
  document.title = 'Regalame un Cafe';
  
  activateNavbarItem("navAstronaut");
</script>