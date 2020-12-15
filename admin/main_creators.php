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
date_default_timezone_set('America/Mexico_City');
?>

<div class="site-section bg-primary-light">
	<div class="container">
        <div class="section-title text-center" >
          <h2>Explora creadores</h2>
        </div>

        <?php
            $sqlx = "SELECT a.id_payments FROM payments as a INNER JOIN users as b on a.email_user=b.email WHERE a.status='completed' and b.id_user=".$_SESSION["user_param"]."";
            $resultx = $conn->query($sqlx);
            
            if ($resultx->num_rows > 0) {
                echo '<div class="row btn-toolbar align-items-center justify-content-center">
                    <a href="../misapoyos/" class="btn btn-warning"><i class="far fa-heart"></i> Mis apoyos</a>
                </div><p></p>';
            }
        ?>

        <div class="row btn-toolbar align-items-center justify-content-center">
		  
		    <button class="btn btn-outline-primary p-2 mr-1 active" id="all">Todo</button>
		    <button class="btn btn-outline-primary p-2 mr-1" id="video"><i class="fas fa-video"></i> Video Creador</button>
		    <button class="btn btn-outline-primary p-2 mr-1" id="writter"><i class="fas fa-pencil-alt"></i> Escritor</button>
		    <button class="btn btn-outline-primary p-2 mr-1" id="developer"><i class="fas fa-code"></i> Developer</button>
            <button class="btn btn-outline-primary p-2 mr-1" id="podcaster"><i class="fas fa-microphone"></i> Podcaster</button>
            <button class="btn btn-outline-primary p-2 mr-1" id="artist"><i class="fas fa-film"></i> Artista</button>
            <button class="btn btn-outline-primary p-2 mr-1" id="influencer"><i class="fas fa-heart"></i> Influencer</button>
            <button class="btn btn-outline-primary p-2 mr-1" id="other"><i class="fas fa-magic"></i> Otro</button>
		
		</div>


        <p></p>
        <div class="row justify-content-center">
            
            <?php
            
            $sql = "SELECT a.id_users_categories, a.date, CASE WHEN a.video = 1 THEN 'video' ELSE '' END as video, CASE WHEN a.writter = 1 THEN 'writter' ELSE '' END as writter, CASE WHEN a.developer = 1 THEN 'developer' ELSE '' END as developer, CASE WHEN a.podcaster = 1 THEN 'podcaster' ELSE '' END as podcaster, CASE WHEN a.artist = 1 THEN 'artist' ELSE '' END as artist, CASE WHEN a.influencer = 1 THEN 'influencer' ELSE '' END as influencer, CASE WHEN a.other = 1 THEN 'other' ELSE '' END as other, c.user_name, c.about, c.creation FROM users_categories as a INNER JOIN (SELECT id_user, MAX(date) as max_date FROM users_categories GROUP by id_user) as b on a.date=b.max_date LEFT JOIN users as c on c.id_user=a.id_user WHERE c.active=1";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
              // output data of each row
              while($row = $result->fetch_assoc()) {
                $uName = $row["user_name"];
                $folder_path = "../".$uName."/profile/";
                echo '<div class="col-md-4 m-1"><div class="card text-center '.$row["video"].' '.$row["writter"].' '.$row["developer"].'  '.$row["podcaster"].' '.$row["artist"].' '.$row["influencer"].' '.$row["other"].'">
                        <div class="card-header">';
                        if (!file_exists($folder_path)) {
                            echo '<img class="masthead-avatar rounded" src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png" width="120" alt="" />';
                        }else{
                            foreach(glob('../'.$uName.'/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
                                if (preg_match('/(\.jpg|\.jpeg|\.png|\.bmp)$/', $file)) {
                                    echo '<img class="masthead-avatar rounded" src="'.$file.'" width="45" alt="" />';
                                }
                            }
                        }
                        echo '</div>
                        <div class="card-body">
                            <h5 class="card-title">'.$row["user_name"].'</h5>
                            <p class="card-text">'.$row["creation"].'</p>
                            <hr>
                            <p class="card-text">'.limit_text($row["about"],15).'</p>
                            <a href="../'.$row["user_name"].'" target="_blank" class="btn btn-primary stretched-link">Apoyar</a>
                        </div>
                </div></div>';
              }
            }

            function limit_text($text, $limit) {
                if (str_word_count($text, 0) > $limit) {
                    $words = str_word_count($text, 2);
                    $pos   = array_keys($words);
                    $text  = substr($text, 0, $pos[$limit]) . '...';
                }
                return $text;
            }
            ?>
            
            
            
        </div>
    </div>
</div>
<?php
if($_SESSION["utype"] != "2"){
    echo '<script type="text/javascript">
    activateNavbarItem("navAstronaut");
  </script>';
}else{
    echo '<script type="text/javascript">
    activateNavbarItem("navExplorar");
  </script>';
}
require_once('../admin/footer.php');
?>
