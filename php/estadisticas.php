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

 $consulta="SELECT COUNT(U.COD_USU) AS COD_USU FROM USUARIO U";
 $result=$connection->query($consulta);

 while($obj=$result->fetch_object()){
   $label[]="Usuarios";
   $datos[]=$obj->COD_USU;

 }
 $consulta2="SELECT COUNT(P.COD_PEDIDO) AS COD_PEDIDO FROM PEDIDO P";
 $result2=$connection->query($consulta2);

 while($obj2=$result2->fetch_object()){
   $label[]="Pedidos";
   $datos[]=$obj2->COD_PEDIDO;

 }
 $consulta3="SELECT COUNT(D.COD_DISCO) AS COD_DISCO FROM DISCO D";
 $result3=$connection->query($consulta3);

 while($obj3=$result3->fetch_object()){
   $label[]="Discos";
   $datos[]=$obj3->COD_DISCO;

 }
 $consulta4="SELECT COUNT(A.COD_AUTOR) AS COD_AUTOR FROM AUTOR A";
 $result4=$connection->query($consulta4);

 while($obj4=$result4->fetch_object()){
   $label[]="Autores";
   $datos[]=$obj4->COD_AUTOR;

 }
 $consulta5="SELECT COUNT(DF.COD_DISCOGRA) AS COD_DISCOGRA FROM DISCOGRAFICA DF";
 $result5=$connection->query($consulta5);

 while($obj5=$result5->fetch_object()){
   $label[]="Discograficas";
   $datos[]=$obj5->COD_DISCOGRA;

 }

	$grafico = new Graph(1200,500,"auto");
	$grafico->SetScale("textlin");
  $grafico->xaxis->title->Set("NOMBRES");
  $grafico->xaxis->SetTickLabels($label);
  $grafico->yaxis->title->Set("CANTIDAD");


	$barplot1=new BarPlot($datos);
	$barplot1->SetFillGradient("#BE81F7","#E3CEF6",GRAD_HOR);
	$barplot1->SetWidth(80);

	$grafico->Add($barplot1);
  $barplot1->value->Show();

	$grafico->Stroke();
  $grafico->stroke("IMG.PNG");

?>
