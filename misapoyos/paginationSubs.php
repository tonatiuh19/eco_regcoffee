<?php
require_once('../admin/cn.php');
date_default_timezone_set('America/Mexico_City');

$limit = 9;

$userId = $_POST['userId'];

if (isset($_POST['page_no'])) {
	$page_no = $_POST['page_no'];
} else {
	$page_no = 1;
}

$offset = ($page_no - 1) * $limit;

$sqlu = "SELECT a.id_payments, a.brand, a.card_number, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, d.id_extra, a.id_openpay, a.email_user, a.description, a.question_answer, d.question, e.id_payments_complete, e.subsciption, a.customer_id, d.subsciption_id 
    FROM payments as a INNER JOIN users as b on a.email_user=b.email 
    INNER JOIN users as c on c.id_user=a.id_user 
    INNER JOIN extras as d on d.id_extra=a.id_extra 
    LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
    WHERE (a.status='completed' or a.status='pending' or a.status='cancelled') and d.active=1 and d.subsciption=1 and b.id_user=".$userId."
    ORDER BY a.date DESC LIMIT $offset, $limit";

$resultu = $conn->query($sqlu);

$output = "";

if (mysqli_num_rows($resultu) > 0) {

	$output .= '<div class="row justify-content-center">';
	while ($rowu = $resultu->fetch_assoc()) {
        $output .= '<div class="card border-primary col-md-4 m-1">
                        <div class="card-body text-primary">
                          <h5 class="card-title">'.$rowu["user_name"].' | '.$rowu["title"].' <i class="fas fa-gifts"></i></h5>
                          ';
                          if($rowu["id_payments_complete"]==null){
                            $output .= '<span class="btn btn-warning">Pendiente a activar</span>';
                          }else{
                            if($rowu['subsciption'] == '1'){
                              $output .= '<button type="button" class="btn btn-danger btn-sm ms-1" data-bs-toggle="modal" data-bs-target="#cancel'.$rowu["id_payments"].'">Cancelar</button>';
                            }else{
                              $output .= '<button type="button" class="btn btn-warning ms-1" data-bs-toggle="modal" data-bs-target="#restart'.$rowu["id_payments"].'">Reiniciar</button>';
                            }
                            
                          }
                          //$output .= '<button type="button" class="btn btn-warning ms-1" data-bs-toggle="modal" data-bs-target="#changeCard'.$rowu["id_payments"].'">Cambiar tarjeta</button>';
                          $output .= '
                            <div class="modal fade" id="cancel'.$rowu["id_payments"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                
                                <div class="modal-body">
                                  <h5>¿Estas seguro?</h5>
                                  <form action="../misapoyos/cancelando/" method="post">
                                    <input type="hidden" name="customerID" value="'.$rowu["customer_id"].'">
                                    <input type="hidden" name="subs" value="'.$rowu["id_openpay"].'">
                                    <input type="hidden" name="idPayment" value="'.$rowu["id_payments"].'">
                                    <input type="hidden" name="idExtra" value="'.$rowu["id_extra"].'">
                                    <input type="hidden" name="emailUser" value="'.$rowu["email_user"].'">
                                  
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-success text-white">Cancelar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>';
                          $output .= '
                            <div class="modal fade" id="restart'.$rowu["id_payments"].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                
                                <div class="modal-body">
                                <h6>Se reiniciara a la ultima tarjeta asociada: ';
                                if($rowu["brand"] == 'american_express'){
                                  $output .= '<i class="fab fa-cc-amex"></i> '.$rowu["card_number"];
                                }else if($rowu["brand"] == 'visa'){
                                  $output .= '<i class="fab fa-cc-visa"></i> '.$rowu["card_number"];
                                }else if($rowu["brand"] == 'mastercard'){
                                  $output .= '<i class="fab fa-cc-mastercard"></i> ;'.$rowu["card_number"];
                                }
                                $output .= '</h6>
                                  
                                  <form action="../misapoyos/reiniciando/" method="post">                                    
                                    <input type="hidden" name="idPayment" value="'.$rowu["id_payments"].'">
                                    
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-success text-white">Reiniciar</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>';
                          if(!($rowu["note_fan"]=="")){
                            $output .= '<p class="card-text">';
                            if($rowu["isPublic_note_fan"]=="1"){
                              $output .= '<span class="small">Tu nota es publica</span>';
                            }else{
                              $output .= '<span class="small">Tu nota es privada</span>';
                            }
                            $output .= '<br>"'.$rowu["note_fan"].'"</p>';  
                          }else{
                            $output .= '<p class="card-text">Sin nota</p>';
                          }

                          if(!($rowu["question"]=="")){
                            $output .= '<p class="small"><span class="font-weight-bold">'.$rowu["question"].'</span><br>
                            Tu respuesta: '.$rowu["question_answer"].'
                            </p>';
                          }
                          $date = date_create($rowu["date"]);
                          $mysqltime = date_format($date, 'd-m-Y G:i a');
                          $output .= '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
                          
                        $output .= '</div>
                      </div>';                 
	}
	$output .= '</div>';

	$sqly = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, d.id_extra, a.id_openpay, a.email_user, a.description, a.question_answer, d.question, e.id_payments_complete, a.customer_id, d.subsciption_id 
        FROM payments as a INNER JOIN users as b on a.email_user=b.email 
        INNER JOIN users as c on c.id_user=a.id_user 
        INNER JOIN extras as d on d.id_extra=a.id_extra 
        LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
        WHERE (a.status='completed' or a.status='pending' or a.status='cancelled') and d.active=1 and d.subsciption=1 and b.id_user=".$userId."";

	$records = $conn->query($sqly);

	$totalRecords = mysqli_num_rows($records);

	$totalPage = ceil($totalRecords / $limit);

	$output .= "<ul class='pagination justify-content-center' style='margin:20px 0'>";

	for ($i = 1; $i <= $totalPage; $i++) {
		if ($i == $page_no) {
			$active = "active";
		} else {
			$active = "";
		}

		$output .= "<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
	}

	$output .= "</ul>";

	echo $output;
} else {
	echo '';
}
