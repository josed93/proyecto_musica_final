<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <link rel="stylesheet" href="css/default.css">
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

                <input type="text" name="us" class="form-control input-lg " placeholder="Usuario" tabindex="2" >		</div>
    				</div>
    				<div class="col-xs-12 col-sm-6 col-md-6">
    					<div class="form-group">
                    <input type="password" name="pw" class="form-control input-lg" placeholder="Contraseña" tabindex="2">
    					</div>
    				</div>
            <div class="col-xs-12 col-sm-6 col-md-6">
    					<div class="form-group">
                  <input type="text" name="lc" class="form-control input-lg" placeholder="LOCALHOST" tabindex="2">  					</div>
    				</div>

            <div class="col-xs-12 col-sm-6 col-md-6">
              <div class="form-group">
                  <input type="text" name="db" class="form-control input-lg" placeholder="NOMBRE_BASE" tabindex="2">  					</div>
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

    <section class="footer">

          <div class="row">
            <div class="col-lg-3  col-md-3 col-sm-3">
                <div class="footer_dv">
                    <h4>FORMAS DE PAGO</h4>


                   <img src="imagenes/tarjetas/1.png">
                  <img src="imagenes/tarjetas/2.png">
                    <img src="imagenes/tarjetas/3.jpg">
                  <img src="imagenes/tarjetas/4.jpg">

                  </div>
              </div>
              <div class="col-lg-3  col-md-3 col-sm-3">
                <div class="footer_dv">
                    <h4>SERVICIOS</h4>
                    <ul id="listas">
                        <li>Ropa de Mujer</li>
                          <li>Ropa de Hombre</li>



                      </ul>
                  </div>
              </div>
              <div class="col-lg-3  col-md-3 col-sm-3">
                <div class="footer_dv">
                    <h4>Contactanos</h4>
                    <ul id="listas">
                        <li>Calle Rafeael Beca Nº 15</li>
                          <li>LLAMANOS 684065028</li>



                      </ul>
                </div>
              </div>

              <div class="col-lg-3  col-md-3 col-sm-3">
                  <div class="footer_dv">
                      <h4>REDES SOCIALES</h4>
                      <a href="https://github.com/"><img src="imagenes/logotipo/1.png"></a>
                      <a href="https://github.com/"><img src="imagenes/logotipo/2.png"></a>
                      <a href="https://github.com/"><img src="imagenes/logotipo/4.gif"></a>
                      <a href="https://github.com/"><img src="imagenes/logotipo/5.png"></a>

                    </div>
              </div>

            </div>


    </section>


  </body>
</html>
