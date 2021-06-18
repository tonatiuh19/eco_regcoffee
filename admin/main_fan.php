<?php
if (!isset($_SESSION)) {
	session_start();
}

$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = rtrim($actual_link, "/");
preg_match("/[^\/]+$/", $url, $matches);
$last_word = $matches[0];
$uName = $last_word;

if ($_SESSION["uname"] != $uName) {
	$sess = false;
} else {
	$sess = true;
}

require_once('admin/header.php');
$_SESSION['extra'] = '0';
date_default_timezone_set('America/Mexico_City');

$sqlz = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.price, b.id_user, b.name, b.last_name, b.about, b.creation, b.extra FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE a.active=4 AND b.user_name='" . $uName . "'";
$resultz = $conn->query($sqlz);

if ($resultz->num_rows > 0) {
	// output data of each row
	while ($rowz = $resultz->fetch_assoc()) {
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
$money = number_format((float)$priceExtra, 2, '.', '');

echo '<input type="hidden" value="' . $money . '" id="hiddenExtra">';

?>
<link rel="stylesheet" href="comolovemifan/css/Main.css">
<link rel="stylesheet" href="comolovemifan/css/usernameAnimation.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://js.openpay.mx/openpay.v1.min.js"></script>
<script type='text/javascript' src="https://js.openpay.mx/openpay-data.v1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>

<div class="site-section bg-primary-light">

	<div class="bg-light">
		<div class="container h-100">
			<div class="row py-5">
				<?php
				if ($sess) {
					echo '<div class="col-sm-12">
						<div class="float-end">
							<button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarme"><i class="fas fa-pencil-alt"></i> Editar pagina</button>
						</div>
						</div>';
				}
				?>

				<div class="col-sm-7">
					<div class="container">
						<div class="row text-center">
							<div class="col-sm-12">
								<?php
								$folder_path = "data/" . $userID . "/profile/";
								if (!file_exists($folder_path)) {
									echo '<img src="https://freesvg.org/img/abstract-user-flat-4.png" class="img-thumbnail bg-light" width="200" />';
								} else {
									foreach (glob('data/' . $userID . '/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
										if (preg_match('/(\.jpg|\.jpeg|\.png|\.bmp)$/', $file)) {
											echo '<img src="' . $file . '" class="img-thumbnail bg-light" width="200" />';
										}
									}
								}
								?>

							</div>
						</div>
						<div class="row text-center">
							<div class="col-sm-12 ">
								<div class="container-animation">
									<h2 class="container-animation-text" style="text-transform: none;">
										<?php
										echo '<span>' . $uName . '</span>';
										?>
									</h2>
								</div>
							</div>
							<div class="col-sm-12 ">
								<h5 class="fw-light">
									<?php
									echo '<span>' . $creation . '</span>';
									?>
								</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5 d-flex align-items-center justify-content-center">
					<div class="card">
						<div class="card-body">
							<h4 class="card-title fw-bold">
								Invítame un cafe, dos o tres, los que quieras
							</h4>
							<div class="card-text">
								<div class="container">
									<div class="row text-center">
										<div class="coffeQuantity col-12">
											<div class="">
												<div class="rating-container">
													<div class="rating">
														<form class="rating-form">
															<label for="super-happy" class="coffeeCupSvg">
																<svg viewBox="-47 1 511 511.99897" xmlns="http://www.w3.org/2000/svg">
																	<path d="m396.675781 46.253906h-24.890625l-6.914062-33.527344c-1.523438-7.375-8.09375-12.726562-15.621094-12.726562h-281.386719c-7.53125 0-14.101562 5.351562-15.621093 12.726562l-6.917969 33.527344h-24.890625c-10.992188 0-19.933594 8.941406-19.933594 19.933594v32.957031c0 10.992188 8.941406 19.9375 19.933594 19.9375h9.78125l5.542968 38.949219c-1.679687.96875-3.210937 2.207031-4.511718 3.703125-3.328125 3.839844-4.828125 8.925781-4.113282 13.960937l37.003907 259.988282c1.019531 7.171875 6.40625 12.859375 13.210937 14.539062l5.265625 37.015625c2.011719 14.117188 14.277344 24.761719 28.535157 24.761719h194.816406c14.257812 0 26.523437-10.644531 28.535156-24.761719l5.265625-37.015625c6.804687-1.679687 12.191406-7.367187 13.210937-14.539062l37.003907-259.988282c.714843-5.035156-.785157-10.121093-4.113281-13.960937-1.300782-1.496094-2.832032-2.734375-4.515626-3.703125l5.546876-38.949219h9.78125c10.992187 0 19.933593-8.945312 19.933593-19.9375v-32.957031c-.003906-10.992188-8.945312-19.933594-19.9375-19.933594zm-21.5625 127.324219-37.003906 259.988281c-.175781 1.234375-1.246094 2.160156-2.488281 2.160156h-71.847656c-4.144532 0-7.503907 3.359376-7.503907 7.507813s3.359375 7.507813 7.503907 7.507813h60.753906l-4.894532 34.382812c-.964843 6.761719-6.839843 11.863281-13.671874 11.863281h-194.8125c-6.832032 0-12.707032-5.101562-13.671876-11.863281l-4.890624-34.382812h136.253906c4.148437 0 7.507812-3.359376 7.507812-7.507813s-3.359375-7.507813-7.507812-7.507813h-147.351563c-1.242187 0-2.3125-.925781-2.488281-2.160156l-37.003906-259.988281c-.140625-.988281.308594-1.679687.589844-2.003906.269531-.308594.855468-.800781 1.769531-.847657.101562-.003906.199219-.011718.304687-.019531h327.789063c.101562.007813.203125.015625.304687.019531.914063.046876 1.5.539063 1.769532.847657.28125.324219.730468 1.015625.589843 2.003906zm-329.730469-54.496094h326.347657l-5.210938 36.613281h-315.925781zm356.214844-19.9375c0 2.714844-2.207031 4.921875-4.921875 4.921875h-376.242187c-2.710938 0-4.921875-2.207031-4.921875-4.921875v-32.957031c0-2.714844 2.210937-4.921875 4.921875-4.921875h67.175781c4.144531 0 7.503906-3.359375 7.503906-7.507813 0-4.144531-3.359375-7.503906-7.503906-7.503906h-26.953125l6.289062-30.492187c.089844-.433594.476563-.75.917969-.75h281.386719c.441406 0 .828125.316406.917969.75l6.289062 30.492187h-233.914062c-4.148438 0-7.507813 3.359375-7.507813 7.503906 0 4.148438 3.359375 7.507813 7.507813 7.507813h274.132812c2.714844 0 4.921875 2.207031 4.921875 4.921875zm0 0" />
																	<path d="m265.023438 241.421875c-.050782-.050781-.105469-.097656-.160157-.148437-24.953125-24.695313-70.410156-19.570313-101.484375 11.507812-14.851562 14.847656-24.320312 33.40625-26.664062 52.257812-2.433594 19.546876 3.015625 37.097657 15.339844 49.421876 0 .003906.003906.003906.007812.007812.019531.019531.039062.039062.058594.054688 10.398437 10.363281 24.496094 15.84375 40.375 15.84375 2.933594 0 5.933594-.191407 8.976562-.566407 18.851563-2.34375 37.410156-11.816406 52.261719-26.664062 31.152344-31.15625 36.234375-76.769531 11.324219-101.679688-.011719-.015625-.023438-.023437-.035156-.035156zm-113.410157 65.46875c1.933594-15.550781 9.882813-30.996094 22.378907-43.496094 14.972656-14.972656 33.71875-22.863281 50.480468-22.863281 7.703125 0 14.980469 1.675781 21.285156 5.089844-12.605468 7.488281-32.179687 22.21875-38.132812 44.050781-5.179688 18.980469-33.28125 40.007813-48.703125 49.757813-6.28125-8.628907-8.875-19.957032-7.308594-32.539063zm91.503907 25.628906c-12.5 12.5-27.945313 20.445313-43.496094 22.378907-10.984375 1.367187-21.015625-.433594-29.128906-5.089844 15.480468-10.21875 45.132812-32.414063 51.617187-56.1875 5.292969-19.417969 26.214844-32.492188 35.769531-37.574219 14.859375 19.78125 8.875 52.832031-14.761718 76.472656zm0 0" />
																</svg>
															</label>

															<label for="happy" class="timesSvg">
																<svg height="365.696pt" viewBox="0 0 365.696 365.696" width="365.696pt" xmlns="http://www.w3.org/2000/svg">
																	<path d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" />
																</svg>
															</label>

															<label for="neutral">
																<input type="radio" name="rating" class="neutral" id="neutral" value="1" checked />
																<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve">
																	<g>
																		<g>
																			<path d="M341.333,0H42.667C19.093,0,0,19.093,0,42.667v298.667C0,364.907,19.093,384,42.667,384h298.667
			C364.907,384,384,364.907,384,341.333V42.667C384,19.093,364.907,0,341.333,0z M234.667,298.667H192V128h-42.667V85.333h85.333
			V298.667z" />
																		</g>
																	</g>
																</svg>
															</label>

															<label for="sad">
																<input type="radio" name="rating" class="sad" id="sad" value="3" />
																<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve">
																	<g>
																		<g>
																			<path d="M341.333,0H42.667C19.093,0,0,19.093,0,42.667v298.667C0,364.907,19.093,384,42.667,384h298.667
			C364.907,384,384,364.907,384,341.333V42.667C384,19.093,364.907,0,341.333,0z M256,160c0,17.707-14.293,32-32,32
			c17.707,0,32,14.293,32,32v32c0,23.573-19.093,42.667-42.667,42.667H128V256h85.333v-42.667h-42.667v-42.667h42.667V128H128
			V85.333h85.333C236.907,85.333,256,104.427,256,128V160z" />
																		</g>
																	</g>
																</svg>
															</label>

															<label for="super-sad">
																<input type="radio" name="rating" class="super-sad" id="super-sad" value="5" />
																<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 384 384" style="enable-background:new 0 0 384 384;" xml:space="preserve">
																	<g>
																		<g>
																			<path d="M341.333,0H42.667C19.093,0,0,19.093,0,42.667v298.667C0,364.907,19.093,384,42.667,384h298.667
			C364.907,384,384,364.907,384,341.333V42.667C384,19.093,364.907,0,341.333,0z M256,128h-85.333v42.667h42.667
			c23.573,0,42.667,19.093,42.667,42.667V256c0,23.573-19.093,42.667-42.667,42.667H128V256h85.333v-42.667H128v-128h128V128z" />
																		</g>
																	</g>
																</svg>
															</label>

															<label class="lastInput">
																<input type="number" class="form-control" min="1" name="qty" id="valueRadioGive" value="1" placeholder="10" required />
															</label>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="d-grid gap-2 mt-2">
								<button class="btn btn-success" type="button" id="btnPayCoffee" data-bs-toggle="modal" data-bs-target="#apoyar">
									<span class="fw-bold">
										<?php
										echo 'Apoyar <i class="fas fa-dollar-sign"></i> <strong style="font-size:120%;" id="valueBtnExtra">' . $money . '</strong>';
										echo '<script>var btnPay = document.getElementById("btnPayCoffee");
												btnPay.addEventListener("click", function(){
													document.getElementById("titlePay").innerHTML = "Apoyando a <b>' . $uName . '</b>"; 
													document.getElementById("titlePaying").innerHTML = "Apoyando a <b>' . $uName . '</b>"; 
													$("#preguntaSection").hide();
													document.getElementById("questionAnswer").removeAttribute("required");
													document.getElementById("payType").value = "1";
													var prriceCoffee = document.getElementById("valueBtnExtra").innerText;
													document.getElementById("amountCoffe").value = prriceCoffee;													
													document.getElementById("id-extra").value = "' . $idExtra . '";
													document.getElementById("descripcionPay").value = "Coffee for: ' . $userID . '";
												});</script>';
										?>
									</span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="bg-dark text-white">
		<div class="container p-5">
			<div class="row text-center">
				<div class="col-sm-2"></div>
				<div class="col-sm-8">
					<div class="card text-dark">
						<div class="card-body">
							<h5 class="fw-bold">
								<?php
								echo $about;
								?>
							</h5>
						</div>
					</div>
				</div>
				<div class="col-sm-2"></div>
			</div>
		</div>
	</div>
	<div class="bg-white py-3">
		<div class="container">
			<div class="row">
				<div class="col-8">
					<div class="container">
						<div class="row">
							<?php
							$sqle = "SELECT a.id_extra, a.title, a.description, a.confirmation, a.id_user, a.limit_slots, a.price, a.question, a.subsciption, a.subsciption_id, a.active, a.date FROM extras as a INNER JOIN users as b on b.id_user=a.id_user WHERE b.user_name='" . $uName . "' and (a.active=1 or a.active=3)";
							$resulte = $conn->query($sqle);
							if ($resulte->num_rows > 0) {

								while ($rowe = $resulte->fetch_assoc()) {
									if ($rowe["active"] == "1" || $sess) {
										echo '<div class="col-6 p-1">
												<div class="card d-flex flex-column bg-light h-100">
												<div class="card-body d-flex flex-column h-100">
													<h5 class="card-title fw-bold">' . $rowe["title"] . '</h5>
													<h6 class="card-subtitle mb-2 text-muted">';
										echo '<div class="row text-start">
												<div class="col-sm-12">';
										if ($rowe["limit_slots"] == "0") {
											$noSlots = false;
											if ($rowe["subsciption"] == "1") {

												echo '<div class="badge bg-secondary text-wrap">Agotado</div>
													<div class="badge bg-dark text-wrap ms-1">Suscripción</div>';
											} else {
												echo '<div class="badge bg-secondary text-wrap">Agotado</div>';
											}
										} else if ($rowe["limit_slots"] == "1") {
											$noSlots = true;
											if ($rowe["subsciption"] == "1") {
												echo '<div class="badge bg-warning text-dark text-wrap">Queda el ultimo lugar</div>
													<div class="badge bg-dark text-wrap ms-1">Suscripción</div>';
											} else {
												echo '<div class="badge bg-warning text-dark text-wrap">Queda el ultimo lugar</div>';
											}
										} else if ($rowe["limit_slots"] == "-1") {
											$noSlots = true;
											if ($rowe["subsciption"] == "1") {
												echo '<div class="badge bg-dark text-wrap">Suscripción</div>';
											}
										} else {
											$noSlots = true;
											if ($rowe["subsciption"] == "1") {
												echo '<div class="badge bg-warning text-dark text-wrap">Quedan : ' . $rowe["limit_slots"] . ' lugares</div>
													<div class="badge bg-dark text-wrap ms-1">Suscripción</div>';
											} else {
												echo '<div class="badge bg-warning text-dark text-wrap">Quedan : ' . $rowe["limit_slots"] . ' lugares</div>
												';
											}
										}

										if ($rowe["active"] == "3" && $sess) {
											$noSlots = false;
											echo '<div class="badge bg-danger text-wrap ms-1">Pendiente de aprobación</div>';
										}

										echo '</div>
										</div>';

										echo '</h6>
													<p class="card-text">' . $rowe["description"] . '</p>
													<div class="d-grid gap-2 mt-2 ">
													';
										if ($noSlots) {
											echo '<button
														class="align-self-end btn btn-success btn-sm mt-auto"
														type="button"
														id="btnPayCoffee' . $rowe["id_extra"] . '"
														data-bs-toggle="modal" data-bs-target="#apoyar"
													>
														Comprar &nbsp;
														<span class="fw-bold"><i class="fas fa-dollar-sign"></i> 
														' . $rowe["price"] . '
														</span>
													</button>';
										} else {
											echo '<button
														class="align-self-end btn btn-success btn-sm mt-auto"
														type="button"
														id="btnPayCoffee' . $rowe["id_extra"] . '"
														disabled
													>
														Comprar &nbsp;
														<span class="fw-bold"><i class="fas fa-dollar-sign"></i> 
														' . number_format((float)$rowe["price"], 2, '.', '') . '
														</span>
													</button>';
										}

										echo '</div>
												</div>
												</div>
											</div>';

										echo '<script>let btnPay' . $rowe["id_extra"] . ' = document.getElementById("btnPayCoffee' . $rowe["id_extra"] . '");
											btnPay' . $rowe["id_extra"] . '.addEventListener("click", function(){
												
											document.getElementById("titlePay").innerHTML = "<b>' . $rowe["title"] . '</b>"; 
											document.getElementById("titlePaying").innerHTML = "<b>' . $rowe["title"] . '</b>";
											document.getElementById("amountCoffe").value = "' . $rowe["price"] . '";
											document.getElementById("titleExtraval").value = "' . $rowe["title"] . '";
											document.getElementById("id-extra").value = "' . $rowe["id_extra"] . '";
											document.getElementById("descripcionPay").value = "' . $rowe["title"] . ' from: ' . $userID . '";';

										if ($rowe["subsciption"] == "1") {
											echo 'document.getElementById("payType").value = "2";';
											echo 'document.getElementById("subsid").value = "' . $rowe["subsciption_id"] . '";';
											echo 'document.getElementById("btnPaypalDiv").style.display = "none";';
										} else {
											echo 'document.getElementById("payType").value = "1";';
											echo 'document.getElementById("btnPaypalDiv").style.display = "block";';
										}

										if ($rowe["question"] == "") {
											echo 'console.log("aqui");';
											echo '$("#preguntaSection").hide();
												$("#preguntaSection2").hide();
												document.getElementById("questionAnswer").removeAttribute("required");';
										} else {
											echo '$("#preguntaSection").show();
												$("#preguntaSection2").show();
												document.getElementById("questionAnswer").setAttribute("required", "");
												document.getElementById("questionLabel").innerHTML = "<b>' . $rowe["question"] . '</b>";';
										}
										echo '});</script>';
										$noExtras = false;
									} else {
										$noExtras = true;
									}
								}
							} else {

								$noExtras = true;
							}

							if ($noExtras) {
								echo '<div class="flex-container mt-2">
										<div class="flex-items">
											<div class="p-5 mb-4 bg-light rounded-3">
												<div class="container-fluid py-5">
													<h3 class="display-5 fw-bold">
														Gracias por tu apoyo <i class="fas fa-heart text-danger"></i>
													</h3>
												</div>
											</div>
										</div>
									</div>';
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-4">
					<div class="container">
						<div class="row">
							<div class="col">
								<?php
								echo '<h5>
									Ultimas noticias de ' . $uName . '
								</h5>';
								?>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<div class="card-text ">
											<?php
											$sqlf = "SELECT a.id_users_posts, a.is_deleted, a.text, a.date FROM users_posts as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='" . $uName . "' AND a.is_deleted=0 ORDER by a.date desc";
											$resultf = $conn->query($sqlf);

											if ($resultf->num_rows > 0) {

												while ($rowf = $resultf->fetch_assoc()) {
													$date = date_create($rowf["date"]);
													$mysqltime = date_format($date, 'd-m-Y G:i a');
													echo '<span class="fst-italic mb-1">' . $rowf["text"] . '</span>
														<p class="fw-light">
															<i class="fas fa-calendar-alt"></i> ' . $mysqltime . '
														</p>';
												}
											} else {
												//
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col">
								<h5>Comentarios de Fans:</h5>
							</div>
						</div>
						<div class="row">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<div class="card-text ">
											<?php
											$sqlk = "SELECT a.note_fan, a.date FROM payments as a INNER JOIN users as b on a.id_user=b.id_user WHERE b.user_name='" . $uName . "' AND a.status='completed' ORDER by a.date asc";
											$resultk = $conn->query($sqlk);

											if ($resultk->num_rows > 0) {
												$fansCount = 0;
												while ($rowk = $resultk->fetch_assoc()) {
													$fansCount++;
												}
												echo '<span class="small float-end"><i class="fas fa-users"></i> ' . $fansCount . '</span>';
											} else {
												echo '<h5 class="fw-bold">
												Puedes ser el primero en aparecer aquí
											</h5>';
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
													   url  : "comolovemifan/pagination.php",
													   type : "POST",
													   cache: false,
													   data : {page_no:page, username:"' . $uName . '"},
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
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editarme" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Editar mi Pagina</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body text-center">
					<form class="needs-validation" method="post" action="misextras/saveExtraCoffee/" enctype="multipart/form-data">
						<?php
						$folder_path = "data/" . $userID . "/profile/";
						if (!file_exists($folder_path)) {
							echo '<img src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" width="120" id="preview" class="img-thumbnail rounded">';
						} else {
							foreach (glob('data/' . $userID . '/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
								if (preg_match('/(\.jpg|\.png|\.bmp)$/', $file)) {
									echo '<img src="' . $file . '" id="preview" class="img-thumbnail" width="120">';
								}
							}
						}
						?>
						<input type="file" class="file" name="fileToUpload" accept="image/jpeg, image/png">
						<div class="my-3">
							<input type="text" class="form-control mb-2" disabled placeholder="Upload File" id="file">
							<div class="input-group-append">
								<button type="button" class="browse btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i> Editar foto</button>
							</div>
						</div>

						<div class="mb-3">
							<label for="exampleFormControlTextarea1"><b>Tu descripcion personal:</b></label>
							<?php
							echo '<textarea class="form-control"  name="creation" rows="2" required>' . $creation . '</textarea>';
							?>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1"><b>Escribe que haces, tu pasion, tu dedicacion:</b></label>
							<?php
							echo '<textarea class="form-control"  name="description_ex" rows="2" required>' . $about . '</textarea>';
							?>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlInput1"><b>Precio de tu cafe:</b></label>
							<?php
							echo '<input type="textbox" class="form-control currency"  name="price_ex" style="text-align:center;" value="' . $priceExtra . '" required>';
							?>
						</div>
						<div class="mb-3">
							<label for="exampleFormControlTextarea1"><b>Este mensaje le llegara a tu fan una vez haya pagado uno o varios cafes:</b></label>
							<?php
							echo '<textarea class="form-control"  name="confirmation_ex" rows="2" required>' . $confirmationExtra . '</textarea>
							<input type="hidden" name="extra_edit" value="' . $idExtra . '">';
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


	<div class="modal fade" id="apoyar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body">
					<div class="container">
						<div class="row mb-3 text-center">
							<div class="col-12">
								<button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
								<h5 class="modal-title w-100" id="exampleModalLongTitle">
									<i class="fas fa-user-alt"></i> <span id="titlePay"></span>
								</h5>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12">
								<input type="email" class="form-control" id="inputMailFan1" aria-describedby="emailHelp" placeholder="Ingresa tu correo">
								<small id="emailHelp" class="form-text text-muted">Aqui te llegara tu confirmacion de pago y un mensaje especial.</small>
							</div>
						</div>
						<div class="row mb-3">
							<div class="col-12">
								<textarea class="form-control" id="inputTextFan1" rows="2" placeholder="Aqui puedes escribirle algo publico o privado.. (opcional)"></textarea>
								<div class="m-1">
									<div class="flipswitch">
										<input type="checkbox" name="flipswitch" class="flipswitch-cb" id="fs" checked>
										<label class="flipswitch-label" for="fs">
											<div class="flipswitch-inner"></div>
											<div class="flipswitch-switch"></div>
										</label>
									</div>
								</div>

							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<h5 class="fw-bold">Pagar con:</h5>
							</div>
							<div class="col-12 p-2 text-center d-grip">
								<button type="button" class="btn btn-warning col-12" id="btnPayCreditDebit" data-bs-target="#apoyarSiguiente" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="fab fa-cc-visa fa-2x"></i> <i class="fab fa-cc-mastercard fa-2x"></i> <i class="fab fa-cc-amex fa-2x"></i> Pago seguro</button>
							</div>
							<div class="col-12 p-2" id="btnPaypalDiv"><button class="btn btn-warning btn-block" id="btnPaypal"><img src="images/paypal.png" width="100"></button></div>
							<div class="col-12 text-center">
								<span class="badge bg-success"><i class="fas fa-user-lock"></i> Tus pagos se realizan de forma segura con encriptación de 256 bits.</span>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="apoyarSiguiente" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="mb-3">
									<button type="button" class="btn-close float-end" data-bs-dismiss="modal" aria-label="Close"></button>
									<h5 class="modal-title w-100" id="exampleModalLongTitle">
										<i class="fas fa-user-alt"></i> <span id="titlePaying"></span>
									</h5>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<form action="pagando/" method="POST" id="payment-form" novalidate="">
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
									echo '<input type="hidden" name="confirmationM" value="' . $confirmationExtra . '">';
									echo '<input type="hidden" name="uname" value="' . $uName . '" id="unamePay">';
									echo '';
									?>
									<div class="mb-3">
										<input type="email" class="form-control" id="inputMailFan2" name="email" aria-describedby="emailHelp" placeholder="Inresa tu correo" required>
										<small id="emailHelp" class="form-text text-muted">Aqui te llegara tu confirmacion de pago y un mensaje especial.</small>
									</div>
									<div class="mb-3">
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
									<div class="mb-3" id="preguntaSection">
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
										<div class="mb-3">
											<input type="text" placeholder="Nombre en tarjeta" name="holder_name" autocomplete="off" data-openpay-card="holder_name" required class="form-control">
										</div>
										<div class="mb-3">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Numero de tarjeta" id="txtCardNumber" aria-describedby="basic-addon2">
												<input type="hidden" id="txtCardNumberNoSpaces" data-openpay-card="card_number" aria-describedby="basic-addon2">
												<span class="input-group-text" id="basic-addon2">
													<i class="fab fa-cc-visa mx-1"></i>
													<i class="fab fa-cc-mastercard mx-1"></i>
													<i class="fab fa-cc-amex mx-1"></i>
												</span>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-8">
												<div class="mb-3">
													<label><span class="hidden-xs">Expiración</span></label>
													<div class="input-group">
														<select class="form-select" name="expiration_month" data-openpay-card="expiration_month" required>
															<option selected disabled value="">Mes</option>
															<option>01</option>
															<option>02</option>
															<option>03</option>
															<option>04</option>
															<option>05</option>
															<option>06</option>
															<option>07</option>
															<option>08</option>
															<option>09</option>
															<option>10</option>
															<option>11</option>
															<option>21</option>
														</select>
														<select class="form-select" name="expiration_year" data-openpay-card="expiration_year" required>
															<option selected disabled value="">Año</option>
															<option>21</option>
															<option>22</option>
															<option>23</option>
															<option>24</option>
															<option>25</option>
															<option>26</option>
															<option>27</option>
															<option>28</option>
															<option>29</option>
															<option>30</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-sm-4">
												<div class="mb-4">
													<div class="label">
														<span class="label-text">CCV&nbsp;</span>
														<span class="tooltip-toggle" aria-label="Código de tres digitos atras de tu tarjeta" tabindex="0">
															<i class="fa fa-question-circle"></i>
														</span>
													</div>
													<input type="text" required autocomplete="off" data-openpay-card="cvv2" name="cvv2" class="form-control">
												</div>
											</div>
										</div>
										<button class="btn btn-warning btn-block shadow-sm col-6 mb-3" id="pay-button" type="submit"><span id="endLabelPay"><i class="fas fa-lock"></i> Finalizar</span><span id="endLabelPaying"><i class="fas fa-spinner fa-pulse"></i> Pagando</span></button>
									</div>
								</form>
							</div>
							<div class="col-12">
								<span class="badge bg-success"><i class="fas fa-user-lock"></i> Tus pagos se realizan de forma segura con encriptación de 256 bits.</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type='text/javascript' src="js/coffeeOpenPay.js"></script>
<?php
require_once('admin/footer.php');
if ($sess) {
	echo '<script type="text/javascript">
	activateNavbarItem("navPagina");
	</script>';
}

function asDollars($value)
{
	if ($value < 0) return "-" . asDollars(-$value);
	return '$' . number_format($value, 2);
}
?>