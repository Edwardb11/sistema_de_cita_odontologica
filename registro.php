<?php
include_once('php/conexionDB.php');
include_once('php/consultas.php');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <title>Perfect teeth</title>
  <!-- ICONO -->
  <link rel="icon" href="./src/img/logo.png" type="image/png" />
  <!-- Styles -->
  <link rel="stylesheet" href="src/css/login.css" />
  <!-- Bootstrap -->
  <link href="src/css/lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="src/css/lib/fontawesome/css/all.css">
</head>

<body>
  <div class="container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <h1><span id="fl">Perfect</span><span id="sl"> teeth</span></h1>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="src/img/logo.png" alt="profile_img" height="100px" width="100px;">
        </div>
        <h3>Registrarse</h3>
        <form action="../crud/registro_INSERT.php?opciones=INS" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class=" form-group">
            <div class="row">
              <!-- primera columna -->
              <div class="col-md-4">
                <label for="name" class="font-weight-bold">Nombre </label>
                <input type="text" class="form-control" name="name" placeholder="Nombre" required>
              </div>
              <!-- segunda columna -->
              <div class="col-md-4">
                <label for="apellido" class="font-weight-bold">Apellido </label>
                <input type="text" class="form-control" name="apellido" placeholder="Apellido" required>
              </div>

              <div class="col-md-4">
                <label for="sexo" class="font-weight-bold">Sexo</label>
                <select class="form-control" name="sexo" required>
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>
            </div>
          </div>
          <div class=" form-group">
            <div class="row">
              <!-- primera columna -->
              <div class="col-md-6">
                <label for="nacimiento" class="font-weight-bold">Fecha de nacimiento</label>
                <input class="form-control" type="date" name="nacimiento" placeholder="Fecha de nacimiento" required>
              </div>
              <!-- segunda columna -->
              <div class="col-md-6">
                <label for="cell" class="font-weight-bold">Teléfono </label>
                <input type="text" class="form-control" name="cell" placeholder="Teléfono" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="username" class="font-weight-bold">Correo Electrónico</label>
            <input type="email" class="form-control" name="correo_electronico" placeholder="Correo electrónico" required>
          </div>
          <div class="form-group">
            <label for="password" class="font-weight-bold">Contraseña </label>
            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
          </div>
          <div class="form-group">
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="ingresar" value="ingresar">
              <i class="fas fa-sign-in-alt"></i> Registrarse
            </button>
          </div>
          <div class="form-group">
            <a href="index.php"> <i class="fas fa-history"></i> Atrás </a>
          </div>
        </form>
      </div>


      <script>
        document.addEventListener('DOMContentLoaded', () => {
          (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
            const $notification = $delete.parentNode;

            $delete.addEventListener('click', () => {
              $notification.parentNode.removeChild($notification);
            });
          });
        });
      </script>
    </div>
  </div>
</body>

</html>