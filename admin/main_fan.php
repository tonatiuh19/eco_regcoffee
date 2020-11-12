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

			$sql = "SELECT name, last_name, about, creation, extra FROM users WHERE user_name='".$uName."'";
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
			if($creation == ''){
				echo '<span>Aun no añades tu descripcion <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
			}else{
				echo '<span>'.$creation.' <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></span>';
			}
			echo '<div class="divider-custom divider-light">
				<div class="divider-custom-line"></div>
					<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
					<div class="divider-custom-line"></div>
				</div>
			';
			if($about == ''){
				echo '<p class="masthead-subheading font-weight-light mb-0">Escribe que haces, tu pasion, tu dedicacion, etc. <button type="button" class="btn btn-warning p-1" data-toggle="modal" data-target="#editarme"><i class="fas fa-pencil-alt"></i></button></p>';
			}else{
				echo '<p class="masthead-subheading font-weight-light mb-0">'.$about.'</p>';
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
								<li class="nav-item">
									<a class="nav-link"  href="#history" role="tab" aria-controls="history" aria-selected="false">Extras</a>
								</li>
							</ul>
							</div>
							<div class="card-body">
							<div class="tab-content mt-3">
								<div class="tab-pane active" id="description" role="tabpanel">
									<div class="row">
										<div class="col-sm-7">

										</div>
										<div class="col-sm-5">
											<div class="card">
												<div class="card-body">
													<h6 class="card-title">Apoya a <strong>tonatiuh</strong> comprandole un cafe</h6>
													<form action="#">
														<div class="row stock-images">
															<div class="col s6 m3"><input id="test0" name="same-group-name" class="radiosImg" type="radio" /><label for="test0">
																<div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
																</label>
															</div>
															<div class="col s6 m3"><input id="test1" name="same-group-name" class="radiosImg" type="radio" /><label for="test1">
																<div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
																</label>
															</div>
															<div class="col s6 m3"><input id="test2" name="same-group-name" class="radiosImg" type="radio" /><label for="test2">
																<div class="image" style="background-image: url(http://loremflickr.com/620/440/london)"></div>
																</label>
															</div>
														</div>
													</form>
													
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<div class="tab-pane" id="history" role="tabpanel" aria-labelledby="history-tab">  
									<p class="card-text">First settled around 1000 BCE and then founded as the Etruscan Felsina about 500 BCE, it was occupied by the Boii in the 4th century BCE and became a Roman colony and municipium with the name of Bononia in 196 BCE. </p>
									<a href="#" class="card-link text-danger">Read more</a>
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
<?php
require_once('../admin/footer.php');
?>