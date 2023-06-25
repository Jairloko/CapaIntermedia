<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
    <link rel="icon" type="image/x-icon" href="Img/Icono.ico">
    <!-- CSS only -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/login.css">
</head>
<body>

    <div class="container w-75 bg-light position-absolute top-50 start-50 translate-middle rounded shadow">
        <div class="row align-items-stretch">
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded-start">

            </div>
            <div class="col bg-white p-5 rounded-end">
                <div class="text-center">
                    <img src="Img/Logo3.png" width="100" alt="">
                </div>
                <h2 class="py-5 text-center">Bienvenido</h2>

                  <!-- Login -->

                  <form  method="POST" id="formL" action="APIs/LoginUser.php">
                        <div class="mb-4">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario y/o correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="********" required>

                        </div>
                        <div class="mb-4 form-check">
                            <input type="checkbox" name="connected" class="form-check-input" id="">
                            <label for="connected" class="form-check-label">Recordarme</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" id="lin">Iniciar Sesión</button>
                        </div>

                        <div class="my-3">
                            <span>No tienes cuenta? <a href="Registro.php">Regístrate</a></span>       
                        </div>
                        
                  </form>

            </div>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="Js/Login.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</body>
</html>