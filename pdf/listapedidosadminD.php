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
$pdf->SetMargins(15, 25 , 30);
$pdf->SetFont('Arial', '', 10);
$pdf->Image('../images/logo2.PNG' , 10 ,8, 60 , 8,'PNG');
$pdf->Cell(18, 10, '', 0);
$pdf->Cell(150, 10, '', 0);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(50, 0, 'Fecha: '.date('d-m-Y').'', 0);
$pdf->Ln(15);
$pdf->SetFont('Courier', 'B', 20);
$pdf->Cell(15, 0, '', 0);
$pdf->SetTextColor(204,0,0);
$pdf->Cell(10, 25, 'LISTADO DE PEDIDOS DE LOS USUARIOS', 0);
$pdf->Ln(23);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(249, 161, 21);



$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(30, 8, 'USUARIO', 1,0,"C",'True');
$pdf->Cell(40, 8, 'TITULO', 1,0,"C",'True');
$pdf->Cell(40, 8, 'FECHA PEDIDO', 1,0,"C",'True');
$pdf->Cell(30, 8, 'CANTIDAD', 1,0,"C",'True');
$pdf->Cell(40, 8, 'IMPORTE', 1,0,"C",'True');


$pdf->Ln(8);
$pdf->SetFillColor(242, 203, 139);


$pdf->SetFont('Arial', '', 8);
//CONSULTA
$usuarios = $connection->query("SELECT *,LP.CANTIDAD AS CANT FROM PEDIDO P,USUARIO U,LINEA_PEDIDO LP,DISCO D WHERE P.COD_USU=U.COD_USU AND P.COD_PEDIDO=LP.COD_PEDIDO AND LP.COD_DISCO=D.COD_DISCO ORDER BY FECHA_PED ASC ");


while($obj = $usuarios->fetch_object()){
	$pdf->Cell(30, 8, $obj->USERNAME, 1,0,"C",'True');
	$pdf->Cell(40, 8,$obj->TITULO, 1,0,"C",'True');
	$pdf->Cell(40, 8, $obj->FECHA_PED, 1,0,"C",'True');
  $pdf->Cell(30, 8, $obj->CANT, 1,0,"C",'True');
  $pdf->Cell(40, 8, $obj->IMPORTE.' EU', 1,0,"C",'True');


	$pdf->Ln(8);
}
$pdf->SetFont('Arial', 'B', 8);
$filename='listapedidosadmin.pdf';
$pdf->Output($filename,'D');
?>
