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
    <link rel="stylesheet" href="Css/chats.css">
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
                <li><a class="dropdown-item" href="TodoProd.php">Accesorios</a></li>
                <li><a class="dropdown-item" href="TodoProd.php">Hogar</a></li>
                <li><a class="dropdown-item" href="TodoProd.php">Salud</a></li>
              </ul>
            </li>
          </ul>
          
          <form class="d-flex w-50" role="search" action="TodoProd.php">
            <div class="input-group ">
              <input type="text" class="form-control " placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
              <button class="btn btn-outline-success" type="submit" id="button-addon2">Button</button>
            </div>
       
          </form>

          <div class="ms-lg-5">
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
    <div class="container-fluid pb-5 mb-5 ">
      <div class="row ">
        <!--Datos Usuario-->
        <div class="col-lg-3 bg-light pt-5 usuario shadow pb-5  h-50">  
          <div class="text-center">
            <p class="fs-2">Usuarios</p>
          </div>
          <div id="users">
            <div class="ms-2 mb-3 ">
              <button class="btn w-100 fs-4 text-start">Usuario 1</button>
            </div>
            <div class="ms-2 mb-3 ">
              <button class="btn w-100 fs-4 text-start">Usuario 2</button>
            </div>
            <div class="ms-2 mb-3 ">
              <button class="btn w-100 fs-4 text-start">Usuario 3</button>
            </div>
            <div class="ms-2 mb-3 ">
              <button class="btn w-100 fs-4 text-start">Usuario 4</button>
            </div>
            <div class="ms-2 mb-3 ">
              <button class="btn w-100 fs-4 text-start">Usuario 5</button>
            </div>
          </div>
          
          
          
        </div>

        <!--Otros datos-->
        <div class="col-lg-8 bg-light mx-lg-auto mt-5 mt-lg-0 shadow px-5 " id="colListas">
          <div class="row border-bottom my-4 text-center">
            <div class="col text-center">
              <h2 class="">Nombre del usuario</h2>
            </div>
          </div>

          <div id="prodLista">
           
          </div>

        

          
        </div>
      </div>
    
    </div>
  </main>


  <footer class="text-muted pb-5 bg-light fixed-bottom">
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

<!-- <script src="Js/perfil.js"></script> -->
      


</body>
</html>