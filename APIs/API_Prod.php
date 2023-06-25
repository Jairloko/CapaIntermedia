<?php

include_once 'ConexionBD.php';
include_once 'API_Lista.php';

class API_Prod extends ConectionDB{


    //Perfil
    function NewProd($username){
        $nombreProd = $_POST['nombreProd'];
        $descipcionProd = $_POST['descripcionProd'];
        $categoriaProd = $_POST['categoriaProd'];
        $cantidadProd = $_POST['cantidadProd'];
        $imagen1 = ImagesProd('file1',$username,$nombreProd);
        $imagen2 = ImagesProd('file2',$username,$nombreProd);
        $imagen3 = ImagesProd('file3',$username,$nombreProd);
        $video = ImagesProd('fileV',$username,$nombreProd);

        if(isset($_POST['cotizar'])){
            $cotizarProd = 1;
            if($sql= $this->connect()->query("Insert into Producto(NombreProducto,Descripcion,Categoria,Imagen1,Imagen2,Imagen3,Video,Cotizar,Cantidad,Username) 
            values('$nombreProd','$descipcionProd','$categoriaProd','Img/Productos/".$imagen1."','Img/Productos/".$imagen2."','Img/Productos/".$imagen3."','Img/Productos/".$video."','$cotizarProd','$cantidadProd','$username')") === TRUE){
                echo 'true';
            }else{
                echo 'false';
            }
        }else{
            $precioProd = $_POST['precioProd'];
            if($sql= $this->connect()->query("Insert into Producto(NombreProducto,Descripcion,Categoria,Imagen1,Imagen2,Imagen3,Video,Precio,Cantidad,Username) 
            values('$nombreProd','$descipcionProd','$categoriaProd','Img/Productos/".$imagen1."','Img/Productos/".$imagen2."','Img/Productos/".$imagen3."','Img/Productos/".$video."','$precioProd','$cantidadProd','$username')") === TRUE){
                echo 'true';
            }else{
                echo 'false';
            }
        }
    }

    function LoadProductosUser($username){
        $productos = '<div class="row border-bottom my-4">
        <div class="col text-center">
          <h2 class="">Mis productos</h2>
        </div>
        </div>
        <div id="prodLista">';
        $sql = $this->connect()->query("Select id_producto,Imagen1,NombreProducto,Autorizado,Cantidad from Producto where Username='".$username."' AND Activo=1");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="row row-cols-1 row-cols-xxl-5 border-bottom py-2 mb-2 text-center">
                <div class="col mt-xxl-0">
                  <img src="'.$row->Imagen1.'" class="imagenProdUser">
                </div>
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                    '.$row->NombreProducto.'
                  </span>
                </div>
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                   Estado:';
                   if($row->Autorizado == 0){
                    $productos .= ' <span class="fs-6">Sin Autorizar</span>';
                   }else if($row->Autorizado == 1){
                    $productos .= ' <span class="fs-6">Autorizado</span>';
                   }else{
                    $productos .= ' <span class="fs-6">No Autorizado</span>';
                   }
    
                $productos .= '</span>
                </div>
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                   Disponibles: <span class="fs-6">'.$row->Cantidad.'</span> 
                  </span>
                </div>
                <div class="col my-3  my-xxl-0 d-flex align-self-center flex-column"> 
                  <button class="btn btn-secondary w-100 mb-3" id="EditProd" Producto="'.$row->id_producto.'" onclick=traerDataProd('.$row->id_producto.')>Editar</button>
                  <button class="btn btn-danger w-100" Producto="'.$row->id_producto.'" onclick=eliminarProd('.$row->id_producto.')>Eliminar</button>
                </div>
            </div>';   
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
        
       

        $productos .= '</div>';
        echo $productos;
        $this->connect()->close();

    }

    function LoadProductosAdmin(){
        $productos = '<div class="row border-bottom my-4">
        <div class="col text-center">
          <h2 class="">Productos por autorizar</h2>
        </div>
        </div>
        <div id="prodLista">';
        $sql = $this->connect()->query("Select id_producto,Imagen1,NombreProducto,Username from Producto where Autorizado=0 AND Activo=1 Order By Username");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="row row-cols-1 row-cols-xxl-4 border-bottom py-2 mb-2 text-center">
                <div class="col mt-xxl-0">
                  <img src="'.$row->Imagen1.'" class="imagenProdUser">
                </div>
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                    '.$row->NombreProducto.'
                  </span>
                </div>
                
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                   Usuario: <span class="fs-6">'.$row->Username.'</span> 
                  </span>
                </div>
                <div class="col my-3  my-xxl-0 d-flex align-self-center flex-column"> 
                  <button class="btn btn-success w-100 mb-3" id="Autorizar" Producto="'.$row->id_producto.'" onclick=autorizarProd('.$row->id_producto.')>Autorizar</button>
                  <button class="btn btn-danger w-100" Producto="'.$row->id_producto.'" onclick=cancelarProd('.$row->id_producto.')>Cancelar</button>
                </div>
            </div>';   
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
        
       

        $productos .= '</div>';
        echo $productos;
        $this->connect()->close();

    }

    function LoadContentProdUpdate($id){
        $productoEdit ='<div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="contentModalEditProd2">           
                        <form method="POST" action="APIs/ActualizarProd.php" id="formEditProd">';   
        $sql = $this->connect()->query("Select id_producto,NombreProducto,Descripcion,Categoria,Imagen1,Imagen2,Imagen3,Video,Cotizar,Precio,Cantidad from Producto where id_producto = ".$id."");
        
        if($row = $sql->fetch_object()){
            $productoEdit .= '<div class="mb-3">
            <label for="nombreProdEdit" class="col-form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombreProdEdit" name="nombreProdEdit" value="'.$row->NombreProducto.'">
          </div>
          <div class="mb-3" hidden>
            <input type="text" class="form-control" id="idProd" name="idProdEdit" value="'.$row->id_producto.'">
          </div>
          <div class="mb-3">
            <label for="descripcionProdEdit" class="col-form-label">Descripción</label>
            <textarea class="form-control" id="descripcionProdEdit" name="descripcionProdEdit" >'.$row->Descripcion.'</textarea>
          </div>
          <div class="mb-3">
              <label for="categoriaProdEdit" class="col-form-label">Categoria</label>
              <select name="categoriaProdEdit" id="categoriaProdEdit" class="form-select">
                <option value="'.$row->Categoria.'" selected>'.$row->Categoria.'</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="imagen1Edit" class="col-form-label">Imagen 1</label><br>
              <img src="'.$row->Imagen1.'" class="fileProd" alt="">    
          </div>
          <div class="mb-3">
              <label for="imagen2Edit" class="col-form-label">Imagen 2</label><br>
              <img src="'.$row->Imagen2.'" class="fileProd" alt="">  
          </div>
          <div class="mb-3">
              <label for="imagen3Edit" class="col-form-label">Imagen 3</label><br>
              <img src="'.$row->Imagen3.'" class="fileProd" alt="">   
          </div>
          <div class="mb-3">
              <label for="videoEdit" class="col-form-label">Video</label><br>
              <video src="'.$row->Video.'" width="350" height="300" heigth controls></video>
          </div>    
          <div class="mb-3">
              <label for="cantidadProdEdit" class="col-form-label">Cantidad</label>
              <input type="number" class="form-control" id="cantidadProdEdit" name="cantidadProdEdit" min="1"  value="'.$row->Cantidad.'">
          </div>';


          if($row->Cotizar == 1){
            $productoEdit .='<div class="mb-3">
                <label for="cotizarEdit" class="form-check-label"><input type="checkbox" class="form-check-input me-1" id="cotizarEdit" name="cotizarEdit" checked >Cotizar</label>
            </div>
            <div class="mb-3"  id="precioEdit" hidden>
                <label for="precioProdEdit" class="col-form-label">Precio</label>
                <input type="number" class="form-control" id="precioProdEdit" name="precioProdEdit"  value="'.$row->Precio.'">
            </div>';//Falta comprobar lo de cotizar
            
          }
          else{
            $productoEdit .='<div class="mb-3">
                <label for="cotizarEdit" class="form-check-label"><input type="checkbox" class="form-check-input me-1" id="cotizarEdit" name="cotizarEdit">Cotizar</label>
            </div>
            <div class="mb-3"  id="precioEdit">
                <label for="precioProdEdit" class="col-form-label">Precio</label>
                
                <input type="number" class="form-control" id="precioProdEdit" name="precioProdEdit"  value="'.$row->Precio.'">
            </div>';
          }

          $productoEdit .='<div class="mb-3">
              <label for="newimagen1Edit" class="col-form-label">Nueva Imagen 1</label>
              <input type="file" class="form-control" id="newimagen1Edit" name="newimagen1Edit">
          </div>
          <div class="mb-3">
              <label for="newimagen2Edit" class="col-form-label">Nueva Imagen 2</label>
              <input type="file" class="form-control" id="newimagen2Edit" name="newimagen2Edit">
          </div>
          <div class="mb-3">
              <label for="newimagen3Edit" class="col-form-label">Nueva Imagen 3</label>
              <input type="file" class="form-control" id="newimagen3Edit" name="newimagen3Edit">
          </div>
          <div class="mb-3">
              <label for="newvideoEdit" class="col-form-label">Nuevo Video</label>
              <input type="file" class="form-control" id="newvideoEdit" name="newvideoEdit">
          </div>
         </form>    
         </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" >Cancelar</button>
                      <button type="submit" form="formEditProd" class="btn btn-primary"  data-bs-dismiss="modal" >Actualizar</button>
                    </div>'; 
        }  
        
        echo json_encode($productoEdit);
        $this->connect()->close();
        
    }
    
    function UpdateProd($username){
        $idProd = $_POST['idProdEdit'];
        $nombreProd = $_POST['nombreProdEdit'];
        $descipcionProd = $_POST['descripcionProdEdit'];
        $categoriaProd = $_POST['categoriaProdEdit'];
        $cantidadProd = $_POST['cantidadProdEdit'];
        // $imagen1 = ImagesProd('file1',$username,$nombreProd);
        // $imagen2 = ImagesProd('file2',$username,$nombreProd);
        // $imagen3 = ImagesProd('file3',$username,$nombreProd);
        // $video = ImagesProd('fileV',$username,$nombreProd);
        if(isset($_POST['cotizarEdit'])){
            $cotizarProd = 1;
            $precioProd = 0;
        }else{
            $cotizarProd = 0;
            $precioProd = $_POST['precioProdEdit'];
        }

        $sql = "update Producto set NombreProducto='".$nombreProd."', Descripcion='".$descipcionProd."', Categoria='".$categoriaProd."', Cotizar=".$cotizarProd.", Precio=".$precioProd.", Cantidad=".$cantidadProd."";

        if($_FILES['newimagen1Edit']['name'] != ''){
            $newImagen1 = ImagesProd('newimagen1Edit',$username,$nombreProd);
            $sql .= ", Imagen1='Img/Productos/".$newImagen1."'";
        }
        if($_FILES['newimagen2Edit']['name'] != ''){
            $newImagen2 = ImagesProd('newimagen2Edit',$username,$nombreProd);
            $sql .= ", Imagen2='Img/Productos/".$newImagen2."'";
        }
        if($_FILES['newimagen3Edit']['name'] != ''){
            $newImagen3 = ImagesProd('newimagen3Edit',$username,$nombreProd);
            $sql .= ", Imagen3='Img/Productos/".$newImagen3."'";
        }
        if($_FILES['newvideoEdit']['name'] != ''){
            $newVideo = ImagesProd('newvideoEdit',$username,$nombreProd);
            $sql .= ", Video='Img/Productos/".$newVideo."'";
        }
       
        $sql .=" where id_producto = ".$idProd."";

        if($this->connect()->query($sql)  === TRUE ){
            echo 'true';
        }else{
            echo 'false';
        }

        $this->connect()->close();
        

    }

    function DeleteProd($idProd){
       
        $sql = "update Producto set Activo=0 where id_producto = ".$idProd."";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }
    
    function AutorizarProducto($idProd){
       
        $sql = "update Producto set Autorizado=1 where id_producto = ".$idProd."";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }

    function CancelarProducto($idProd){
       
        $sql = "update Producto set Autorizado = 2 where id_producto = ".$idProd."";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }

    //Vendedor

    function LoadProductosUserVendedor($username){
        $productos = '<div class="row border-bottom my-4">
        <div class="col text-center">
          <h2 class="">Productos de '.$username.'</h2>
        </div>
        </div>
        <div id="prodLista">';
        $sql = $this->connect()->query("Select id_producto,Imagen1,NombreProducto,Autorizado,Cantidad from Producto where Username='".$username."' AND Activo=1");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="row row-cols-1 row-cols-xxl-3 border-bottom py-2 mb-2 text-center">
                <div class="col mt-xxl-0">
                  <img src="'.$row->Imagen1.'" class="imagenProdUser">
                </div>
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                    '.$row->NombreProducto.'
                  </span>
                </div>   
                <div class="col d-flex align-items-center mt-3 mt-xxl-0">
                  <span class="w-100 text-center fs-5">
                   Disponibles: <span class="fs-6">'.$row->Cantidad.'</span> 
                  </span>
                </div>
            </div>';   
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
        
       

        $productos .= '</div>';
        echo $productos;
        $this->connect()->close();

    }


    //Main
    function LoadProductosMasVendidos(){
        $productos = '';
        $sql = $this->connect()->query("Select * from Producto where Activo = 1 and Autorizado = 1 Order By Ventas Desc Limit 9");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>
                    
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary px-4">Detalles</a>
                    <button class="btn btn-success px-4" idProd='.$row->id_producto.' id="addCarrito" onClick="addCarrito('.$row->id_producto.')">Agregar</button>
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '<div class="col text-center ">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productos;
        $this->connect()->close();

    }

    function LoadProductosMasPopulares(){
        $productos = '';
        $sql = $this->connect()->query("Select * from Producto where Activo = 1 and Autorizado = 1 Order By Valoracion Desc Limit 9");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>
                   
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary px-4">Detalles</a>
                    <button class="btn btn-success px-4" idProd='.$row->id_producto.' id="addCarrito" onClick="addCarrito('.$row->id_producto.')">Agregar</button>
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productos;
        $this->connect()->close();

    }

    function LoadProductos(){
        $productos = '';
        $sql = $this->connect()->query("Select * from Producto where Activo = 1 and Autorizado = 1 Order By RAND() Desc Limit 8");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item mt-4">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="d-flex  align-items-center">
                        <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>
                    
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary px-4">Detalles</a>
                    <button class="btn btn-success px-4" idProd='.$row->id_producto.' id="addCarrito" onClick="addCarrito('.$row->id_producto.')">Agregar</button>
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productos;
        $this->connect()->close();

    }




    //Pagina Producto

    function LoadFilesProd($idProd){
        $producto ='';
        $sql =  $this->connect()->query("Select * from Producto where id_producto=".$idProd."");


        while($row = $sql->fetch_object()){
                $producto .= '
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="false">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner" id="imgCarousel">
                <div class="carousel-item active">
                <img src="'.$row->Imagen1.'" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="'.$row->Imagen2.'" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="'.$row->Imagen3.'" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <video  src="'.$row->Video.'" class="d-block w-100" controls></video>              
                </div>
                </div>
                <button class="carousel-control-prev h-75" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next h-75" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
                </button>
            </div> ';
         }
        echo $producto;
        $this->connect()->close();
    }

    function LoadDataProd($idProd){
        $producto ='';
        $sql =  $this->connect()->query("Select * from Producto where id_producto =".$idProd."");


        while($row = $sql->fetch_object()){
            $producto .= ' <!--Nombre, descripcion y precio-->
            <h4 class="border-bottom" id="nameProd" idprod='.$idProd.'>'.$row->NombreProducto.'</h4>
            <h6>'.$row->Descripcion.'</h6>';
            if($row->Cotizar == 1){
                $producto .= ' <h5 id="precioProd">Desconocido</h5>';
                $hidden = 'hidden';
            }
            else{
                $producto .= ' <h5 id="precioProd">$'.$row->Precio.'</h5>';
                $hidden = '';
            }
                
      
            $producto .= ' <!-- Detalles-->
            <h4 class="my-3">Detalles del producto</h4>
            <h6>-Vendedor: <a href="PerfilVendedor.php?user='.$row->Username.'" id="vendedor">'.$row->Username.'</a></h6>
            <h6>-Categoria: '.$row->Categoria.'</h6>
            <h6>-Existencias: '.$row->Cantidad.'</h6>
            <!--Valoracion-->
            <p class="mt-4 mb-0">Valoracion</p>
            <div>';

            for($i = 0; $i<5; $i++){
                if($i < $row->Valoracion)
                    $producto .= '<i class="bi bi-star-fill"></i>';
                else
                    $producto .= '<i class="bi bi-star"></i>';
            }
            $producto .= '<br>
            <div class="mt-3" '.$hidden.'><input type="number" class="form-control w-25" id="cantidad" min=1 value = 1></div> </div>';
           
            } 

            echo $producto;
        $this->connect()->close();
    }
    
    function LoadProductosVendedor($idProdUser){
        $productos = '';
        $sql = $this->connect()->query("select * from Producto where Activo = 1 and Username = (Select Username from Producto where id_producto = ".$idProdUser.") Order By RAND() Desc Limit 8");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>                 
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>   
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '<div class="col text-center">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productos;
        $this->connect()->close();

    }

    //Pagina busqueda Productos

    function LoadProductosBusqueda($b){
        $productos = '';
        $sql = $this->connect()->query("Select * from Producto where Username Like '%".$b."%' Or NombreProducto Like '%".$b."%' Or Categoria Like '%".$b."%'");

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item mt-4">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="d-flex  align-items-center">
                        <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>
                    
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary px-4">Detalles</a>
                    <button class="btn btn-success px-4" idProd='.$row->id_producto.' id="addCarrito" onClick="addCarrito('.$row->id_producto.')">Agregar</button>
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '<div class="col text-center py-5 w-100">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productos;
        $this->connect()->close();

    }

    function LoadProductosBusquedaFiltros(){
        $cat = $_POST['categoria'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        $ord = $_POST['ordenar'];
        $b = $_POST['b'];
        $productos = '';
        $query = "Select * from Producto where CONCAT(Username,' ',NombreProducto) Like '%".$b."%' ";
        if($cat != 'Selecciona una Categoria')
            $query .= " And Categoria = '".$cat."'";
        if($min != '')
            $query .= " And Precio >= ".$min."";
        if($max != '')
            $query .= " And Precio <= ".$max."";

        switch($ord){
            case 'Predeterminado':    
                break;
            case 'precioMB':  
                $query .= " Order By Precio Asc";
                break;
            case 'precioMA':  
                $query .= " Order By Precio Desc";
                break;
            case 'calfMB':  
                $query .= " Order By Valoracion Asc";
                break;
            case 'calfMA':  
                $query .= " Order By Valoracion Desc";
                break;
        }
        $sql = $this->connect()->query($query);

        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $productos .= '<div class="item mt-4">
                <div class="card border-0 shadow">
                <img src="'.$row->Imagen1.'" class="card-img-top">
                <div class="card-body">
                <h4 class="card-tittle">'.$row->NombreProducto.'</h4>
                <h6 class="card-text Descrip">'.$row->Descripcion.'</h6>';

                if($row->Cotizar == 1){
                    $productos .='<p class="card-text">Desconocido</p>
                    <div class="d-flex  align-items-center">
                        <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary w-100">Detalles</a>
                    
                    </div>
                    </div>
                    </div>
                    </div>';
                }else{
                    $productos .='<p class="card-text">$'.$row->Precio.'</p>
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="Producto.php?id='.$row->id_producto.'" class="btn btn-secondary px-4">Detalles</a>
                    <button class="btn btn-success px-4" idProd='.$row->id_producto.' id="addCarrito" onClick="addCarrito('.$row->id_producto.')">Agregar</button>
                    </div>
                    </div>
                    </div>
                    </div>';
                }
                
            }
        }else{
            $productos .= '';
        }
 
        echo json_encode($productos);
        $this->connect()->close();

    }




    //Carrito

    function AddProdCar($idProd, $cantidadProd, $username){
      
        if($sql= $this->connect()->query("Select * from Carrito where Username = '".$username."' and id_producto = ".$idProd."")){
            $row_cnt = $sql->num_rows;
            if($row_cnt == 0){
                if($sql= $this->connect()->query("Insert into Carrito(cantidad,Username,id_producto) Values(".$cantidadProd.",'".$username."', ".$idProd.")") === TRUE){
                    $re ='true';
                }else{
                    $re ='false';
                }
                echo json_encode($re);
                $this->connect()->close();
            }else{
                if($sql= $this->connect()->query("Update Carrito set cantidad = cantidad + ".$cantidadProd." where Username = '".$username."' and id_producto = ".$idProd."") === TRUE){
                    $re ='true';
                }else{
                    $re ='false';
                }
                echo json_encode($re);
                $this->connect()->close();
            }
        }

        
    }
   
    function LoadCarrito($username){
        $u = $username;
        $productosCar = '';
        $sql = $this->connect()->query("select * from Carrito where Username = '".$username."'");
        $totalGnl=0;
        $row_cnt = $sql->num_rows;
        if($row_cnt > 0){
            while($row = $sql->fetch_object()){
                $sql2 = $this->connect()->query("select * from Producto where id_producto = ".$row->id_producto."");
                if($row2 = $sql2->fetch_object()){
                    $productosCar .= '<div class="row row-cols-1 row-cols-md-1 row-cols-xxl-5 border-bottom border-top py-2 mb-2 text-center">
                        <div class="col">
                            <img src="'.$row2->Imagen1.'">
                        </div>
                        <div class="col align-middle">
                            <p class="fs-5">'.$row2->NombreProducto.'</p>
                            <div class="d-flex justify-content-around">
                                <label for="tipoLista" class="col-form-label">Cantidad</label>
                                <input class="form-control w-25" type="number" min="1" value="'.$row->cantidad.'" onChange="cambiarCantidad(this)" idProd ='.$row2->id_producto.'>
                            </div>
                        </div>
                        <div class="col">
                            <p class="fs-5">Precio</p>
                            <p class="fs-6">$'.$row2->Precio.'</p>
                        </div>';

                        $total = $row->cantidad * $row2->Precio;
                        $productosCar .= '
                        <div class="col">
                            <p class="fs-5">Total</p>
                            <p class="fs-6" id="totalProd">$'.$total.'</p>
                        </div>
                        <div class="col"><button class="btn btn-danger w-100" onClick="deleteProdCar('.$row->id_producto.')">Eliminar</button></div>
                    </div>';
                    $totalGnl= $totalGnl + $total;
                }  
                             
            }

            $productosCar .= "<div class='w-100 text-end my-3'>
                Total de la compra: $".$totalGnl."
                <button class='btn ms-5 btn-success px-5' onclick=PagarCarrito('$u')>Pagar</button>

                </div>";  
        }else{
            $productosCar .= '<div class="col text-center py-5">
            <h3 >No hay productos por mostrar</h3>
            </div>';
        }
 
        echo $productosCar;
        $this->connect()->close();
    }

    function DeleteProdCar($idProd,$username){
       
        $sql = "Delete From Carrito where Username = '".$username."' and id_producto=".$idProd."";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }

    function UpdateProdCar($idProd,$cantidadProd,$username){
       
        $sql = "Update Carrito set cantidad = ".$cantidadProd." where Username = '".$username."' and id_producto=".$idProd."";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }
    
    function ConfirmarCompra($user){
        $re='';
        $carritoSql = $this->connect()->query("select * from Carrito where Username = '".$user."'");
        while($rowCarrito = $carritoSql->fetch_object()){
            $prodSql = $this->connect()->query("select * from Producto where id_producto = ".$rowCarrito->id_producto."");
            $rowProd = $prodSql->fetch_object();
            if($rowCarrito->cantidad > $rowProd->Cantidad){
                echo $rowProd->NombreProducto;
                $this->connect()->close();   
                break; 
            }else{
                $totalVenta = $rowProd->Precio * $rowCarrito->cantidad;
               if($ventaSql= $this->connect()->query("Insert into 
               Venta(Username,NombreProducto,Categoria,Precio,Existencia)
               Values('".$rowProd->Username."', '".$rowProd->NombreProducto."','".$rowProd->Categoria."',".$totalVenta.",".$rowProd->Cantidad.")") === TRUE){
                $sqlIdVenta = $this->connect()->query("select id_venta from Venta ORDER BY id_venta DESC Limit 1");
                $reIdVenta = $sqlIdVenta->fetch_object();
                if($pedidoSql= $this->connect()->query("Insert into 
                Pedido(Username,NombreProducto,Categoria,Precio,id_venta)
                Values('".$user."', '".$rowProd->NombreProducto."','".$rowProd->Categoria."',".$totalVenta.", ".$reIdVenta->id_venta.")") === TRUE){
                    if($updateProd = $this->connect()->query("update Producto set Cantidad = Cantidad-".$rowCarrito->cantidad.", Ventas = Ventas +".$rowCarrito->cantidad." where id_producto =".$rowCarrito->id_producto." ") === TRUE){
                       $re = 'true';
                       $sqlDeleteCarrito = $this->connect()->query("Delete from Carrito where Username = '".$user."'");
                    }else{
                        echo 'false';
                        $this->connect()->close(); 
                        break; 
                    }
                }else{
                echo 'false';
                $this->connect()->close(); 
                break; 
                }
               }else{
                echo 'false';
                $this->connect()->close(); 
                break; 
               }
            }

        }
        if($re != ''){
            echo $re;
            $this->connect()->close(); 
        }

        
    }

    function Comentarios($username){
        $u = $username;
        $productosCar = '<div class="col text-center my-2"><h2 class="">Comentarios</h2></div>';
        $sqlPedidos = $this->connect()->query("Select * from pedido where Username = '".$username."' and Calificacion=-1;");
        $row_cnt = $sqlPedidos->num_rows;
        if($row_cnt > 0){
            while($row = $sqlPedidos->fetch_object()){
                $productosCar .= '<div class="row row-cols-1 row-cols-md-1 row-cols-xxl-5 border-bottom border-top py-2 mb-2 text-center">
                        <div class="col align-middle justify-content-center">
                            <p class="fs-4">'.$row->NombreProducto.'</p>
                        </div>
                        <div class="col align-middle">
                            <p class="fs-5">Fecha de venta: <p class="fs-6">'.$row->Fecha.'</p></p> 
                            <p class="fs-5 mt-2"> Precio: <p class="fs-6">$'.$row->Precio.'</p></p>        
                        </div>
                        <div class="col">  
                            <label for="ComentarioPedido">Comentario</label>
                            <textarea class="form-control mt-2" placeholder="Deja tu comentario" id="ComentarioPedido'.$row->id_pedido.'"></textarea>
                            
                        </div>
                        <div class="col align-middle">
                            <label for="Calificacion" class="col-form-label">Calificacion</label>
                            <input class="form-control w-25 align-middle mx-auto" type="number" min="0" max="5" id="Calificacion'.$row->id_pedido.'">
                        </div>
                        <div class="col">
                            <button class="btn btn-success w-100" onClick="Comentar('.$row->id_pedido.')">Comentar</button>
                        </div>
                    </div>';
                             
            }
         
        }else{
            $productosCar .= '<div class="col text-center py-5">
            <h3 >No hay comentarios por mostrar</h3>
            </div>';
        }
 
        echo $productosCar;
        $this->connect()->close();
    }

    function AddComentario($username,$idVP,$comentario,$calificacion){
        $sqlIdProd = $this->connect()->query("Select Pc.id_producto,P.id_venta, PC.NombreProducto From Venta V
        inner join Pedido P on P.id_venta = V.id_venta
        inner join Producto Pc on V.NombreProducto = PC.NombreProducto
        where P.id_pedido = ".$idVP."");
        $reIdProd = $sqlIdProd->fetch_object();

        if($sqlComentario= $this->connect()->query("Insert into Comentario(Username,id_producto,valoracion,comentario) Values('".$username."', ".$reIdProd->id_producto.",".$calificacion.",'".$comentario."')") === TRUE){
            if($sqlUpPedido= $this->connect()->query("Update Pedido set Calificacion = ".$calificacion." where id_pedido = ".$idVP." and Username='".$username."' ") === TRUE){
                if($sqlUpVenta= $this->connect()->query("Update Venta set Calificacion = ".$calificacion." where id_venta = ".$reIdProd->id_venta."") === TRUE){
                    $sqlValoracion = $this->connect()->query("Select Calificacion,COUNT(Calificacion) as Calif From Venta where NombreProducto = '".$reIdProd->NombreProducto."' Group By Calificacion Order By Calif Desc Limit 1");
                    $reValoracion = $sqlValoracion->fetch_object();
                    if($sqlUpProd= $this->connect()->query("Update Producto set Valoracion = ".$reValoracion->Calificacion." where id_producto = ".$reIdProd->id_producto."") === TRUE){
                        $re ='true';
                    }else{
                        $re ='false';
                    }   
                    
                }else{
                    $re ='false';
                }
            }else{
                $re ='false';
            }
        }else{
            $re ='false';
        }
       
        echo $re;
        $this->connect()->close();
    }


    //Categorias 
    function NewCategoria($username){
        $nombreCat = $_POST['nombreCat'];
        $descripcionCat = $_POST['descripcionCat'];
        
        if($sql= $this->connect()->query("Insert into Categorias(NombreCategoria,Descripcion,Username) values('$nombreCat',' $descripcionCat','$username')") === TRUE){
            echo 'true';
        }else{
            echo 'false';
        }
    }

    function LoadCategoria(){
        $categoria = ' <option selected>Selecciona una Categoria</option>';
        $sql = $this->connect()->query("Select NombreCategoria from Categorias");

        while($row = $sql->fetch_object()){
            $categoria .= '<option value="'.$row->NombreCategoria.'">'.$row->NombreCategoria.'</option>';
            
        }

        echo $categoria;
        $this->connect()->close();
    }

    function LoadCategoriaMain(){
        $categoria = '';
        $sql = $this->connect()->query("Select NombreCategoria from Categorias");

        while($row = $sql->fetch_object()){
            $categoria .= '<li><a class="dropdown-item" href="TodoProd.php?b='.$row->NombreCategoria.'">'.$row->NombreCategoria.'</a></li>';
            
        }

        echo $categoria;
        $this->connect()->close();
    }

    function LoadCategoriaEdit($cat){
        $categoria = '';
        $sql = $this->connect()->query("Select NombreCategoria from Categorias");

        while($row = $sql->fetch_object()){
            if($row->NombreCategoria == $cat)
                $categoria .= '<option value="'.$row->NombreCategoria.'" selected>'.$row->NombreCategoria.'</option>';
            else
                $categoria .= '<option value="'.$row->NombreCategoria.'">'.$row->NombreCategoria.'</option>';
            
        }

        echo json_encode($categoria);
        $this->connect()->close();
    }



    //Comentarios
    function LoadComentario($idProd){
        $sql = $this->connect()->query("Select * from Comentario where id_producto=".$idProd."");
        $comentario = '';
        while($row = $sql->fetch_object()){
            $comentario .='<div class="col">
            <h6 class="mb-0">'.$row->Username.'</h6>
            <div class="mb-2">';
                for($i = 1; $i < 6; $i++){
                    if($i <= $row->valoracion)
                        $comentario .='<i class="bi bi-star-fill"></i>';
                    else
                        $comentario .='<i class="bi bi-star"></i>';
                }

                $comentario .='</div>
            <p class="fs-5">'.$row->comentario.'</p>
          </div>';
            
        }

        echo $comentario;
        $this->connect()->close();
    }

}

function ImagesProd($image,$username,$nombre){
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
            $allowed = array('jpg', 'jpeg', 'png', 'mp4');
        
            //If the extension is allowed
            if(in_array($fileActualExt, $allowed)){
                //We check if there were any errors with the file upload
                if($fileError === 0){
                    $random = rand();
                    //We make the name of the file unique
                    $fileNameNew = "profile" .$username."_prod".$nombre."".$random." .". $fileActualExt;
        
                    //We select the place to upload it
                    $fileDestintion = '../Img/Productos/' . $fileNameNew;
        
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

if(isset($_POST['userCompra'])){
    session_start();

    $var = new API_Prod();
    $var->ConfirmarCompra($_SESSION['user']);
 
}

if(isset($_POST['userComenta'])){
    session_start();
    $var = new API_Prod();
    $var->Comentarios($_SESSION['user']);


}

if(isset($_POST['Comentario'])){
    session_start();
    $var = new API_Prod();
    $var->AddComentario($_SESSION['user'],$_POST['Comentario'],$_POST['text'],$_POST['calif']);

  

}


if(isset($_POST['productosVendedor'])){
    $var = New API_Prod();
    $var->LoadProductosUserVendedor($_POST['user']);
}






?>