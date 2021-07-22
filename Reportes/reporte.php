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
        $this->Cell(70, 20, 'Paciente' . ' ' .   $row1['nombre'], 0, 0, 'C');
        $this->Ln(50);

        $this->SetFont('Arial', 'B', 14);
        $this->SetFillColor(9, 199, 189); //Gris tenue de cada fila
        $this->SetTextColor(3, 3, 3); //Color del texto: Negro
        $bandera = true; //Para alternar el relleno
        $this->Cell(40, 10, 'Paciente', 1, 0, 'C', $bandera);
        $this->Cell(60, 10, 'Consultas Pendientes', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Fecha', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Hora', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Doctor', 1, 1, 'C', $bandera);
    }
    function header2()
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
        $this->Cell(40, 10, 'Paciente', 1, 0, 'C', $bandera);
        $this->Cell(60, 10, 'Consultas Realizadas', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Fecha', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Hora', 1, 0, 'C', $bandera);
        $this->Cell(30, 10, 'Doctor', 1, 1, 'C', $bandera);
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


$resultado = CitasPendientesFPDF($link, $vUsuario);
//$pdf->Ln(50);
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(40, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(60, 10, utf8_decode($row['tipo']), 1, 0, 'C', 0);

    $pdf->Cell(30, 10, $row['fecha_cita'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['hora_cita'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombreD'], 1, 1, 'C', 0);
}
$pdf->Output();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

while ($row = $resultado->fetch_assoc()) {
    $pdf->Cell(40, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    $pdf->Cell(60, 10, utf8_decode($row['tipo']), 1, 0, 'C', 0);

    $pdf->Cell(30, 10, $row['fecha_cita'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['hora_cita'], 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $row['nombreD'], 1, 1, 'C', 0);
}


$pdf->Output();
