<?php
  include_once("../plantilla/db_configuration.php");
?>
 <?php
    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }

      $result = $connection->query("SELECT * FROM USUARIO WHERE USERNAME LIKE '%".$_GET['dato']."%'");
      echo '<table style="margin-top:2%;" class="table table-hover table-bordered table-responsive ">
       <tr style="text-align:center;font-weight:bold;background-color:#F2F2F2">

           <td>USERNAME</td>
           <td>ROL</td>
           <td>ESTADO</td>
           <td>NOMBRE</td>
           <td>EMAIL</td>
           <td colspan="3">OPERACIONES</td>


       </tr>';

          //RECORRER OBJETOS DE LA CONSULTA
          while($obj = $result->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj->USERNAME."</td>";
              echo "<td>".$obj->ROL."</td>";
              echo "<td>".$obj->ESTADO."</td>";
              echo "<td>".$obj->NOMBRE."</td>";
              echo "<td>".$obj->EMAIL."</td>";
              echo "<td><a href='?coduser=$obj->COD_USU'><button type='button' class='btn btn-info'><span class='glyphicon glyphicon-search'></span> Ver detalles</button></a></td>";
              echo "<td><a href='./editar_user.php?coduser=$obj->COD_USU'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'> Editar</button></a></td>";
              echo "<td><a href='./borrar_user.php?coduser=$obj->COD_USU'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'> Borrar</button></a></td>";





              echo "</tr>";


          }
    $result->close();
          unset($obj);
          unset($connection);
    echo '</table>';

       ?>
