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

$sqlu = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description 
    FROM payments as a 
    INNER JOIN users as b on a.email_user=b.email 
    INNER JOIN users as c on c.id_user=a.id_user 
    INNER JOIN extras as d on d.id_extra=a.id_extra 
    WHERE a.status='paid' and d.active=4 and b.id_user=".$userId."
    ORDER BY a.date DESC LIMIT $offset, $limit";

$resultu = $conn->query($sqlu);

$output = "";

if (mysqli_num_rows($resultu) > 0) {

	$output .= '<div class="row justify-content-center">';
	while ($rowu = $resultu->fetch_assoc()) {
        $whatIWant = substr($rowu["description"], strpos($rowu["description"], "|") + 1);
		$date = date_create($rowu["date"]);
		$mysqltime = date_format($date, 'd-m-Y G:i a');
		$output .= '<div class="card border-primary col-md-3 m-1">
        <div class="card-body text-primary">
          <h5 class="card-title">'.$rowu["user_name"].' | '.$whatIWant.' <i class="fas fa-mug-hot"></i></h5>';
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
          $output .= '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
          $output .= '</div>
          </div>';                     
	}
	$output .= '</div>';

	$sqly = "SELECT a.id_payments, a.amount, a.note_fan, a.isPublic_note_fan, a.date, c.user_name, d.title, a.description 
        FROM payments as a 
        INNER JOIN users as b on a.email_user=b.email 
        INNER JOIN users as c on c.id_user=a.id_user 
        INNER JOIN extras as d on d.id_extra=a.id_extra 
        WHERE a.status='paid' and d.active=4 and b.id_user=".$userId."
        ORDER BY a.date DESC";

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
