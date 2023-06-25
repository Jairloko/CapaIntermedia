<?php
session_start();
require_once 'API_Prod.php';
    $productosUser = new API_Prod;
    $productosUser->LoadProductosAdmin();

?>