<?php
include_once('../php/conexionDB.php');
include_once('../php/consultas.php');

if (isset($_SESSION['id_doctor'])) {
  $vUsuario = $_SESSION['id_doctor'];
  $row = consultarDoctor($link, $vUsuario);
  $resultadoCitas = MostrarCitas($link, $vUsuario); // mostrar citas
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
  <script type="text/javascript">
    function confirmation() {
      if (!confirm("Realmente desea eliminar esta cita?")) return false;
    }
  </script>
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
        <?php
        if ($row['sexo'] == 'Masculino') {
        ?>
          <img src="../src/img/odontologo.png" class="rounded-circle" width="150">

        <?php
        } elseif ($row['sexo'] == 'Femenino') {
        ?>
          <img src="../src/img/odontologa.png" class="rounded-circle" width="150">
        <?php
        }
        ?>
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
              <div class="content-box-large">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-12 text-info">
                      <div class="p-3 mb-2 bg-primary text-white text-center">Citas pendientes</div>
                      <!-- Tablas -->
                      <div class="col-md-7">
                        <?php if (isset($_SESSION['MensajeTexto'])) { ?>
                          <div class="alert <?php echo $_SESSION['MensajeTipo'] ?>" role="alert">
                            <?php echo $_SESSION['MensajeTexto'] ?>
                            <button class="delete"><i class="fa fa-times"></i></button>
                          </div>

                        <?php $_SESSION['MensajeTexto'] = null;
                          $_SESSION['MensajeTipo'] = null;
                        }
                        ?>
                      </div>
                      <table id="example" class=" table table-striped nowrap responsive ">
                        <thead>
                          <tr>
                            <th>Nombre completo</th>

                            <th>Edad</th>
                            <th>Consulta</th>
                            <th>Fecha </th>
                            <th>Hora </th>
                            <!-- <th>Dentista</th> -->
                            <th>Estado</th>
                            <th>Diagnóstico </th>
                            <th> </th>
                            <th> </th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          //este while va a recorrer en array me va a devolver posicion por posicion lo que 
                          //esta en la variable resultado y de la forma que lo vas hacer es mysqli
                          //es decir crear un arreglo de la forma asociativa cada posicion me lo va a retornar como una columna
                          while ($row = mysqli_fetch_array($resultadoCitas, MYSQLI_ASSOC)) { ?>
                            <tr>
                              <td> <?php echo $row['nombre'] . ' ' . $row['apellido']  ?> </td>
                              <td> <?php echo  $row['años']; ?> </td>
                              <td> <?php echo $row['tipo'] ?> </td>
                              <td> <?php echo $row['fecha_cita'] ?> </td>
                              <td> <?php echo $row['hora_cita'] ?> </td>

                              <td> <?php if ($row['estado'] == 'A') {
                                      echo "Realizada";
                                    } else {
                                      echo "Pendiente";
                                    } ?> </td>
                              <td> <?php echo $row['descripcion'] ?> </td>
                              <td> <a class="button is-info" data-toggle="tooltip" data-placement="top" title="Editar" name="editar" href="./realizar_consulta.php?accion=UDT&id=<?php echo $row['id_cita'] ?>"> <i class="fas fa-edit"></i> </a> </td>


                              <td> <a class="button text-danger" data-toggle="tooltip" data-placement="top" title="Anular" name="anular" href="../crud/realizar_consultasUPDATE.php?accion=DLT&id=<?php echo $row['id_cita']  ?>&estado=<?php echo $row['estado'] ?>" onclick="return confirmation() "> <i class=" fas fa-trash"> </i> </a> </td>
                            </tr>
                          <?php
                          }
                          ?>
                        </tbody>
                      </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </main>


  <script>
    document.addEventListener('DOMContentLoaded', () => {
      (document.querySelectorAll('.alert .delete') || []).forEach(($delete) => {
        const $notification = $delete.parentNode;

        $delete.addEventListener('click', () => {
          $notification.parentNode.removeChild($notification);
        });
      });
    });
  </script>

  <script src="../src/js/jquery.js"></script>

  <!-- <script src="../src/css/lib/bootstrap/js/bootstrap.min.js"></script> -->
  <script src="../src/js/admin.js"></script>

  <!-- Script para datatable -->
  <script type="text/javascript" src="../src/js/lib/datatable\js\jquery-3.5.1.js"> </script>
  <script type="text/javascript" src="../src/js/lib/datatable\js\jquery.dataTables.min.js"> </script>
  <script type="text/javascript" src="../src/js/lib/datatable\js\dataTables.responsive.min.js"> </script>
  <script type="text/javascript" src="../src/js/lib/datatable\datatable.js"></script>
</body>

</html>