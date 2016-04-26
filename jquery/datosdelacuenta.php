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
var_dump($_POST);
$o_pass=$_POST['old_pass'];
$c_pass=$_POST['check_pass'];
$n_pass=$_POST['new_pass'];

  $connection->set_charset("utf8");

  if($n_pass==$c_pass){
    $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

     if ($connection->connect_errno) {
        printf("Conexión fallida %s\n", $mysqli->connect_error);
        exit();
    }
      $result3 = $connection3->query("UPDATE USUARIO SET PASSWORD=md5('".$n_pass."') WHERE PASSWORD=md5('".$o_pass."') and USERNAME= '".$_SESSION['user']."'");

          unset($connection3);


        if($connection->query($result3)==true){
        header('Location:perfil.php');

        }else{
          echo $connection->error;

        }
        unset($connection);

?>
