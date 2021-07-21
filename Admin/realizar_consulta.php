<?php
if (!empty($_GET['id'])) {
    include_once('../php/conexionDB.php');
    include_once('../php/consultas.php');
    $id = $_GET['id'];
    $row = ConsultarCitas($link, $id); //resultado es igual a lo que me devuelva esa funcion
    $vUsuario = $_SESSION['id_doctor'];
    $row1 = consultarDoctor($link, $vUsuario);
} else {
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- ICONO -->
    <link rel="icon" href="../src/img/logo.png" type="image/png" />
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../src/css/lib/bootstrap/css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="../src/css/admin.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../src/css/lib/fontawesome/css/all.css">

    <!-- Datatable libreria -->
    <link rel="stylesheet" href="../src/js/lib/datatable\css\jquery.dataTables.min.css">
    <link rel="stylesheet" href="../src/js/lib/datatable\css\responsive.dataTables.min.css">

    <title>Perfect Teeth </title>
</head>

<body>
    <aside class="sidebar">
        <div class="toggle">
            <a href="#" class="burger js-menu-toggle" data-toggle="collapse" data-target="#main-navbar">
                <span></span>
            </a>
        </div>
        <div class="side-inner">

            <div class="profile">
                <img src="../src/img/admin_user.png" alt="Image" class="img-fluid">
                <h3 class="name"><?php echo utf8_decode($row['nombreD'] . ' ' . $row['apellido']); ?></h3>
                <span class="country">Perfect Teeth </span>
            </div>
            <div class="nav-menu">
                <ul>
                    <li class="accordion">

                    <li><a href="inicioAdmin.php"><span class="icon-location-arrow mr-3"></span> <i class="far fa-calendar-check"></i>
                            Citas
                            pendientes
                        </a></li>
                    <li><a href="doctores.php"><span class="icon-location-arrow mr-3"></span><i class="fas fa-user-md"></i>
                            Dentistas</a></li>
                    <li><a href="calendar.php"><span class="icon-pie-chart mr-3"></span> <i class="far fa-calendar-alt"></i>
                            Calendario</a>
                    </li>
                    <li><a href="../php/cerrar.php"><span class="icon-sign-out mr-3"></span><i class="fas fa-sign-out-alt"></i> Cerrar
                            sesión </a>
                    </li>
                </ul>
            </div>
        </div>

    </aside>
    <main class="bg bg-white">
        <div class="site-section ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="content-box-large">
                            <div>
                                <ol class=" breadcrumb bg-white">
                                    <li class="breadcrumb-item active">
                                        Inicio
                                    </li>
                                </ol>
                            </div>
                            <div class="panel-body">
                                <div class="row">

                                    <div class="container">
                                        <div class="p-3 mb-2 bg-info text-white text-center">Realizar diagnóstico sobre la cita</div>

                                        <form action="../crud/realizar_consultasUPDATE.php?accion=UDT" method="POST" enctype="multipart/form-data" autocomplete="off" class="form-horizontal">

                                            <input type="hidden" name="id" id="id" value="<?php echo $row['id_cita'] ?>">
                                            <!-- para almacenar los id que el usuario logea -->


                                            <div class="card">

                                                <div class="card-body">
                                                    <h5 class="card-title">Diagnóstico </h5>
                                                    <p class="card-text">Con el fin de identificar dicha enfermedad o afección mediante una buena interpretación de los resultados obtenidos. En ocasiones asisten pacientes a la consulta dental que solo desean resolver un problema que les aqueja en ese momento.

                                                    </p>

                                                </div>
                                            </div>


                                            <div class=" form-group">
                                                <div class="row" style="margin-top: 5%;">
                                                    <!-- primera columna -->
                                                    <div class=" col-md-4">
                                                        <label for="apellidos"> Descripción </label>
                                                        <input class="form-control" type="text" name="Descripción" placeholder="Descripción" required>
                                                    </div>
                                                    <!-- segunda columna -->
                                                    <div class=" col-md-4">
                                                        <label for="apellidos">Medicina </label>
                                                        <input class="form-control" type="text" name="Medicina" placeholder="Medicina opcional" required>
                                                    </div>
                                                </div>

                                                <div class="ol-md-4" style="margin-top: 5%;">
                                                    <button class="btn btn-success btn-lg " type="submit" name="guardar" value="Guardar">
                                                        <i class="far fa-save"></i> Guardar
                                                    </button>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-2 col-md-offset-5">
                                                        <a href="./inicioAdmin.php"> <i class="fas fa-history"></i> Atrás </a>
                                                    </div>
                                                </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


    </main>


    <script src="../src/js/jquery.js"></script>
    <!-- <script src="../src/css/lib/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="../src/js/admin.js"></script>

</body>

</html>