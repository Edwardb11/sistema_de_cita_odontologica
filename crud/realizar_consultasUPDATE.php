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
        header("Location: ../admin/inicioAdmin.php");
    }

    //CRUD - INS - DLT -- UDT
    switch ($opcion) {
        case 'UDT':

            //$estado = filter_var($_POST['estado'], FILTER_SANITIZE_NUMBER_INT);  //para filtrar la data a entero
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $descripcion = filter_var($_POST['Descripción'], FILTER_SANITIZE_STRING);  //para filtrar la data
            $medicina = filter_var($_POST['Medicina'], FILTER_SANITIZE_STRING);  //para filtrar la data

            $query1 = " 
            INSERT INTO `paciente_diagnostico`(`id_cita`, `descripcion`, `medicina`) VALUES ('$id', '$descripcion',  '$medicina')";
            $query = "UPDATE `citas` SET `estado` = 'A'   WHERE `id_cita` = '$id'"; //para actualizar


            $resultado = mysqli_query($link, $query) && $resultado1 = mysqli_query($link, $query1); //Si devuelve True se ejecuto con exito y si no pues no
            if (!$resultado) {
                $_SESSION['MensajeTexto'] = "Error actualizando la cita ";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                header("Location: ../admin/inicioAdmin.php ");
                // die("Error en base de datos: " . mysqli_error($link));
            } else {
                $_SESSION['MensajeTexto'] = "Cita actualizada con exito";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                header("Location: ../admin/inicioAdmin.php");
                //die("Error en base de datos: " . mysqli_error($link));
            }
            //cerrando conexion
            mysqli_close($link);
            break;

        case 'DLT':

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);  //para filtrar la data
            $estado = filter_var($_GET['estado'], FILTER_SANITIZE_STRING);  //para filtrar la data

            if ($estado != "I") {
                $query = "DELETE  FROM `citas` where `id_cita` ='$id' "; //para borrar
                $resultado = mysqli_query($link, $query); //Si devuelve True se ejecuto con exito y si no pues no

                if (!$resultado) {
                    $_SESSION['MensajeTexto'] = "Error borrando la cita ";
                    $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                    header("Location: ../admin/inicioAdmin.php ");
                    // die("Error en base de datos: " . mysqli_error($link));
                } else {
                    $_SESSION['MensajeTexto'] = "Cita borrada con exito";
                    $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                    header("Location: ../admin/inicioAdmin.php");
                    //die("Error en base de datos: " . mysqli_error($link));
                }
            } else {
                # code...
                $_SESSION['MensajeTexto'] = "No se puede borrar la cita porque aun no se ha realizado";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger  text-white";
                header("Location: ../admin/inicioAdmin.php");
                //die("Error en base de datos: " . mysqli_error($link));
            }


            //cerrando conexion
            mysqli_close($link);
            break;

        default:
            # code...
            $_SESSION['MensajeTexto'] = "Avertencia: No se pudo identificar la accion a realizar";
            $_SESSION['MensajeTipo'] = "is-warning";
            header("Location: ../admin/inicioAdmin.php");
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
