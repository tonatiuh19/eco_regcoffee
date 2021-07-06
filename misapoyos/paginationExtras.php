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

$sqlu = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description, a.question_answer, d.question, e.id_payments_complete 
  FROM payments as a 
  INNER JOIN users as b on a.email_user=b.email 
  INNER JOIN users as c on c.id_user=a.id_user 
  INNER JOIN extras as d on d.id_extra=a.id_extra 
  LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
  WHERE a.status='completed' and d.active=1 and d.subsciption=0 and b.id_user=".$userId."
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
                                $output .= '<span class="btn btn-warning p-1">Pendiente</span>';
                              }else{
                                $output .= '<span class="btn btn-success text-white p-1">Completo</span>';
                              }
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

	$sqly = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description, a.question_answer, d.question, e.id_payments_complete 
  FROM payments as a 
  INNER JOIN users as b on a.email_user=b.email 
  INNER JOIN users as c on c.id_user=a.id_user 
  INNER JOIN extras as d on d.id_extra=a.id_extra 
  LEFT JOIN payments_complete as e on e.id_payments=a.id_payments 
  WHERE a.status='completed' and d.active=1 and d.subsciption=0 and b.id_user=".$userId."";

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
