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
 $consulta="SELECT U.NOMBRE,U.COD_USU FROM USUARIO U";
 $result=$connection->query($consulta);

 while($obj=$result->fetch_object()){
   $label[]=$obj->NOMBRE;
   $datos[]=$obj->COD_USU;

 }

	$grafico = new Graph(1200,500,"auto");
	$grafico->SetScale("textlin");
  $grafico->xaxis->title->Set("Nombres");
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("Cod_usu");


	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient("#BE81F7","#E3CEF6",GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);

	$grafico->Stroke();
  $grafico->stroke("IMG.PNG");

?>
