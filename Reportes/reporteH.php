<?php
include_once('fpdf/fpdf.php');
include_once('../php/conexionDB.php');
include_once('../php/consultas.php');

$Usuario = $_SESSION['nombre'];
if (isset($_SESSION['id_paciente'])) {
    $vUsuario = $_SESSION['id_paciente'];
    $row1 = consultarPaciente($link, $vUsuario);
} else {
    $_SESSION['MensajeTexto'] = "Error acceso al sistema  no registrado.";
    $_SESSION['MensajeTipo'] = "p-3 mb-2 bg-danger text-white";
    header("Location: ../index.php");
}
$resultado = CitasRealizadasFPDF($link, $vUsuario);


class PDF extends FPDF
{
    function header()
    {

        $this->Image('../src/img/logo.png', 90, 16, 33);
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(60);
        $this->Cell(70, 10, 'HISTORIAL MEDICO', 0, 0, 'C');
        $this->Ln(50);

        $this->SetFont('Arial', 'B', 14);
        $this->SetFillColor(9, 199, 189); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = true; //Para alternar el relleno
        // $this->Cell(40, 10, 'Paciente', 1, 0, 'C', $bandera);
        $this->Cell(60, 10, 'Consultas Realizadas', 1, 0, 'C', $bandera);
        $this->Cell(25, 10, 'Fecha', 1, 0, 'C', $bandera);
        $this->Cell(25, 10, 'Hora', 1, 0, 'C', $bandera);
        $this->Cell(25, 10, 'Doctor', 1, 0, 'C', $bandera);
        $this->Cell(32, 10, 'Descripcion', 1, 0, 'C', $bandera);
        $this->Cell(27, 10, 'Mecicina', 1, 1, 'C', $bandera);
    }
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


$resultado = CitasRealizadasFPDF($link, $vUsuario);
//$pdf->Ln(50);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$pdf->SetTextColor(0, 0, 0); //color texto de la barra NEGRO

//nombre
$pdf->SetXY(0, 2);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(65, 5, "Historial clinico -- Perfect Teeth  -- ID paciente " . utf8_decode($row1['id_paciente']), 0, 0, 'C', 0);
// $pdf->Cell(290, 5,  "ID_paciente " . utf8_decode($row1['id_paciente']), 0, 0, 'C', 0);
$pdf->SetXY(0, 28);

//nombre
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 2, "Nombre: ", 0, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 2,  utf8_decode($row1['nombre']), 0, 0, 'C', 0);
//apellido
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 2, "Apellido: ", 0, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 2,  utf8_decode($row1['apellido']), 0, 0, 'C', 0);

//sexo
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(5, 2, "Sexo: ", 0, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 2,  utf8_decode($row1['sexo']), 0, 0, 'C', 0);


//nacimiento
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(31, 2, "Fecha de nacimiento: ", 0, 0, 'C', 0);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 2,  utf8_decode($row1['fecha_nacimiento']), 0, 0, 'C', 0);



$pdf->SetXY(-100, 20);
$pdf->Ln(50);

while ($row = $resultado->fetch_assoc()) {

    $pdf->Cell(60, 10, utf8_decode($row['tipo']), 1, 0, 'C', 0);

    $pdf->Cell(25, 10, $row['fecha_cita'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['hora_cita'], 1, 0, 'C', 0);
    $pdf->Cell(25, 10, $row['nombreD'], 1, 0, 'C', 0);
    $pdf->Cell(32, 10, $row['descripcion'], 1, 0, 'C', 0);
    $pdf->Cell(27, 10, $row['medicina'], 1, 1, 'C', 0);
}
$pdf->Output();
