<?php

include_once 'ConexionBD.php';

class API_Chat extends ConectionDB{
    
    function InsertarMensaje($userDe,$userPara,$idProd,$mensaje){
      $comprobar = $this->connect()->query("Select id_chat from Chat where userDe='".$userDe."' and userPara='".$userPara."' and id_producto=".$idProd." OR userDe='".$userPara."' and userPara='".$userDe."' and id_producto=".$idProd."");
      if($row = $comprobar->fetch_object()){
        
        if($insertMensaje = $this->connect()->query("Insert into Mensaje(id_chat,userDe,userPara,mensaje) values(".$row->id_chat.",'".$userDe."','".$userPara."','".$mensaje."')"))
          $re = 'true';
        else
          $re = 'false';
      
      }
      else{
        if($insertChat = $this->connect()->query("Insert into Chat(userDe,userPara,id_producto) values('".$userDe."','".$userPara."',".$idProd.");"))
        {
          $selectIdChat= $this->connect()->query("Select id_chat from Chat where userDe='".$userDe."' and userPara='".$userPara."' and id_producto=".$idProd." OR userDe='".$userDe."' and userPara='".$userPara."' and id_producto=".$idProd."");
          if($row2 = $selectIdChat->fetch_object()){
            if($insertMensaje = $this->connect()->query("Insert into Mensaje(id_chat,userDe,userPara,mensaje) values(".$row2->id_chat.",'".$userDe."','".$userPara."','".$mensaje."')"))
              $re = 'true';
            else
              $re = 'false';
          
          }
          else
           $re = 'false';
 
        }
      else
        $re = 'false';


      }

      echo $re;
      $this->connect()->close();
    }
  
    function CargarUsernameChat($user){
      $text = "<div class='row border-bottom my-4 text-center'><div class='col '><h2 class=''>Mensajes</h2></div></div>";
      //seleccionamos los chats que tiene el usuario
      $chats = $this->connect()->query("Select * from Chat where userDe='".$user."' OR userPara='".$user."' ");
      $row_cnt = $chats->num_rows;
      if($row_cnt > 0){
        while($row = $chats->fetch_object()){
          $prodQuery = $this->connect()->query("Select NombreProducto from Producto where id_producto=".$row->id_producto." ");  
          $prodResult =$prodQuery->fetch_object();
          $msgQuery = $this->connect()->query("Select mensaje from Mensaje where id_chat=".$row->id_chat." order by fecha desc limit 1");  
          $msgResult = $msgQuery->fetch_object();
          if($row->userDe == $user)
            $var = $row->userPara;
          else
            $var = $row->userDe;
        
          $text .= "<div id='prodLista' >
          <div class='row row-cols-1 row-cols-lg-3 border-bottom mb-3 d-flex align-items-center text-center ' id='userMensaje' onclick=Prueba('$var','$row->id_producto')>
            <div class='col '>
              <p class='fs-4'>".$var."</p>
            </div>
            <div class='col'>
              <p class='fs-5'>".$prodResult->NombreProducto."</p>
            </div>
            <div class='col'>
              <p class='msg'>".$msgResult->mensaje."</p>
            </div>
          </div>";
          
        }
      }else{
        $text .= "No hay mensajes aún";
      }
      

      
      
      $text .= "</div>";
      echo $text;
      $this->connect()->close();
    }
    
    function CargarChat($userSes,$otherUser, $prod){
      $text = '<div class="w-100 text-center my-3 fs-2">'.$otherUser.'</div>
      <div class="overflow-scroll w-100 border border-dark position-relative MsgScroll">';
      $chat = $this->connect()->query("Select id_chat from Chat where userDe='".$userSes."' and userPara='".$otherUser."' and id_producto=".$prod." OR userDe='".$otherUser."' and userPara='".$userSes."' and id_producto=".$prod."");

      if($row = $chat->fetch_object()){
        $mensajes = $this->connect()->query("Select * from Mensaje where userDe='".$userSes."' and userPara='".$otherUser."' and id_chat=".$row->id_chat." OR userDe='".$otherUser."' and userPara='".$userSes."' and id_chat=".$row->id_chat."");
        while($rowMsg = $mensajes->fetch_object()){
            if($rowMsg->userDe == $userSes){
              $text .= '<div class="row row-cols-1 w-100 me-0 p-2 mb-3 rounded d-flex justify-content-end">
              <div class="col fs-6 d-flex justify-content-end">
                '.$rowMsg->fecha.'
              </div>
              <div class="col bg-success py-2 rounded text-white Mensaje">
              <p class="msgText" >'.$rowMsg->mensaje.'</p>
              </div>
             </div>';
      
            }else{
              $text .= '<div class="row row-cols-1 w-100 ms-0 p-2 mb-3 rounded De">
              <div class="col fs-6">
              '.$rowMsg->fecha.'
              </div>
              <div class="col bg-secondary py-2 rounded text-white Mensaje">
              <p class="msgText" >'.$rowMsg->mensaje.'</p>
              </div>
              </div>';
            }
        }
      }
 
      $text .= '</div>
      <div class="w-100 mt-4">
      <form action="APIs/API_Chat.php" id="formM">              
          <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Escribe un mensaje" aria-describedby="button-addon2" name="mensaje" required>
          <button class="btn btn-outline-success" type="submit" id="button-addon2">Enviar</button>
        </div>
      </form>
      </div>
      
      ';
      echo $text;
      $this->connect()->close();
    }



}

if(isset($_GET['CargarPerfilesChat'])){
  session_start();
  $var = new API_Chat();
  $var->CargarUsernameChat($_SESSION['user']);
  
}

else if(isset($_GET['user']) && isset($_GET['prod'])){
  session_start();
  $var = new API_Chat();
  $var->CargarChat($_SESSION['user'],$_GET['user'],$_GET['prod']);

}

else if($_POST['enviarMensaje']) {
  session_start();
  $var = new API_Chat();
    $var->InsertarMensaje($_SESSION['user'], $_POST['userPara'],$_POST['idProd'], $_POST['mensaje']);
  
}



?>