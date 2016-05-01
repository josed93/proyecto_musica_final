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

<!DOCTYPE html>
<html lang="">
<title>Tienda</title>
<?php include("../plantilla/header.php");?>
<script type="text/javascript" src="../javascript/gestion_tienda.js"></script>
<?php
if(isset($_SESSION["user"])){
  include("../plantilla/temas.php");
}
else{
  echo '<link rel="stylesheet" href="../plantilla/plantilla.css">';
}
?></head>



<body>




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
      <div class="container well well-sm" style="margin-bottom:-1%">

  <div class="row">
    <a href="../estadisticas/discosmascomprados.php"><button type="button" style="margin-left:1%" class="btn btn-primary col-sm-2"><span class="glyphicon glyphicon-stats"></span> Ver discos más vendidos</button></a>
  <h5 style="font-weight:bold;color:orange;float:left;font-family:cursive" class="col-md-offset-3">DISCOS DE LA TIENDA</h5>
    <div class="col-md-offset-10" style="margin-right:1%">
            <div class="input-group custom-search-form" >
              <input id="sti" type="text" class="form-control" placeholder="Filtrar por titulo de disco:">

             </div>
        </div>
  </div>
    </div>
    <br>
    <br>

      <?php
      $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

            if ($connection->connect_errno) {
               printf("Conexión fallida %s\n", $mysqli->connect_error);
               exit();
           }


        $result = $connection->query("SELECT D.*,A.NOMBRE_A FROM DISCO D, AUTOR A WHERE D.COD_AUTOR=A.COD_AUTOR");
        ?>
<div class="container" id="dti">
  <?php
      while($obj=$result->fetch_object()){
          echo '<div style=";width:20%;margin-right:1.5%;height:20%;float:left;padding:5px 0px;margin-bottom:10px;margin:0 auto">
          <a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><img src="../images/caratulas/'.$obj->CARATULA.'" style="width:70%;height:80%;margin-left:15%"></a>
          <center><a href="../tienda/detalles_disco.php?codisco='.$obj->COD_DISCO.'"><h4 style="margin-top:2%">'.$obj->TITULO.'</h4></a></center>
          <center><p style="margin-top:-3%">'.$obj->NOMBRE_A.'</p></center>
          <center><h4 style="margin-top:-3%;color:red">'.$obj->PRECIO.' €</h4></center>
        </div>';
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
