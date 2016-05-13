<?php
require('../fpdf/fpdf.php');
require('../plantilla/db_configuration.php');
include_once('../plantilla/variablesdeconexion.php');
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
 //TESTING IF THE CONNECTION WAS RIGHT
 if ($connection->connect_errno) {
		 printf("Conexión fallida %s\n", $mysqli->connect_error);
		 exit();
 }

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../images/logo2.PNG' , 10 ,8, 60 , 8,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, '', 0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(50, 0, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Courier', 'B', 20);
$pdf->Cell(50, 0, '', 0);
$pdf->SetTextColor(204,0,0);
$pdf->Cell(85, 25, 'LISTADO DE USUARIOS', 0);
$pdf->Ln(23);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(249, 161, 21);



$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(25, 8, 'USERNAME',1,0,"C",'True');
$pdf->Cell(30, 8, 'NOMBRE', 1,0,"C",'True');
$pdf->Cell(40, 8, 'APELLIDOS', 1,0,"C",'True');
$pdf->Cell(50, 8, 'E-MAIL', 1,0,"C",'True');
$pdf->Cell(40, 8, 'ROL', 1,0,"C",'True');

$pdf->Ln(8);
$pdf->SetFillColor(242, 203, 139);


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT * FROM USUARIO ORDER BY ROL ASC");

while($obj = $usuarios->fetch_object()){

	$pdf->Cell(25, 8, $obj->USERNAME, 1,0,"C",'True');
	$pdf->Cell(30, 8,$obj->NOMBRE, 1,0,"C",'True');
	$pdf->Cell(40, 8, $obj->APELLIDOS, 1,0,"C",'True');
	$pdf->Cell(50, 8, $obj->EMAIL, 1,0,"C",'True');
  $pdf->Cell(40, 8, $obj->ROL, 1,0,"C",'True');

	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
$filename='listausuarios.pdf';
$pdf->Output($filename,'D');
?>
