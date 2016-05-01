<?php
    session_start();
    if(isset($_SESSION["user"])){
        
    }
    else{
        header("Location:plantilla.php");
    }


?>


<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla</title>
    <link rel="stylesheet" href="plantilla.css">
    <script type="text/javascript" src="../jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="plantilla.js"></script>
    <script src=""></script>
</head>

<body>
    
    <div id="top">
        <div id="logo">
            <a href="../inicio/inicio.php"><img src="../images/prueba.png"></a>
            
        </div>
        <div id="logo2">
            <a href="../inicio/inicio.php"><img src="../images/logo2.PNG"></a>
            
        </div>
        <div id="find">
            <form id="searchform">

                 <input type="text" placeholder="Buscar cancion,interprete..." required>

                 <button type="submit">Buscar</button>

             </form>

            
            
        </div>
        
        <?php
    if(isset($_POST["user"])){  

    //CREATING THE CONNECTION
      $connection = new mysqli("localhost", "root", "", "pruebausuarios");
      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */

        $consulta="SELECT * FROM usuarios where username='".$_POST["user"]."'and password=md5('".$_POST["password"]."');";

      if ($result = $connection->query($consulta)) {
          if($result->num_rows===0){
            echo "<script type='text/javascript'>alert('LOGIN INVALIDO ');</script>";
              
          }else{
            $_SESSION["user"]=$_POST["user"];
            
              
              header("Location: prueba1.php");
              
          }
      }else{
        echo "<script type='text/javascript'>alert('NO VALIDO ');</script>";
        }
    }
      


    ?>
        
        
       <div id="loginContainer">
                <a href="#" id="loginButton"><span><?php echo $_SESSION["user"]?></span><em></em></a>
                
            </div>
            <div id="reg">
              <a href="logout.php"><p style="color:white">Cerrar sesion</p></a>
               
               
                
                
                
            </div>

         
          
           
        <div id="carrito" class="rotateinfinite">
                <a href="#"><img src="../images/carrito.PNG"></a>
                
        </div>
            
            
        
        
        
        
    </div>
    <nav id="top_menu">

		<ul>
			<li>
				<a href="../inicio/inicio.php"><div class="contenedor_general">

					<div class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/home_white.PNG">INICIO</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_uno"><img src="../images/iconos_menu/home_black.PNG">INICIO</p>					
                    </div>

				</div></a>
			</li>




			<li>
				<a href="../tienda/tienda.php"><div class="contenedor_general">

					<div class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/tienda_white.PNG">TIENDA</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/tienda_black.PNG">TIENDA</p>
					</div>

                    </div></a>
			</li>
			<li>
				<a href="../catalogo/catalogo.php"><div class="contenedor_general">

					<div class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/catalogo_white.png">CATÁLOGO</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/catalogo_black.PNG">CATÁLOGO</p>
					</div>

                    </div></a>
			</li>



			<li>
				<a href="../aboutus/aboutus.php"><div id ="excep" class="contenedor_general">

					<div class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/aboutus_white.png">SOBRE NOSOTROS</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/aboutus_black.PNG">SOBRE NOSOTROS</p>
					</div>

                </div></a>
			</li>


			<li>
				<a href="../contacto/contacto.php"><div class="contenedor_general">

					<div class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/contact_white.png">CONTACTO</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/contac_black.PNG">CONTACTO</p>
					</div>

                </div></a>
			</li>
			
			

		</ul>


		
	</nav>

    <div id="center">
       
      
        
    </div>     
    <div id="foot">
        <div id="fizq" class="efooter">
           
           
           
           <h3>SOBRE NOSOTROS</h3>
           <p>Página Web desarrollada por José Daniel de las Heras Díaz para el proyecto de Implantación de aplicaciones web de ASIR Segundo Año.</p>
           <p>Delasheras-Music va dedicada principalmente a la venta de discos de música de una gran multitud de géneros.</p>
           <br>
            <p id="copy">Delasheras-Music. Copyright © 2015. All right reserved.<img src="../images/logo2.png"></p>
            
            
        </div>
        <div id="fcenter" class="efooter">
            <h3>REDES SOCIALES</h3>
            <div><a href="https://www.facebook.com/josedaniel.delasheras" target="_blank"><img src="../images/iconos_footer/icon_facebook.PNG"><p>Facebook</p></a></div>
            <div><a href="https://twitter.com/zombiejd93" target="_blank"><img src="../images/iconos_footer/icon_twitter.PNG"><p>Twitter</p></a></div>
            <div><a href="https://plus.google.com/+sangetsubankai/posts" target="_blank"><img src="../images/iconos_footer/icon_google.PNG"><p>Google+</p></a></div>
            <div><a href="https://www.youtube.com/channel/UCG36-wXs5lBZMmWXUjyouZw" target="_blank"><img src="../images/iconos_footer/icon_you.PNG"><p>Youtube</p></a></div>
            <div><a href="https://github.com/josed93/IMPLA" target="_blank"><img src="../images/iconos_footer/icon_github.PNG"><p>Github</p></a></div>
            
            
        </div>
        <div id="fder" class="efooter">
            <h3>CONTACTO</h3>
            <div id="pos"><img src="../images/iconos_footer/icon_position.PNG"><p>Posición</p></div>
            <div id="lugar"><iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="300" height="143" src="https://maps.google.com/maps?hl=en&q=IES Triana&ie=UTF8&t=m&z=18&iwloc=B&output=embed"><div><small><a href="http://embedgooglemaps.com">embedgooglemaps.com</a></small></div><div><small><a href="http://www.bmwpedia.net/">BMW cars</a></small></div></iframe></div>
            <img src="../images/iconos_footer/icon_email.PNG"><p>jose_d.93@hotmail.com</p>
            <img src="../images/iconos_footer/icon_tel.PNG"><p>+34 655599239</p>
            
            
        </div>
        
        
        
    </div>
    <div class="ir-arriba"><img src="../images/icon_up.PNG"></div>
    
    
    
    
    
    
    
    
</body>
</html>
