<?php
session_start();
if(!isset($_SESSION["uname"])) 
{
	require_once('../admin/header_fan.php');
	$sess = false;
}else{
	$sess = true;
	require_once('../admin/header.php');
}
?>
<div class="site-section bg-primary-light">
	<div class="container d-flex align-items-center flex-column">
		<?php
			if($sess){
				$folder_path = "../".$_SESSION["uname"]."/profile/";
				$uName = $_SESSION["uname"];

				$sqlz = "SELECT id_extra, title, description, confirmation, price FROM extras WHERE id_user='".$_SESSION["user_param"]."' AND active=2";
				$resultz = $conn->query($sqlz);

				if ($resultz->num_rows > 0) {
				// output data of each row
					while($rowz = $resultz->fetch_assoc()) {
						$idExtra = $rowz["id_extra"];
						$titleExtra = $rowz["title"];
						$descriptionExtra = $rowz["description"];
						$confirmationExtra = $rowz["confirmation"];
						$priceExtra = $rowz["price"];
					}
				}
				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alertPaging">
					<strong>Tus fans asi ven tu pagina.</strong> Editala como tu lo necesites.
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>';
				echo '<input type="hidden" value="'.$priceExtra.'" id="hiddenExtra">';
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
					<img class="masthead-avatar mb-2 rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" alt="" />
					<button type="button" class="btn btn-warning p-1 delete-image" data-toggle="modal" data-target="#editarme" style="position:absolute;bottom:50px;right:2px;margin:0;"><i class="fas fa-pencil-alt"></i></button>
				</a>';
			}else{
				foreach(glob('user/'.$_SESSION['email'].'/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
					if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
						echo '<img class="profile-pic" src="'.$file.'" height="80" width="80"/><br>';
					}
				}
			}

			$sql = "SELECT name, last_name, about, creation, extra FROM users WHERE user_name='".$_SESSION["uname"]."'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					$name = $row["name"];
					$lname = $row["last_name"];
					$about = $row["about"];
					$creation = $row["creation"];
					$extra = $row["extra"];
				}
			}

			

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
				echo '<p class="masthead-subheading font-weight-light mb-0">Oye, acabo de crear una página aquí. ¡Ahora puedes invitarme a un café!</p>';
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
    															<input type="number" class="form-control rounded text-center font-weight-bold" width="48" heigth="48" name="qty" id="valueRadioGive" value="1" placeholder="10" required>
															</div>
														</div>
														<?php
															if($sess){
																echo '<button type="button" class="btn btn-warning p-1 float-right" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button>';
															}
														?>
														<div class="row">
															<div class="col-sm-12">
																<button type="button" class="btn btn-success col-sm-12 text-white" data-toggle="modal" data-target="#apoyar">Apoyar <i class="fas fa-dollar-sign"></i> <strong style="font-size:120%;" id=>45</strong></button>
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
												echo '<h3>Fans</h3>';
											?>
										</div>
									</div>
								</div>
								
								<div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
									<div class="row justify-content-center">
									<?php
										if($sess){
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
														if($rowe["subsciption"]=="1"){
															echo '<button class="btn btn-success btn-sm p-1 text-white">Suscribirme <strong>'.$rowe["price"].'</strong></button>';
														}else{
															echo '<button class="btn btn-success btn-sm p-1 text-white">Comprar <strong>'.$rowe["price"].'</strong></button>';
														}
														echo '</div>
												</div>';
											}
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
				echo 'Apoyando a <stong>'.$uName.'</stong>';
			?>
			</h5>
			<p>
				<div class="divider-custom-pay divider-light-pay">
					<div class="divider-custom-line-pay"></div>
						<div class="divider-custom-icon-pay">Pagar con:</div>
						<div class="divider-custom-line-pay"></div>
					</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 p-2"><button type="button" class="btn btn-warning col-sm-12"><i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> Pago seguro</button></div>
						<div class="col-sm-12 p-2"><button type="button" class="btn btn-outline-warning col-sm-12">Paypal</button></div>
					</div>
					
				</div>
			</p>
			<small><i class="fas fa-user-lock"></i> Tus pagos se realizan de forma segura con encriptación de 256 bits.</small>
			
	
		</div>
      
    </div>
  </div>
</div>
<?php
require_once('../admin/footer.php');
?>