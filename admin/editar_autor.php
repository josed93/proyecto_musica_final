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
<title>Editar Autor</title>
<?php include("../plantilla/header.php");?>
<?php include("../plantilla/temas.php");?>
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

    }
      ?>

        <?php include("../plantilla/alerts.php");?>

    <div id="center" class="container">


    <?php if(!isset($_POST["nombreautor"])): ?>
     <?php

    $codautor=$_GET['codautor'];

     $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT * FROM AUTOR WHERE COD_AUTOR= '".$codautor."'");


     while($obj=$result->fetch_Object()){

            $nom_a=$obj->NOMBRE_A;
            $fecha_nac=$obj->FECHA_NAC;





     }


     echo '<div class="container">
     <div class="well well-sm" style="text-align:center">
     <h5 style="font-weight:bold">EDITAR AUTORES</h5>

     </div>

    <div id="myTabContent" class="tab-content">

      <div class="tab-pane active in" id="home">
          <form id="tab" role="form" method="post">
           <div id="izquierda" style="margin-left:20%;width:25%;height:auto;float:left;">

              <div class="form-group">
                <label>NOMBRE</label>

                  <input type="text" class="form-control" name="nombreautor" value="'.$nom_a.'">

              </div>



        </div>
        <div id="derecha" style="margin-left:5%;width:25%;height:auto;float:left;">
            <div class="form-group">
                <label>FECHA DE NACIMIENTO</label>

                  <input type="date" class="form-control" name="fecha_nac" value="'.$fecha_nac.'">

             </div>


        </div>

        <div id="modif" style="clear:left;float:right;margin-right:25%;">
           <input type="submit" class="btn btn-primary" value="Modificar">
        </div>

      </div>

        </form>
      </div>
    </div>
    </div>';
    ?>

    <?php else: ?>
       <?php

            $codautor2=$_GET['codautor'];
            $nom_a2=$_POST['nombreautor'];
            $fecha_nac2=$_POST['fecha_nac'];



        //ACTUALIZA LOS DATOS DE LAS DISCOGRÁFICAS

   $connection2 = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection2->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result2 = $connection2->query("UPDATE AUTOR SET NOMBRE_A='".$nom_a2."',FECHA_NAC='".$fecha_nac2."' WHERE COD_AUTOR= '".$codautor2."'");

            unset($connection2);

        echo '  <script type="text/javascript">
                  document.location.href = document.location.href;
            </script>';




?>


        <?php endif ?>



    </div>
    <?php include("../plantilla/footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
