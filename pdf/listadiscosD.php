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
$pdf->SetMargins(16, 25 , 30);
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
$pdf->Cell(85, 25, 'LISTADO DE DISCOS', 0);
$pdf->Ln(23);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(249, 161, 21);



$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 8, 'CARAT.',1,0,"C",'True');
$pdf->Cell(30, 8, 'TITULO', 1,0,"C",'True');
$pdf->Cell(40, 8, 'GENERO', 1,0,"C",'True');
$pdf->Cell(50, 8, 'CANTIDAD', 1,0,"C",'True');
$pdf->Cell(40, 8, 'PRECIO', 1,0,"C",'True');

$pdf->Ln(8);
$pdf->SetFillColor(242, 203, 139);


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT * FROM DISCO");


while($obj = $usuarios->fetch_object()){
$image1 = "../images/caratulas/$obj->CARATULA";
  $pdf->Cell(15, 15, $pdf->Image($image1, $pdf->GetX()+0, $pdf->GetY(), 15), 1, 0, 'C', false );
	$pdf->Cell(30, 15, $obj->TITULO, 1,0,"C",'True');
	$pdf->Cell(40, 15,$obj->GENERO, 1,0,"C",'True');
	$pdf->Cell(50, 15, $obj->CANTIDAD, 1,0,"C",'True');
  $pdf->Cell(40, 15, $obj->PRECIO.' EU', 1,0,"C",'True');

	$pdf->Ln(15);
}
$pdf->SetFont('Arial', 'B', 8);
$filename='listadiscos.pdf';
$pdf->Output($filename,'D');

?>
