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

function MostrarConsultas($link)
{
    $query = "SELECT * FROM `consultas` ";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}
function MostrarEspecialidad($link)
{
    $query = "SELECT * FROM `especialidad` ";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}

function MostrarDentistas($link)
{
    $query = "SELECT * FROM `doctor` ";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}
function MostrarPacientes($link)
{
    $query = "SELECT * FROM `pacientes` ";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}
function MostrarCitas1($link)
{
    $query = "SELECT  FROM `citas`, `pacientes`  ";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}
function MostrarCitas($link, $id)
{
    $query = "SELECT  
                    c.id_cita,
	                p.nombre,
	                p.apellido,
	                d.nombreD,
	                c.fecha_nacimiento,
	                c.fecha_cita,
	                c.hora_cita,
                    con.tipo, 
                    c.estado,
                 year(curdate()), year(c.fecha_nacimiento) ,year(CURDATE())-year(c.fecha_nacimiento) as años,
                 pd.descripcion

            FROM 
                    `citas`   as c 
            LEFT JOIN `pacientes` as p ON  p.id_paciente  =  c.id_paciente
            LEFT JOIN `doctor` as d ON  d.id_doctor  =  c.id_doctor
            LEFT JOIN `consultas` as con ON  con.id_consultas  =  c.id_consultas
            LEFT JOIN `paciente_diagnostico` as pd ON  pd.id_cita  =  c.id_cita
            WHERE d.id_doctor = $id
          ;
            ;";
    $resultado = mysqli_query($link, $query);
    return $resultado;
}


function ConsultarCitas($link, $id)
{
    $query = "SELECT * FROM `citas` WHERE `id_cita` =  '$id'";
    $resultado = mysqli_query($link, $query);

    if (mysqli_num_rows($resultado) == 1) {
        # code...
        $row = mysqli_fetch_array($resultado);
        return $row;
    } else {
        # code...
        $_SESSION['MensajeTexto'] = "Error consultando datos";
        $_SESSION['MensajeTipo'] = "is-danger";
    }
}
