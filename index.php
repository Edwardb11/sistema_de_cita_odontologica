<?php
include_once('./php/conexionDB.php');
include_once('./php/consultas.php');
//Este punto  luego de presionar el boton de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $vUsuario = trim(htmlspecialchars($_POST['username']));
  $vClave = trim(htmlspecialchars($_POST['password']));
  $vTipo = trim(htmlspecialchars($_POST['tipo']));

  //echo "<br>  Hola " . $vUsuario . "-" . $vClave;
  validarLogin($link, $vUsuario, $vClave, $vTipo);
}
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
  <div class=" container login-container">
    <div class="row">
      <div class="col-md-6 ads">
        <h1><span id="fl">Perfect</span><span id="sl"> teeth</span></h1>
      </div>
      <div class="col-md-6 login-form">
        <div class="profile-img">
          <img src="src/img/logo.png" alt="profile_img" height="120px" width="120px;">
        </div>
        <h3>Iniciar sesión</h3>
        <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" autocomplete="off">
          <div class="form-group">
            <label for="username" class="font-weight-bold">Correo Electrónico</label>
            <input type="email" class="form-control" name="username" id="username" placeholder="Correo electrónico" required>
          </div>
          <div class="form-group">
            <label for="password" class="font-weight-bold">Contraseña </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
          </div>

          <div class="form-check">
            <input type="radio" name="tipo" value="Paciente" id="Paciente">
            <label for="Paciente">Paciente</label>
            <br>
            <input type="radio" name="tipo" value="Administrador">
            <label for="Administrador">Administrador</label>
          </div>


          <div class="form-group">
            <button type="submit" name="ingresar" value="ingresar" class="btn btn-primary btn-lg btn-block">
              <i class="fas fa-sign-in-alt"></i> Iniciar sesión
            </button>
          </div>
          <div class="form-group">
            <a href="registro.php"><i class="fas fa-sign-in-alt"></i> Registrarse
            </a>
          </div>
        </form>
        <?php if (isset($_SESSION['MensajeTexto'])) { ?>
          <div class="card">

            <div class="notification <?php echo $_SESSION['MensajeTipo'] ?>">

              <?php echo $_SESSION['MensajeTexto'] ?>
              <button class="delete"><i class="fas fa-times"></i></button>
            </div>
          </div>
      </div>
    <?php }
        //session_destroy();
    ?>
    </div>

  </div>
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
</body>

</html>