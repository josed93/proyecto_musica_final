<?php
  include_once("../plantilla/db_configuration.php");
?>
<html>
<body>

<?php
$buscar=['buscar'];

if (!isset($buscar)){
      echo "Debe especificar una cadena a buscar";
      echo "</html></body> \n";
      exit;
}
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

      if ($connection->connect_errno) {
         printf("Conexión fallida %s\n", $mysqli->connect_error);
         exit();
     }

     $div1 ="<div class='prods_title colort'><p>CATÁLOGO DE PRODUCTOS</p></div>";

  $consulta = "SELECT * FROM DISCO WHERE TITULO LIKE '%$buscar%' OR GENERO LIKE '%$buscar%';";

  if ($result = $connection->query($consulta)) {
       if ($result->num_rows==0) {
       }else{
           while($fila=$result->fetch_object()){
               $div1=$div1.'<div id="divprods"><img src="'.$fila->CARATULA.'" style=" width:45%;height:175px;margin-left:27.5%;margin-top:5%;margin-bottom:2%;" /><div style="height:15%;width:100%;margin-bottom:2px;"><h5 style="color:#086A87;font-weight:bold;text-align:center">'.$fila->TITULO.' '.$fila->ROCK.'</h5></div><div style="height:15%;width:100%;margin-bottom:2px;"><center><a style="text-decoration:none;color:white" href="./ver_detalles_prod.php?codprod='.$fila->COD_DISCO.'" class="btn btn-success"><span style="color:white" class="glyphicon glyphicon-shopping-cart white" ></span> '.$fila->PRECIO.'€</a>
  </center></div></div>';
           }
       }
       echo $div1;
  }else{
    echo $connection->error;
  }

      ?>

</body>
</html>
