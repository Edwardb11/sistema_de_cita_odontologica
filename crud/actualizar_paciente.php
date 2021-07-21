<?php
try {
    //code...
    include_once('../php/conexionDB.php');
    include_once('../php/consultas.php');
    if (!empty($_GET['accion'])) {
        # code...
        $opcion = $_GET['accion'];
    } else {
        session_start();
        $_SESSION['MensajeTexto'] = "Avertencia: Accion realilzada no permitada";
        $_SESSION['MensajeTipo'] = "is-warning";
        header("Location: ../principal.php");
    }

    //CRUD - INS - DLT -- UDT
    switch ($opcion) {
        case 'UDT':
            //$estado = filter_var($_POST['estado'], FILTER_SANITIZE_NUMBER_INT);  //para filtrar la data a entero
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $nombre = filter_var($_POST['name'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $telefono = filter_var($_POST['cell'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $sexo = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $fecha = filter_var($_POST['nacimiento'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $clave = filter_var($_POST['clave'], FILTER_SANITIZE_STRING);  //para filtrar la data

            $query = "UPDATE `pacientes` SET `nombre` = '$nombre', `apellido` = '$apellido', `telefono` = '$telefono',  `sexo` = '$sexo',  `fecha_nacimiento` = '$fecha',  `correo_electronico` = '$correo',  `clave` = '$clave'    WHERE `id_paciente` = '$id'"; //para actualizar


            $resultado = mysqli_query($link, $query);
            if (!$resultado) {
                $_SESSION['MensajeTexto'] = "Error actualizando el registro ";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                //header("Location: ../principal.php");
                die("Error en base de datos: " . mysqli_error($link));
            } else {
                $_SESSION['MensajeTexto'] = "Registro actualizado con exito";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                header("Location: ../principal.php");
                //die("Error en base de datos: " . mysqli_error($link));
            }
            //cerrando conexion
            mysqli_close($link);
            break;

        default:
            # code...
            $_SESSION['MensajeTexto'] = "Avertencia: No se pudo identificar la accion a realizar";
            $_SESSION['MensajeTipo'] = "is-warning";
            header("Location:../principal.php");
            //die("Error en base de datos: ". mysqli_error($link));  //muestra en pantalla el error que se ejecuta
            break;
    }
} catch (Exception $e) {
    print "Exception no controlado 01" . $e->getMessage();
    print "Estamos trabajando en corregir esta situacion";
} catch (Error $e) {
    print "Error no controlado 01" . $e->getMessage();
    print "Estamos trabajando en corregir esta situacion";
}
