<?php
  include_once("../plantilla/db_configuration.php");
?><?php
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
if($connection->connect_errno){
    printf("ERROR AL INTENTAR CONECTARSE A LA BASE DE DATOS",$connection->connect_errno);
    exit();

}
   $consulta=("SELECT * FROM USUARIO where COD_USU=$id");
$id=$_POST['id'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$dni=$_POST['dni'];
$localidad=$_POST['localidad'];
$provincia=$_POST['provincia'];
$telefono=$_POST['telefono'];
$pais=$_POST['pais'];
$fecha=$_POST['fecha'];
$email=$_POST['email'];
$direccion=$_POST['direccion'];

  $connection->set_charset("utf8");

$consulta_mysql2="UPDATE  `prueba`.`USUARIO`  SET COD_USU='$id',NOMBRE='".$nombre."',APELLIDOS='".$apellido."',
DNI='".$dni."',LOCALIDAD='".$localidad."',PROVINCIA='".$provincia."',
PAIS='".$pais."',DIRECCION='".$direccion."',Tlf='".$telefono."' WHERE COD_USU=$id";
var_dump($consulta_mysql2);


        if($connection->query($consulta_mysql2)==true){
        header('Location:perfil.php');

        }else{
          echo $connection->error;

        }
        unset($connection);

?>
