<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){
        if($_SESSION["rol"] == "admin"){
            header("Location:../admin/ausuarios.php");
        }

    }

?>
<?php
  //include_once("./db_configuration.php");
?>

<!DOCTYPE html>
<html lang="">
<title>Cesta</title>
<?php include("../plantilla/header.php");?>
<?php
if(isset($_SESSION["user"])){
  include("../plantilla/temas.php");
}
else{
  echo '<link rel="stylesheet" href="../plantilla/plantilla.css">';
}
?></head>



<body>
  <script>
  function oculta(id){
    var elDiv = document.getElementById(id); //se define la variable "elDiv" igual a nuestro div
      elDiv.style.display='none'; //damos un atributo display:none que oculta el div
     }
     </script>


    <div id="top" class="container">
        <div id="logo">
            <a href="../inicio/inicio.php"><img src="../images/prueba.png"></a>

        </div>
        <div id="logo2">
            <a href="../inicio/inicio.php"><img src="../images/logo2.PNG"></a>

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
                $estado=$obj->ESTADO;


                $_SESSION["user"]=$userlogin;
                $_SESSION["rol"]=$rol;
                $_SESSION["estado"]=$estado;


                  }

           /* while($obj = $result->fetch_object()) {
                  $rol=$obj->ROL;
              if($_POST["alargar_sesion"] == true){
                    $_SESSION["user"]=$userlogin;
                    $_SESSION["rol"]=$rol;
                    setcookie("PHPSESSID",$userlogin,time() +3600,"/","","",TRUE);

              }
               else{
                   $_SESSION["user"]=$userlogin;
                    $_SESSION["rol"]=$rol;


               }
            }*/




               if ($rol == "admin"){
                   header("Location:../admin/ausuarios.php");
               }
               else{
                    header("Location:../inicio/inicio.php");
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
    <div id="carrito" class="rotateinfinite">
                    <a href="../tienda/cesta.php"><img src="../images/carrito.PNG" style="float:left;width:40px;height:40px"/><p style="position:relative;float:left;top:20px;left:-23px;">
                      <?php
                      //CREATING THE CONNECTION
                       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                        //TESTING IF THE CONNECTION WAS RIGHT
                        if ($connection->connect_errno) {
                            printf("Conexión fallida %s\n", $mysqli->connect_error);
                            exit();
                        }
                      $user=$_SESSION["user"];
                      $consulta = "SELECT SUM(CESTA.CANTIDAD) AS total FROM USUARIO, CESTA WHERE USUARIO.COD_USU = CESTA.COD_USU AND USUARIO.USERNAME = '".$user."';";
                      if($result = $connection->query($consulta)){
                            $total=0;
                            if($result->num_rows==0){
                            }else{
                                while($fila=$result->fetch_object()){
                                    $total=$total+$fila->total;
                                }
                            }
                            echo " ($total)";
                      }
                      ?>
                    </p></a>
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
                                                 <input type="checkbox" name="alargar_sesion"> Mantener en sesión
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
        <?php include("../plantilla/menu.php");?>
        <?php include("../plantilla/alerts.php");?>

    <div id="center" class="container">
      <div id="tabla" class="container">



        <a href='../tienda/cesta.php?hacerpedido=yes' id='hp' ><button style='float:right;margin-bottom:10px;' type='button'
          class='btn btn-success btn-lg'><span class='glyphicon glyphicon-ok'></span> Realizar pedido</button></a>

          <?php

            if(isset($_GET["hacerpedido"])){
              //CREATING THE CONNECTION
               $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
                //TESTING IF THE CONNECTION WAS RIGHT
                if ($connection->connect_errno) {
                    printf("Conexión fallida %s\n", $mysqli->connect_error);
                    exit();
                }

              $consultaRecuperarIdUsuario="SELECT COD_USU FROM USUARIO WHERE USERNAME='".$_SESSION["user"]."'";
              $result= $connection->query($consultaRecuperarIdUsuario);
              $fila=$result->fetch_object();

              $idusuario=$fila->COD_USU;

              $consultaRecogerCestaUsuario="SELECT C.CANTIDAD, D.PRECIO,D.COD_DISCO,C.COD_DISCO
               FROM CESTA C,DISCO D
               WHERE C.COD_DISCO=D.COD_DISCO AND C.COD_USU='".$idusuario."'";

              if($result2=$connection->query($consultaRecogerCestaUsuario)){
                if($result2->num_rows==0){

                  //echo "No hay productos en la cesta para realizar el pedido";
                }else{

                  $consultaPedido="INSERT INTO PEDIDO (`COD_USU`, `FECHA_PED`, `IMPORTE`) VALUES ($idusuario,CURRENT_TIMESTAMP(),0)";
                  $result= $connection->query($consultaPedido);

                  $consultaRecuperarMaxIdPedido="SELECT * FROM PEDIDO ORDER BY COD_PEDIDO DESC LIMIT 1;";
                  $result3= $connection->query($consultaRecuperarMaxIdPedido);

                  $idNuevoPedido=0;
                  while($f=$result3->fetch_object()){
                    $idNuevoPedido=$f->COD_PEDIDO;
                  }

                  echo $idNuevoPedido;
                  $precioTotalPedido=0;

                  while($fila=$result2->fetch_object()){
                    $consultaInsertDetallesLineaPedido="INSERT INTO LINEA_PEDIDO (`CANTIDAD`, `COD_PEDIDO`, `COD_DISCO`)
                     VALUES (".$fila->CANTIDAD.",$idNuevoPedido,".$fila->COD_DISCO.")";
                    $connection->query($consultaInsertDetallesLineaPedido);
                    $cant=$fila->CANTIDAD;
                    $precio=$fila->PRECIO;
                    $precioTotalPedido= $precioTotalPedido +($cant*$precio);

                  }

                  $connection->query("UPDATE PEDIDO SET IMPORTE = $precioTotalPedido WHERE COD_PEDIDO=$idNuevoPedido");
                  $connection->query("DELETE FROM CESTA WHERE COD_USU=$idusuario");
                  header("Location: ../tienda/cesta.php");

                }
              }else{
                echo $connection->error;
              }


            }
        ?>


      <?php
      //CREATING THE CONNECTION
       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Conexión fallida %s\n", $mysqli->connect_error);
            exit();
        }


      //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
      $consulta="SELECT D.CARATULA,D.TITULO,D.PRECIO,C.CANTIDAD,D.COD_DISCO,(C.CANTIDAD*D.PRECIO) AS PRECIOTOTAL FROM CESTA C,USUARIO U,DISCO D WHERE D.COD_DISCO=C.COD_DISCO AND C.COD_USU=U.COD_USU AND U.USERNAME='".$_SESSION["user"]."'";

      if ($result = $connection->query($consulta)) {
            if ($result->num_rows==0) {
              echo '<hr style="border:solid 1px brown">';
              echo '<span style="margin:5% 0 0 30%;font-size:200%;font-weight:bold;font-family:Courier New;color:brown">NO HAY DISCOS EN LA CESTA</span>';
                echo '<hr style="border:solid 1px brown;margin-bottom:10%">';
                echo '<script type="text/javascript">
                $(document).ready(function(){
                  oculta("hp");

                });
                $(document).ready(function(){
                  oculta("so");

                });
                $(document).ready(function(){
                  oculta("so2");

                });

                  </script>';

            } else {
              echo '<table   style="margin-top:20px;text-align:center"  class="table">
                  <tr class="active">
                    <th style="text-align:center;">Carátula</th>
                    <th style="text-align:center;">Título</th>
                    <th style="text-align:center;">Precio</th>
                    <th style="text-align:center;">Cantidad</th>
                    <th style="text-align:center;">Precio Total Disco</th>
                    <th style="text-align:center;">Operaciones</th>

                  </tr>';
                  while($fila=$result->fetch_object()){
                      echo "<tr>
                              <td><img src='../images/caratulas/".$fila->CARATULA."' style='width:40px;height:40px' alt='' /></td>
                              <td>$fila->TITULO</td>
                              <td>$fila->PRECIO €</td>
                              <td>$fila->CANTIDAD</td>
                              <td>$fila->PRECIOTOTAL €</td>
                              <td>
                                <a href='../tienda/cesta.php?codisco=".$fila->COD_DISCO."'><button type='button' class='btn btn-danger btn'><span class='glyphicon glyphicon-trash'></span> Borrar</button></a>
                              </td>
                            </tr>";
                  }
            }
      }else{
        echo $connection->error;
      }

      ?>
    </table>
    <?php
    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
     //TESTING IF THE CONNECTION WAS RIGHT
     if ($connection->connect_errno) {
         printf("Conexión fallida %s\n", $mysqli->connect_error);
         exit();
     }


   //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
   $consulta="SELECT SUM(C.CANTIDAD*D.PRECIO) AS PRECIOTOTALTOTAL FROM CESTA C,USUARIO U,DISCO D WHERE D.COD_DISCO=C.COD_DISCO AND C.COD_USU=U.COD_USU AND U.USERNAME='".$_SESSION["user"]."'";
   $result=$connection->query($consulta);
   $fila=$result->fetch_object();
   echo "<span id='so' style='font-weight:bold;font-size:150%;text-decoration: underline;'>Precio Total del pedido: </span>&nbsp&nbsp<span id='so2' style='font-weight:bold;font-size:190%;font-family:cursive;color:darkred'>$fila->PRECIOTOTALTOTAL €</span>";


        if(isset($_GET["codisco"])){
          $idproducto=$_GET["codisco"];

          //CREATING THE CONNECTION
           $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
            //TESTING IF THE CONNECTION WAS RIGHT
            if ($connection->connect_errno) {
                printf("Conexión fallida %s\n", $mysqli->connect_error);
                exit();
            }

          $consultaRecuperarIdUsuario="SELECT COD_USU FROM USUARIO WHERE USERNAME='".$_SESSION["user"]."'";
          $result= $connection->query($consultaRecuperarIdUsuario);
          $fila=$result->fetch_object();

          $idusuario=$fila->COD_USU;

          $consultaBorrarCesta="DELETE FROM CESTA WHERE COD_DISCO=$idproducto AND COD_USU=$idusuario";

          $connection->query($consultaBorrarCesta);
          echo  $connection->error;
          echo  $consultaBorrarCesta;
          header("Location: ../tienda/cesta.php");
        }
     ?>
  </div>

</div>

    <?php include("../plantilla/footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
