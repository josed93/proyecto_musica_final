<?php
switch ($_SESSION["style"]) {
    case 0:
        echo '<link rel="stylesheet" href="../plantilla/plantilla.css">';
        break;
    case 1:
        echo '<link rel="stylesheet" href="../styles/plantilla2.css">';
        break;
    case 2:
        echo '<link rel="stylesheet" href="../styles/plantilla3.css">';
        break;
    case 3:
        echo '<link rel="stylesheet" href="../styles/plantilla4.css">';
        break;
}
?>
