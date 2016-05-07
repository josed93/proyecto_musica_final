<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();


?>
<?php
  //include_once("./db_configuration.php");
?>

<!DOCTYPE html>
<html lang="">
<title>Sobre nosotros</title>
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
                 $style=$obj->STYLE;


                 $_SESSION["user"]=$userlogin;
                 $_SESSION["rol"]=$rol;
                 $_SESSION["estado"]=$estado;
                 $_SESSION["style"]=$style;



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
        <?php
        if($_SESSION["rol"] == "user"){


        ?>
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
    <!-- EN FUNCIÓN DEL ROL QUE CAMBIE EL MENÚ-->
     <?php if(isset($_SESSION["user"])){
      if($_SESSION["rol"] == "admin"){
          include("../admin/amenu.php");
      }
      else{
          include("../plantilla/menu.php");
      }

  }else {
    include("../plantilla/menu.php");
  }
    ?>
        <?php include("../plantilla/alerts.php");?>

    <div id="center">
      <div class="container">
        <div style="margin: 0 auto" >
          <img src="../images/patio.jpg" style="margin: 0 auto;width:100%;padding-bottom:2%" >

        </div>
        <div style="float:right">
            <img src="../images/logo2.PNG">
        </div>
        <div style="width:55%;font-size:120%;font-family:tahoma;clear: left;border:solid 2px grey;border-radius:2%;margin-bottom:2%">
      <p>Página Web desarrollada por José Daniel de las Heras Díaz para el proyecto de Implantación de aplicaciones web de ASIR Segundo Año.</p>
      <p>Delasheras-Music va dedicada principalmente a la venta de discos de música de una gran multitud de géneros.</p>
      <br>
      </div>

      <div>
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              VER UBICACIÓN DEL SITIO
            </a>
          </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1585.1599987168577!2d-6.007117!3d37.382264!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfb6bb621dc08a753!2sInstituto+de+Educaci%C3%B3n+Secundaria+Ies+Triana!5e0!3m2!1sen!2sus!4v1456792245727" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>          </div>
        </div>
      </div>


    </div>

     </div>
     <p id="copy">Delasheras-Music. Copyright © 2015. All right reserved.</p>
     </div>
    </div>
    <?php include("../plantilla/footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
