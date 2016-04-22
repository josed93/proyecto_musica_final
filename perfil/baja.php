<?php
  include_once("../plantilla/db_configuration.php");
?>
<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){


$connection = new mysqli($db_host, $db_user, $db_password, $db_name);

       if ($connection->connect_errno) {
          printf("Conexión fallida %s\n", $mysqli->connect_error);
          exit();
      }
        $result = $connection->query("UPDATE USUARIO SET ESTADO='inactivo' WHERE USERNAME= '".$_SESSION['user']."'");

            unset($connection);
        session_destroy();

        header("Location:../inicio/inicio.php");
    }
    else{
        header("Location:../inicio/inicio.php");
    }











?>
