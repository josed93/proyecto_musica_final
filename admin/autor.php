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
<title>Autores</title>
<?php include("../plantilla/header.php");?>
<script type="text/javascript" src="../javascript/gestion_autor.js"></script>
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
      <div class="container well well-sm" style="margin-bottom:0%">
      <a href="./anadir_autor.php"><button type="button" class="btn btn-success col-sm-1"><span class="glyphicon glyphicon-plus"></span> Añadir</button></a>
	<div class="row">
	<h5 style="font-weight:bold;color:#00BFFF;float:left;font-family:cursive" class="col-md-offset-4">AUTORES AÑADIDOS</h5>
  <div class="input-group custom-search-form col-md-2" style="margin-right:1%;float:right" >
    <input id="scan" type="text" class="form-control" placeholder="Filtrar por nombre:">
    <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>

   </div>
   <div style="float:right;margin-right:0.2%;">
   <a href="../pdf/listautoresD.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
     onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-download-alt"></span></button></a>
 </div>
   <div style="float:right;margin-right:0.2%;">
   <a href="../pdf/listautores.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
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


   $result = $connection->query("SELECT * FROM AUTOR");


   ?>
      <div  id="tcan" style="height:500px;overflow: auto" class="col-md-6 col-md-offset-3 table-responsive">

       <table style="margin-top:2%;" class="table table-hover table-bordered ">
       <tr style="font-weight:bold;text-align:center;background-color:#F2F2F2">


           <td>NOMBRE</td>
           <td>FECHA DE NACIMIENTO</td>
           <td colspan="2">OPERACIONES</td>


        </tr>

      <?php
          //RECORRER OBJETOS DE LA CONSULTA
          while($obj = $result->fetch_object()) {
              //PINTAR CADA FILA
              echo "<tr>";

              echo "<td>".$obj->NOMBRE_A."</td>";
              echo "<td>".$obj->FECHA_NAC."</td>";

              echo "<td><a href='./editar_autor.php?codautor=$obj->COD_AUTOR'><button type='button' class='btn btn-warning'><span class='glyphicon glyphicon-edit'> Editar</button></a></td>";
              echo "<td><a href='./borrar_autor.php?codautor=$obj->COD_AUTOR'><button type='button' class='btn btn-danger'><span class='glyphicon glyphicon-trash'> Borrar</button></a></td>";



              echo "</tr>";


          }
    $result->close();
          unset($obj);
          unset($connection);
    echo '</table>';

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
