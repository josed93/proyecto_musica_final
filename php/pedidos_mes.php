<?php

  include ("../grafico/src/jpgraph.php");
	include ("../grafico/src/jpgraph_pie.php");
  include ("../plantilla/db_configuration.php");
  $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
   //TESTING IF THE CONNECTION WAS RIGHT
   if ($connection->connect_errno) {
  		 printf("Conexión fallida %s\n", $mysqli->connect_error);
  		 exit();
   }
 $consulta="SELECT COUNT(P.COD_PEDIDO) AS CANTIDAD,DATE_FORMAT(P.fecha_ped,'%M') as MES from PEDIDO P GROUP BY MONTH(P.fecha_ped);";
 $result=$connection->query($consulta);

 while($obj=$result->fetch_object()){
   $label[]=$obj->MES;
   $datos[]=$obj->CANTIDAD;

 }


 $grafico = new PieGraph(1200,500);
 $grafico->img->SetTransparent("white");

 $grafico->SetShadow();
 $grafico->legend->SetFont(FF_FONT1, FS_BOLD, 12);

 $p1 = new PiePlot($datos);
 $p1->SetLegends($label);
 $p1->SetCenter(0.4);
$p1->value->SetFont(FF_FONT1,FS_BOLD);
$p1->value->SetColor("darkred");
$p1->value->SetFormat('%01.0f%%');

 $grafico->Add($p1);
 $grafico->Stroke();
  $grafico->stroke("IMG2.PNG");

?>
