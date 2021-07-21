<?php
try {
    //code...
    include_once('../php/conexionDB.php');
    include_once('../php/consultas.php');
    if (!empty($_GET['opciones'])) {
        # code...
        $opcion = $_GET['opciones'];
    } else {
        session_start();
        $_SESSION['MensajeTexto'] = "Avertencia: Accion realilzada no permitada";
        $_SESSION['MensajeTipo'] = "is-warning";
        header("Location: ../index.php");
    }

    //CRUD - INS - DLT -- UDT
    switch ($opcion) {
        case 'INS':
            if (isset($_POST['enviar'])) {

                $id_paciente = $_SESSION['id_paciente'];
                $id_doctor11 = $_POST['dentistas'];
                $fecha_cita = filter_var($_POST['fecha_cita'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $hora = filter_var($_POST['hora'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $id_consultas = $_POST['consultas'];
                $query = " 
                INSERT INTO `citas`(`id_paciente`, `id_doctor`, `fecha_cita`, `hora_cita`, `id_consultas`,`estado`) VALUES ('$id_paciente', '$id_doctor11','$fecha_cita', '$hora','$id_consultas','I')";
            }
            $resultado = mysqli_query($link, $query); //Si devuelve True se ejecuto con exito y si no pues no
            if (!$resultado) {
                $_SESSION['MensajeTexto'] = "Error insertando el contenido";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                //header("Location: ./index.php");
                die("Error en base de datos: " . mysqli_error($link));
            } else {
                $_SESSION['MensajeTexto'] = "Cita realizada con exito!!";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                header("Location: ../principal.php");
            }
            //cerrando conexion
            mysqli_close($link);
            break;
        default:
            # code...
            $_SESSION['MensajeTexto'] = "Avertencia: No se pudo identificar la accion a realizar";
            $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-warning text-white";
            header("Location: ../principal.php");
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
