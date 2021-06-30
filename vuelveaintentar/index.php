<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">
<link href="../css/fontawesome/css/all.css" rel="stylesheet">
<?php
require_once('../admin/cn.php');
if(!isset($_GET['order']) || $_GET['order']=='') {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
		window.location.href='../';
		</SCRIPT>");
}else{
	$sql = "SELECT a.id_payments, a.id_user, a.id_extra, a.email_user, a.id_paypal, a.amount, a.description, b.user_name, c.confirmation,  
	(
	   CASE WHEN EXISTS(SELECT NULL FROM users WHERE a.email_user=users.email)
		  THEN a.email_user 
		  ELSE 0
	   END 
	  )AS userToPay
	FROM payments as a
	INNER JOIN users as b on a.id_user=b.id_user
	INNER JOIN extras as c on c.id_extra=a.id_extra
	WHERE a.id_payments=".$_GET['order']."";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$whatIWant = substr($row["description"], strpos($row["description"], "|") + 1);
			echo '<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body text-center">
				
					<h4 class="modal-title w-100" id="exampleModalLongTitle"><i class="fas fa-sad-tear fa-3x text-danger mb-2"></i><br><b>Algo salio mal</b></h4>
					<p>Tu pago no ha sido procesado correctamente. No se tienen los fondos suficientes o hubo un problema de red.</p>
					
					<a href="../' . $row["user_name"] . '" class="btn btn-dark"><i class="fas fa-arrow-circle-left"></i> Prueba de nuevo</a>
					
					</div>
				</div>
				</div>
			</div>';
		}
	} else {
		echo "0 results";
	}
}
?>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script>
  $('#exampleModalCenter').modal({
    backdrop: 'static',
    keyboard: false
  });
</script>