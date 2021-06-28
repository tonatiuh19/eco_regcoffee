<?php
require_once('../admin/header.php');
date_default_timezone_set('America/Mexico_City');
$today = date("Y-m-d H:i:s");
$sqlx = "INSERT INTO visitors (section, date)
VALUES ('creators', '$today')";

if ($conn->query($sqlx) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
<link rel="stylesheet" href="./css/style.css">
<div class="site-section pb-5">
    <div class="container">
        <div class="row pt-5">
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                <h2 class="fw-bold">Explora creadores</h2>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-lg-6 ">
                <div class="float-end">
                    <div id="wrap">
                        <input name="search" type="text" placeholder="Buscar..." id="keywords" onkeyup="searchFilter();">
                        <input id="search_submit" value="Rechercher" type="submit">
                    </div>
               </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="container-gum">
                    <ul>
                        <?php
                        $sqlx = "SELECT a.id_categories, a.category FROM categories as a";
                        $resultx = $conn->query($sqlx);

                        if ($resultx->num_rows > 0) {
                            // output data of each row
                            while ($rowx = $resultx->fetch_assoc()) {
                                echo '<li>
                                    <label>
                                        <input type="checkbox" name="check_list[]" id="myonoffswitch' . $rowx['id_categories'] . '" value="' . $rowx['id_categories'] . '" onchange="searchFilter();">
                                        <div class="icon-box">' . $rowx['category'] . '</div>
                                    </label>
                                </li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="row text-center">
            <div class="col">
                <div class="loading-overlay">
                    <div class="overlay-content"><i class="fas fa-spinner fa-spin fa-2x"></i></div>
                </div>
            </div>
        </div>

        <div class="row" id="postContent">
            <!-- Loading overlay -->


            <!-- Post list container -->

            <?php
            // Include pagination library file 
            include_once 'pagination.php';

            // Include database configuration file 

            // Set some useful configuration 
            $baseURL = 'getData.php';
            $limit = 20;

            // Count of all records 
            $sql = "SELECT COUNT(*) as rowNum FROM users_categories as a INNER JOIN users as b on b.id_user=a.id_user AND a.active=1 GROUP BY a.id_user";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $rowCount = 0;
                while ($row = $result->fetch_assoc()) {
                    $rowCount++;
                }
            } else {
                echo "0 results";
            }


            // Initialize pagination class 
            $pagConfig = array(
                'baseURL' => $baseURL,
                'totalRows' => $rowCount,
                'perPage' => $limit,
                'contentDiv' => 'postContent',
                'link_func' => 'searchFilter'
            );
            $pagination =  new Pagination($pagConfig);

            // Fetch records based on the limit 

            $sql = "SELECT a.id_user, b.user_name, b.about, b.creation,
                    MAX(CASE WHEN a.id_categories = 1 THEN 1 ELSE 0 END) Video,
                    MAX(CASE WHEN a.id_categories = 2 THEN 1 ELSE 0 END) Writter,
                    MAX(CASE WHEN a.id_categories = 3 THEN 1 ELSE 0 END) Developer,
                    MAX(CASE WHEN a.id_categories = 4 THEN 1 ELSE 0 END) Podcaster,
                    MAX(CASE WHEN a.id_categories = 5 THEN 1 ELSE 0 END) Artist,
                    MAX(CASE WHEN a.id_categories = 6 THEN 1 ELSE 0 END) Influencer,
                    MAX(CASE WHEN a.id_categories = 7 THEN 1 ELSE 0 END) Other
                FROM users_categories as a
                INNER JOIN users as b on b.id_user=a.id_user AND a.active=1
                GROUP BY a.id_user LIMIT $limit";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $idUser = $row["id_user"];
                    $folder_path = "../data/" . $idUser . "/profile/";

                    echo '<div class="col pb-5">
                    <div class="content-card-st m-3">
                        <div class="card-st">
                            <div class="firstinfo">
                                <div class="img-card">';
                                if (!file_exists($folder_path)) {
                                    //echo '<img src="" class="rounded" width="100">';
                                    echo '<img src="https://www.pinclipart.com/picdir/big/91-919500_individuals-user-vector-icon-png-clipart.png"/>';
                                } else {
                                    foreach (glob('../data/' . $idUser . '/profile/*.{jpg,png}', GLOB_BRACE) as $file) {
                                        if (preg_match('/(\.jpg|\.jpeg|\.png|\.bmp)$/', $file)) {
                                            //echo '<img src="' . $file . '" class="rounded" width="155">';
                                            echo '<img src="' . $file . '" />';
                                        }
                                    }
                                }
                                echo '</div>
                                <div class="profileinfo">
                                    <h1>' . $row["user_name"] . '</h1>
                                    <h3>' . $row["creation"] . '</h3>
                                    <p class="bio">' . limit_text($row["about"], 15) . '
                                        <div class="pt-1 float-end">
                                            <a href="../' . $row["user_name"] . '" target="_blank" class="btn btn-danger""><i class="far fa-heart"></i> Apoyar</a>
                                        </div> 
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="badgescard-st">';
                            if($row["Video"] == '1'){
                                echo '<span class="badge bg-danger">Video creador</span>';
                            }
                            if($row["Writter"] == '1'){
                                echo '<span class="badge bg-danger">Escritor</span>';
                            }
                            if($row["Developer"] == '1'){
                                echo '<span class="badge bg-danger">Developer</span>';
                            }
                            if($row["Podcaster"] == '1'){
                                echo '<span class="badge bg-danger">Podcaster</span>';
                            }
                            if($row["Artista"] == '1'){
                                echo '<span class="badge bg-danger">Artista</span>';
                            }
                            if($row["Influencer"] == '1'){
                                echo '<span class="badge bg-danger">Influencer</span>';
                            }
                            if($row["Other"] == '1'){
                                echo '<span class="badge bg-danger">Otro</span>';
                            }
                        echo '</div>
                    </div>
                  </div>';
                }
                echo $pagination->createLinks();
            } else {
                echo '<div class="col-sm-12 text-center">
                <i class="fas fa-dizzy fa-5x"></i> <h2>Sin resultados</h2>
                </div>';
            }
            function limit_text($text, $limit)
            {
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
if ($sess) {
    if ($_SESSION["utype"] != "2") {
        echo '<script type="text/javascript">
        activateNavbarItem("navAstronaut");
      </script>';
    } else {
        echo '<script type="text/javascript">
        activateNavbarItem("navExplorar");
      </script>';
    }
}
require_once('../admin/footer.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./js/filtering.js"></script>