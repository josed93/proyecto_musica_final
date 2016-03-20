<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();

    $coduser=$_GET['coduser'];
 $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result = $connection->query("UPDATE USUARIO SET ESTADO='activo' WHERE COD_USU='".$coduser."'");

            unset($connection);

        header("Location:./ausuarios.php");
