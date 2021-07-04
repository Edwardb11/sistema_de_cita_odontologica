<?php
function validarLogin($link, $user, $pass, $tipo)
{
    if ($tipo == "Paciente") {
        $query = "SELECT * FROM `login` WHERE `correo_eletronico` = '$user' AND `clave` = '$pass'";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            # code...
            $row = $resultado->fetch_assoc();
            $_SESSION['id_usuario'] = $row['id_usuario'];
            // See the password_hash() example to see where this came from.
            //$hash = $row['password']; //se alamecena el valor encriptado de la base de datos

            //if (password_verify($pass, $hash)) //verifico que el valor encriptado se igual a la contraseña que me estan pasando si e sverdad creo las secciones
            //{
            //echo 'Password is valid!';
            $_SESSION['MensajeTexto'] = null;
            $_SESSION['MensajeTipo'] = null;
            header("Location: principal.php");
            //$_SESSION['MensajeTexto'] = "Felicidades"; //FUnciona bien
            //$_SESSION['MensajeTipo'] = "is-succes"; //FUnciona bien
            // } else {
            //echo 'Invalid password.';
            //$_SESSION['MensajeTexto'] = "Error validando datos de usuario";
            //$_SESSION['MensajeTipo'] = "is-danger";
            //}
        } else {

            $_SESSION['MensajeTexto'] = "Error validando datos del paciente ";
            $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
        }
    } else { //areglar
        $query = "SELECT * FROM `dentistas` WHERE `correo_electronico` = '$user' AND `clave` = '$pass'";
        $resultado = mysqli_query($link, $query);

        if (mysqli_num_rows($resultado) == 1) {
            # code...
            $row = $resultado->fetch_assoc();
            $_SESSION['id_dentista'] = $row['id_dentista'];
            // See the password_hash() example to see where this came from.
            //$hash = $row['password']; //se alamecena el valor encriptado de la base de datos

            //if (password_verify($pass, $hash)) //verifico que el valor encriptado se igual a la contraseña que me estan pasando si e sverdad creo las secciones
            //{
            //echo 'Password is valid!';
            $_SESSION['MensajeTexto'] = null;
            $_SESSION['MensajeTipo'] = null;
            header("Location: registrarse.php");
            //$_SESSION['MensajeTexto'] = "Felicidades"; //FUnciona bien
            //$_SESSION['MensajeTipo'] = "is-succes"; //FUnciona bien
            // } else {
            //echo 'Invalid password.';
            //$_SESSION['MensajeTexto'] = "Error validando datos de usuario";
            //$_SESSION['MensajeTipo'] = "is-danger";
            //}
        } else {

            $_SESSION['MensajeTexto'] = "Error validando datos del administrador ";
            $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
        }
    }
}


function consultarPaciente($link, $id)
{
    $query = "SELECT * FROM `login` WHERE `id_usuario` = '$id'  ";
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
