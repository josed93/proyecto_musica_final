<?php

  include ("../grafico/src/jpgraph.php");
	include ("../grafico/src/jpgraph_bar.php");
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


	$grafico = new Graph(1200,500,"auto");
	$grafico->SetScale("textlin");
  $grafico->xaxis->title->Set("MESES");
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("CANTIDAD DE PEDIDOS");


	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient("#BE81F7","#E3CEF6",GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);

	$grafico->Stroke();
  $grafico->stroke("IMG2.PNG");

?>
