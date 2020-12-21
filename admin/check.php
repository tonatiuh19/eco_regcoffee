<?php
session_start();
require_once('cn.php');

if(isset($_POST['username'])){
    $sql = "SELECT user_name FROM users WHERE user_name='".$_POST['username']."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "1";
    } else {
        $folders = array('passwordReset', 
        'olvidemicontrasena', 
        'adios',
        'admin',
        'chart',
        'comolovemifan',
        'css',
        'developers',
        'fonts',
        'gracias',
        'houstontenemosproblemas',
        'images',
        'js',
        'material',
        'micuenta',
        'mipagina',
        'misextras',
        'misfans',
        'mispagos',
        'notificaciones',
        'pagando',
        'perfil',
        'scss',
        'sign-in',
        'sign-up',
        'thanks',
        'template',
        'explorar',
        'misapoyos',
        'tunombreaqui');
        if (in_array($_POST['username'], $folders)) {
            echo "1";
        }else{
            echo "0";
        }
    }
    $conn->close();
}

?>