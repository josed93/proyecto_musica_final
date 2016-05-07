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
	$grafico->SetScale("textint");
  $grafico->xaxis->title->Set("TITULO DE CANCION");
  $grafico->xaxis->title->SetColor("darkred");
  $grafico->xaxis->title->SetFont(FF_FONT2, FS_BOLD, 16);

  $grafico->xaxis->SetColor("black");
  $grafico->xaxis->SetFont(FF_FONT1, FS_BOLD, 10);
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("TOTAL VENTAS");
  $grafico->yaxis->title->SetColor("darkred");
  $grafico->yaxis->title->SetFont(FF_FONT2, FS_BOLD, 16);
  $grafico->yaxis->SetFont(FF_FONT1, FS_BOLD, 10);







	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient('orange','darkred',GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);
  $barplot1->value->SetFormat('%01.0f');
  $barplot1->value->Show();
	$grafico->Stroke();
  $grafico->stroke("IMG4.PNG");

?>
