<?php
$servername = "mx50.hostgator.mx";
$username = "alanchat_admin";
$password = "tonatiuh19";
$dbname = "alanchat_runc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_set_charset($conn, 'utf8');

//$con->close();

?>
