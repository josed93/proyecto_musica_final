<?php

      $buscar = $_POST['b'];

      if(!empty($buscar)) {
            buscar($buscar);
      }

      function buscar($b) {
        include_once("../plantilla/db_configuration.php");

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        if ($connection->connect_errno) {
           printf("Conexión fallida %s\n", $mysqli->connect_error);
           exit();
       }

       $consulta = "SELECT * FROM DISCO WHERE TITULO LIKE '%".$b."%' OR GENERO LIKE '%".$b."%';";

       if ($result = $connection->query($consulta)) {
         $filas = $result->num_rows;
         $div1 ="<div style='opacity: 0.9;filter: alpha(opacity=90);'><h3 style='color: rgba(2, 112, 191, 1);margin-top:5%;font-weight:bold;font-family:cursive'>Búsqueda personalizada: $filas discos encontrados</h3></div>";

            if ($result->num_rows==0) {
            }else{
                while($obj=$result->fetch_object()){
                    $div1=$div1.'<div style=";width:10%;margin-right:1.5%;height:10%;float:left;padding:5px 0px;margin-bottom:10px;margin:0 auto;">

                    <a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><img src="../images/caratulas/'.$obj->CARATULA.'" style="width:70%;height:80%;margin-left:15%;margin-top:10%;border-radius:2%"></a>
                    <center><a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><h4 style="margin-top:2%">'.$obj->TITULO.'</h4></a></center>

                    <center><h4 style="margin-top:-3%;color:red">'.$obj->PRECIO.' €</h4></center>

                  </div>';
                }
            }
            echo $div1;
       }else{
         echo $connection->error;
       }
     }

    ?>
