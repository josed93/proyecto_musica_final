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
<title>Editar Usuarios</title>
<?php include("../plantilla/header.php");?>
<?php
if(isset($_SESSION["user"])){
  include("../plantilla/temas.php");
}
else{
  echo '<link rel="stylesheet" href="../plantilla/plantilla.css">';
}
?>
<style>
.well {
background: rgb(202, 230, 255);
}

</style>

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
               <a href="../registro/registro.php" id="regbutton"><span><img src="../images/iconos_menu/reg.PNG"><b>Registrarse</b></span></a>
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


    <?php if(!isset($_POST["nombre"])): ?>
     <?php

    $coduser=$_GET['coduser'];
       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }


   $result = $connection->query("SELECT * FROM USUARIO WHERE COD_USU= '".$coduser."'");


     while($obj=$result->fetch_Object()){

            $username=$obj->USERNAME;
            $pass=$obj->PASSWORD;
            $dni=$obj->DNI;
            $nombre=$obj->NOMBRE;
            $apellidos=$obj->APELLIDOS;
            $fecha_nac=$obj->FECHA_NAC;
            $direccion=$obj->DIRECCION;
            $tlf=$obj->TLF;
            $email=$obj->EMAIL;
            $provincia=$obj->PROVINCIA;
            $localidad=$obj->LOCALIDAD;
            $pais=$obj->PAIS;
            $estado=$obj->ESTADO;
            $rol_user=$obj->ROL;



     }


     echo '<div class="container">
    <ul class="nav nav-pills well well-sm">
      <li class="active"><a href="#home" data-toggle="tab"><span class="glyphicon glyphicon-user"></span> Datos Personales</a></li>
      <li><a href="#profile" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span> Datos de la Cuenta</a></li>
      <li style="font-weight:bold;line-height:40px;font-size:120%;font-family:cursive;color:darkorange;margin-left:15%">USUARIO:&nbsp'.$username.'</li>';
        if($rol_user == 'user'){
      echo '<a href="./baja_user.php?coduser='.$coduser.'" style="float:right"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Dar de baja</button></a>
      <a href="./alta_user.php?coduser='.$coduser.'" style="float:right;margin-right:1%;"><button type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Dar de alta</button></a>';
        }
    echo '</ul>
    <div id="myTabContent" class="tab-content">

      <div class="tab-pane active in" id="home">
          <form id="tab" role="form" method="post">
           <div id="izquierda" style="margin-left:20%;width:25%;height:auto;float:left;">

              <div class="form-group">
                <label>DNI</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" name="dni" value="'.$dni.'">
                  </div>
              </div>
            <div class="form-group">
                <label>Nombre</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" name="nombre" value="'.$nombre.'">
                  </div>
             </div>
             <div class="form-group">
                <label>Apellidos</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                  <input type="text" class="form-control" name="apellidos" value="'.$apellidos.'">
                  </div>
             </div>

             <div class="form-group">
                <label>Email</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                  <input type="email" class="form-control" name="email" value="'.$email.'">
                  </div>

             </div>
             <div class="form-group">
                <label>Teléfono</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
                  <input type="number" class="form-control" name="tlf" value="'.$tlf.'">
                  </div>
             </div>



        </div>
        <div id="derecha" style="margin-left:5%;width:25%;height:auto;float:left">

              <div class="form-group">
                <label>Fecha de Nacimiento</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                  <input type="date" class="form-control" name="fecha_nac" value="'.$fecha_nac.'">
                  </div>
              </div>
            <div class="form-group">
                <label>Dirección</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
                  <input type="text" class="form-control" name="direccion" value="'.$direccion.'">
                  </div>
             </div>
             <div class="form-group">
                <label>Localidad</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                  <input type="text" class="form-control" name="localidad" value="'.$localidad.'">
                  </div>
             </div>
             <div class="form-group">
                <label>Provincia</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                  <input type="text" class="form-control" name="provincia" value="'.$provincia.'">
                  </div>
             </div>
             <div class="form-group">
                <label>País</label>
                <div class="input-group">
                  <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                  <input type="text" class="form-control" name="pais" value="'.$pais.'">
                  </div>
             </div>




        </div>
        <div id="modif" style="clear:left;float:right;margin-right:25%;">
           <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>
        </div>

      </div>
      <div class="tab-pane fade" id="profile">


             <div id="perf1" style="margin-left:20%;width:25%;height:auto;float:left">
              <div class="form-group">
                    <label>Nueva Contraseña</label>
                    <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                      <input type="password" class="form-control" name="new_pass" placeholder="Introduzca su nueva contraseña">
                      </div>
                </div>';
              if ($rol_user == 'user'){
                if($estado=='activo'){
              echo '<p ><em>Estado actual de la cuenta</em>:<span style="color:green"><b> '.$estado.'</b></span></p>';
            }else {
              echo '<p ><em>Estado actual de la cuenta</em>:<span style="color:red"><b> '.$estado.'</b></span></p>';
            }
                }
              echo '</div>

                <div id="perf2" style="margin-left:5%;width:25%;height:auto;float:left">

                   <div class="form-group">
                    <label>Confirmar contraseña nueva</label>
                    <div class="input-group">
                      <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>

                      <input type="password" class="form-control" name="check_pass" placeholder="Confirme su nueva contraseña">
                      </div>
                  </div>

                    <div id="modif2" style="clear:left;float:right;margin-top:8%;">
           <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Modificar</button>
            </div>

                </div>


        </form>
      </div>
    </div>
    </div>';
    ?>

    <?php else: ?>
       <?php


            $coduser=$_GET['coduser'];
            $c_pass=$_POST['check_pass'];
            $n_pass=$_POST['new_pass'];
            $dni2=$_POST['dni'];
            $nombre2=$_POST['nombre'];
            $apellidos2=$_POST['apellidos'];
            $fecha_nac2=$_POST['fecha_nac'];
            $direccion2=$_POST['direccion'];
            $tlf2=$_POST['tlf'];
            $email2=$_POST['email'];
            $provincia2=$_POST['provincia'];
            $localidad2=$_POST['localidad'];
            $pais2=$_POST['pais'];

        //ACTUALIZA LOS DATOS PERSONALES DEL USUARIO

   $connection2 = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection2->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result2 = $connection2->query("UPDATE USUARIO SET DNI='".$dni2."',NOMBRE='".$nombre2."',APELLIDOS='".$apellidos2."',FECHA_NAC='".$fecha_nac2."',DIRECCION='".$direccion2."',TLF='".$tlf2."',EMAIL='".$email2."',PROVINCIA='".$provincia2."',LOCALIDAD='".$localidad2."',PAIS='".$pais2."' WHERE COD_USU= '".$coduser."'");

            unset($connection2);



 //ACTUALIZA LOS DATOS DE LA CUENTA DEL USUARIO
    if($n_pass==$c_pass){
       $connection3 = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection3->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result3 = $connection3->query("UPDATE USUARIO SET PASSWORD=md5('".$n_pass."') WHERE COD_USU= '".$coduser."'");

            unset($connection3);
        echo '  <script type="text/javascript">
                  document.location.href = document.location.href;
            </script>';






    }else{
        echo "Contraseña no coincide";

    }



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
