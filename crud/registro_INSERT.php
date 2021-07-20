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
            if (isset($_POST['ingresar'])) {
                $nombre = filter_var($_POST['name'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $telefono = filter_var($_POST['cell'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $sexo = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $fecha = filter_var($_POST['nacimiento'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $clave = filter_var($_POST['password'], FILTER_SANITIZE_STRING);  //para filtrar la data

                $query = " 
                    INSERT INTO `pacientes`(`nombre`, `apellido`,`telefono` , `sexo`, `fecha_nacimiento` ,`correo_electronico`, `clave`) VALUES ('$nombre', '$apellido', '$telefono','$sexo','$fecha','$correo', '$clave')";
            }
            $resultado = mysqli_query($link, $query); //Si devuelve True se ejecuto con exito y si no pues no
            if (!$resultado) {
                $_SESSION['MensajeTexto'] = "Error insertando el contenido";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                header("Location: ../index.php");
                //die("Error en base de datos: " . mysqli_error($link));
            } else {
                $_SESSION['MensajeTexto'] = "Registro almacenado con exito, por favor inicie session";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                header("Location: ../index.php");
            }
            //cerrando conexion
            mysqli_close($link);
            break;

        case 'INSDOCT':
            if (isset($_POST['guardar'])) {
                $nombre = filter_var($_POST['name'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $sexo = filter_var($_POST['sexo'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $fecha = filter_var($_POST['nacimiento'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $correo = filter_var($_POST['correo'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $telefono = filter_var($_POST['cell'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $clave = filter_var($_POST['clave'], FILTER_SANITIZE_STRING);  //para filtrar la data
                $especialidad = filter_var($_POST['especialidad'], FILTER_SANITIZE_STRING);  //para filtrar la data
                //$hash_passcode = password_hash($clave, PASSWORD_DEFAULT);
                $query = " 
                    INSERT INTO `doctor`(`nombreD`, `apellido`, `sexo`, `fecha_nacimiento` ,`telefono`, `correo_eletronico`, `clave`,`id_especialidad`) VALUES ('$nombre', '$apellido','$sexo', '$fecha', '$telefono','$correo', '$clave', '$especialidad')";
            }

            $resultado = mysqli_query($link, $query); //Si devuelve True se ejecuto con exito y si no pues no
            if (!$resultado) {
                $_SESSION['MensajeTexto'] = "Error insertando el contenido";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
                header("Location: ../admin/doctores.php");
                // die("Error en base de datos: " . mysqli_error($link));
            } else {
                $_SESSION['MensajeTexto'] = "Registro almacenado con exito.";
                $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-info text-white";
                header("Location: ../admin/doctores.php");
            }
            //cerrando conexion
            mysqli_close($link);
            break;
        default:
            # code...
            $_SESSION['MensajeTexto'] = "Avertencia: No se pudo identificar la accion a realizar";
            $_SESSION['MensajeTipo'] = "bg-warning text-dark";
            header("Location: ../index.php");
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
