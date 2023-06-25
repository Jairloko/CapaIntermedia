<?php

require_once 'API_Lista.php';
    $productosLista = new API_Lista;
    $productosLista->LoadProductosLista($_GET['listaName']);

?>