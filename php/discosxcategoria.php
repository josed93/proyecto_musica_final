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
 $consulta="SELECT COUNT(D.COD_DISCO)AS CANTIDAD,D.GENERO AS CATEGORIA from DISCO D GROUP BY D.GENERO;";
 $result=$connection->query($consulta);

 while($obj=$result->fetch_object()){
   $label[]=$obj->CATEGORIA;
   $datos[]=$obj->CANTIDAD;

 }


	$grafico = new Graph(1200,500,"auto");
	$grafico->SetScale("textlin");
  $grafico->xaxis->title->Set("CATEGORIA");
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("CANTIDAD DE DISCOS");


	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient("#BE81F7","#E3CEF6",GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);

	$grafico->Stroke();
  $grafico->stroke("IMG3.PNG");

?>
