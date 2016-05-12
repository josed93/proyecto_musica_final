<?php ob_start(); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Instalación</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--<link rel="stylesheet" href="../plantilla/plantilla.css">-->
    <script type="text/javascript" src="../jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="../plantilla/plantilla.js"></script>
    <script type="text/javascript" src="../javascript/gestion_todo.js"></script>

    <!-- Versión compilada y comprimida del CSS de Bootstrap -->


    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>



    <!-- Tema opcional -->
    <link rel="stylesheet" href="../bootstrap3/css/bootstrap-theme.min.css">

    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="../bootstrap3/js/bootstrap.min.js"></script>


    <style>
    body{
      background-image: url(../images/backgroundtext.png);


    }
    #logo{
        float: left;
        width: auto;
        height: auto;


    }

    #logo img{

        width: 65px;
        height: 65px;


    }

    #logo2{
        float: left;
        width: auto;
        height: auto;

    }

    #logo2 img{
        margin: 10px 0 0 0;
        width: 280px;
        height: 50px;

    }
    #logototal{
      margin-left: 30%;
      margin-top: 1%;
      width: 50%;
      height: auto;

    }
    .form-horizontal .control-label{
      text-align:left;
    }
    .form-group{
      background-color: #CEE3F6;
      padding: 1% 0 1% 0;

    }

    </style>
  </head>
  <body>




    <div class="container" style="width:90%;background-color:white;padding:0 5% 2% 5%;margin-top:1%;border-radius:1%;box-shadow: 5px 5px 5px #888888;">
      <div id="logototal" class="container">
      <div id="logo">
          <img src="../images/prueba.png">

      </div>

      <div id="logo2">
          <img src="../images/logo2.PNG">

      </div>
    </div>
      <br>

    <div>
      <h3 style="font-family:Lucida Console">Bienvenido</h3>
      <hr style="border:solid black 1px">
      <p style="font-family:Verdana">¡Bienvenido al proceso de instalación de la página <b>delasheras-music</b>!
      Este proceso no le llevará más de medio minuto.
      Sólo deberá rellenar los campos de los formularios que aparecen más abajo.
    Una vez completado, podrá disfrutar de la página web de musica online más completa del mundo :)</p>



    </div>
    <div>
      <h3 style="font-family:Lucida Console">Información Necesaria para la Instalación de la Aplicación Web</h3>
      <hr style="border:solid black 1px">
      <p style="font-family:Verdana">Por favor, usted deberá rellenar con sus datos pertinentes los sieguientes campos de formulario para llevar a cabo la instalación.
      No te preocupes, siempre podrás cambiar los datos desde el fichero de configuración que se generará posteriormente.</p>

      <div class="row" class="container">
        <form method="post" class="form-horizontal">
          <div class="form-group">
            <label class="col-sm-3 control-label">Nombre de usuario:</label>
          <div class="col-sm-4">
            <input type="text" name="us" class="form-control input-md " placeholder="USERNAME" tabindex="1" required >
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-3 control-label">Contraseña de usuario:</label>
        <div class="col-sm-4 ">
          <input type="password" name="pw" class="form-control input-md" placeholder="PASSWORD" tabindex="2" required>
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-3 control-label">Host de la base de datos:</label>
      <div class="col-sm-4">
        <input type="text" name="lc" class="form-control input-md" placeholder="LOCALHOST" tabindex="3" required>
      </div>
      </div>
      <div class="form-group">
      <label class="col-sm-3 control-label">Nombre de la base de datos:</label>
      <div class="col-sm-4">
        <input type="text" name="db" class="form-control input-md" placeholder="DATABASE" tabindex="4" required>
      </div>
      </div>
          <label class="col-sm-4"><input type="checkbox" name="terms" required> ACEPTAR <a href="#">Terminos y Condiciones</a>.</label><br>
          <button type="submit" class="btn btn-mutted btn-lg col-sm-offset-6" style="background-color: #FFBF00;color:black;font-weight:bold"
          onMouseOver="this.style.cssText='background-color: #2E9AFE;color:white;font-weight:bold'" onMouseOut="this.style.cssText='background-color: #FFBF00;color:black;font-weight:bold'"><span class="glyphicon glyphicon-saved"></span> Instalar</button>
          </form>
      </div>


    </div>


        <?php
          if(isset($_POST["us"])){
              $username=$_POST["us"];
              $password=$_POST["pw"];
              $database=$_POST["db"];
              $localhost=$_POST["lc"];
              $connection = new mysqli($localhost, $username, $password, $database);
                 //TESTING IF THE CONNECTION WAS RIGHT
              if ($connection->connect_errno) {
                   printf("Connection failed: %s\n", $connection->connect_error);
                   exit();
              }
              else {
                include("./database.php");
                $file = fopen("../plantilla/variablesdeconexion.php", "a");
                fwrite($file, "<?php"."\n");
                fwrite($file, "$"."username="."'".$username."';"."\n");
                fwrite($file, "$"."password="."'".$password."';"."\n");
                fwrite($file, "$"."database="."'".$database."';"."\n");
                fwrite($file, "$"."localhost="."'".$localhost."';"."\n");
                fwrite($file, "?>"."\n");
                fclose($file);

                unlink('../instalacion/install.php');
                unlink('../instalacion/database.php');
                rmdir('../instalacion');

              header("Location: ./../inicio/inicio.php");
              }
          }

        ?>
    </div>




  </body>
</html>
<?php ob_end_flush(); ?>
