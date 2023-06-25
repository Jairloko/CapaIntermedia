<?php
$user = $_POST['usuario'];
$password = $_POST['password'];


session_start();
require_once 'API_User.php';

$API = new API_User;

if($API->Login($user,$password)){
    $_SESSION['user'] = $user;
    return true;
}


?>