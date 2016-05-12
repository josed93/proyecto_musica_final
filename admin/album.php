<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){
        if($_SESSION["rol"] == "admin"){

        }
        else{
        header("Location:../inicio/inicio.php");
        }

    }
    else{
        header("Location:../inicio/inicio.php");
    }
?>
<!DOCTYPE html>
<html lang="">
<title>Álbum</title>
<?php include("../plantilla/header.php");?>
<?php
if(isset($_SESSION["user"])){
  include("../plantilla/temas.php");
}
else{
  echo '<link rel="stylesheet" href="../plantilla/plantilla.css">';
}
?>
<script type="text/javascript" src="../javascript/gestion_disco.js"></script>
<script type="text/javascript" src="../javascript/gestion_cancion.js"></script>
</head>

<body>

    <div id="top">
        <div id="logo">
            <a href="../admin/ausuarios.php"><img src="../images/prueba.png"></a>

        </div>
        <div id="logo2">
            <a href="../admin/ausuarios.php"><img src="../images/logo2.PNG"></a>

        </div>
        <?php include("../plantilla/searchnbar.php");?>
       <?php
    if(isset($_POST["user"])){

        $userlogin=$_POST["user"];
        $passlogin=$_POST["password"];

        //CREATING THE CONNECTION
         $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
          //TESTING IF THE CONNECTION WAS RIGHT
          if ($connection->connect_errno) {
              printf("Conexión fallida %s\n", $mysqli->connect_error);
              exit();
          }
          //MAKING A SELECT QUERY
          /* Consultas de selección que devuelven un conjunto de resultados */

            $consulta="SELECT * FROM USUARIO where USERNAME='".$userlogin."'and PASSWORD=md5('".$passlogin."') and ESTADO='activo';";

          if ($result = $connection->query($consulta)) {
              if($result->num_rows===0){

                  ?>
                  <script type="text/javascript">
                      $(document).ready( function() {
                        $('#failedlogin').show();
                        $('#failedlogin').delay(3000).fadeOut();

                      });
                </script>

              <?php


          }else{

           while($obj = $result->fetch_object()) {
                  $rol=$obj->ROL;

                  $_SESSION["user"]=$userlogin;
                  $_SESSION["rol"]=$rol;

                  }

            }

      }else{
        ?>
              <script type="text/javascript">
                  $(document).ready( function() {
                    $('#novalido').show();
                    $('#novalido').delay(3000).fadeOut();

                  });
            </script>

              <?php
        }
    }

    ?>
    <?php

    if(isset($_SESSION["user"])){
    ?>

    <div>
      <ul id="ent" class="navbar-left">
        <li class="dropdown">
          <a  href="#" class="dropdown-toggle" data-toggle="dropdown"><b><?php echo $_SESSION["user"]?></b> <span class="caret"></span></a>
            <ul id="login-dp2" class="dropdown-menu" style="width:100px;">
                <li>
                     <div class="row">
                            <div class="collapse navbar-collapse">
                                <ul class="nav navbar-nav">
                                    <li id="uno"><a href="../perfil/perfil.php"><span class="glyphicon glyphicon-user"></span>Ver perfil</a></li>
                                    <?php

                                    if($_SESSION["rol"] == "user"){
                                        echo '<li id="uno"><a href="../tienda/ver_pedidos.php"><span class="glyphicon glyphicon-eye-open"></span>Ver pedidos</a></li>';
                                    }
                                    ?>
                                    <li id="dos"><a href="../plantilla/logout.php"><span class="glyphicon glyphicon-log-in"></span>Cerrar sesión</a></li>

                                </ul>



                            </div>

                     </div>
                </li>
            </ul>
        </li>
      </ul>
    </div>



    <?php
    }
    else{
    ?>
        <div>
          <ul id="ent" class="navbar-left">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Entrar</b> <span class="caret"></span></a>
                <ul id="login-dp" class="dropdown-menu">
                    <li>
                         <div class="row">
                                <div class="col-md-12">


                                        <form class="form" role="form" method="post" action="" accept-charset="UTF-8" id="login-nav">
                                            <div class="form-group">
                                                 <label class="sr-only" for="exampleInputUsername2">Usuario</label>
                                                 <input type="text" class="form-control" id="name" name="user" placeholder="Usuario" required>
                                            </div>
                                            <div class="form-group">
                                                 <label class="sr-only" for="exampleInputPassword2">Contraseña</label>
                                                 <input type="password" class="form-control" id="pass" name="password" placeholder="Contraseña" required>
                                                 <div class="help-block text-right"><a href="">Olvidaste la contraseña ?</a></div>
                                            </div>
                                            <div class="form-group">
                                                 <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                            </div>
                                            <div class="checkbox">
                                                 <label>
                                                 <input type="checkbox"> Mantener en sesión
                                                 </label>
                                            </div>
                                     </form>
                                </div>

                         </div>
                    </li>
                </ul>
            </li>
          </ul>
        </div>
        <div id="reg">
               <a href="../registro/registro.php" id="regbutton"><span><img src="../images/iconos_menu/reg.PNG"><b>Registrarse</b></span><em></em></a>
        </div>


    <?php
    }


?>





    </div>
        <?php include("../admin/amenu.php");?>
        <?php include("../plantilla/alerts.php");?>

    <div id="center" class="container">
      <div class="container well well-sm" style="margin-bottom:1%">
      <a href="./anadir_disco.php"><button type="button" class="btn btn-success col-sm-1"><span class="glyphicon glyphicon-plus"></span> Añadir</button></a>

	<div class="row">
	<h5 style="font-weight:bold;color:#00BFFF;float:left;font-family:cursive" class="col-md-offset-4">DISCOS AÑADIDOS</h5>
  <div class="input-group custom-search-form col-md-2" style="margin-right:1%;float:right" >
    <input id="sdi" type="text" class="form-control" placeholder="Filtrar por nombre:">
    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>

   </div>
   <div style="float:right;margin-right:0.2%;">
   <a href="../pdf/listadiscosD.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
     onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-download-alt"></span></button></a>
 </div>
   <div style="float:right;margin-right:0.2%;">
   <a href="../pdf/listadiscos.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
     onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-file"></span> PDF</button></a>
 </div>
	</div>
    </div>

     <?php
 $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT D.*,A.NOMBRE_A FROM DISCO D,DISCOGRAFICA DF,AUTOR A WHERE D.COD_AUTOR=A.COD_AUTOR GROUP BY D.COD_DISCO");


   ?>
      <div id="tdi" style="height:500px;overflow: auto" class="col-md-10 col-md-offset-1 table-responsive" >
       <table style="margin-top:2%;" class="table table-hover table-bordered table-responsive ">
       <tr style="font-weight:bold;text-align:center;background-color:#F2F2F2">

          <td>CARÁTULA</td>
           <td>TÍTULO</td>
           <td>AUTOR</td>
           <td>PRECIO</td>
           <td colspan="4">OPERACIONES</td>


       </tr>

      <?php
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

        </div>
         <!------------ VER DETALLES ---------->


        <?php

    if(isset($_GET["codisco1"])){
        $codisco=$_GET["codisco1"];
        $connection6 = new mysqli($db_host, $db_user, $db_password, $db_name);

              if ($connection6->connect_errno) {
                 printf("Conexión fallida %s\n", $mysqli->connect_error);
                 exit();
             }


          $result6 = $connection6->query("SELECT D.*,DF.NOMBRE,COUNT(TITULO_C) AS NUM_CANC,A.NOMBRE_A FROM DISCO D,DISCOGRAFICA DF,CANCION C,AUTOR A WHERE D.COD_DISCOGRA=DF.COD_DISCOGRA AND D.COD_DISCO=C.COD_DISCO AND D.COD_AUTOR=A.COD_AUTOR AND D.COD_DISCO='".$codisco."' GROUP BY D.COD_DISCO");
          $obj6 = $result6->fetch_object();




   ?>
        <div class="col-md-10 col-md-offset-1" >
            <div class="nav nav-tabs well well-sm" style="text-align:center;"><h5 style="font-weight:bold;color:#FF8000;font-family:cursive">DETALLES DEL DISCO: <?php echo $obj6->TITULO; ?></h5></div>
        <div class="table-responsive">
       <table style="margin-top:-1%;text-align:center;font-size:90%" class="table table-hover table-bordered">
       <tr style="font-weight:bold">

           <td>TÍTULO</td>
           <td>AUTOR</td>
           <td>GÉNERO</td>
           <td>Nº DE CANCIONES</td>
           <td>FECHA DE PUBLICACIÓN</td>
           <td>PRECIO</td>
           <td>CANTIDAD</td>
           <td>DISCOGRÁFICA</td>



       </tr>

      <?php
      $connection2 = new mysqli($db_host, $db_user, $db_password, $db_name);

            if ($connection2->connect_errno) {
               printf("Conexión fallida %s\n", $mysqli->connect_error);
               exit();
           }


        $result2 = $connection2->query("SELECT D.*,DF.NOMBRE,COUNT(TITULO_C) AS NUM_CANC,A.NOMBRE_A FROM DISCO D,DISCOGRAFICA DF,CANCION C,AUTOR A WHERE D.COD_DISCOGRA=DF.COD_DISCOGRA AND D.COD_DISCO=C.COD_DISCO AND D.COD_AUTOR=A.COD_AUTOR AND D.COD_DISCO='".$codisco."' GROUP BY D.COD_DISCO");

          //RECORRER OBJETOS DE LA CONSULTA
          while($obj2 = $result2->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj2->TITULO."</td>";
              echo "<td>".$obj2->NOMBRE_A."</td>";
              echo "<td>".$obj2->GENERO."</td>";
              echo "<td>".$obj2->NUM_CANC."</td>";
              echo "<td>".$obj2->FECHA."</td>";
              echo "<td>".$obj2->PRECIO."&nbsp€</td>";
              echo "<td>".$obj2->CANTIDAD."&nbsp</td>";
              echo "<td>".$obj2->NOMBRE."</td>";


              echo "</tr>";


          }
        $result2->close();
          unset($obj2);
          unset($connection2);

      echo '</table>';
        echo '</div>';



            echo '</div>';
            }

           ?>
           <!------------ VER CANCIONES ---------->


        <?php

    if(isset($_GET["codisco2"])){
        $codisco2=$_GET["codisco2"];
        $connection5 = new mysqli($db_host, $db_user, $db_password, $db_name);
            if ($connection5->connect_errno) {
               printf("Conexión fallida %s\n", $mysqli->connect_error);
               exit();
           }


        $result5 = $connection5->query("SELECT C.* , D.TITULO FROM CANCION C, DISCO D WHERE D.COD_DISCO=C.COD_DISCO AND C.COD_DISCO='".$codisco2."'");
        $obj5 = $result5->fetch_object();


   ?>
        <div class="col-md-8 col-md-offset-2" >
            <div class="nav nav-tabs well well-sm " style="text-align:center;">
            <a href="./anadir_cancion.php?codisco5=<?php echo $codisco2 ?>"><button type="button" class="btn btn-success col-sm-2"><span class="glyphicon glyphicon-plus"></span> Añadir</button></a>
            <div class="row">
	<h5 style="font-weight:bold;color:#00BFFF;float:left;font-family:cursive" class="col-md-offset-3">CANCIONES DE: <?php echo $obj5->TITULO; ?></h5>
  <div style="float:right;margin-right:1%;">
  <a href="../pdf/listacancionesD.php?codisco4=<?php echo $codisco2 ?>"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
    onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-download-alt"></span></button></a>
</div>
  <div style="float:right;margin-right:0.2%;">
  <a href="../pdf/listacanciones.php?codisco3=<?php echo $codisco2 ?>"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
    onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-file"></span> PDF</button></a>
</div>
	</div>
       </div>
        <div class="table-responsive" style="height:300px;overflow: auto" >
       <table id="tcan" style="text-align:center;font-size:90%" class="table table-hover table-bordered">
       <tr style="font-weight:bold;text-align:center;background-color:#F2F2F2">

           <td>TÍTULO</td>
           <td>DURACIÓN</td>
           <td colspan="2">OPERACIONES</td>




       </tr>

      <?php
      $connection3 = new mysqli($db_host, $db_user, $db_password, $db_name);
          if ($connection3->connect_errno) {
             printf("Conexión fallida %s\n", $mysqli->connect_error);
             exit();
         }


      $result3 = $connection3->query("SELECT C.* , D.TITULO FROM CANCION C, DISCO D WHERE D.COD_DISCO=C.COD_DISCO AND C.COD_DISCO='".$codisco2."'");

          //RECORRER OBJETOS DE LA CONSULTA
          while($obj3 = $result3->fetch_object()) {


              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj3->TITULO_C."</td>";
              echo "<td>".$obj3->DURACION."</td>";
              echo "<td><a href='./editar_cancion.php?codcan=$obj3->COD_CANCION'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'> Editar</button></a></td>";
              echo "<td><a href='./borrar_cancion.php?codcan=$obj3->COD_CANCION'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'> Borrar</button></a></td>";



              echo "</tr>";


          }
        $result3->close();
          unset($obj3);
          unset($connection3);

      echo '</table>';
        echo '</div>';



            echo '</div>';
            }

           ?>



    </div>
    <?php include("../plantilla/footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
