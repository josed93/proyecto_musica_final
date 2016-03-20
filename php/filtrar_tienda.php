<?php
  include_once("../plantilla/db_configuration.php");
?>

<?php

    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }



              $result = $connection->query("SELECT D.*,A.NOMBRE_A FROM DISCO D, AUTOR A WHERE D.COD_AUTOR=A.COD_AUTOR AND D.TITULO LIKE '%".$_GET['dato']."%'");





          //RECORRER OBJETOS DE LA CONSULTA
          while($obj=$result->fetch_object()){
              echo '<div style=";width:20%;margin-right:1.5%;height:20%;float:left;padding:5px 0px;margin-bottom:10px;margin:0 auto">
              <a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><img src="../images/caratulas/'.$obj->CARATULA.'" style="width:70%;height:80%;margin-left:15%"></a>
              <center><a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><h4 style="margin-top:2%">'.$obj->TITULO.'</h4></a></center>
              <center><p style="margin-top:-3%">'.$obj->NOMBRE_A.'</p></center>
              <center><h4 style="margin-top:-3%;color:red">'.$obj->PRECIO.' €</h4></center>
            </div>';
          }
    $result->close();
          unset($obj);
          unset($connection);


       ?>
