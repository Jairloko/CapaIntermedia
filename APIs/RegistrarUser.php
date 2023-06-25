<?php
    //iniciamos la sesion
    session_start();

    $nombre = $_POST['nombre'];
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $file = $_FILES['imagen'];

    //We get all of the file data
    $fileName = $_FILES['imagen']['name'];
    $fileTmpName = $_FILES['imagen']['tmp_name'];
    $fileSize = $_FILES['imagen']['size'];
    $fileError = $_FILES['imagen']['error'];
    $fileType = $_FILES['imagen']['type'];

    //We separate the extension of the file name name . jpg
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    //We type the allowed extensions
    $allowed = array('jpg', 'jpeg', 'png');

    //If the extension is allowed
    if(in_array($fileActualExt, $allowed)){
        //We check if there were any errors with the file upload
        if($fileError === 0){
            $random = rand();
            //We make the name of the file unique
            $fileNameNew = "profile" . $user  . "." .$fileActualExt;

            //We select the place to upload it
            $fileDestintion = 'Img/Users/' . $fileNameNew;

            //We upload the file
            move_uploaded_file($fileTmpName, $fileDestintion);
           
        }else{
            echo "There was an error uploading your file";
        }
    }else{
        echo "Wrong type of file";
    }

    


    $fecha = $_POST['fecha'];
    $fechaSQL = date("Y-m-d", strtotime($fecha));

    if($_POST['genero'] == 1){
        $sexo = 'm';
    }else{
        $sexo = 'f';
    }

    
    if($_POST['rol'] == 1){
        $rol = 'v';
    }else{
        $rol = 'c';
    }

    if(isset($_POST['privado'])){
        $privado = 1;
    }else{
        $privado = 0;
    }

    $conn = new mysqli('localhost', 'root', '', 'tienda_online');

    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection failed: " . $conn->connect_error);
    }else {
       $sql ="Insert into usuarios (Username,Nombre,Email,Password,Nacimiento,Sexo,Rol,Privado,Imagen) 
       Values ('$user', '$nombre', '$email','$password', '$fechaSQL', '$sexo', '$rol', '$privado', '$fileDestintion')" ;

       if($conn->query($sql) === TRUE){
        $_SESSION["user"] = $user;
        echo $_SESSION["user"];
       }
    }   

    $conn->close();
?>