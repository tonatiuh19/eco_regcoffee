<?php
if(!isset($_SESSION)) 
{
	session_start();
}
if(!isset($_SESSION["uname"])) 
{
	$sess = false;
	$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$url = rtrim($actual_link,"/");
	preg_match("/[^\/]+$/", $url, $matches);
	$last_word = $matches[0];
	$uName = $last_word;
	require_once('../admin/header_fan.php');
}else{
	$sess = true;
	$folder_path = "../".$_SESSION["uname"]."/profile/";
	$uName = $_SESSION["uname"];
	
	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertPaging">
		<strong>Tus fans asi ven tu pagina.</strong> Editala como tu lo necesites.
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
	</div>';
	require_once('../admin/header.php');
}
$_SESSION['extra'] = '0';
date_default_timezone_set('America/Mexico_City');
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://js.openpay.mx/openpay.v1.min.js"></script>
  <script type='text/javascript' src="https://js.openpay.mx/openpay-data.v1.min.js"></script>
</head>
<div class="site-section bg-primary-light">
	<div class="container d-flex align-items-center flex-column">
		<?php
			echo '<div class="container bg-light rounded">
					<div class="row">
						<div class="col-lg-7 col-sm-12 col-md-5">';
						echo '<div class="container">
								<div class="row">
									<div class="col-sm-12">';
									$folder_path = "../".$uName."/profile/";
									if (!file_exists($folder_path)) {
											if($sess){
												echo '<a data-toggle="modal" href="#editarme" style="position:relative;">
													<img class="m-4 rounded-circle border-3 border-primary shadow mb-5 bg-white rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" width="200" height="200" alt="" />';
												echo '<button type="button" class="btn btn-warning p-1 delete-image z-depth-2" data-toggle="modal" data-target="#editarme" style="position:absolute;bottom:50px;right:2px;margin:0;"><i class="fas fa-pencil-alt"></i></button>';
												echo '</a>';
											}else{
												echo '<img class="m-4 rounded-circle border-3 border-primary shadow mb-5 bg-white rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" width="200" height="200" alt="" />';
											}
										
									}else{
										foreach(glob('../'.$uName.'/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
											if (preg_match('/(\.jpg|\.jpeg|\.png|\.bmp)$/', $file)) {
													if($sess){
														echo '<a data-toggle="modal" href="#editarme" style="position:relative;">
														<img class="m-4 rounded-circle border-3 border-primary shadow mb-5 bg-white rounded" src="'.$file.'" width="200" height="200" alt="" />';
														echo '<button type="button" class="btn btn-warning p-1 delete-image z-depth-2" data-toggle="modal" data-target="#editarme" style="position:absolute;bottom:50px;right:2px;margin:0;"><i class="fas fa-pencil-alt"></i></button>';
														echo '</a>';
													}else{
														echo '<img class="m-4 rounded-circle border-3 border-primary shadow mb-5 bg-white rounded" src="'.$file.'" width="200" height="200" alt="" />';
													}
											}
										}
									}
									echo '</div>';
									echo '<div class="col-sm-12">';		
										$sqlz = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.price, b.id_user, b.name, b.last_name, b.about, b.creation, b.extra FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=2 AND b.user_name='".$uName."'";
										$resultz = $conn->query($sqlz);

										if ($resultz->num_rows > 0) {
											// output data of each row
											while($rowz = $resultz->fetch_assoc()) {
												$idExtra = $rowz["id_extra"];
												$titleExtra = $rowz["title"];
												$descriptionExtra = $rowz["description"];
												$confirmationExtra = $rowz["confirmation"];
												$priceExtra = $rowz["price"];
												$name = $rowz["name"];
												$lname = $rowz["last_name"];
												$about = $rowz["about"];
												$creation = $rowz["creation"];
												$extra = $rowz["extra"];
												$userID = $rowz["id_user"];
											}
										}
										$mon = trim($priceExtra, '$');
										$mon = str_replace( ',', '', $mon );
										$money = $mon+ 0;
										echo '<input type="hidden" value="'.$money.'" id="hiddenExtra">';
										
										echo '<span class="btn btn-primary mb-2 p-1" style="text-transform: none;"><h2 class="masthead-heading ">'.$uName.'</h2></span>';
										$today = date("Y-m-d H:i:s");
										$sqlh = "INSERT INTO visitors_users (id_user, date)
										VALUES ('$userID', '$today')";

										if ($conn->query($sqlh) === TRUE) {
											//echo "New record created successfully";
										} else {
											echo "Error: " . $sql . "<br>" . $conn->error;
										}							
									echo '</div>';
									echo '<div class="col-sm-12 mb-4">';
										if($sess){
											if($creation == ''){
												echo '<span>Aun no añades tu descripcion <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
											}else{
												echo '<span>'.$creation.' <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
											}
										}else{
											if($creation == ''){
												echo '<span>Creador maravilloso</span>';
											}else{
												echo '<span>'.$creation.'</span>';
											}
											
										}
										echo '<hr>
										';

										if($sess){
											if($about == ''){
												echo '<p class="masthead-subheading font-weight-light mb-0">Escribe que haces, tu pasion, tu dedicacion, etc. <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></p>';
											}else{
												echo '<p class="masthead-subheading font-weight-light mb-0">'.$about.'</p>';
											}
										}else{
											if($about == ''){
												echo '<p class="masthead-subheading font-weight-light mb-0">¡Oye!, acabo de crear una página aquí. ¡Ahora puedes invitarme a un café!</p>';
											}else{
												echo '<p class="masthead-subheading font-weight-light mb-0">'.$about.'</p>';
											}
											
										}
										
									echo '</div>';
									
								echo '</div>
							</div>';
						
						echo '</div>
						<div class="col-lg-5 col-sm-12 col-md-7">'; ?>
							<div class="card mt-5">
								<div class="card-body">
									<?php
									echo '<h6 class="card-title">Apoya a <strong>'.$uName.'</strong> comprandole un cafe o mas</h6>';
									?>
									<form action="../thanks/" method="post">
										<div class="row stock-images d-flex">
											<div class="col-2 h-100 justify-content-center align-items-center">
												<i class="fas fa-mug-hot fa-3x text-primary"></i>
											</div>
											<div class="col-1 center0">
												<i class="fas fa-times"></i>
											</div>
											<div class="col-2"><input id="test0" name="same-group-name" class="radiosImg" type="radio" value="1" checked="checked" />
												<label for="test0">
													<span class="image fa-stack text-dark ">
														<strong class="fa-stack-1x text-white mt-2" style="font-size:180%;">
															1
														</strong>
													</span>
												</label>
											</div>
											<div class="col-2"><input id="test1" name="same-group-name" class="radiosImg" type="radio" value="3" />
												<label for="test1">
													<span class="image fa-stack text-dark ">
														<strong class="fa-stack-1x text-white mt-2" style="font-size:180%;">
															3
														</strong>
													</span>
												</label>
											</div>
											<div class="col-2"><input id="test2" name="same-group-name" class="radiosImg" type="radio" value="5" />
												<label for="test2">
													<span class="image fa-stack text-dark ">
														<strong class="fa-stack-1x text-white mt-2" style="font-size:180%;">
															5
														</strong>
													</span>
												</label>
											</div>
											<div class="col-3 h-100 justify-content-center align-items-center">
												<input type="number" min="1" class="form-control rounded text-center font-weight-bold" width="48" heigth="48" name="qty" id="valueRadioGive" value="1" placeholder="10" required>
											</div>
										</div>
										<?php
										if($sess){
										echo '<button type="button" class="btn btn-warning p-1 float-right" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button>';
										}
										?>
										<div class="row">
											<div class="col-sm-12">
												<?php
												echo '<button type="button" class="btn btn-success col-sm-12 text-white" id="btnPayCoffee" data-toggle="modal" data-target="#apoyar">Apoyar <i class="fas fa-dollar-sign"></i> <strong style="font-size:120%;" id="valueBtnExtra">'.$money.'</strong></button>';
												?>
												<?php
												echo '<script>var btnPay = document.getElementById("btnPayCoffee");
												btnPay.addEventListener("click", function(){
													document.getElementById("titlePay").innerHTML = "Apoyando a <b>'.$uName.'</b>"; 
													document.getElementById("titlePaying").innerHTML = "Apoyando a <b>'.$uName.'</b>"; 
													$("#preguntaSection").hide();
													$("#preguntaSection2").hide();
													document.getElementById("questionAnswer").removeAttribute("required");
													document.getElementById("questionAnswer2").removeAttribute("required");
													document.getElementById("payType").value = "1";
													var prriceCoffee = document.getElementById("valueBtnExtra").innerText;
													document.getElementById("amountCoffe").value = prriceCoffee;
													document.getElementById("amountCoffe2").value = prriceCoffee;
													document.getElementById("id-extra").value = "'.$idExtra.'";
													document.getElementById("id-extra2").value = "'.$idExtra.'";
													document.getElementById("descripcionPay").value = "Coffee for: '.$userID.'";
													document.getElementById("descripcionPay2").value = "Coffee for: '.$userID.'";
												});</script>';
												?>
											</div>
										</div>
									</form>
								</div>
							</div>
						<?php echo '</div>
					</div>
				</div>';
			echo '
			</div>';
		?>
		<p></p>
		<div class="container mt-4">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Recientes</a>
								</li>
								<?php
									$sqle = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.limit_slots, a.price, a.question, a.subsciption, a.subsciption_id FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=1 AND a.active <>2 AND b.user_name='".$uName."' order by a.subsciption desc";
									$sqleTop = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.limit_slots, a.price, a.question, a.subsciption, a.subsciption_id FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=1 AND a.active <>2 AND b.user_name='".$uName."' order by RAND() LIMIT 3";
									$resulte = $conn->query($sqle);
									$resultTop = $conn->query($sqleTop);
									
									if ($resulte->num_rows > 0) {
										echo '<li class="nav-item">
											<a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false"><i class="fas fa-gifts"></i> Extras</a>
										</li>';
									}
								?>
							</ul>
							</div>
							<div class="card-body">
							<div class="tab-content mt-3">
								<div class="tab-pane active" id="description" role="tabpanel">
									<div class="row">
										
										<div class="col-lg-5 col-sm-12 col-md-5">
											<?php
											if ($resulte->num_rows > 0) {
												echo '<div class="container">
													<div class="row">
														<div class="col-sm-12">';
														while($rowTop = $resultTop->fetch_assoc()) {
															$q = 1;
															echo '<div class="card mt-2">
																<div class="card-body">
																	<h5 class="card-title">'.$rowTop["title"].'</h5>';
																	echo '<p class="bg-primary p-1 text-white rounded">'.$rowTop["description"].'</p>';		
																	if($rowTop["subsciption"]=="1"){
																		echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowTop["price"].' al mes</h6>';
																	}else{
																		echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowTop["price"].'</h6>';
																	}												
																	if($rowTop["limit_slots"] != "0"){
																		
																		$sqlp = "SELECT id_payments FROM payments WHERE id_extra=".$rowTop["id_extra"]." and status='completed'";
																		$resultp = $conn->query($sqlp);
				
																		if ($resultp->num_rows > 0) {
																			$p=0;
																			while($rowp = $resultp->fetch_assoc()) {
																				$p++;
																			}
																			$q = $rowTop["limit_slots"] - $p;
																			echo 'Quedan '.$q.'<br>';
																		} else {
																			echo 'Quedan '.$rowTop["limit_slots"].'<br>';
																		}
																		
																	}
																	if($rowTop["subsciption"] == "1"){
																		if($q <= 0){
																			echo '<button class="btn btn-success btn-sm p-1 text-white" disabled>Agotado</button>';
																		}else{
																			echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowTop["id_extra"].'" data-toggle="modal" data-target="#apoyar">Suscribete por <strong>'.$rowTop["price"].'</strong></button>';
																		}
																	}else{
																		if($q <= 0){
																			echo '<button class="btn btn-success btn-sm p-1 text-white" disabled>Agotado</button>';
																		}else{
																			echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowTop["id_extra"].'" data-toggle="modal" data-target="#apoyar">Comprar <strong>'.$rowTop["price"].'</strong></button>';
																		}
																	}
																	
				
																	echo '<script>var btnPay'.$rowTop["id_extra"].' = document.getElementById("btnPayCoffee'.$rowTop["id_extra"].'");
																				btnPay'.$rowTop["id_extra"].'.addEventListener("click", function(){
																				document.getElementById("titlePay").innerHTML = "<b>'.$rowTop["title"].'</b>"; 
																				document.getElementById("titlePaying").innerHTML = "<b>'.$rowTop["title"].'</b>";
																				document.getElementById("amountCoffe").value = "'.$rowTop["price"].'";
																				document.getElementById("amountCoffe2").value = "'.$rowTop["price"].'";
																				document.getElementById("titleExtraval").value = "'.$rowTop["title"].'";
																				document.getElementById("titleExtraval2").value = "'.$rowTop["title"].'";
																				document.getElementById("id-extra").value = "'.$rowTop["id_extra"].'";
																				document.getElementById("id-extra2").value = "'.$rowTop["id_extra"].'";
																				document.getElementById("descripcionPay").value = "'.$rowTop["title"].' from: '.$userID.'";
																				document.getElementById("descripcionPay2").value = "'.$rowTop["title"].' from: '.$userID.'";';
																				
																				if($rowTop["subsciption"] == "1"){
																					echo 'document.getElementById("payType").value = "2";';
																					echo 'document.getElementById("subsid").value = "'.$rowTop["subsciption_id"].'";';
																					echo 'document.getElementById("subsid2").value = "'.$rowTop["subsciption_id"].'";';
																					echo 'document.getElementById("btnPaypalDiv").style.display = "none";';
																				}else{
																					echo 'document.getElementById("payType").value = "1";';
																					echo 'document.getElementById("btnPaypalDiv").style.display = "block";';
																				}
				
																				if($rowTop["question"] == ""){
																					echo '$("#preguntaSection").hide();
																					$("#preguntaSection2").hide();
																					document.getElementById("questionAnswer").removeAttribute("required");
																					document.getElementById("questionAnswer2").removeAttribute("required");';
																				}else{
																					echo '$("#preguntaSection").show();
																					$("#preguntaSection2").show();
																					document.getElementById("questionAnswer").setAttribute("required", "");
																					document.getElementById("questionAnswer2").setAttribute("required", "");
																					document.getElementById("questionLabel").innerHTML = "<b>'.$rowTop["question"].'</b>";
																					document.getElementById("questionLabel2").innerHTML = "<b>'.$rowTop["question"].'</b>";';
																				}
																			echo '});</script>';
																	echo '</div>
															</div>';
														
														}
														echo '</div>
													</div>
												</div>';
											}
											?>
											
											<p></p>
											<div class="container">
												<?php
													$sqlf = "SELECT a.id_users_posts, a.is_deleted, a.text, a.date FROM users_posts as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='".$uName."' AND a.is_deleted=0";
													$resultf = $conn->query($sqlf);
													
													if ($resultf->num_rows > 0) {
														echo '<h3>Posts</h3>';
														echo '<div class="row justify-content-center">';
														while($rowf = $resultf->fetch_assoc()) {
															echo '<div class="card col-sm-12 m-1 p-3">
																	<div class="card-body">
																		
																		<p class="font-italic">'.$rowf["text"].'</p>';
																		$date = date_create($rowf["date"]);
																		$mysqltime = date_format($date, 'd-m-Y G:i a');
																		echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
																		
																	echo '</div>
																</div>';
														}
														echo '</div>';
														if($sess){
															echo '<div class="row justify-content-center p-2">';
															echo '  <a href="../misposts/" class="btn btn-success text-white">Agregar Post</a>';
															echo '</div>';
														}
													} else {
														if($sess){
															echo '<h3>Posts</h3>';
															echo '<div class="card col-12">
															<div class="card-body">
																	<h5 class="card-title">Aun no tienes Posts</h5>
																	<a href="../misposts/" class="btn btn-success text-white">Agregar Post</a>
																</div>
															</div>';
														}
													}
												?>	
											</div>
										</div>
										<div class="col-lg-7 col-sm-12 col-md-7">
											<?php
												$sqlk = "SELECT a.note_fan, a.date FROM payments as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='".$uName."' AND a.status='completed'";
												$resultk = $conn->query($sqlk);

												if ($resultk->num_rows > 0) {
													$fansCount = 0;
													while($rowk = $resultk->fetch_assoc()) {
														$fansCount++;
													}
													echo '<h3>Fans</h3>';
													echo '<span class="small"><i class="fas fa-users"></i> '.$fansCount.'</span>';
												} else {
													echo '<h3>Fans</h3>';

												}
												echo '<p id="imageLoading"><i class="fas fa-spinner fa-spin fa-2x"></i></p><script>
												$(document).ready(function() {
												  $("#imageLoading").hide();
												});
												</script>';
												
											
												echo '<div id="table-data"></div>';
												echo '<script type="text/javascript">
												 $(document).ready(function(){
												   function loadData(page){
													 $.ajax({
													   url  : "../comolovemifan/pagination.php",
													   type : "POST",
													   cache: false,
													   data : {page_no:page, username:"'.$uName.'"},
													   beforeSend: function(){
														$("#imageLoading").show();
														},
														complete: function(){
															$("#imageLoading").hide();
														},
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
											?>
											
										</div>
									</div>
								</div>
								
								<div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
									<div class="row justify-content-center">
									<?php	
										
										//$sqle = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.limit_slots, a.price, a.question, a.subsciption FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=1 AND a.active <>2 AND b.user_name='".$uName."'";									
										while($rowe = $resulte->fetch_assoc()) {
											$q = 1;
											echo '<div class="card col-sm-3 m-1 p-3">
												<div class="card-body">
													<h5 class="card-title">'.$rowe["title"].'</h5>';
													echo '<p class="bg-primary p-1 text-white rounded">'.$rowe["description"].'</p>';		
													if($rowe["subsciption"]=="1"){
														echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowe["price"].' al mes</h6>';
													}else{
														echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowe["price"].'</h6>';
													}												
													if($rowe["limit_slots"] != "0"){
														
														$sqlg = "SELECT id_payments FROM payments WHERE id_extra=".$rowe["id_extra"]." and status='completed'";
														$resultg = $conn->query($sqlg);

														if ($resultg->num_rows > 0) {
															$x=0;
															while($rowg = $resultg->fetch_assoc()) {
																$x++;
															}
															$q = $rowe["limit_slots"] - $x;
															echo 'Quedan '.$q.'<br>';
														} else {
															echo 'Quedan '.$rowe["limit_slots"].'<br>';
														}
														
													}
													if($rowe["subsciption"] == "1"){
														if($q <= 0){
															echo '<button class="btn btn-success btn-sm p-1 text-white" disabled>Agotado</button>';
														}else{
															echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowe["id_extra"].'" data-toggle="modal" data-target="#apoyar">Suscribete por <strong>'.$rowe["price"].'</strong></button>';
														}
													}else{
														if($q <= 0){
															echo '<button class="btn btn-success btn-sm p-1 text-white" disabled>Agotado</button>';
														}else{
															echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowe["id_extra"].'" data-toggle="modal" data-target="#apoyar">Comprar <strong>'.$rowe["price"].'</strong></button>';
														}
													}
													

													echo '<script>var btnPay'.$rowe["id_extra"].' = document.getElementById("btnPayCoffee'.$rowe["id_extra"].'");
																btnPay'.$rowe["id_extra"].'.addEventListener("click", function(){
																document.getElementById("titlePay").innerHTML = "<b>'.$rowe["title"].'</b>"; 
																document.getElementById("titlePaying").innerHTML = "<b>'.$rowe["title"].'</b>";
																document.getElementById("amountCoffe").value = "'.$rowe["price"].'";
																document.getElementById("amountCoffe2").value = "'.$rowe["price"].'";
																document.getElementById("titleExtraval").value = "'.$rowe["title"].'";
																document.getElementById("titleExtraval2").value = "'.$rowe["title"].'";
																document.getElementById("id-extra").value = "'.$rowe["id_extra"].'";
																document.getElementById("id-extra2").value = "'.$rowe["id_extra"].'";
																document.getElementById("descripcionPay").value = "'.$rowe["title"].' from: '.$userID.'";
																document.getElementById("descripcionPay2").value = "'.$rowe["title"].' from: '.$userID.'";';
																
																if($rowe["subsciption"] == "1"){
																	echo 'document.getElementById("payType").value = "2";';
																	echo 'document.getElementById("subsid").value = "'.$rowe["subsciption_id"].'";';
																	echo 'document.getElementById("subsid2").value = "'.$rowe["subsciption_id"].'";';
																	echo 'document.getElementById("btnPaypalDiv").style.display = "none";';
																}else{
																	echo 'document.getElementById("payType").value = "1";';
																	echo 'document.getElementById("btnPaypalDiv").style.display = "block";';
																}

																if($rowe["question"] == ""){
																	echo '$("#preguntaSection").hide();
																	$("#preguntaSection2").hide();
																	document.getElementById("questionAnswer").removeAttribute("required");
																	document.getElementById("questionAnswer2").removeAttribute("required");';
																}else{
																	echo '$("#preguntaSection").show();
																	$("#preguntaSection2").show();
																	document.getElementById("questionAnswer").setAttribute("required", "");
																	document.getElementById("questionAnswer2").setAttribute("required", "");
																	document.getElementById("questionLabel").innerHTML = "<b>'.$rowe["question"].'</b>";
																	document.getElementById("questionLabel2").innerHTML = "<b>'.$rowe["question"].'</b>";';
																}
															echo '});</script>';
													echo '</div>
											</div>';
										
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
	</div>
</div>
<div class="modal fade" id="editarme" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar mi Pagina</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
	  	<form class="needs-validation" method="post" action="../misextras/saveExtraCoffee/" enctype="multipart/form-data">
			<p>
				<?php
					$folder_path = "../".$uName."/profile/";
					if (!file_exists($folder_path)) {
						echo '<img src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" width="120" id="preview" class="img-thumbnail rounded">';
					}else{
						foreach(glob('../'.$uName.'/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
							if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
								echo '<img src="'.$file.'" id="preview" class="img-thumbnail" width="120">';
							}
						}
					}
				?>
				<input type="file" class="file" name="fileToUpload" accept="image/jpeg, image/png">
				<div class="input-group my-3">
					<input type="text" class="form-control" disabled placeholder="Upload File" id="file">
					<div class="input-group-append">
						<button type="button" class="browse btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Editar foto</button>
					</div>
				</div>
			</p>
		  	<div class="form-group">
				<label for="exampleFormControlTextarea1"><b>Tu descripcion personal:</b></label>
				<?php
					if($creation == ''){
						echo '<textarea class="form-control" id="exampleFormControlTextarea1" name="creation" rows="3" required>Creador maravilloso</textarea>';
					}else{
						echo "aqui";
						echo '<textarea class="form-control" id="exampleFormControlTextarea1" name="creation" rows="3" required>'.$creation.'</textarea>';
					}
					
				?>
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1"><b>Escribe que haces, tu pasion, tu dedicacion:</b></label>
				<?php
					if($about == ''){
						echo '<textarea class="form-control" id="exampleFormControlTextarea1" name="description_ex" rows="2" required>¡Oye!, acabo de crear una página aquí. ¡Ahora puedes invitarme a un café!</textarea>';
					}else{
						echo '<textarea class="form-control" id="exampleFormControlTextarea1" name="description_ex" rows="2" required>'.$about.'</textarea>';
					}
				?>
			</div>
			<div class="form-group">
				<label for="exampleFormControlInput1"><b>Precio de tu cafe:</b></label>
				<?php
					echo '<input type="textbox" class="form-control currency" id="exampleFormControlInput1" name="price_ex" style="text-align:center;" value="'.$priceExtra.'" required>';
				?>				
			</div>
			<div class="form-group">
				<label for="exampleFormControlTextarea1"><b>Este mensaje le llegara a tu fan una vez haya pagado uno o varios cafes:</b></label>
				<?php
					echo '<textarea class="form-control" id="exampleFormControlTextarea1" name="confirmation_ex" rows="2" required>'.$confirmationExtra.'</textarea>
					<input type="hidden" name="extra_edit" value="'.$idExtra.'">';
				?>
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success text-white"><i class="fas fa-magic"></i> Actualizar</button>
		</form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="apoyar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
		<div class="modal-body text-center">
			
			<h5 class="modal-title w-100" id="exampleModalLongTitle"><img class="masthead-avatar-pay mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" /><br>
			<?php
				echo '<span id="titlePay"></span>';
			?>
			</h5>
			<p>
				<div class="form-group">
					<input type="email" class="form-control" id="inputMailFan1" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
					<small id="emailHelp" class="form-text text-muted">Aqui te llegara tu confirmacion de pago y un mensaje especial.</small>
				</div>
				<div class="form-group">
					<textarea class="form-control" id="inputTextFan1" rows="2" placeholder="Aqui puedes escribirle algo.. (opcional)"></textarea>
					<div class="form-check form-check-inline small">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked>
						<label class="form-check-label" for="inlineRadio1">Publico</label>
					</div>
					<div class="form-check form-check-inline small">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
						<label class="form-check-label" for="inlineRadio2">Privado</label>
					</div>
				</div>
				
				<div class="divider-custom-pay divider-light-pay">
					<div class="divider-custom-line-pay"></div>
						<div class="divider-custom-icon-pay">Pagar con:</div>
						<div class="divider-custom-line-pay"></div>
					</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 p-2"><button type="button" class="btn btn-warning col-sm-12" id="btnPayCreditDebit"><i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> Pago seguro</button></div>
						<div class="col-sm-12 p-2" id="btnPaypalDiv"><button class="btn btn-warning col-sm-12" id="btnPaypal"><img src="../images/paypal.png" width="100"></button></div>
					</div>
					
				</div>
			</p>
			<small><i class="fas fa-user-lock"></i> Tus pagos se realizan de forma segura con encriptación de 256 bits.</small>
			
	
		</div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="apoyarSiguiente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
		<div class="modal-body text-center">
			
			<h5 class="modal-title w-100" id="exampleModalLongTitle"><img class="masthead-avatar-pay mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" /><br>
			<?php
				echo '<span id="titlePaying"></span>';
			?>
			</h5>
			<p>
				<form action="../pagando/" method="POST" id="payment-form" novalidate="">
					<input type="hidden" name="token_id" id="token_id">
					<input type="hidden" name="payType" value="1" id="payType">
					<input type="hidden" name="coffeeQuantity" value="1" id="quantityCoffe">
					<input type="hidden" name="amount" value="0" id="amountCoffe">
					<input type="hidden" name="descripcion" value="0" id="descripcionPay">
					<input type="hidden" name="id-extra" value="0" id="id-extra">
					<input type="hidden" name="subsid" value="0" id="subsid">
					<input type="hidden" name="titleExtra" value="0" id="titleExtraval">
					<input type="hidden" name="isPaypal" value="0" id="isPaypal">
					<?php
						echo '<input type="hidden" name="confirmationM" value="'.$confirmationExtra.'">';
						echo '<input type="hidden" name="uname" value="'.$uName.'" id="unamePay">';						
						echo '';
					?>
					<div class="form-group">
						<input type="email" class="form-control" id="inputMailFan2" name="email" aria-describedby="emailHelp" placeholder="Inresa tu correo" required>
						<small id="emailHelp" class="form-text text-muted">Aqui te llegara tu confirmacion de pago y un mensaje especial.</small>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="inputTextFan2" name="noteFan" rows="2" placeholder="Aqui puedes escribirle algo.. (opcional)"></textarea>
						<div class="form-check form-check-inline small">
							<input class="form-check-input" type="radio" name="privatePublic" id="inlineRadio12" value="1" checked>
							<label class="form-check-label" for="inlineRadio1">Publico</label>
						</div>
						<div class="form-check form-check-inline small">
							<input class="form-check-input" type="radio" name="privatePublic" id="inlineRadio22" value="0">
							<label class="form-check-label" for="inlineRadio2">Privado</label>
						</div>
					</div>
					<div class="form-group" id="preguntaSection">
						<label for="exampleFormControlTextarea1" id="questionLabel">Example textarea</label>
						<textarea class="form-control" id="questionAnswer" name="questAnswer" rows="2" placeholder="Aqui tu respuesta" name="questionAnswer" required></textarea>
					</div>
					<div class="divider-custom-pay divider-light-pay">
						<div class="divider-custom-line-pay"></div>
							<div class="divider-custom-icon-pay">Pagar con:</div>
							<div class="divider-custom-line-pay"></div>
						</div>
					<div class="container">
						<p class="alert alert-danger p-1 small" id="alertBank">Some text success or error</p>
						<p class="alert alert-danger p-1 small invalid-feedback" id="alertBank_form">Completa todos los campos</p>
						<div class="form-group">
							<input type="text" placeholder="Nombre en tarjeta" name="holder_name" autocomplete="off" data-openpay-card="holder_name" required class="form-control">
						</div>
						<div class="form-group">
							<div class="input-group">
							<input type="text" autocomplete="off" data-openpay-card="card_number" name="card_number" placeholder="Numero de tarjeta" class="form-control" required>
							<div class="input-group-append">
								<span class="input-group-text text-muted">
									<i class="fab fa-cc-visa mx-1"></i>
									<i class="fab fa-cc-mastercard mx-1"></i>
									<i class="fab fa-cc-amex mx-1"></i>
								</span>
							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-8">
							<div class="form-group">
								<label><span class="hidden-xs">Expiración</span></label>
								<div class="input-group">
								<input type="number" placeholder="MM" name="expiration_month" max="12" data-openpay-card="expiration_month" class="form-control" required>
								<input type="number" placeholder="YY" name="expiration_year" min="20" max="30" data-openpay-card="expiration_year" class="form-control" required>
								</div>
							</div>
							</div>
							<div class="col-sm-4">
							<div class="form-group mb-4">
								<label data-toggle="tooltip" title="Código de tres dígitos en el reverso de tu tarjeta">CVV
															<i class="fa fa-question-circle"></i>
														</label>
								<input type="text" required autocomplete="off" data-openpay-card="cvv2" name="cvv2" class="form-control">
							</div>
							</div>
						</div>
						<button class="btn btn-warning btn-block shadow-sm" id="pay-button" type="submit"><span id="endLabelPay"><i class="fas fa-lock"></i> Finalizar</span><span id="endLabelPaying"><i class="fas fa-spinner fa-pulse"></i> Pagando</span></button>
					</div>
				</form>
				<form action="../pagandoPaypal/" method="POST" id="payment-form-paypal" class="needs-validation" novalidate>
					<input type="hidden" name="payType" value="3" id="payType2">
					<input type="hidden" name="coffeeQuantity" value="1" id="quantityCoffe2">
					<input type="hidden" name="amount" value="0" id="amountCoffe2">
					<input type="hidden" name="descripcion" value="0" id="descripcionPay2">
					<input type="hidden" name="id-extra" value="0" id="id-extra2">
					<input type="hidden" name="subsid" value="0" id="subsid2">
					<input type="hidden" name="titleExtra" value="0" id="titleExtraval2">
					<input type="hidden" name="isPaypal" value="0" id="isPaypal2">
					<?php
						echo '<input type="hidden" name="confirmationM" value="'.$confirmationExtra.'">';
						echo '<input type="hidden" name="uname" value="'.$uName.'" id="unamePay2">';						
						echo '';
					?>
					<div class="form-group">
						<input type="email" class="form-control" id="inputMailFan2" name="email" aria-describedby="emailHelp" placeholder="Inresa tu correo" required>
						<small id="emailHelp" class="form-text text-muted">Aqui te llegara tu confirmacion de pago y un mensaje especial.</small>
					</div>
					<div class="form-group">
						<textarea class="form-control" id="inputTextFan2" name="noteFan" rows="2" placeholder="Aqui puedes escribirle algo.. (opcional)"></textarea>
						<div class="form-check form-check-inline small">
							<input class="form-check-input" type="radio" name="privatePublic" id="inlineRadio12" value="1" checked>
							<label class="form-check-label" for="inlineRadio1">Publico</label>
						</div>
						<div class="form-check form-check-inline small">
							<input class="form-check-input" type="radio" name="privatePublic" id="inlineRadio22" value="0">
							<label class="form-check-label" for="inlineRadio2">Privado</label>
						</div>
					</div>
					<div class="form-group" id="preguntaSection2">
						<label for="exampleFormControlTextarea1" id="questionLabel2">Example textarea</label>
						<textarea class="form-control" id="questionAnswer2" name="questAnswer" rows="2" placeholder="Aqui tu respuesta" name="questionAnswer" required></textarea>
					</div>
					<div class="divider-custom-pay divider-light-pay">
						<div class="divider-custom-line-pay"></div>
							<div class="divider-custom-icon-pay">Pagar con:</div>
							<div class="divider-custom-line-pay"></div>
						</div>
					<div class="container">
						<button class="btn btn-warning col-sm-12" type="submit"><img src="../images/paypal.png" width="100"></button>
					</div>
				</form>
			</p>
			<small><i class="fas fa-user-lock"></i> Tus pagos se realizan de forma segura con encriptación de 256 bits.</small>
		</div>
    </div>
  </div>
</div>
<?php
require_once('../admin/footer.php');
?>
<script type="text/javascript">
  activateNavbarItem("navPagina");
</script>