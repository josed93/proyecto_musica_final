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
<?php
  //include_once("./db_configuration.php");
?>

<!DOCTYPE html>
<html lang="">
<title>Ver Pedidos Admin</title>
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

  }else {
    include("../plantilla/menu.php");
  }
    ?>
        <?php include("../plantilla/alerts.php");?>

    <div id="center" class="container">
      <div class="nav nav-tabs well well-sm " style="text-align:center;">

      <div class="row">
<h5 style="font-weight:bold;color:#00BFFF;float:left;font-family:cursive;" class="col-md-offset-5">PEDIDOS DE TODOS LOS USUARIOS</h5>
<div style="float:right;margin-right:1%;">
<a href="../pdf/listapedidosadminD.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
  onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-download-alt"></span></button></a>
</div>
<div style="float:right;margin-right:0.2%;">
<a href="../pdf/listapedidosadmin.php"><button type="button" style=" background-color: #DF0101;color:white;font-weight:bold" class="btn btn-muted col-sm-0"
  onMouseOver="this.style.cssText='background-color: #FF0000;color:#2E2E2E;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #DF0101;color:white;font-weight:bold'"><span class="glyphicon glyphicon-file"></span> PDF</button></a>
</div>
</div>
 </div>
      <div id="tabla" style="height:300px;overflow: auto" class="table-responsive">
      <table style="margin-top:20px;text-align:center" class="table table-hover table-bordered">
          <tr class="active">
            <th style="text-align:center" >Usuario</th>
            <th style="text-align:center" >Disco</th>
            <th style="text-align:center" >Fecha Pedido</th>
            <th style="text-align:center" >Cantidad</th>
            <th style="text-align:center" >Importe total</th>
          </tr>
      <?php
      //CREATING THE CONNECTION
       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Conexión fallida %s\n", $mysqli->connect_error);
            exit();
        }


      //Aqui ponemos $user y $pass porque recogemos las variables arriba por eso no usamos $_POST.
      $consulta="SELECT *,LP.CANTIDAD AS CANT FROM PEDIDO P,USUARIO U,LINEA_PEDIDO LP,DISCO D WHERE P.COD_USU=U.COD_USU AND P.COD_PEDIDO=LP.COD_PEDIDO AND LP.COD_DISCO=D.COD_DISCO ORDER BY FECHA_PED ASC ";


      if ($result = $connection->query($consulta)) {

            //Si te devuelve 0 es que el usuario no esta en la base de datos.Sino si existe y mira en else
            if ($result->num_rows==0) {
              //echo "EL USUARIO NO EXISTE";
            } else {
                  while($fila=$result->fetch_object()){
                      echo "<tr>
                              <td>$fila->USERNAME</td>
                              <td>$fila->TITULO</td>
                              <td>$fila->FECHA_PED</td>
                              <td>$fila->CANT</td>
                              <td>$fila->IMPORTE&nbsp€</td>
                            </tr>";
                  }
            }
      }else{
        echo $connection->error;
      }

      ?>
      </table> </center>

    </div>
  </div>

    <?php include("../plantilla/footer.php");?>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>







</body>
</html>
<?php
ob_end_flush();
?>
