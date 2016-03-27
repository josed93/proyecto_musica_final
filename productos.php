<?php
require('./fpdf/fpdf.php');
require('./plantilla/db_configuration.php');
include_once('./plantilla/variablesdeconexion.php');
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
 //TESTING IF THE CONNECTION WAS RIGHT
 if ($connection->connect_errno) {
		 printf("Conexión fallida %s\n", $mysqli->connect_error);
		 exit();
 }

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('./images/logo2.PNG' , 10 ,8, 60 , 8,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, '', 0);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(50, 10, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 8, '', 0);
$pdf->Cell(100, 8, 'LISTADO DE USUARIOS', 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 8, 'Cod_usuario', 0);
$pdf->Cell(30, 8, 'Nombre', 0);
$pdf->Cell(40, 8, 'Apellidos', 0);
$pdf->Cell(70, 8, 'Direccion', 0);
$pdf->Cell(25, 8, 'Poblacion', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT * FROM USUARIO");

while($obj = $usuarios->fetch_object()){

	$pdf->Cell(25, 8, $obj->COD_USU, 0);
	$pdf->Cell(30, 8,$obj->NOMBRE, 0);
	$pdf->Cell(40, 8, $obj->APELLIDOS, 0);
	$pdf->Cell(70, 8, $obj->DIRECCION, 0);
	$pdf->Cell(25, 8, $obj->PROVINCIA, 0);
	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
$pdf->Output();
?>
