<?php
    session_start();
    ob_start();
    if(isset($_SESSION["user"])){
    
    //setcookie("PHPSESSID","",time() -3600,"/");
    session_destroy();
 header("Location:../inicio/inicio.php");
    }
else{
    header("Location:../inicio/inicio.php");
}
    

?>