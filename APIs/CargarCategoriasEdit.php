<?php
require_once 'API_Prod.php';
$API = new API_Prod;
$API->LoadCategoriaEdit($_GET['cat']);
    
?>