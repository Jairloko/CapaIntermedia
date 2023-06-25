<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link rel="icon" type="image/x-icon" href="Img/Icono.ico">
    <!-- CSS only -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/landingPage.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg  bg-dark navbar-dark" id="navtop">
          <div class="container-fluid ">
            <a class="navbar-brand" href="#"><img src="Img/Logo3.png" width="50" alt="">       Nava</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse justify-content-end navbar-collapse" id="navbarSupportedContent">
              <div class="ms-lg-5 me-5 pe-1">
                <ul class="navbar-nav w-100 mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link border rounded border-primary " href="Login.php" role="button"  aria-expanded="false">
                      Ingresa
                    </a>
                  </li>
                  <li class="nav-item" >
                    <a href="Registro.php" class="btn btn-primary ms-3">Registrarse</a>
                  </li>       
                </ul>   
              </div>
              
            </div>
          </div>
        </nav>
    </header>

    <main>
        <div class="container-fluid w-100 h-100 position-absolute justify-content-between contenido">
            <div class="row row-cols-1 row-cols-lg-2 h-100 w-100 d-flex align-items-center">
                <div class="col-lg-4 text-center">
                    <span class="fw-bold text-light" id="titulo">Te damos la bienvenida a Nava!</span>
                    <p class="fst-italic fs-2 text-light">Bienvenido a la página donde encontraras todo lo que necesites para tu día a día.
                        Solo basta de buscar y comprar, así de sencillo.
                    </p>
                    <a href="Login.php" class="btn btn-primary ms-3 w-50">Comenzar</a>
                </div>

                <div class="col-lg-8 text-center ">
                    <img src="Img/landing.png" class="w-75 h-75" alt="">
                </div>

            </div>
        </div>
    </main>
    


    <!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>