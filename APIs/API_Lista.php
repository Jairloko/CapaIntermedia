<?php

include_once 'ConexionBD.php';

class API_Lista extends ConectionDB{

    function NuevaLista($username){
        $nombreLista = $_POST['nombreLista'];
        $descripLista = $_POST['descripcionLista'];
        if(isset($_POST['privado'])){
            $privado = 1;
        }else{
            $privado = 0;
        }

        if($_FILES['imagenLista']['name'] != ''){
            
            $sql = "insert into Lista(Username,NombreLista,Descripcion,Imagen,Privado)
            Values ('".$username."','".$nombreLista."','".$descripLista."','Img/Listas/".ImageList('imagenLista')."','".$privado."')";
            if($this->connect()->query($sql)  === TRUE ){
                echo 'true';
            }else{
                echo 'false';
            }
           
           
        }else{
            $sql = "insert into Lista(Username,NombreLista,Descripcion,Imagen,Privado)
            Values ('".$username."','".$nombreLista."','".$descripLista."','Img/Listas/Default.png','".$privado."')";
            if($this->connect()->query($sql)  === TRUE  ){
                echo 'true';
            }else{
                echo 'false';
            }
        }
        $this->connect()->close();
        
    }

    function LoadNombreListas($username){
        $lista = '<option selected>Selecciona una lista</option>';
        $sql = $this->connect()->query("Select id_lista,NombreLista from Lista where Username='".$username."'");

        while($row = $sql->fetch_object()){
            $lista .= '<option value="'.$row->NombreLista.'" idlista='.$row->id_lista.'>'.$row->NombreLista.'</option>';
            
        }

        echo $lista;
        $this->connect()->close();
    }

    function AddProdLista($idProd, $lista,$user){
        $sql = "insert into ProductosListas(id_lista, id_producto) Values((select id_lista From Lista where NombreLista = '".$lista."' and Username='".$user."'),".$idProd.") ";
        if($this->connect()->query($sql)  === TRUE ){
            $result= 'true';
        }else{
            $result= 'false';
        }

        echo json_encode($result);
        $this->connect()->close();
    }

    function LoadProductosLista($listaN,$user){
        $productos = '<div class="row border-bottom my-4">
        <div class="col text-center">
          <h2 class="">'.$listaN.'</h2>
        </div>
        </div>
        <div id="prodLista">';
        $sql = $this->connect()->query("select * From Producto P 
        Inner Join ProductosListas PL on PL.id_lista = (Select id_lista From Lista where NombreLista = '".$listaN."' and Username='".$user."')
        where P.id_producto = PL.id_producto and PL.Activo=1 ");
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
                   Disponibles: <span class="fs-6">'.$row->Cantidad.'</span> 
                  </span>
                </div>';

                if($row->Precio == 0){
                    $productos .= '<div class="col d-flex align-items-center mt-3 mt-xxl-0">
                    <span class="w-100 text-center fs-5">
                     Precio: <span class="fs-6">Desconocido</span> 
                    </span>
                  </div>';
                }
                else{
                    $productos .= '<div class="col d-flex align-items-center mt-3 mt-xxl-0">
                    <span class="w-100 text-center fs-5">
                     Precio: <span class="fs-6">$'.$row->Precio.'</span> 
                    </span>
                  </div>';
                }
                
                $productos .= '<div class="col my-3  my-xxl-0 d-flex align-self-center flex-column"> 
                  <button class="btn btn-success w-100 mb-3" id="Autorizar" Producto="'.$row->id_producto.'" onclick=comprarProdLista('.$row->id_producto.')>Comprar</button>
                  <button class="btn btn-danger w-100" Producto="'.$row->id_producto.'" onclick=eliminarProdLista('.$row->id_producto.')>Eliminar</button>
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

    function LoadProductosListaVendedor($listaName,$user){
        $productos = '<div class="row border-bottom my-4">
        <div class="col text-center">
          <h2 class="">'.$listaName.'</h2>
        </div>
        </div>
        <div id="prodLista">';
        $sql = $this->connect()->query("select * From Producto P 
        Inner Join ProductosListas PL on PL.id_lista = (Select id_lista From Lista where NombreLista = '".$listaName."' and Username='".$user."')
        where P.id_producto = PL.id_producto and PL.Activo=1");

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
                </div>';

                if($row->Precio == 0){
                    $productos .= '<div class="col d-flex align-items-center mt-3 mt-xxl-0">
                    <span class="w-100 text-center fs-5">
                     Precio: <span class="fs-6">Desconocido</span> 
                    </span>
                  </div>';
                }
                else{
                    $productos .= '<div class="col d-flex align-items-center mt-3 mt-xxl-0">
                    <span class="w-100 text-center fs-5">
                     Precio: <span class="fs-6">$'.$row->Precio.'</span> 
                    </span>
                  </div>';
                }
                
                $productos .= '</div>';   
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


    function DeleteProdLista($idProd, $listaName){
       
        $sql = "update ProductosListas set Activo=0 where id_producto = ".$idProd." and id_lista=(Select id_lista From Lista where NombreLista = '".$listaName."')";


        if($this->connect()->query($sql)  === TRUE ){
            $re = 'true';
        }else{
            $re = 'false';
        }

        echo json_encode($re);
        $this->connect()->close();
        

    }

}

function ImageList($image){
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
                    $fileNameNew = "lista" .$_SESSION['user']."." . $fileActualExt;
        
                    //We select the place to upload it
                    $fileDestintion = '../Img/Listas/' . $fileNameNew;
        
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


if(isset($_POST['listasVendedor'])){

    $var = new API_Lista();
    $var->LoadNombreListas($_POST['user']);
 
}

if(isset($_GET['prodListasVendedor'])){
   
    $var = new API_Lista();
    $var->LoadProductosListaVendedor($_GET['listaProdV'],$_GET['user']);
 
}

if(isset($_GET['prodListas'])){
    session_start();
    $productosLista = new API_Lista;
    $productosLista->LoadProductosLista($_GET['listaName'],$_SESSION['user']);

 
}

?>