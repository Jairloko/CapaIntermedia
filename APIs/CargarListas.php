<?php
session_start();
require_once 'API_Lista.php';
    $ListasPerfil = new API_Lista;
    $ListasPerfil->LoadNombreListas($_SESSION["user"]);

?>