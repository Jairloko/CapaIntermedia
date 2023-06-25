<?php
// Create connection
class ConectionDB{
   function connect(){
    $conn =  new mysqli("localhost", "root", "","tienda_online");
    return $conn;
   }
}


?>