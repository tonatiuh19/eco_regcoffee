<?php
	require_once('../admin/cn.php');
	date_default_timezone_set('America/Mexico_City');

    $limit = 10;
    
	$uName = $_POST['username'];

	if (isset($_POST['page_no'])) {
	    $page_no = $_POST['page_no'];
	}else{
	    $page_no = 1;
	}

	$offset = ($page_no-1) * $limit;

	$sqlu = "SELECT a.note_fan, a.date FROM payments as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='".$uName."' AND a.status='completed' AND a.isPublic_note_fan=1 AND a.note_fan<>'' LIMIT $offset, $limit";

	$resultu = $conn->query($sqlu);

	$output = "";

	if (mysqli_num_rows($resultu) > 0) {

	$output.='<div>';
        while ($rowu = $resultu->fetch_assoc()) {

            /*$output.="<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['age']}</td>
            </tr>";*/
            $date = date_create($rowu["date"]);
            $mysqltime = date_format($date, 'd-m-Y G:i a');
            $output.='
					<span className="fst-italic">'.$rowu["note_fan"].'</span>
			<p className="fw-light mb-1">
			<i class="fas fa-calendar-alt"></i>'.$mysqltime.'
			</p>';
        } 
	$output.='</div>';

	$sqly = "SELECT a.note_fan, a.date FROM payments as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='".$uName."' AND a.status='completed' AND a.isPublic_note_fan=1 AND a.note_fan<>'' order by a.date desc";

    $records = $conn->query($sqly);

	$totalRecords = mysqli_num_rows($records);

	$totalPage = ceil($totalRecords/$limit);

	$output.="<ul class='pagination justify-content-center' style='margin:20px 0'>";

	for ($i=1; $i <= $totalPage ; $i++) { 
	   if ($i == $page_no) {
		$active = "active";
	   }else{
		$active = "";
	   }

	    $output.="<li class='page-item $active'><a class='page-link' id='$i' href=''>$i</a></li>";
	}

	$output .= "</ul>";

	echo $output;

	}else{
        echo '$uName';
    }
