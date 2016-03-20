<!DOCTYPE html>
<html lang="">
<title>Discográficas</title>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="plantilla/plantilla.css">
    <script type="text/javascript" src="jquery/jquery-1.11.2.min.js"></script>
    <script type="text/javascript" src="plantilla/plantilla.js"></script>
    <!-- Versión compilada y comprimida del CSS de Bootstrap -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  

    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
    <script src="bootstrap3/js/bootstrap.min.js"></script>

</head>

  <body>
   
   <style type="text/css">
       

#top_menu2{
	
	width:auto;
	height:50px;
    background-image: url(./images/top.png);
    
  
    
}

#top_menu2 ul{
	list-style: none;
    margin:0;
    margin-left:-2%;
    height: 50px;
    
    
    
}

#top_menu2 ul li{
	float:left;
	width:160px;
	height:49px;
	overflow: hidden;
	margin:0px;
}

#top_menu2 .contenedor_general:hover{
	margin-top:-40px;
}

#top_menu2 .contenedor_general{
	width:200px;
	height:100px;
	
	-webkit-transition:margin-top .4s;
}

#top_menu2 .contenedor_uno{
    padding-top:6px;
	width:160px;
	height:50px;
	background-image: url(./images/top.png);
	overflow: hidden;
	border-bottom:4px solid #00BFFF;
}

#top_menu2 .contenedor_dos{
	width:160px;
	height:40px;
	background-color: #00BFFF;
	overflow: hidden;
	border-bottom:4px solid black;
}

#top_menu2 p.texto_uno, p.texto_dos{
    margin-left: 50px;
    float: left;
	text-align: center;
	margin-top:0px;
	color:white;
    font-family: helvetica;
    font-weight: bold;
    line-height: 35px;
}
#top_menu2 a {
    text-decoration: none;
}

#top_menu2 #excep{
   font-size: 11px;
}
    #top_menu2 #excep2{
   font-size: 10px;
}



#top_menu2 img{
    margin-top: 2px;
    margin-left: -35px;
    float: left;
    width: 30px;
    height: 30px;
}
#top_menu2 #img1 img,#img2 img,#img3 img{
    -webkit-filter: invert(100%);
    filter: invert(100%);
}
/*------------------Al contraerse----------------*/       
@media (max-width: 1358px) {
    .navbar-header {
        float: none;
    }
    .navbar-left,.navbar-right {
        float: none !important;
    }
    .navbar-toggle {
        display: block;
        
    }
    .navbar-collapse {
        border-top: 1px solid transparent;
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.1);
    }
    .navbar-fixed-top {
        top: 0;
        border-width: 0 0 1px;
    }
    .navbar-collapse.collapse {
        display: none!important;
    }
    .navbar-nav {
        float: none!important;
        margin-top: 7.5px;
    }
    .navbar-nav>li {
        float: none;
    }
    .navbar-nav>li>a {
        padding-top: 10px;
        padding-bottom: 10px;
    }
    .collapse.in{
        display:block !important;
    }
    
    #top_menu2 ul li{
      
	left:-47px;
    position:relative;    
	width:110%;
	height:49px;
	overflow: hidden;
	margin:0px;
    }
    
    #top_menu2 .contenedor_general{
	width:100%;
	height:100px;
	
	-webkit-transition:margin-top .4s;
    }

#top_menu2 .contenedor_uno{
    padding-top:6px;
	width:100%;
	height:50px;
	background-image: url(./images/top.png);
	overflow: hidden;
	border-bottom:4px solid #00BFFF;
    }

#top_menu2 .contenedor_dos{
	width:100%;
	height:40px;
	background-color: #00BFFF;
	overflow: hidden;
	border-bottom:4px solid black;
    }
    
#top_menu2 #excep{
   font-size: 14px;
    }
#top_menu2 #excep2{
   font-size: 14px;
    }
}       
       
       
       
       
       
       
       
       
       
       
       
       
      
      </style>

   <nav id="top_menu2" class="navbar navbar-default" role="navigation">
   <div class="container-fluid">
   <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Desplegar navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
            
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
		<ul >
			<li>
				<a href="../admin/ausuarios.php"><div class="contenedor_general" >

					<div id="img1" class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/usuarios.png">USUARIOS</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_uno"><img src="../images/iconos_menu/usuarios.png">USUARIOS</p>					
                    </div>

				</div></a>
			</li>




			<li>
				<a href="../admin/album.php"><div class="contenedor_general">

					<div id="img2"  class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/album.png">ÁLBUMES</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/album.png">ÁLBUMES</p>
					</div>

                    </div></a>
			</li>
			<li>
				<a href="../admin/cancion.php"><div class="contenedor_general">

					<div id="img2"  class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/cancion.png">CANCIONES</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/cancion.png">CANCIONES</p>
					</div>

                    </div></a>
			</li>
			<li>
				<a href="../admin/autor.php"><div class="contenedor_general">

					<div id="img2"  class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/autor.png">AUTORES</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/autor.png">AUTORES</p>
					</div>

                    </div></a>
			</li>
			<li>
				<a href="../admin/discogra.php"><div id ="excep2" class="contenedor_general">

					<div id="img3" class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/discografica.png">DISCOGRÁFICAS</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/discografica.png">DISCOGRÁFICAS</p>
					</div>

                    </div></a>
			</li>
			<li>
				<a href="../admin/pedidos.php"><div class="contenedor_general">

					<div id="img3" class="contenedor_uno">
						<p class="texto_uno"><img src="../images/iconos_menu/discografica.png">PEDIDOS</p>
					</div>

					<div class="contenedor_dos">
                        <p class="texto_dos"><img src="../images/iconos_menu/discografica.png">PEDIDOS</p>
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
       </div>
		</div>



		
	</nav>
</body> 
	
</html>