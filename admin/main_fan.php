<?php
if(!isset($_SESSION)) 
{
	session_start();
}
if(!isset($_SESSION["uname"])) 
{
	require_once('../admin/header_fan.php');
	$sess = false;
}else{
	$sess = true;
	require_once('../admin/header.php');
}
$_SESSION['extra'] = '0';
?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://js.openpay.mx/openpay.v1.min.js"></script>
  <script type='text/javascript' src="https://js.openpay.mx/openpay-data.v1.min.js"></script>
</head>
<div class="site-section bg-primary-light">
	<div class="container d-flex align-items-center flex-column">
		<?php
			if($sess){
				$folder_path = "../".$_SESSION["uname"]."/profile/";
				$uName = $_SESSION["uname"];

				
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertPaging">
					<strong>Tus fans asi ven tu pagina.</strong> Editala como tu lo necesites.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>';
				
			}else{
				$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$url = rtrim($actual_link,"/");
				preg_match("/[^\/]+$/", $url, $matches);
				$last_word = $matches[0];
				$uName = $last_word;
			}

			$folder_path = "../".$uName."/profile/";
			if (!file_exists($folder_path)) {
				echo '<a data-toggle="modal" href="#editarme" style="position:relative;">
					<img class="masthead-avatar mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" />';
					if($sess){
						echo '<button type="button" class="btn btn-warning p-1 delete-image" data-toggle="modal" data-target="#editarme" style="position:absolute;bottom:50px;right:2px;margin:0;"><i class="fas fa-pencil-alt"></i></button>';
					}
				echo '</a>';
			}else{
				foreach(glob('user/'.$_SESSION['email'].'/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
					if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
						echo '<img class="profile-pic" src="'.$file.'" height="80" width="80"/><br>';
					}
				}
			}
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
			echo '<input type="hidden" value="'.$priceExtra.'" id="hiddenExtra">';
			
			echo '<h1 class="masthead-heading mb-0">'.$uName.'</h1>';
			if($sess){
				if($creation == ''){
					echo '<span>Aun no añades tu descripcion <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
				}else{
					echo '<span>'.$creation.' <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
				}
			}else{
				echo '<span>Creador maravilloso</span>';
			}
			
			echo '<div class="divider-custom divider-light">
				<div class="divider-custom-line"></div>
					<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
					<div class="divider-custom-line"></div>
				</div>
			';
			if($sess){
				if($about == ''){
					echo '<p class="masthead-subheading font-weight-light mb-0">Escribe que haces, tu pasion, tu dedicacion, etc. <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></p>';
				}else{
					echo '<p class="masthead-subheading font-weight-light mb-0">'.$about.'</p>';
				}
			}else{
				echo '<p class="masthead-subheading font-weight-light mb-0">¡Oye!, acabo de crear una página aquí. ¡Ahora puedes invitarme a un café!</p>';
			}
			
			echo '
			</div>';
		
		?>
		<p></p>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<ul class="nav nav-tabs card-header-tabs" id="bologna-list" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" href="#description" role="tab" aria-controls="description" aria-selected="true">Recientes</a>
								</li>
								<?php
									$sqle = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.limit_slots, a.price, a.question, a.subsciption FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=1 AND a.active <>2 AND b.user_name='".$uName."'";
									$resulte = $conn->query($sqle);
									
									if ($resulte->num_rows > 0) {
										echo '<li class="nav-item">
											<a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Extras</a>
										</li>';
									}
								?>
							</ul>
							</div>
							<div class="card-body">
							<div class="tab-content mt-3">
								<div class="tab-pane active" id="description" role="tabpanel">
									<div class="row">
										
										<div class="col-sm-5">
											<div class="card">
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
															<div class="col-2"><input id="test0" name="same-group-name" class="radiosImg" type="radio" value="1" checked="checked" /><label for="test0">
																<span class="image fa-stack text-dark ">
																	<strong class="fa-stack-1x text-white mt-2" style="font-size:180%;">
																		1
																	</strong>
																</span>
																</label>
															</div>
															<div class="col-2"><input id="test1" name="same-group-name" class="radiosImg" type="radio" value="3" /><label for="test1">
																<span class="image fa-stack text-dark ">
																	<strong class="fa-stack-1x text-white mt-2" style="font-size:180%;">
																		3
																	</strong>
																</span>
																</label>
															</div>
															<div class="col-2"><input id="test2" name="same-group-name" class="radiosImg" type="radio" value="5" /><label for="test2">
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
																<button type="button" class="btn btn-success col-sm-12 text-white" id="btnPayCoffee" data-toggle="modal" data-target="#apoyar">Apoyar <i class="fas fa-dollar-sign"></i> <strong style="font-size:120%;" id="valueBtnExtra">45</strong></button>
																<?php
																	echo '<script>var btnPay = document.getElementById("btnPayCoffee");
																	btnPay.addEventListener("click", function(){
																	   document.getElementById("titlePay").innerHTML = "Apoyando a <b>'.$uName.'</b>"; 
																	   document.getElementById("titlePaying").innerHTML = "Apoyando a <b>'.$uName.'</b>"; 
																	   $("#preguntaSection").hide();
																		document.getElementById("questionAnswer").removeAttribute("required");
																		document.getElementById("payType").value = "1";
																		var prriceCoffee = document.getElementById("valueBtnExtra").innerText;
																		document.getElementById("amountCoffe").value = prriceCoffee;
																		document.getElementById("id-extra").value = "'.$idExtra.'";
																		document.getElementById("descripcionPay").value = "Coffee for: '.$userID.'";
																	});</script>';
																?>
															</div>
														</div>
													</form>
													
												</div>
											</div>
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
										<div class="col-sm-7">
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
												
												$sqlu = "SELECT a.note_fan, a.date FROM payments as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='".$uName."' AND a.status='completed' AND a.isPublic_note_fan=1 AND a.note_fan<>'' ";
												$resultu = $conn->query($sqlu);

												if ($resultu->num_rows > 0) {
												// output data of each row
													echo '<div class="row justify-content-center">';
													while($rowu = $resultu->fetch_assoc()) {
														echo '<div class="card col-sm-12 m-1 p-3 bg-light">
																	<div class="card-body">
																		
																		<p class="font-weight-bold">'.$rowu["note_fan"].'</p>';
																		$date = date_create($rowu["date"]);
																		$mysqltime = date_format($date, 'd-m-Y G:i a');
																		echo '<p class="small"><i class="fas fa-calendar-alt"></i> '.$mysqltime.'</p>';
																		
																	echo '</div>
																</div>';
													}
													echo '</div>';
												} else {
													echo "0 results";
												}
											?>
											
										</div>
									</div>
								</div>
								
								<div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
									<div class="row justify-content-center">
									<?php	
										//$sqle = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.limit_slots, a.price, a.question, a.subsciption FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=1 AND a.active <>2 AND b.user_name='".$uName."'";									
										while($rowe = $resulte->fetch_assoc()) {
											echo '<div class="card col-sm-3 m-1 p-3">
												<div class="card-body">
													<h5 class="card-title">'.$rowe["title"].'</h5>';
													echo '<p class="font-italic bg-dark p-1 text-white rounded">'.$rowe["description"].'</p>';		
													if($rowe["subsciption"]=="1"){
														echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowe["price"].' al mes</h6>';
													}else{
														echo '<h6 class="card-subtitle mb-2 text-muted">Por solo: '.$rowe["price"].'</h6>';
													}												
														
													echo 'Quedan '.$rowe["limit_slots"].' lugares';
													if($rowe["subsciption"] == "1"){
														echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowe["id_extra"].'" data-toggle="modal" data-target="#apoyar">Suscribete por <strong>'.$rowe["price"].'</strong></button>';
													}else{
														echo '<button class="btn btn-success btn-sm p-1 text-white" id="btnPayCoffee'.$rowe["id_extra"].'" data-toggle="modal" data-target="#apoyar">Comprar <strong>'.$rowe["price"].'</strong></button>';
													}
													

													echo '<script>var btnPay'.$rowe["id_extra"].' = document.getElementById("btnPayCoffee'.$rowe["id_extra"].'");
																btnPay'.$rowe["id_extra"].'.addEventListener("click", function(){
																document.getElementById("titlePay").innerHTML = "<b>'.$rowe["title"].'</b>"; 
																document.getElementById("titlePaying").innerHTML = "<b>'.$rowe["title"].'</b>";
																document.getElementById("amountCoffe").value = "'.$rowe["price"].'";
																document.getElementById("id-extra").value = "'.$rowe["id_extra"].'";
																document.getElementById("descripcionPay").value = "'.$rowe["title"].' from: '.$userID.'";';
																if($rowe["subsciption"] == "1"){
																	echo 'document.getElementById("payType").value = "2";';
																}else{
																	echo 'document.getElementById("payType").value = "1";';
																}

																if($rowe["question"] == ""){
																	echo '$("#preguntaSection").hide();
																	document.getElementById("questionAnswer").removeAttribute("required");';
																}else{
																	echo '$("#preguntaSection").show();
																	document.getElementById("questionAnswer").setAttribute("required", "");
																	document.getElementById("questionLabel").innerHTML = "<b>'.$rowe["question"].'</b>";';
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
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
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
						<!--<div class="col-sm-12 p-2"><button type="button" class="btn btn-outline-warning col-sm-12">Paypal</button></div>-->
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
					<?php
						echo '';
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
							<input type="text" placeholder="Nombre en tarjeta" autocomplete="off" data-openpay-card="holder_name" required class="form-control">
						</div>
						<div class="form-group">
							<div class="input-group">
							<input type="text" autocomplete="off" data-openpay-card="card_number" placeholder="Numero de tarjeta" class="form-control" required>
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
								<input type="number" placeholder="MM" max="12" data-openpay-card="expiration_month" class="form-control" required>
								<input type="number" placeholder="YY" min="20" max="30" data-openpay-card="expiration_year" class="form-control" required>
								</div>
							</div>
							</div>
							<div class="col-sm-4">
							<div class="form-group mb-4">
								<label data-toggle="tooltip" title="Código de tres dígitos en el reverso de tu tarjeta">CVV
															<i class="fa fa-question-circle"></i>
														</label>
								<input type="text" required autocomplete="off" data-openpay-card="cvv2" class="form-control">
							</div>
							</div>
						</div>
						<button class="btn btn-warning btn-block shadow-sm" id="pay-button" type="submit"><span id="endLabelPay"><i class="fas fa-lock"></i> Finalizar</span><span id="endLabelPaying"><i class="fas fa-spinner fa-pulse"></i> Pagando</span></button>
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
