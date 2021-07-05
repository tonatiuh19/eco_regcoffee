<?php
mysqli_report(MYSQLI_REPORT_STRICT); 
$servername = "mx50.hostgator.mx";
$username = "alanchat_admin";
$password = "tonatiuh19";
//$password = "tonatiuh199";
$dbname = "alanchat_runc";

// Create connection
global $conn;
//$conn = new mysqli($servername, $username, $password, $dbname);
try{
    $conn = new mysqli($servername, $username, $password, $dbname);
}
catch(Exception $e){
    header('Location: ../algosaliomal');
    die();
}
// Check connection
if ($conn->connect_error) {
    /*echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='../algosaliomal/';
    </SCRIPT>");
    die(); */
    die("Connection failed: " . $conn->connect_error);
    //die(header("Location: http://localhost:8000/algosaliomal/"));
}
mysqli_set_charset($conn, 'utf8');

//$con->close();

?>
