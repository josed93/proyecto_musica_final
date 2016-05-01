<?php

  include_once("../plantilla/db_configuration.php");
?><?php
$connection = new mysqli($db_host, $db_user, $db_password, $db_name);
if($connection->connect_errno){
    printf("ERROR AL INTENTAR CONECTARSE A LA BASE DE DATOS",$connection->connect_errno);
    exit();

}
$consulta=("SELECT * FROM USUARIO where COD_USU=$id");
$id=$_POST['id2'];

$o_pass=$_POST['old_pass'];
$c_pass=$_POST['check_pass'];
$n_pass=$_POST['new_pass'];

  if($n_pass==$c_pass){


      $result = $connection->query("UPDATE USUARIO SET PASSWORD=md5('".$n_pass."') WHERE PASSWORD=md5('".$o_pass."') and COD_USU= '".$id."'");
      if($connection->query($result)==false){
      header('Location:perfil.php');

      }else{
        echo $connection->error;

      }
}else{
  echo "LA CONTRASEÑA NO COINCIDE";
}


        unset($connection);


?>
