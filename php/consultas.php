<?php
function validarLogin($link, $user, $pass, $tipo)
{
    if ($tipo == "Paciente") {
        $query = "SELECT * FROM `pacientes` WHERE `correo_electronico` = '$user' AND `clave` = '$pass'";
        $resultado = mysqli_query($link, $query);
        if (mysqli_num_rows($resultado) == 1) {
            # code...
            $row = $resultado->fetch_assoc();
            $_SESSION['id_paciente'] = $row['id_paciente'];

            $_SESSION['MensajeTexto'] = null;
            $_SESSION['MensajeTipo'] = null;
            header("Location: principal.php");
            //$_SESSION['MensajeTexto'] = "Felicidades"; //FUnciona bien
            //$_SESSION['MensajeTipo'] = "is-succes"; //FUnciona bien
        } else {
            $_SESSION['MensajeTexto'] = "Error validando datos del paciente ";
            $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
        }
    } else {
        $query = "SELECT * FROM `doctor` WHERE `correo_eletronico` = '$user' AND `clave` = '$pass'";
        $resultado = mysqli_query($link, $query);
        if (mysqli_num_rows($resultado) == 1) {
            # code...
            $row = $resultado->fetch_assoc();
            $_SESSION['id_doctor'] = $row['id_doctor'];

            $_SESSION['MensajeTexto'] = null;
            $_SESSION['MensajeTipo'] = null;
            header("Location: /admin/inicioAdmin.php ");
            //$_SESSION['MensajeTexto'] = "Felicidades"; //FUnciona bien
            //$_SESSION['MensajeTipo'] = "is-succes"; //FUnciona bien
        } else {
            $_SESSION['MensajeTexto'] = "Error validando datos del administrador ";
            $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
        }
    }
}

function consultarPaciente($link, $id)
{
    $query = "SELECT * FROM `pacientes` WHERE `id_paciente` = '$id'";
    $resultado = mysqli_query($link, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = $resultado->fetch_assoc();
        return $row;
    } else {
        $_SESSION['MensajeTexto'] = "Error validando datos de usuario";
        $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
        header("Location: ./index.php");
    }
}

function consultarDoctor($link, $id)
{
    $query = "SELECT * FROM `doctor` WHERE `id_doctor` = '$id'";
    $resultado = mysqli_query($link, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = $resultado->fetch_assoc();
        return $row;
    } else {
        $_SESSION['MensajeTexto'] = "Error validando datos de usuario";
        $_SESSION['MensajeTipo'] = "is-danger";
        header("Location: ../index.php");
    }
}
