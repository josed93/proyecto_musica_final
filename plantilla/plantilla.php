<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){
        if($_SESSION["rol"] == "user"){
            header("Location:../inicio/inicio.php");
        }else{

        }

    }
    else{

    }


?>

<!DOCTYPE html>
<html lang="">
<?php include("./header.php");?>
<body>

    <div id="top">
        <div id="logo">
            <a href="../inicio/inicio.php"><img src="../images/prueba.png"></a>

        </div>
        <div id="logo2">
            <a href="../inicio/inicio.php"><img src="../images/logo2.PNG"></a>

        </div>
        <?php include("./searchnbar.php");?>
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

        $consulta="SELECT * FROM usuario where username='".$userlogin."'and password=md5('".$passlogin."');";

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
              header("Location: ../registro/registro.php");



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




        <div id="carrito" class="rotateinfinite">
                <a href="#"><img src="../images/carrito.PNG"></a>

        </div>






    </div>
        <?php include("./menu.php");?>
        <?php include("./alerts.php");?>

    <div id="center">
        <?php include("../registro/r_alerts.php");?>



         <h2>CREAR CUENTA</h2>



        <div id="izq">




            <h4>INFORMACIÓN PERSONAL</h4>
        <form method="post" action="#">

        <table>
            <tr>
                <td>
                   <label for="nombre">NOMBRE</label><br>
                    <input type="text" name="name" id="nombre" required><br>

                </td>
            </tr>
            <tr>
                <td>
                    <label for="apellidos">APELLIDOS</label><br>
                    <input type="text" name="proname" id="apellidos" required><br>

                </td>
            </tr>
            <tr>
                <td>
                   <label for="email">CORREO ELECTRÓNICO</label><br>
                    <input type="email" name="mail" id="email" required><br>



                </td>
            </tr>
        </table>

        </div>
        <div id="der">
           <h4>INFORMACIÓN DE INICIO DE SESIÓN</h4>

            <table>
            <tr>

                <td>
                   <label for="nickname">NOMBRE DE USUARIO</label><br>
                    <input type="text" name="nickname" id="nickname" required><br>

                </td>
            </tr>
                <tr>
                <td>
                   <label for="password">CONTRASEÑA</label><br>
                    <input type="password" name="pass" id="password" required onchange="form.test.pattern = this.value;"><br>

                </td>
            </tr>
                <tr>
                <td>
                   <label for="testpass">CONFIRMAR LA CONTRASEÑA</label><br>
                    <input type="password" name="test" id="testpass" required oninvalid="setCustomValidity('Las contraseñas no coinciden ')"
    onchange="try{setCustomValidity('')}catch(e){}" /><br>

                </td>
            </tr>

            </table>



        </div>

        <input type="submit" name="sub" id="enviar" value="REGISTRAR">

        </form>




        <?php
           if(isset ($_POST["nickname"])){
            $nombre=$_POST["name"];
            $apellidos=$_POST["proname"];
            $email=$_POST["mail"];
            $username=$_POST["nickname"];
            $password=$_POST["pass"];
            $confpass=$_POST["test"];

 $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
    if($connection->connect_errno)
    {
        printf("ERROR AL INTENTAR CONECTARSE A LA BASE DE DATOS",$connection->connect_errno);
        exit();

    }


     $connection->query("INSERT INTO USUARIO (nombre,apellidos,email,username,password,rol) VALUES ('$nombre','$apellidos','$email','$username',md5('$password'),'user')");

             echo '  <script type="text/javascript">
                  $(document).ready( function() {
                    $("#true-reg").show();
                    $("#true-reg").delay(3000).fadeOut();

                  });
                  setTimeout(function(){
                      window.location.href = "../inicio/inicio.php";
                  },3000)
            </script>';

        unset($connection);
 /*echo '<script type="application/javascript">alert("Usuario '.$username.' creado correctamente"); window.location.href = "../inicio/inicio.php";</script>';*/
            }
        ?>




    </div>
    <?php include("./footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
