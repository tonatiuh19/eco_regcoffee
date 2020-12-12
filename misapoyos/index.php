<?php
require_once('../admin/header.php');
date_default_timezone_set('America/Mexico_City');
?>

<div class="site-section bg-primary-light">
	<div class="container">
        <div class="section-title text-center" >
          <h2>A quien apoyas</h2>
          <p>Tu apoyo haciendose realidad</p>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Cafes</a>
                  </li>
                  <?php
                        $sql = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description, a.question_answer, d.question, e.id_payments_complete FROM payments as a INNER JOIN users as b on a.email_user=b.email INNER JOIN users as c on c.id_user=a.id_user INNER JOIN extras as d on d.id_extra=a.id_extra LEFT JOIN payments_complete as e on e.id_payments=a.id_payments WHERE a.status='completed' and d.active=1 and d.subsciption=0 and b.id_user=".$_SESSION["user_param"]."";
                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) {
                            echo '<li class="nav-item">
                            <a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Extras</a>
                          </li>';
                        }

                        $sqly = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, d.id_extra, a.id_openpay, a.email_user, a.description, a.question_answer, d.question, e.id_payments_complete, a.customer_id, d.subsciption_id FROM payments as a INNER JOIN users as b on a.email_user=b.email INNER JOIN users as c on c.id_user=a.id_user INNER JOIN extras as d on d.id_extra=a.id_extra LEFT JOIN payments_complete as e on e.id_payments=a.id_payments WHERE a.status='completed' and d.active=1 and d.subsciption=1 and b.id_user=".$_SESSION["user_param"]."";
                        $resulty = $conn->query($sqly);
                        
                        if ($resulty->num_rows > 0) {
                            echo '<li class="nav-item">
                            <a class="nav-link" href="#deals" role="tab" aria-controls="deals" aria-selected="false">Subscripciones</a>
                          </li>';
                        }
                  ?>
                </ul>
              </div>
              <div class="card-body">
           
                <div class="tab-content">
                  <div class="tab-pane active" id="description" role="tabpanel">
                    
                    <?php
                        $sqlx = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description FROM payments as a INNER JOIN users as b on a.email_user=b.email INNER JOIN users as c on c.id_user=a.id_user INNER JOIN extras as d on d.id_extra=a.id_extra WHERE a.status='completed' and d.active=2 and b.id_user=".$_SESSION["user_param"]."";
                        $resultx = $conn->query($sqlx);
                        
                        if ($resultx->num_rows > 0) {
                          echo '<div class="row justify-content-center">';
                          while($rowx = $resultx->fetch_assoc()) {
                            $whatIWant = substr($rowx["description"], strpos($rowx["description"], "|") + 1);
                            echo '<div class="card border-primary col-md-4 m-1">
                            <div class="card-body text-primary">
                              <h5 class="card-title">'.$rowx["user_name"].' | '.$whatIWant.' <i class="fas fa-mug-hot"></i></h5>
                              ';
                              
                              if(!($rowx["note_fan"]=="")){
                                echo '<p class="card-text">';
                                if($rowx["isPublic_note_fan"]=="1"){
                                  echo '<span class="small">Tu nota es publica</span>';
                                }else{
                                  echo '<span class="small">Tu nota es privada</span>';
                                }
                                echo '<br>"'.$rowx["note_fan"].'"</p>';
                               
                              }else{
                                echo '<p class="card-text">Sin nota</p>';
                              }
                              $date = date_create($rowx["date"]);
                              $mysqltime = date_format($date, 'd-m-Y G:i a');
                              echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
                              
                            echo '</div>
                          </div>';
                          }
                          echo '</div>';
                        }
                    ?>
                  </div>
                  
                  <div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
                    <?php
                      if ($result->num_rows > 0) {
                        echo '<div class="row justify-content-center">';
                          while($row = $result->fetch_assoc()) {
                          
                            echo '<div class="card border-primary col-md-4 m-1">
                            <div class="card-body text-primary">
                              <h5 class="card-title">'.$row["user_name"].' | '.$row["title"].' <i class="fas fa-gifts"></i></h5>
                              ';
                              if($row["id_payments_complete"]==null){
                                echo '<span class="btn btn-warning p-1">Pendiente</span>';
                              }else{
                                echo '<span class="btn btn-success text-white p-1">Completo</span>';
                              }
                              if(!($row["note_fan"]=="")){
                                echo '<p class="card-text">';
                                if($row["isPublic_note_fan"]=="1"){
                                  echo '<span class="small">Tu nota es publica</span>';
                                }else{
                                  echo '<span class="small">Tu nota es privada</span>';
                                }
                                echo '<br>"'.$row["note_fan"].'"</p>';  
                              }else{
                                echo '<p class="card-text">Sin nota</p>';
                              }

                              if(!($row["question"]=="")){
                                echo '<p class="small"><span class="font-weight-bold">'.$row["question"].'</span><br>
                                Tu respuesta: '.$row["question_answer"].'
                                </p>';
                              }
                              $date = date_create($row["date"]);
                              $mysqltime = date_format($date, 'd-m-Y G:i a');
                              echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
                              
                            echo '</div>
                          </div>';
                          }
                        echo '</div>';
                      }
                    ?>
                  </div>
                  
                  <div class="tab-pane" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                    <?php
                    if ($resulty->num_rows > 0) {
                      echo '<div class="row justify-content-center">';
                      while($rowy = $resulty->fetch_assoc()) {
                      
                        echo '<div class="card border-primary col-md-4 m-1">
                        <div class="card-body text-primary">
                          <h5 class="card-title">'.$rowy["user_name"].' | '.$rowy["title"].' <i class="fas fa-gifts"></i></h5>
                          ';
                          if($rowy["id_payments_complete"]==null){
                            echo '<span class="btn btn-success text-white p-1">Activa</span>';
                          }else{
                            echo '<span class="btn btn-primary text-white p-1">Reiniciar</span>';
                          }
                          echo '
                          <button type="button" class="btn btn-danger p-1" data-toggle="tooltip" data-placement="top" title="Cancelar subsripcion">
                            <span data-toggle="modal" data-target="#cancel'.$rowy["id_payments"].'"><i class="fas fa-ban"></i></span>
                          </button>
                          <div class="modal fade" id="cancel'.$rowy["id_payments"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              
                              <div class="modal-body">
                                <h5>¿Estas seguro?</h5>
                                <form action="../misapoyos/cancelando/" method="post">
                                  <input type="hidden" name="customerID" value="'.$rowy["customer_id"].'">
                                  <input type="hidden" name="subs" value="'.$rowy["id_openpay"].'">
                                  <input type="hidden" name="idPayment" value="'.$rowy["id_payments"].'">
                                  <input type="hidden" name="idExtra" value="'.$rowy["id_extra"].'">
                                  <input type="hidden" name="emailUser" value="'.$rowy["email_user"].'">
                                
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                                  <button type="submit" class="btn btn-success text-white">Cancelar</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>';
                          if(!($rowy["note_fan"]=="")){
                            echo '<p class="card-text">';
                            if($rowy["isPublic_note_fan"]=="1"){
                              echo '<span class="small">Tu nota es publica</span>';
                            }else{
                              echo '<span class="small">Tu nota es privada</span>';
                            }
                            echo '<br>"'.$rowy["note_fan"].'"</p>';  
                          }else{
                            echo '<p class="card-text">Sin nota</p>';
                          }

                          if(!($rowy["question"]=="")){
                            echo '<p class="small"><span class="font-weight-bold">'.$rowy["question"].'</span><br>
                            Tu respuesta: '.$rowy["question_answer"].'
                            </p>';
                          }
                          $date = date_create($rowy["date"]);
                          $mysqltime = date_format($date, 'd-m-Y G:i a');
                          echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
                          
                        echo '</div>
                      </div>';
                      }
                    echo '</div>';
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
?>
<script type="text/javascript">
  activateNavbarItem("navAstronaut");
</script>