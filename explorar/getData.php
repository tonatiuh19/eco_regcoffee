<?php
session_start();
require_once('../admin/cn.php');
if (isset($_POST['page'])) {
    // Include pagination library file 
    include_once 'pagination.php';

    // Include database configuration file 

    // Set some useful configuration 
    $baseURL = 'getData.php';
    $offset = !empty($_POST['page']) ? $_POST['page'] : 0;
    $limit = 20;

    // Set conditions for search 
    $whereSQL = $orderSQL = '';
    $checks = $_POST['sortBy'];
    $checksArr = explode(',', $checks);
    $i=0;
    $orderSQL = '';
    
    foreach($checksArr as $item) {
        if($i==0){
            $orderSQL = $orderSQL." WHERE a.id_categories=".$item;
        }else{
            $orderSQL = $orderSQL." OR a.id_categories=".$item;
        }
        $i++;
    }
    
    if($checksArr[0] == ''){
        $orderSQL = '';
        $i=0;
    }
    if (!empty($_POST['keywords'])) {
        if($i==0){
            $whereSQL = " WHERE b.user_name LIKE '%" . $_POST['keywords'] . "%'";
        }else{
            $whereSQL = " AND b.user_name LIKE '%" . $_POST['keywords'] . "%'";
        }
        
    }
    
    
    $sql = "SELECT COUNT(*) as rowNum FROM users_categories as a INNER JOIN users as b on b.id_user=a.id_user AND a.active=1 ".$orderSQL.$whereSQL." GROUP BY a.id_user";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $rowCount = 0;
        while ($row = $result->fetch_assoc()) {
            $rowCount++;
        }
    } else {
        //echo "0 results";
    }

    // Initialize pagination class 
    $pagConfig = array(
        'baseURL' => $baseURL,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'currentPage' => $offset,
        'contentDiv' => 'postContent',
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Fetch records based on the offset and limit 
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
    ".$orderSQL.$whereSQL."
    GROUP BY a.id_user LIMIT $offset,$limit";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idUser = $row["id_user"];
            $folder_path = "../data/" . $idUser . "/profile/";


            echo '<div class="col">
                    <div class="content-card-st m-5">
                        <div class="card-st">
                            <div class="firstinfo">';
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
                                
                                echo '<div class="profileinfo">
                                    <h1>' . $row["user_name"] . '</h1>
                                    <h3>' . $row["creation"] . '</h3>
                                    <p class="bio">' . $row["about"] . '
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
}
