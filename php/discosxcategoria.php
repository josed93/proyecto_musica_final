<?php

  include ("../grafico/src/jpgraph.php");
	include ("../grafico/src/jpgraph_pie.php");
  include ("../grafico/src/jpgraph_pie3d.php");
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


 // Create the Pie Graph.
 $grafico = new PieGraph(1200,600);
 $grafico->SetShadow();
 $grafico->img->SetTransparent("white");





  // Create plots
 $p1 = new PiePlot3D($datos);

 $p1->SetAngle(80);
 $p1->SetLegends($label);
 $grafico->legend->SetPos(0.5,0.65,'center','bottom');
 $grafico->legend->SetFont(FF_FONT1, FS_BOLD, 10);

 $p1->SetSize(0.35);
 $p1->SetCenter(0.50,0.32);
 $p1->value->SetFont(FF_FONT1,FS_BOLD);
 $p1->value->SetColor("black");
 $p1->SetLabelPos(0.65);
 // Explode all slices
 $p1->ExplodeAll(10);

 // Add drop shadow
 $p1->SetShadow();

 $grafico->Add($p1);
 $grafico->Stroke();
 $grafico->stroke("IMG3.PNG");

 ?>
