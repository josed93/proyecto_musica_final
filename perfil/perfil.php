<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){


    }
    else{
        header("Location:../inicio/inicio.php");
    }

?>


<!DOCTYPE html>
<html lang="">
<title>Perfil Usuario</title>
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

  <style>
  .radio img{
      width: 90%;
      height: 90%;


  }
  .radio{
    display: inline-block;
    width: 20%;
    height: 20%;


  }





  </style>

    <div id="top">
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

    }
      ?>

        <?php include("../plantilla/alerts.php");?>

    <div id="center" class="container">
      <?php

      //CREATING THE CONNECTION
     $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      $connection->set_charset("utf8");

      echo '<div>
     <ul class="nav nav-pills well well-sm">
       <li class="active"><a href="#home" data-toggle="pill">Datos Personales</a></li>
       <li><a href="#menu1" data-toggle="tab">Datos de la Cuenta</a></li>';
       if($_SESSION['rol']=='user'){
       echo '<li><a href="#menu2" data-toggle="tab">Temas</a></li>';
       }
       if($_SESSION['rol']=='user'){
       echo '<a href="./baja.php" style="float:right;"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Dar de baja</button></a>';
       }
     echo '</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">

    <div class="container well ">';
      ?>
      <?php
    $consulta=("SELECT * FROM USUARIO where USERNAME='".$_SESSION['user']."' ");

    if ($result = $connection->query($consulta)) {


$obj = $result->fetch_object();

    ?>
  <form  action="datospersonales.php" class="form-horizontal " method="POST">
    <div id="izquierda" style="margin-left:20%;width:25%;height:auto;float:left;">

      <div class="form-group">
            <label>Nombre del Usuario</label>

                <input class="form-control" name="id" type="hidden"  value=<?php echo $obj->COD_USU;?> >
              <input class="form-control" type="text" name="nombre" value=<?php echo $obj->USERNAME;?> disabled>

          </div>
          <div class="form-group">
            <label>DNI</label>

              <input type="text" class="form-control" name="dni" value=<?php echo $obj->DNI;?>>

          </div>

        <div class="form-group">
            <label>Nombre</label>
              <input  class="form-control" type="text" name="nombre" value=<?php echo $obj->NOMBRE;?>>

          </div>

          <div class="form-group">
            <label>Apellidos</label>
              <input class="form-control" type="text"  name="apellido" value="<?php echo $obj->APELLIDOS?>">
          </div>
          <div class="form-group">
             <label>Email</label>

               <input type="email" class="form-control" name="email" value="<?php echo $obj->EMAIL?>">

          </div>
          <div class="form-group">
            <label>Teléfono</label>

            <div class="input-group">
              <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
              <input class="form-control" type="number"  name="telefono" value=<?php echo $obj->TLF;?>>

            </div>
          </div>
        </div>
        <div id="derecha" style="margin-left:5%;width:25%;height:auto;float:left">

          <div class="form-group">
            <label>Fecha de Nacimiento</label>

              <input type="date" class="form-control" name="fecha_nac" value="<?php echo $obj->FECHA_NAC?>">

          </div>
          <div class="form-group">
              <label>Dirección</label>

                <input type="text" class="form-control" name="direccion" value="<?php echo $obj->DIRECCION?>">

           </div>


          <div class="form-group">
             <label>Localidad</label>

               <input type="text" class="form-control" name="localidad" value="<?php echo $obj->LOCALIDAD?>">

          </div>
          <div class="form-group">
             <label>Provincia</label>

               <input type="text" class="form-control" name="provincia" value="<?php echo $obj->PROVINCIA?>">

          </div>
          <div class="form-group">
             <label>País</label>

               <input type="text" class="form-control" name="pais" value="<?php echo $obj->PAIS?>">

          </div>

                <div class="form-group">
                  <label class="col-sm-6 control-label" for="formGroup"></label>
                  <div class="col-sm-4">

                <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>



                  </div>
                </div>

          </div>



  </form>
  <?php
}?>

  </div>
</div>
<div class="tab-pane fade" id="menu1">
  <div class="container well">

    <?php
  $consulta2=("SELECT * FROM USUARIO where USERNAME='".$_SESSION['user']."' ");

  if ($result2 = $connection->query($consulta2)) {


$obj2 = $result2->fetch_object();

  ?>
  <form  action="datosdelacuenta.php" class="form-horizontal " method="POST">
       <div id="perf1" style="margin-left:20%;width:25%;height:auto;float:left">

        <div class="form-group">
          <label>Contraseña</label>
            <input class="form-control" name="id2" type="hidden"  value=<?php echo $obj2->COD_USU;?> >
            <input type="password" class="form-control" name="old_pass" placeholder="Introduzca su contraseña actual">

        </div>
        <p><em>Para poder cambiar su contraseña debe introducir la actual y posteriormente la nueva.</em></p>

        </div>
          <div id="perf2" style="margin-left:5%;width:25%;height:auto;float:left">
          <div class="form-group">
              <label>Nueva Contraseña</label>

                <input type="password" class="form-control" name="new_pass" placeholder="Introduzca su nueva contraseña">

          </div>
             <div class="form-group">
              <label>Confirmar contraseña nueva</label>

                <input type="password" class="form-control" name="check_pass" placeholder="Confirme su nueva contraseña">

            </div>

              <div id="modif2" style="clear:left;float:right;margin-top:8%;">
              <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>
              </div>

          </div>


        </form>
        <?php
      }?>
</div>
</div>

<div id="menu2" class="tab-pane fade">
  <div class="container well " >


      <?php
      //CREATING THE CONNECTION
     $connection3 = new mysqli($db_host, $db_user, $db_password, $db_name);

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      $connection3->set_charset("utf8");

      $consulta3=("SELECT * FROM USUARIO where USERNAME='".$_SESSION['user']."' ");

      if ($result3 = $connection3->query($consulta3)) {


  $obj3 = $result3->fetch_object();


    ?>
        <form  action="temas.php" class="form-horizontal " method="POST">
          <form id="tem">
            <input class="form-control" name="id" type="hidden"  value=<?php echo $obj3->COD_USU;?> >


            <div class="radio">
              <label for="opciones_0"><img src="../images/temas/0.jpg" alt="??" /></label>
                <input type="radio" name="opciones" id="opciones_0" value="0" >


            </div>
            <div class="radio">
              <label for="opciones_1"><img src="../images/temas/1.jpg" alt="??" /></label>
              <input type="radio" name="opciones" id="opciones_1" value="1" >

            </div>
            <div class="radio">
              <label for="opciones_2"><img src="../images/temas/2.jpg" alt="??" /></label>
              <input type="radio" name="opciones" id="opciones_2" value="2" >

            </div>
            <div class="radio">
              <label for="opciones_3"><img src="../images/temas/3.jpg" alt="??" /></label>
              <input type="radio" name="opciones" id="opciones_3" value="3">

            </div>



                      <div id="modif2" style="clear:left;float:right;margin-top:8%;">
                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>
                      </div>

  </form>
  </form>
  <?php
}else{

}?>
</div>
</div>
</div>
</div>
</div>
<?php include("../plantilla/footer.php");?>
  <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>

</body>
</html>
