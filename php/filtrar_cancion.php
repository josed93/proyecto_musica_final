<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
      $codisco2=$_GET["codisco"];
$connection3 = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection3->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result3 = $connection3->query("SELECT * FROM CANCION C WHERE C.COD_DISCO='".$codisco2."'");




       echo '<table id="tcan" style="margin-top:-1%;text-align:center;font-size:90%" class="table table-hover table-bordered">
       <tr style="font-weight:bold">

           <td>TÍTULO</td>
           <td>DURACIÓN</td>
           <td colspan="2">OPERACIONES</td>




       </tr>';


          //RECORRER OBJETOS DE LA CONSULTA
          while($obj3 = $result3->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj3->TITULO_C."</td>";
              echo "<td>".$obj3->DURACION."</td>";
              echo "<td><a href='./editar_cancion.php?codcan=$obj3->COD_CANCION'><button type='button' class='btn btn-warning'>Editar</button></a></td>";
              echo "<td><a href='./borrar_cancion.php?codcan=$obj3->COD_CANCION'><button type='button' class='btn btn-danger'>Borrar</button></a></td>";



              echo "</tr>";


          }
        $result3->close();
          unset($obj3);
          unset($connection3);

      echo '</table>';

       ?>
