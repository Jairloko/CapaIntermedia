<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" type="image/x-icon" href="Img/Icono.ico">
    <!-- CSS only -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/registro.css">
</head>
<body class="justify-content-center">
 
    <div class="container-fluid w-75 bg-light   rounded shadow ">
        <div class="row align-items-stretch">
            <div class="col bg-white p-5 rounded-start">
                <div class="text-center">
                    <img src="Img/Logo3.png" width="100" alt="">
                </div>
                <h2 class="py-5 text-center">Registrate</h2>

                  <!-- Registro -->

                  <form method="POST" action="APIs/RegistrarUser.php" id="formR" >
                        <div class="mb-4">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre completo" required >
                        </div>
                        <div class="mb-4">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su nombre de usuario" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
                        </div>
                        <div class="mb-4">
                            <label for="fecha" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fecha" id="nacimiento" required>
                        </div>
                        <div class="mb-4">
                            <label for="genero" class="form-label">Sexo</label>
                            <select class="form-select" id="genero" name="genero">
                                <option selected>Selecciona un sexo</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                              </select>
                        </div>
                        <div class="mb-4">
                            <label for="rol" class="form-label">Rol de Usuario</label>
                            <select class="form-select" id="rol" name="rol">
                                <option selected>Selecciona un rol</option>
                                <option value="1">Vendedor</option>
                                <option value="2">Cliente</option>
                              </select>
                        </div>
                        <div class="mb-4">
                            <label for="imagen" class="form-label">Imagen de Usuario</label>
                            <input type="file" class="form-control" name="imagen" required>
                        </div>

                        <div class="form-check mb-4">
                            <input class="form-check-input" type="checkbox" value="" id="privado" name="privado">
                            <label class="form-check-label" for="privado">
                              Privado
                            </label>
                          </div>
                       

                        <div class="d-grid col-6 mx-auto">
                            <button type="submit" class="btn btn-primary my-2">Registrar</button>
                            <a href="Login.php" role="button" class="btn btn-danger">Cancelar</a>
                        </div>
                  </form>

            </div>
            <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded-end">

            </div>
            
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script src="Js/Registro.js"></script>
</body>
</html>