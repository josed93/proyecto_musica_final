<?php
session_start();
ob_start();
  include_once("../plantilla/db_configuration.php");
?><?php
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
if($connection->connect_errno){
    printf("ERROR AL INTENTAR CONECTARSE A LA BASE DE DATOS",$connection->connect_errno);
    exit();

}

$style=$_POST['opciones'];

 $id=$_POST['id'];
  $consulta=("SELECT * FROM USUARIO where COD_USU=$id");
 $consulta_mysql2="UPDATE USUARIO SET STYLE=$style WHERE COD_USU=$id";

  $connection->set_charset("utf8");
 if($style==0){

   if($connection->query($consulta_mysql2)==true){
     include_once("../plantilla/logout.php");


   }else{
     echo $connection->error;

   }

  }elseif ($style==1) {
    if($connection->query($consulta_mysql2)==true){

   include_once("../plantilla/logout.php");



    }else{
      echo $connection->error;

    }

  }
  elseif ($style==2) {
    if($connection->query($consulta_mysql2)==true){

   include_once("../plantilla/logout.php");



    }else{
      echo $connection->error;

    }

  }
  elseif ($style==3) {
    if($connection->query($consulta_mysql2)==true){

   include_once("../plantilla/logout.php");



    }else{
      echo $connection->error;

    }

  }else{
    if($connection->query($consulta_mysql2)==true){
      include_once("../plantilla/logout.php");




    }else{
      echo $connection->error;

    }

  }

$consulta_mysql2="UPDATE USUARIO SET STYLE=$style WHERE COD_USU=$id";




        unset($connection);

?>
