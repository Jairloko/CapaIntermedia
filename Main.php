<?php
session_start();
include_once 'APIs/API_Prod.php';
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
    <link rel="stylesheet" href="Css/main.css">
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
      <!--Populares-->
      <div class="row bg-light mb-4 pt-2 shadow">
        <p class="fs-4 ms-3 mb-3 fw-semibold ">Populares</p>
        <div class="row">
          <div class="owl-carousel owl-theme pb-4" id="Populares">    
          <?php
          $ProdMasPop = new API_Prod;
          $ProdMasPop->LoadProductosMasPopulares();
          ?>
          </div>
        </div>
      </div>

      <!--Más Vendidos-->
      <div class="row bg-light mb-4 pt-2 shadow">
        <p class="fs-4 ms-3 mb-3 fw-semibold">Productos más Vendidos</p>
        <div class="row">
          <div class="owl-carousel owl-theme pb-4" id="MasVendidos">
          <?php
          $ProdMasVen = new API_Prod;
          $ProdMasVen->LoadProductosMasVendidos();
          ?>
          </div>
        </div>
      </div>

      <!-- Otros Productos-->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 row-cols-xxl-4 justify-content-between" id="Columnas">
          <?php
          $OtrosProd = new API_Prod;
          $OtrosProd->LoadProductos();
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
<script src="Js/Main.js"></script>
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