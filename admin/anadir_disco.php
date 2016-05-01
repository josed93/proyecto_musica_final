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
<title>Añadir Disco</title>
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


    <?php if(!isset($_POST["titulo"])): ?>
     <?php



      echo '<div class="container">
    <div class="well well-sm" style="text-align:center">
     <h5 style="font-weight:bold">AÑADIR DISCOS</h5>

     </div>
    <div id="myTabContent" class="tab-content">

      <div class="tab-pane active in" id="home">
          <form id="tab" role="form" method="post" enctype="multipart/form-data">
           <div id="izquierda" style="margin-left:20%;width:25%;height:auto;float:left;">

              <div class="form-group">
                <label>Título</label>

                  <input type="text" class="form-control" name="titulo">

              </div>
              <div class="form-group">
                <label>Autor</label>

                  <select name="nombreautor" class="form-control" id="sel1">';
 $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
    $result = $connection->query("SELECT DISTINCT * FROM AUTOR A");
    echo "<option disabled selected>-- elige un autor --</option>";

    while($obj2 = $result->fetch_Object()){

        echo "<option value='$obj2->COD_AUTOR'>$obj2->NOMBRE_A</option>";

    }
  echo '</select>



              </div>
            <div class="form-group">
                <label>Género</label>

                  <input type="text" class="form-control" name="genero" >

             </div>

             <div class="form-group">
                <label>Fecha</label>

                  <input type="date" class="form-control" name="fecha" >

             </div>
             <div class="form-group">
                 <label>Cantidad</label>

                   <input type="number" class="form-control" name="cantidad" step="any">

              </div>

        </div>

        <div id="derecha" style="margin-left:5%;width:25%;height:auto;float:left">

              <div class="form-group">
                <label>Carátula</label>

                  <input type="file" class="form-control" name="imagen" id="imagen" >';
            ?>
                        <script language="javascript">
                                    function readURL(input) {
                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $('#caratulas').attr('src', e.target.result);
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                        }
                                    }
                                    $("#imagen").change(function(){
                                        readURL(this);
                                    });
                                </script>


              </div>
              <div>

                      <center>
                          <img src="" style="border:solid red 1px; width:150px; height:150px" id="caratulas"/>
                      </center>




              </div>
            <div class="form-group">
                <label>Precio</label>

                  <input type="number" class="form-control" name="precio"  step="any">

             </div>
             <?php
             echo '<div class="form-group">
                <label>Discográfica:</label>
  <select name="nombrediscografica" class="form-control" id="sel1">';
 $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
    $result = $connection->query("SELECT DISTINCT * FROM DISCOGRAFICA DG");
     echo "<option disabled selected>-- elige un discográfica --</option>";

    while($obj3 = $result->fetch_Object()){

        echo "<option value='$obj3->COD_DISCOGRA'>$obj3->NOMBRE</option>";

    }
  echo '</select>

             </div>


        </div>
        <div id="modif" style="clear:left;float:right;margin-right:25%;">
        <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>        </div>

      </div>


        </form>
      </div>
    </div>
    </div>';
    ?>

    <?php else: ?>
       <?php


            $titulo2=$_POST['titulo'];
            $genero2=$_POST['genero'];
            $fecha2=$_POST['fecha'];
            $precio2=$_POST['precio'];
            $cantidad2=$_POST['cantidad'];
            $nombreautor=$_POST['nombreautor'];
            $nombrediscografica=$_POST['nombrediscografica'];
            $ruta="";
              if ($_FILES["imagen"]["error"] > 0){
                      echo "ha ocurrido un error";
              } else {
                      //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
                      //y que el tamano del archivo no exceda los 100kb
                      $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
                      $limite_kb = 4000;
                      if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
                        //esta es la ruta donde copiaremos la imagen
                        //recuerden que deben crear un directorio con este mismo nombre

                        $ruta = "../images/caratulas/" . $_FILES['imagen']['name'];
                        //comprobamos si este archivo existe para no volverlo a copiar.
                        //pero si quieren pueden obviar esto si no es necesario.
                        //o pueden darle otro nombre para que no sobreescriba el actual.
                        if (!file_exists($ruta)){
                            //aqui movemos el archivo desde la ruta temporal a nuestra ruta
                            //usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
                            //almacenara true o false
                            $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
                            if ($resultado){
                              echo "el archivo ha sido movido exitosamente";
                            } else {
                              echo "ocurrio un error al mover el archivo.";
                            }
                        } else {
                            echo $_FILES['imagen']['name'] . ", este archivo existe";
                        }
                      } else {
                        echo "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
                      }
          }
          $ruta=$_FILES['imagen']['name'];


        //AÑADE LOS DATOS DE LOS DISCOS
 $connection2 = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection2->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result2 = $connection2->query("INSERT INTO DISCO (TITULO,GENERO,FECHA,CARATULA,PRECIO,CANTIDAD,COD_DISCOGRA,COD_AUTOR) VALUES ('$titulo2','$genero2','$fecha2','$ruta','$precio2','$cantidad2','$nombrediscografica','$nombreautor')");




            unset($connection2);

        header("Location:./album.php");




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
