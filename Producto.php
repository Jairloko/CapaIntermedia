<?php
session_start();
include_once 'APIs/API_Prod.php';
include_once 'APIs/API_Lista.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link rel="icon" type="image/x-icon" href="Img/Icono.ico">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/producto.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark" id="navtop">
      <div class="container-fluid ">
        <a class="navbar-brand" href="Main.php"><img src="Img/Logo3.png" width="50" alt="">       Nava</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse justify-content-between  navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="Main.php">Inicio</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Categorías
              </a>
              <ul class="dropdown-menu">
                <?php
                  $Cat = new API_Prod;
                  $Cat->LoadCategoriaMain();
                ?>
              </ul>
            </li>
          </ul>
          
          <div class="d-flex w-50" role="search" >
            <div class="input-group ">
              <input type="text" class="form-control " placeholder="Search" aria-label="Search" aria-describedby="button-addon2" id="inpBuscar">
              <button class="btn btn-outline-success"  id="btnBuscar">Button</button>
            </div>
       
          </div>

          <div class="ms-lg-5 me-5 pe-1">
            <ul class="navbar-nav  mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Perfil
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="Perfil.php">Ver perfil</a></li>
                  <li><a class="dropdown-item" href="ConsultaVentas.php">Consultar ventas</a></li>   
                  <li><a class="dropdown-item" href="ConsultarPedidos.php">Consultar pedidos</a></li>   
                  <li><a class="dropdown-item" href="APIs/CerrarSesion.php">Cerrar sesión</a></li>   
                </ul>
              </li>
              <li class="nav-item" >
                <a href="Carrito.php" class="btn btn-primary"><i class="bi bi-cart"></i> </a>
              </li>       
            </ul>   
          </div>
          
        </div>
      </div>
    </nav>
</header>

  
  <main>
    
    <div class="container w-75 py-5 ">
      <!--Producto-->
      <div class="row bg-light mb-4 pt-2 shadow">
        
        <div class="row py-3 ps-4 row-cols-1 row-cols-lg-2">
          <div class="col">
              <?php 
              $filesProd = New API_Prod;
              $filesProd->LoadFilesProd($_GET['id']);
              ?> 
          </div>
          <div class="col">
            <div class="row row-cols-1">
              <div class="col">
                  <?php 
                  $dataProd = New API_Prod;
                  $id = $_GET['id'];
                  $dataProd->LoadDataProd($id);
                  ?> 
              </div>
              <div class="col mt-4 text-center">
                <button class='btn btn-success w-50 mb-3' id="btnAgregar" onClick=addCarrito(<?php echo $_GET['id']?>)>Agregar</button>
                <button type="button" class="btn btn-primary w-50 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal" hidden id="btnCotizar">Cotizar</button>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header" >
                        <h5 class="modal-title" id="exampleModalLabel">Cotizar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      
                      <form action="APIs/API_Chat.php" id="formM">  
                      <div class="modal-body">
                         
                          <div class="mb-3">
                            <label for="mensaje" class="col-form-label">Mensaje</label>
                            <textarea class="form-control" id="mensaje" name="mensaje"></textarea>
                            <input type="text" name="idProd" value=<?php echo $_GET['id'];?> hidden>
                          </div> 
                        
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" name="enviarMensaje" class="btn btn-primary"  data-bs-dismiss="modal">Enviar</button>
                      </div>
                      </form>
                    </div>
                  </div>
                </div>
                <select name="lista" id="lista" class="form-select">
                  <?php 
                  $listas = New API_Lista;
                  $listas->LoadNombreListas($_SESSION["user"]);
                  ?> 
                </select>
                <button type="button" class="btn btn-warning w-50 mb-3 mt-3" hidden id="btnAddLista" >Agregar a la lista</button>
              </div>
            </div>
          </div>
         
        </div>

        

      </div>

      <!--Relacionados-->
      <div class="row bg-light mb-4 pt-2 shadow">
        <p class="fs-4 ms-3 mb-3 fw-semibold">Te puede interesar</p>
        <div class="row">
          <div class="owl-carousel owl-theme pb-4" id="prodRelacionados">
                <?php 
              $productosVendedor = New API_Prod;
              $id = $_GET['id'];
              $productosVendedor->LoadProductosVendedor($id);
              ?> 
          </div>
        </div>
      </div>

      <!--Comentarios-->
      <div class="row row-cols-1">
        <div class="text-center">
          <h3 class="align-content-center">Comentarios</h3>
 
        </div>
        <div id="Comentarios">
          <?php
            $var = new API_Prod();
            $var->LoadComentario($_GET['id']);
          ?>

        </div>
        
      </div>


  </main>

  <footer class="text-muted pb-5 bg-light">
    <div class="d-grid">
      <a href="#navtop" role="button" class="btn btn-light text-muted">Volver al Inicio</a>
    </div>
    
    <div class="container pt-5 ">
      <p class="mb-1">Aquí habrá info</p>
    </div>
  </footer>
    
      





        <!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

        <!-- Owl Caousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="Js/Producto.js"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        },
        1800:{
            items:4
        }
    }
})
</script>

</body>
</html>