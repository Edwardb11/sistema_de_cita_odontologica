<?php
include_once('./php/conexionDB.php');
include_once('./php/consultas.php');
if (isset($_SESSION['id_paciente'])) {
    $vUsuario = $_SESSION['id_paciente'];
    $row = consultarPaciente($link, $vUsuario);
} else {
    $_SESSION['MensajeTexto'] = "Error acceso al sistema  no registrado.";
    $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
    header("Location: ./index.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- ICONO -->
    <link rel="icon" href="./src/img/logo.png" type="image/png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./src/css/editar_form.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="src/css/lib/fontawesome/css/all.css">
    <title>Perfect Teeth </title>
</head>

<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
    <!-- MENU -->
    <section class="navbar navbar-default navbar-static-top" role="navigation">
        <div class="container">

            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                </button>

                <!-- lOGO TEXT HERE -->
                <a href=" ./principal.php" class="navbar-brand"><img src="src/img/logo.png" width="20px" height="20px" alt="Logo"></a>
                <a href=" ./principal.php" class="navbar-brand">Perfect Teeth </a>

            </div>

            <!-- MENU LINKS -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="./principal.php#top" class="smoothScroll">Inicio</a></li>
                    <li><a href="./principal.php#about" class="smoothScroll">Nosotros</a></li>
                    <li><a href="./principal.php#team" class="smoothScroll">Dentistas</a></li>
                    <li><a href="./principal.php#perfil" class="smoothScroll">Perfil</a></li>
                    <li><a href="./principal.php#google-map" class="smoothScroll">Conctato</a></li>
                    <li class="appointment-btn"><a href="./principal.php#appointment">Realizar una Cita</a></li>

                </ul>
            </div>

        </div>
    </section>



    <div class="container">
        <div class="container" id="advanced-search-form">

            <form action="./crud/actualizar_paciente.php?accion=UDT" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">

                <input type="hidden" name="id" id="id" value="<?php echo $row['id_paciente'] ?>">
                <div class="form-group">
                    <label for="first-name">Nombre</label>
                    <input type="text" class="form-control" value="  <?php echo $row['nombre'] ?>" name="name" placeholder="Nombre" id="first-name">
                </div>
                <div class="form-group">
                    <label for="last-name">Apellido</label>
                    <input type="text" class="form-control" value="  <?php echo $row['apellido'] ?>" name="apellido" placeholder="Apellido" id="last-name">
                </div>

                <div class="form-group">
                    <label for="number">Teléfono</label>
                    <input type="text" class="form-control" value="<?php echo $row['telefono'] ?>" name="cell" placeholder="Teléfono" id="number">
                </div>
                <div class="form-group">
                    <label for="age">Fecha de nacimiento</label>
                    <input type="text" class="form-control" value="<?php echo $row['fecha_nacimiento'] ?>" name="nacimiento" placeholder="nacimiento" id="age">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" value="<?php echo $row['correo_electronico'] ?>" name="correo" placeholder="Correo Eletronico" id="email">
                </div>
                <div class="form-group">
                    <label for="category">Contraseña</label>
                    <input type="password" class="form-control" value="<?php echo $row['clave'] ?>" placeholder="Contraseña" name="clave" id="category">
                </div>

                <div class="form-group">

                </div>
                <div class="form-group">
                    <label for="sexo" class="font-weight-bold">Sexo</label>
                    <select class="form-control" name="sexo" required>
                        <option>Masculino</option>
                        <option>Femenino</option>
                    </select>
                </div>

                <br>
                <button class="btn btn-success btn-lg btn-responsive" name="actualizar" id="search">
                    <i class="fas fa-sign-in-alt"></i> Actualizar
                </button>

                <div class="form-group">
                    <a href="principal.php"> <i class="fas fa-history"></i> Atrás </a>
                </div>
            </form>
        </div>
    </div>

    <script src="src/js/jquery.js"></script>
    <script src="src/js/bootstrap.min.js"></script>

</body>

</html>