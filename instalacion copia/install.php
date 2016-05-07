<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
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

  </head>
  <body>
    <div class="container" id="insta">

    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

    			<h2>INSTALACION APLICACION WEB</h2>
    			<hr class="colorgraph">
    			<div class="row">
            <form method="post">
    				<div class="col-xs-12 col-sm-6 col-md-6">
    					<div class="form-group">

                <input type="text" name="us" class="form-control input-lg " placeholder="Usuario" tabindex="1" >		</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-6">
    					<div class="form-group">
                    <input type="password" name="pw" class="form-control input-lg" placeholder="Contraseña" tabindex="2">
    					</div>
    				</div>
            <div class="col-xs-12 col-sm-6 col-md-6">
    					<div class="form-group">
                  <input type="text" name="lc" class="form-control input-lg" placeholder="LOCALHOST" tabindex="3">  					</div>
    				</div>

            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="form-group">
                  <input type="text" name="db" class="form-control input-lg" placeholder="NOMBRE_BASE" tabindex="4">  					</div>
            </div>
            <label><input type="checkbox" name="terms"> ACEPTA <a href="#">Terminos y Condiciones</a>.</label><br>
            <input type="submit" value="Sign up" class="btn btn-primary pull-left">

    			</div>

        </div>
      </div>




        </form>
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
              }else{
                include("./database.php");
                $file = fopen("./plantilla/variablesdeconexion.php", "a");
                fwrite($file, "<?php"."\n");
                fwrite($file, "$"."username="."'".$username."';"."\n");
                fwrite($file, "$"."password="."'".$password."';"."\n");
                fwrite($file, "$"."database="."'".$database."';"."\n");
                fwrite($file, "$"."localhost="."'".$localhost."';"."\n");
                fwrite($file, "?>"."\n");
                fclose($file);
                unlink('install.php');
                 unlink('database.php');
                 header('Location:./inicio/inicio.php');
              }
          }
        ?>
    </div>




  </body>
</html>
