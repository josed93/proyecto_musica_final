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
 $consulta="SELECT D.TITULO AS TIT_CANCION, SUM(LP.CANTIDAD) AS TOTAL_VENTAS
FROM LINEA_PEDIDO LP,DISCO D
WHERE LP.COD_DISCO=D.COD_DISCO
GROUP BY LP.COD_DISCO";
 $result=$connection->query($consulta);

 while($obj=$result->fetch_object()){
   $label[]=$obj->TIT_CANCION;
   $datos[]=$obj->TOTAL_VENTAS;

 }

	$grafico = new Graph(1200,500,"auto");
	$grafico->SetScale("textlin");
  $grafico->xaxis->title->Set("TITULO CANCION");
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("TOTAL VENTAS");


	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient("#BE81F7","#E3CEF6",GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);

	$grafico->Stroke();
  $grafico->stroke("IMG4.PNG");

?>
