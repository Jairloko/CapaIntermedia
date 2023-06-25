<?php

include_once 'ConexionBD.php';

class API_User extends ConectionDB{
    function Login($username,$pass){
       
        $users = array();
        $sql = $this->connect()->query("select * from usuarios where Username='".$username."' And Password='".$pass."'");
        if($row = $sql->fetch_object()){   
            $_SESSION['user'] = $username;  
            echo $_SESSION['user'];     
        }else{
            echo 'false';
        }
        $this->connect()->close();
        
    }

    function LoadPerfilUser($username){
        //global $conn;
        $perfil = '';
        $sql = $this->connect()->query("select * from usuarios where Username='".$username."'");
        if($row = $sql->fetch_object()){
            $perfil ='<div class="text-center">
            <img src="'.$row->Imagen.'" alt="image" class="img-fluid">
            <h2 class="my-3" id="userName">'.$row->Username.' </h2>
            </div>
            <div class="mx-2">';

            if($row->Rol =='a'){
              $perfil .='<div class="text-center">
                           <button type="button" class="btn btn-outline-secondary w-100 mt-3" id="mostrarProductosAdmin">Mostrar todos los productos</button>      
                          </div></div>';
            }else{
              $perfil .=' <p class="fs-5 ms-4 mt-3 mb-1">Listas de Compras</p>
              <div class="text-center mb-2">
                <select name="lista" id="lista" class="form-select">
  
                </select>
                <!--Modal-->
                <button type="button" class="btn btn-primary w-50 my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear lista</button>
                <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva lista</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
    
                        <form method="POST" action="APIs/NuevaLista.php" id="formNewList">
                          <div class="mb-3">
                            <label for="nombreLista" class="col-form-label">Nombre de la lista</label>
                            <input type="text" class="form-control" id="nombreLista" name="nombreLista">
                          </div>
                          <div class="mb-3">
                            <label for="descripcionLista" class="col-form-label">Descripción</label>
                            <textarea class="form-control" id="descripcionLista" name="descripcionLista"></textarea>
                          </div>
                          <div class="mb-3">
                            <label for="imagenLista" class="form-label">Imagen de Lista</label>
                            <input type="file" class="form-control" name="imagenLista" id="imagenLista">
                          </div>
                          <div class="mb-3">
                            <input class="form-check-input" type="checkbox" value="" id="privado" name="privado">
                            <label class="form-check-label" for="privado">
                              Privado
                            </label>
                          </div>
                          
                        </form>
    
    
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" form="formNewList" class="btn btn-primary"  data-bs-dismiss="modal">Crear</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>';
              if($row->Rol =='v'){
                $perfil .='  <div class="text-center">
                <button type="button" class="btn btn-outline-secondary w-100 mt-3" id="mostrarProductos">Mostrar productos</button>
                <button type="button" class="btn btn-primary w-50 my-3" data-bs-toggle="modal" data-bs-target="#addProd">Agregar producto</button>
                  <div class="modal fade text-center" id="addProd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="addProdLabel">Nuevo producto</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action="APIs/NuevoProducto.php" id="formNewProd">
                            <div class="mb-3">
                              <label for="nombreProd" class="col-form-label">Nombre del producto</label>
                              <input type="text" class="form-control" id="nombreProd" name="nombreProd" required>
                            </div>
                            <div class="mb-3">
                              <label for="descripcionProd" class="col-form-label">Descripción</label>
                              <textarea class="form-control" id="descripcionProd" name="descripcionProd" required></textarea>
                            </div>
                            <div class="mb-3">
                              <label for="categoriaProd" class="col-form-label">Categoria</label>
                              <select name="categoriaProd" id="categoriaProd" class="form-select" >
                               
                                     
                              </select>
                              <button type="button" class="btn btn-primary w-75 mt-3" id="newCategoria">Agregar Categoria</button>
                            </div>
                            <div class="mb-3">
                              <label for="file1" class="col-form-label">Imagen #1</label>
                              <input type="file" class="form-control" id="file1" name="file1" multiple required>
                            </div>
                            <div class="mb-3">
                              <label for="file2" class="col-form-label">Imagen #2</label>
                              <input type="file" class="form-control" id="file2" name="file2" multiple required>
                            </div>
                            <div class="mb-3">
                              <label for="file3" class="col-form-label">Imagen #3</label>
                              <input type="file" class="form-control" id="file3" name="file3" multiple required>
                            </div>
                            <div class="mb-3">
                              <label for="fileV" class="col-form-label">Video</label>
                              <input type="file" class="form-control" id="fileV" name="fileV" multiple required>
                            </div>
                            <div class="mb-3">
                              <label for="cantidadProd" class="col-form-label">Cantidad</label>
                              <input type="number" class="form-control" id="cantidadProd" name="cantidadProd" min="1" required>
                            </div>
                            <div class="mb-3">
                              <label for="cotizar" class="form-check-label"><input type="checkbox" class="form-check-input me-1" id="cotizar" name="cotizar">Cotizar</label>
                            </div>
                            <div class="mb-3"  id="precio">
                              <label for="precioProd" class="col-form-label">Precio</label>
                              <input type="number" class="form-control" id="precioProd" name="precioProd" min="1">
                            </div>
                            
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                          <button type="submit" form="formNewProd" class="btn btn-primary"  >Agregar</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>';
              }
              $perfil .='<button type="button" class="btn btn-outline-secondary w-100 mt-3" id="mensajes">Mostrar mensajes</button>
              </div>';
            }


           
               
           
        }

     

       echo $perfil;
        $this->connect()->close();
    }

    function LoadPerfilUserVendedor($username){
      $u = $username;
        $perfil = '';
        $sql = $this->connect()->query("select * from usuarios where Username='".$username."'");
        if($row = $sql->fetch_object()){
            $perfil ='<div class="text-center">
            <img src="'.$row->Imagen.'" alt="image" class="img-fluid">
            <h2 class="my-3">'.$row->Username.' </h2>
            </div>';

            if($row->Privado == 1){
                $perfil .= '<div class="text-center"><i class="bi bi-lock fs-3 "></i> <br> <h3>Este perfil es privado</h3></div>';
            }
            else{
                $perfil .='<div class="mx-2">
                <p class="fs-5 ms-4">Listas de Compras</p>
                <div class="text-center">
                  <select name="lista" id="lista" class="form-select">
                    
                  </select>
                 
                  
                  
                </div>';
                if($row->Rol == 'v'){
                    $perfil .='<div class="text-center">
                    <button type="button" class="btn btn-outline-secondary w-100 mt-3" id="MostrarProd" onclick=mostrarProductos("'.$u.'")>Mostrar productos</button>
                    
                      
                  </div>     
      
                  
                </div>';
                }
            }
          
            echo $perfil;
        }
        $this->connect()->close();
    }

    function LoadPerfilUserModal($username){
        //global $conn;
        $actualizar = '';
        $sql = $this->connect()->query("select * from usuarios where Username='".$username."'");
        if($row = $sql->fetch_object()){
            $actualizar ='
            <form id="formC" method="POST" action="APIs/ActualizarUser.php">
                <div class="mb-3">
                    <label for="newnombreUser" class="col-form-label">Nombre</label>
                    <input type="text" class="form-control" id="newnombreUser" name="newnombreUser" value="'.$row->Nombre.'">
                </div>
                <div class="mb-3">
                    <label for="newemailUser" class="col-form-label">Email</label>
                    <input type="text" class="form-control" id="newemailUser" name="newemailUser" value="'.$row->Email.'">
                </div>
                <div class="mb-3">
                    <label for="newusaernameUser" class="col-form-label">Usuario</label>
                    <input type="text" class="form-control" id="newusaernameUser" name="newusaernameUser" value="'.$row->Username.'">
                </div>
                <div class="mb-3">
                    <label for="newnacimientoUser" class="col-form-label">Nacimiento</label>
                    <input type="date" class="form-control" id="newnacimientoUser" name="newnacimientoUser" value="'.$row->Nacimiento.'">
                </div>
                <div class="mb-3">
                    <label for="newimagenUser" class="col-form-label">Imagen</label>
                    <input type="file" class="form-control" id="newimagenUser" name="newimagenUser">
                </div>';

            if($row->Sexo =="m"){
                $actualizar .=' 
                <div class="mb-3">
                    <label for="newgeneroUser" class="col-form-label">Genero</label>
                    <select class="form-select" id="newgeneroUser" name="newgeneroUser">
                                <option value="1" selected>Hombre</option>
                                <option value="2">Mujer</option>
                    </select>
                </div>';
            }else{
                $actualizar .=' 
                <div class="mb-3">
                    <label for="newgeneroUser" class="col-form-label">Genero</label>
                    <select class="form-select" id="newgeneroUser" name="newgeneroUser">
                                <option value="1" >Hombre</option>
                                <option value="2" selected>Mujer</option>
                    </select>
                </div>';
            }

            if($row->Rol =="v"){
                $actualizar .=' 
                <div class="mb-3">
                    <label for="newrolUser" class="col-form-label">Rol</label>
                    <select class="form-select" id="newrolUser" name="newrolUser">
                        <option value="1" selected>Vendedor</option>
                        <option value="2">Cliente</option>
                    </select>
                </div>';
            }else{
                $actualizar .=' 
                <div class="mb-3">
                    <label for="newrolUser" class="col-form-label">Rol</label>
                    <select class="form-select" id="newrolUser" name="newrolUser">
                        <option value="1" >Vendedor</option>
                        <option value="2" selected>Cliente</option>
                    </select>
                </div>';
            }

            if($row->Privado == 1){
                $actualizar .=' 
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="newprivadoUser" name="newprivadoUser" checked>
                    <label class="form-check-label" for="newprivadoUser">
                     Privado
                    </label>
                </div>';
            }else{
                $actualizar .=' 
                <div class="mb-3">
                    <input class="form-check-input" type="checkbox" value="" id="newprivadoUser" name="newprivadoUser">
                    <label class="form-check-label" for="newprivadoUser">
                     Privado
                    </label>
                </div>';
            } 

            $actualizar .=' </form>';

            echo $actualizar;
        }
        $this->connect()->close();
    }

    function UpdateUser(){
        session_start();
        $name = $_POST['newnombreUser'];
        $email = $_POST['newemailUser'];
        $usuario = $_POST['newusaernameUser'];
        $nacimiento = $_POST['newnacimientoUser'];
        if($_POST['newgeneroUser'] == 1){
            $sexo = 'm';
        }else{
            $sexo = 'f';
        }   
        if($_POST['newrolUser'] == 1){
            $rol = 'v';
        }else{
            $rol = 'c';
        }
        if(isset($_POST['newprivadoUser'])){
            $privado = 1;
        }else{
            $privado = 0;
        }
        
       

        if($_FILES['newimagenUser']['name'] != ''){
            
            $sql = "update usuarios set Nombre='".$name."', Email='".$email."', Username='".$usuario."', Nacimiento='".$nacimiento."', Sexo='".$sexo."', Rol='".$rol."', Privado=".$privado.", Imagen='Img/Users/".Image('newimagenUser')."' where Username='".$_SESSION['user']."'";
            if($this->connect()->query($sql)  === TRUE ){
                echo 'true';
            }else{
                echo 'false';
            }
           
           
        }else{
            $sql = "update usuarios set Nombre='".$name."', Email='".$email."', Username='".$usuario."', Nacimiento='".$nacimiento."', Sexo='".$sexo."', Rol='".$rol."', Privado=".$privado." where Username='".$_SESSION['user']."'";
            if($this->connect()->query($sql)  === TRUE  ){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        $this->connect()->close();
        $_SESSION['user']=$usuario;


    }


    //Pedidos
    function LoadPedidosUser($username){
      $sqlPedidos = $this->connect()->query("Select * from Pedido where Username = '".$username."'");
      $ped ='';
      $row_cnt = $sqlPedidos->num_rows;
      if($row_cnt>0){
        while($rowPedidos = $sqlPedidos->fetch_object()){
          $sqlCatProd = $this->connect()->query("Select Categoria from Producto where NombreProducto = '".$rowPedidos->NombreProducto."'");
          $reCatProd = $sqlCatProd->fetch_object();
          $ped .='<div class="row row-cols-1 row-cols-lg-5  mb-4 pt-2 border-bottom py-2 mb-2 text-center d-flex align-items-center">
            <div class="col">
              <p class="fs-5">'.$rowPedidos->NombreProducto.'</p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Categoria: '.$reCatProd->Categoria.' </p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Fecha: '.$rowPedidos->Fecha.'</p>
            </div>
            <div class="col"> 
              <p>$'.$rowPedidos->Precio.'</p>
            </div>
            <div class="col">';
             
            if($rowPedidos->Calificacion != -1){
              $ped .=' <div>';
              for($i = 1; $i<6; $i++){
                if($i<=$rowPedidos->Calificacion)
                  $ped .='<i class="bi bi-star-fill"></i>';
                else
                  $ped .='<i class="bi bi-star"></i>';
              }
              $ped .='</div>';
            }else{
              $ped .='Sin calificación';
            }
            $ped .='</div>
          </div>';
        }
      }
      else{
        $ped ='<div class="w-100 py-3 text-center"><h2>No hay pedidos</h2></div>';
      }




      echo $ped;
      $this->connect()->close();
    }

    function LoadPedidosUserFiltros($username,$fechaI,$fechaF,$cat){
      $sql = "Select * from Pedido where Username = '".$username."' ";
      if($fechaI != ''){
        $sql .="and Fecha>='".$fechaI."' " ;
      }
      if($fechaF != ''){
        $fe = $fechaF.' 23:59:59';
        $sql .="and Fecha<='".$fe."'  " ;
      }
      if($cat != ''){
        $sql .="and Categoria<='".$cat."' " ;
      }
      $sqlPedidos = $this->connect()->query($sql);
      $ped ='';
      $row_cnt = $sqlPedidos->num_rows;
      if($row_cnt>0){
        while($rowPedidos = $sqlPedidos->fetch_object()){
          $sqlCatProd = $this->connect()->query("Select Categoria from Producto where NombreProducto = '".$rowPedidos->NombreProducto."'");
          $reCatProd = $sqlCatProd->fetch_object();
          $ped .='<div class="row row-cols-1 row-cols-lg-5  mb-4 pt-2 border-bottom py-2 mb-2 text-center d-flex align-items-center">
            <div class="col">
              <p class="fs-5">'.$rowPedidos->NombreProducto.'</p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Categoria: '.$reCatProd->Categoria.' </p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Fecha: '.$rowPedidos->Fecha.'</p>
            </div>
            <div class="col"> 
              <p>$'.$rowPedidos->Precio.'</p>
            </div>
            <div class="col">';
             
            if($rowPedidos->Calificacion != -1){
              $ped .=' <div>';
              for($i = 1; $i<6; $i++){
                if($i<=$rowPedidos->Calificacion)
                  $ped .='<i class="bi bi-star-fill"></i>';
                else
                  $ped .='<i class="bi bi-star"></i>';
              }
              $ped .='</div>';
            }else{
              $ped .='Sin calificación';
            }
            $ped .='</div>
          </div>';
        }
      }else{
        $ped ='<div class="w-100 py-3 text-center"><h2>No hay pedidos</h2></div>';
      }
     echo $ped;
      $this->connect()->close();
    }

    //Ventas
    function LoadVentasUser($username){
      $sqlVentas = $this->connect()->query("Select * from Venta where Username = '".$username."'");
      $ped ='';
      $row_cnt = $sqlVentas->num_rows;
      if($row_cnt>0){
        while($rowVentas = $sqlVentas->fetch_object()){
          $sqlCatProd = $this->connect()->query("Select Categoria,Cantidad from Producto where NombreProducto = '".$rowVentas->NombreProducto."'");
          $reCatProd = $sqlCatProd->fetch_object();
          $ped .='<div class="row row-cols-1 row-cols-lg-5  mb-4 pt-2 border-bottom py-2 mb-2 text-center d-flex align-items-center">
            <div class="col">
              <p class="fs-5">'.$rowVentas->NombreProducto.'</p>
              <p class="d-flex justify-content-start align-items-center ">Categoria: '.$reCatProd->Categoria.' </p>
            </div>
            <div class="col">
              <p class="fs-5">Existencias: '.$reCatProd->Cantidad.'</p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Fecha: '.$rowVentas->Fecha.'</p>
            </div>
            <div class="col"> 
              <p>$'.$rowVentas->Precio.'</p>
            </div>
            <div class="col">';
             
            if($rowVentas->Calificacion != -1){
              $ped .=' <div>';
              for($i = 1; $i<6; $i++){
                if($i<=$rowVentas->Calificacion)
                  $ped .='<i class="bi bi-star-fill"></i>';
                else
                  $ped .='<i class="bi bi-star"></i>';
              }
              $ped .='</div>';
            }else{
              $ped .='Sin calificación';
            }
            $ped .='</div>
          </div>';
        }
      }
      else{
        $ped ='<div class="w-100 py-3 text-center"><h2>No hay ventas</h2></div>';
      }




      echo $ped;
      $this->connect()->close();
    }
  
    function LoadVentasUserFiltrosD($usernameV,$fechaIV,$fechaFV,$catV){
      $sql = "Select * from Venta where Username = '".$usernameV."' ";
      if($fechaIV != ''){
        $sql .="and Fecha>='".$fechaIV."' " ;
      }
      if($fechaFV != ''){
        $fe = $fechaFV.' 23:59:59';
        $sql .="and Fecha<='".$fe."'  " ;
      }
      if($catV != ''){
        $sql .="and Categoria<='".$catV."' " ;
      }
      $sqlVentas = $this->connect()->query($sql);
      $ped ='';
      $row_cntV = $sqlVentas->num_rows;
      if($row_cntV > 0){
        while($rowVentas = $sqlVentas->fetch_object()){
          $sqlCatProd = $this->connect()->query("Select Categoria,Cantidad from Producto where NombreProducto = '".$rowVentas->NombreProducto."'");
          $reCatProd = $sqlCatProd->fetch_object();
          $ped .='<div class="row row-cols-1 row-cols-lg-5  mb-4 pt-2 border-bottom py-2 mb-2 text-center d-flex align-items-center">
            <div class="col">
              <p class="fs-5">'.$rowVentas->NombreProducto.'</p>
              <p class="d-flex justify-content-start align-items-center ">Categoria: '.$reCatProd->Categoria.' </p>
            </div>
            <div class="col">
              <p class="fs-5">Existencias: '.$reCatProd->Cantidad.'</p>
            </div>
            <div class="col">
              <p class="d-flex justify-content-start align-items-center ">Fecha: '.$rowVentas->Fecha.'</p>
            </div>
            <div class="col"> 
              <p>$'.$rowVentas->Precio.'</p>
            </div>
            <div class="col">';
             
            if($rowVentas->Calificacion != -1){
              $ped .=' <div>';
              for($i = 1; $i<6; $i++){
                if($i<=$rowVentas->Calificacion)
                  $ped .='<i class="bi bi-star-fill"></i>';
                else
                  $ped .='<i class="bi bi-star"></i>';
              }
              $ped .='</div>';
            }else{
              $ped .='Sin calificación';
            }
            $ped .='</div>
          </div>';
        }
      }else{
        $ped ='<div class="w-100 py-3 text-center"><h2>No hay pedidos</h2></div>';
      }
     echo $ped;
      $this->connect()->close();
    }

    function LoadVentasUserFiltrosA($usernameV,$month,$year,$catV){
      $sql = "Select Categoria, Count(Categoria) as Ventas, CONCAT(MONTH(Fecha),'-',YEAR(Fecha)) as Fecha  from venta where Username = '".$usernameV."' ";
      if($month != ''){
        $sql .="and MONTH(Fecha)=".$month." " ;
      }
      if($year != ''){
        $sql .="and YEAR(Fecha)=".$year."  " ;
      }
      if($catV != ''){
        $sql .="and Categoria ='".$catV."' " ;
      }
      
      $sqlVentas = $this->connect()->query($sql);
      $ped ='';

        while($row_cntV = $sqlVentas->fetch_object()){
          if($row_cntV->Categoria == ''){
            $ped ='<div class="w-100 py-3 text-center"><h2>No hay pedidos</h2></div>';
            break;
          }
          $ped .='<div class="row row-cols-1 row-cols-lg-3  mb-4 pt-2 border-bottom py-2 mb-2 text-center d-flex align-items-center">
            <div class="col text-center">
              <p class="fs-5">Fecha: '.$row_cntV->Fecha.' </p>
            </div>
            <div class="col text-center">
              <p class="fs-5">Categoria: '.$row_cntV->Categoria.'</p>
            </div>
            <div class="col text-center">
              <p class="fs-5">Ventas: '.$row_cntV->Ventas.'</p>
            </div> 
          </div>';
        }
    
     echo $ped;
      $this->connect()->close();
    }

}

function Image($image){
    $file = $_FILES[$image];

            //We get all of the file data
            $fileName = $_FILES[$image]['name'];
            $fileTmpName = $_FILES[$image]['tmp_name'];
            $fileSize = $_FILES[$image]['size'];
            $fileError = $_FILES[$image]['error'];
            $fileType = $_FILES[$image]['type'];
        
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
                    $fileNameNew = "profile" .$_SESSION['user']."." . $fileActualExt;
        
                    //We select the place to upload it
                    $fileDestintion = '../Img/Users/' . $fileNameNew;
        
                    //We upload the file
                    move_uploaded_file($fileTmpName, $fileDestintion);
                   return $fileNameNew;
                }else{
                    return false;
                }
            }else{
                return false;
            }
}

if(isset($_POST['pedidosFiltros'])){
 session_start();
 $var = New API_User();
 $var->LoadPedidosUserFiltros($_SESSION['user'],$_POST['fechaI'],$_POST['fechaF'],$_POST['cat']);
}

if(isset($_POST['ventasA'])){
  session_start();
  $var = New API_User();
  $var->LoadVentasUserFiltrosA($_SESSION['user'],$_POST['month'],$_POST['year'],$_POST['cat']);
  // echo 'Hola';
 }


if(isset($_POST['ventasFiltrosD'])){
  session_start();
  $var = New API_User();
  $var->LoadVentasUserFiltrosD($_SESSION['user'],$_POST['fechaI'],$_POST['fechaF'],$_POST['cat']);
 }



?>