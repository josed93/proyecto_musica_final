<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php

    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT * FROM DISCOGRAFICA WHERE NOMBRE LIKE '%".$_GET['dato']."%'");

       echo '<table style="margin-top:2%;" class="table table-hover table-bordered table-responsive ">
       <tr style="font-weight:bold;text-align:center">

           <td>NOMBRE</td>
           <td>FUNDACIÓN</td>
           <td>PÁGINA WEB</td>
           <td colspan="2">OPERACIONES</td>


       </tr>';


          //RECORRER OBJETOS DE LA CONSULTA
          while($obj = $result->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj->NOMBRE."</td>";
              echo "<td>".$obj->FUNDACION."</td>";
              echo "<td><a href='".$obj->PAGINA_WEB."' target='_blank'>".$obj->PAGINA_WEB."</a></td>";

              echo "<td><a href='./editar_discogra.php?codiscogra=$obj->COD_DISCOGRA'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'> Editar</button></a></td>";
              echo "<td><a href='./borrar_discogra.php?codiscogra=$obj->COD_DISCOGRA'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'> Borrar</button></a></td>";



              echo "</tr>";


          }
    $result->close();
          unset($obj);
          unset($connection);
    echo '</table>';

       ?>
