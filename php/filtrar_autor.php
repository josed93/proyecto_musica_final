<?php
  include_once("../plantilla/db_configuration.php");
?>

<?php

  $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT * FROM AUTOR A WHERE A.NOMBRE_A LIKE '%".$_GET['dato']."%'");




       echo '<table style="margin-top:2%;" class="table table-hover table-bordered ">
       <tr style="font-weight:bold;text-align:center;background-color:#F2F2F2">

          
           <td>NOMBRE</td>
           <td>FECHA DE NACIMIENTO</td>
           <td colspan="2">OPERACIONES</td>


        </tr>';


          //RECORRER OBJETOS DE LA CONSULTA
while($obj = $result->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj->NOMBRE_A."</td>";
              echo "<td>".$obj->FECHA_NAC."</td>";

              echo "<td><a href='./editar_autor.php?codautor=$obj->COD_AUTOR'><button type='button' class='btn btn-warning'>Editar</button></a></td>";
              echo "<td><a href='./borrar_autor.php?codautor=$obj->COD_AUTOR'><button type='button' class='btn btn-danger'>Borrar</button></a></td>";



              echo "</tr>";


          }
    $result->close();
          unset($obj);
          unset($connection);
    echo '</table>';

       ?>
