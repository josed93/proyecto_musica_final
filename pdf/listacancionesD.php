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
 $codisco=$_GET['codisco4'];
 $tdisco = $connection->query("SELECT D.TITULO FROM DISCO D WHERE D.COD_DISCO='".$codisco."'");
$obj1 = $tdisco->fetch_object();
$titulod=$obj1->TITULO;


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetMargins(45, 25 , 30);
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../images/logo2.PNG' , 10 ,8, 60 , 8,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, '', 0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(50, 0, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Courier', 'B', 20);
$pdf->Cell(-5, 0, '', 0);
$pdf->SetTextColor(204,0,0);
$pdf->Cell(5, 25, "LISTADO DE CANCIONES DEL DISCO: ", 0);
$pdf->Cell(20, 0, '', 0);
$pdf->SetTextColor(0,0,255);
$pdf->Cell(5, 40,$titulod, 0);

$pdf->Ln(30);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(249, 161, 21);



$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(60, 8, 'TITULO', 1,0,"C",'True');
$pdf->Cell(60, 8, 'DURACION', 1,0,"C",'True');

$pdf->Ln(8);
$pdf->SetFillColor(242, 203, 139);


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT C.* , D.TITULO FROM CANCION C, DISCO D WHERE D.COD_DISCO=C.COD_DISCO AND C.COD_DISCO='".$codisco."'");


while($obj = $usuarios->fetch_object()){
	$pdf->Cell(60, 8, $obj->TITULO_C, 1,0,"C",'True');
	$pdf->Cell(60, 8,$obj->DURACION, 1,0,"C",'True');

	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
$filename='listacancionesdisco_'.$titulod.'.pdf';
$pdf->Output($filename,'D');

?>
