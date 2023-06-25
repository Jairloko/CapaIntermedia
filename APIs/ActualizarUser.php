<?php

require_once 'API_User.php';

$API = new API_User;

if($API->UpdateUser()){ 
    return true;
}


?>