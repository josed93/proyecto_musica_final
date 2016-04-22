<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Perfil</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?php
    include "../plantilla/temas.php"
    ?>
<style>
	#tel{
	 margin-right:16px;
	}
</style>

</head>
<body>
  <?php
			include "../plantilla/header.php"
	?>

    <?php

      //CREATING THE CONNECTION
     $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

      //TESTING IF THE CONNECTION WAS RIGHT
      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }

      //MAKING A SELECT QUERY
      /* Consultas de selección que devuelven un conjunto de resultados */
      $connection->set_charset("utf8");?>

      <ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">DATOS PERSONALES</a></li>
  <?php
  if($_SESSION["administrador"]!="0"){?>
  <li><a data-toggle="tab" href="#menu1">PEDIDOS</a></li>

<?php  }?>
<?php
if($_SESSION["administrador"]!="0"){?>
  <li><a data-toggle="tab" href="#menu2">TEMAS</a></li>
  <?php  }?>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">

    <div class="container well ">

      <div class="row">
          <div class="col-xs-12"><h2>Tu Perfil de Usuario</h2></div>
        </div>
      <br /><br />
      <?php
    $consulta=("SELECT * FROM usuarios where Nombre='".$_SESSION['nombre']."' ");

    if ($result = $connection->query($consulta)) {


$obj = $result->fetch_object();
    ?>
  <form  action="modificardatos.php" class="form-horizontal " method="POST">

      <div class="form-group">
            <label class="col-sm-2 control-label" for="formGroup">Nombre del Usuario
              </label>
            <div class="col-sm-2">
                <input class="form-control" name="id" type="hidden"  value=<?php echo $obj->codusuario;?> >
              <input class="form-control" type="text" name="nombre" value=<?php echo $obj->Nombre;?> disabled>
            </div>
          </div>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="formGroup">Nombre</label>
            <div class="col-sm-4">
              <input  class="form-control" type="text" name="nombre" value=<?php echo $obj->Nombre;?>>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="formGroup">Apellidos</label>
            <div class="col-sm-4">
              <input class="form-control" type="text"  name="apellido" value="<?php echo $obj->apellido?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="formGroup">DNI</label>
            <div class="col-sm-4">
              <input class="form-control" type="text"  name="dni" value="<?php echo $obj->dni?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="formGroup">Provincia</label>
            <div class="col-sm-4">
              <input class="form-control" type="text"  name="provincia" value="<?php echo $obj->provincia?>">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label" id="tel"  name="telefono">Teléfono</label>

            <div class="input-group col-sm-3">
              <span class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></span>
              <input class="form-control" type="number"  name="telefono" value=<?php echo $obj->telefono;?>>

            </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label" for="formGroup ">Direccion</label>
              <div class="col-sm-4">
                <input class="form-control" type="text"  name="direccion" value="<?php echo $obj->direccion;?>">

              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="formGroup">Localidad</label>
                <div class="col-sm-4">
                  <input class="form-control" type="text"   name="localidad" value=<?php echo $obj->localidad;?>>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 control-label" for="formGroup">Pais</label>
                  <div class="col-sm-4">
                    <input class="form-control" type="text" name="pais" value=<?php echo $obj->pais?>>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-2 control-label" for="formGroup"></label>
                  <div class="col-sm-4">

                <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-floppy-saved"></span> Guardar</button>



                  </div>
                </div>

          </div>



  </form>
  <?php
}?>

  </div>
  <div id="menu1" class="tab-pane fade">
    <?php
      include_once("../plantilla/db_configuration.php");
    ?>

    <?php

       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);
    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        header('location: index.php');

    }


$connection->set_charset("utf8");
if ($result1 = $connection->query("SELECT * from usuarios u join  pedidos p  on
u.codusuario=p.codusuario join incluyen i on p.codpedido=i.codpedido join producto pro on i.codproducto=pro.codproducto
where u.Nombre='".$_SESSION['nombre']."'")){



?>
<div class="container">


    <!-- PRINT THE TABLE AND THE HEADER -->
    <table style="border:1px solid black" class="table table-bordered table-hover table-condensed" id="pedido">
    <thead>
      <tr class="info" >
        <th>Nombre del Cliente</th>
        <th>Fecha del pedido</th>
        <th>Direccion del pedido</th>
        <th>Cantidad de Producto</th>
        <th>Precio del Producto</th>
        <th>Importe total del pedido</th>

</tr>

    </thead>

<?php

    //FETCHING OBJECTS FROM THE RESULT SET
    //THE LOOP CONTINUES WHILE WE HAVE ANY OBJECT (Query Row) LEFT
    while($obj1 = $result1->fetch_object()) {

        //PRINTING EACH ROW
        echo "<tr>";
        echo "<td>".$obj1->Nombre."</td>";
        echo "<td>".$obj1->fechaemision."</td>";
          echo "<td>".$obj1->direccion."</td>";
            echo "<td>".$obj1->cantidad."</td>";
              echo "<td>".$obj1->precio.'&nbsp€'."</td>";
              echo "<td>".$obj1->cantidad*$obj1->precio.'&nbsp€'."</td>";

        echo "</tr>";

    }

    //Free the result. Avoid High Memory Usages
    $result->close();
    unset($obj);
    unset($connection);

} //END OF THE IF CHECKING IF THE QUERY WAS RIGHT

?>
</table>
</div>
</div>
  <div id="menu2" class="tab-pane fade">
    <div class="container well " >

      <div class="row">
          <div><h2>ELIGE EL TEMA</h2></div>
        </div>
        <?php
        //CREATING THE CONNECTION
       $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        //TESTING IF THE CONNECTION WAS RIGHT
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }

        //MAKING A SELECT QUERY
        /* Consultas de selección que devuelven un conjunto de resultados */
        $connection->set_charset("utf8");

      $consulta=("SELECT * FROM usuarios where Nombre='".$_SESSION['nombre']."' ");

      if ($result = $connection->query($consulta)) {


      $obj = $result->fetch_object();

      ?>
          <form  action="modificatemas.php" class="form-horizontal " method="POST">
            <form>
              <input class="form-control" name="id" type="hidden"  value=<?php echo $obj->codusuario;?> >
      <input type="radio" name="procesar" value="0" > <img src="../imagenes/plantillas/default.png" height="142" width="142">
      <input type="radio" name="procesar" value="1"><img src="../imagenes/plantillas/plantilla1.png" height="142" width="142">
      <input type="radio" name="procesar" value="2"><img src="../imagenes/plantillas/plantilla2.png" height="142" width="142">

      <button type="submit" class="btn btn-primary">MODIFICA</button>

    </form>
    </form>
    <?php
}else{

}?>
  </div>
</div>
  </div>
</div>
<?php
include "../plantilla/foot.php"
?>
</body>
</html>
