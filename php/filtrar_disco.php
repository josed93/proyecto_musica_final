<?php
  include_once("../plantilla/db_configuration.php");
?>

<?php

    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT D.*,A.NOMBRE_A FROM DISCO D,DISCOGRAFICA DF,AUTOR A WHERE D.COD_AUTOR=A.COD_AUTOR AND D.TITULO LIKE '%".$_GET['dato']."%' GROUP BY D.COD_DISCO");




       echo '<table style="margin-top:2%;" class="table table-hover table-bordered table-responsive ">
       <tr style="font-weight:bold;text-align:center">

          <td>CARÁTULA</td>
           <td>TÍTULO</td>
           <td>AUTOR</td>
           <td>PRECIO</td>
           <td colspan="4">OPERACIONES</td>


       </tr>';


          //RECORRER OBJETOS DE LA CONSULTA
          while($obj = $result->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";
              echo "<td style='text-align:center'><img src='../images/caratulas/".$obj->CARATULA."' style='width:60px;height:60px' alt='' /></td>";
              echo "<td>".$obj->TITULO."</td>";
              echo "<td>".$obj->NOMBRE_A."</td>";
              echo "<td>".$obj->PRECIO."&nbsp€</td>";
              echo "<td><a href='?codisco1=$obj->COD_DISCO'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-search'></span> Ver detalles</button></a></td>";
              echo "<td><a href='?codisco2=$obj->COD_DISCO'><button type='button' class='btn btn-primary'><span class='glyphicon glyphicon-play-circle'></span> Ver Canciones</button></a></td>";
              echo "<td><a href='./editar_disco.php?codisco=$obj->COD_DISCO'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'> Editar</button></a></td>";
              echo "<td><a href='./borrar_disco.php?codisco=$obj->COD_DISCO'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'> Borrar</button></a></td>";



              echo "</tr>";


          }
    $result->close();
          unset($obj);
          unset($connection);
    echo '</table>';

       ?>
