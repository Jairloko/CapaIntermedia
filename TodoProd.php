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
    <title>Productos</title>
    <link rel="icon" type="image/x-icon" href="Img/Icono.ico">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/todoProd.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
   
    <div class="container w-75 pb-5 pt-0">
      <div class="row bg-light mb-4 pt-2 shadow">
        <p class="fs-4 ms-3 mb-3 fw-semibold" id="busquedaText" Busqueda=<?php $b = $_GET['b']; echo $b?>>Busqueda: <?php $b = $_GET['b']; echo $b?></p>
        <div class="row row-cols-1 row-cols-lg-4 mb-2 mx-auto">
          <div class="col text-center" >      
            <p class="d-flex align-items-center ">Categoria
              <select name="prodCat" id="prodCat" class="form-select ms-1" >
                <?php
                  $cat = new API_Prod;
                  $cat->LoadCategoria();
                ?>

              </select>
            </p>
          </div>
          <div class="col text-center">
            <p class="d-flex align-items-center ">Precio
              <input type="text" id="minimo" class="form-control mx-1" placeholder="$Min">
              <input type="text" id="maximo" class="form-control"placeholder="$Max">
            </p>
          </div>
          <div class="col text-center">
            <p class="d-flex align-items-center ">Ordenar por:
              <select name="prodOrd" id="prodOrd" class="form-select ms-1" >
                <option selected value="predeterminado">Predeterminado</option>
                <option value="precioMB">Precio (más bajo)</option>
                <option value="precioMA">Precio (más alto)</option>
                <option value="calfMB">Calificación (más bajo)</option>
                <option value="calfMA">Calificación (más alto)</option>
              </select>
            </p>
          </div>
          <div class="col text-center ">
            <button class="btn btn-secondary" id="btnFiltrar">Filtrar</button>
          </div>
        </div>
      </div>

      <!-- Productos-->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 justify-content-between" id="Columnas">
           <?php 
              $Prods = new API_Prod;
              $b = $_GET['b'];
              $Prods->LoadProductosBusqueda($b);
            ?>
      </div>


      <!-- <div class="d-flex mt-3 justify-content-center">
        <nav class="">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div> -->
    </div>
  </main>


  <footer class="text-muted pb-5 bg-light w-100  bottom-0 " >
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
<script src="Js/TodoProd.js"></script>


</body>
</html>