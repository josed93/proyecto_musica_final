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
$pdf->SetMargins(22, 25 , 30);

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
$pdf->Cell(85, 25, 'LISTADO DE AUTORES', 0);
$pdf->Ln(23);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(249, 161, 21);



$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(80, 8, 'NOMBRE', 1,0,"C",'True');
$pdf->Cell(80, 8, 'FECHA DE NACIMIENTO', 1,0,"C",'True');


$pdf->Ln(8);
$pdf->SetFillColor(242, 203, 139);


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT * FROM AUTOR");


while($obj = $usuarios->fetch_object()){
	$pdf->Cell(80, 8, $obj->NOMBRE_A, 1,0,"C",'True');
	$pdf->Cell(80, 8,$obj->FECHA_NAC, 1,0,"C",'True');


	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
$filename='listautores.pdf';
$pdf->Output($filename,'D');

?>
