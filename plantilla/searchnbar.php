
<?php
if(isset($_SESSION["user"])){
    if($_SESSION["rol"] !== "admin"){
      include_once("../plantilla/resultados.php");

    }else {
      # code...
    }

}else {
  include_once("../plantilla/resultados.php");
}




	?>
<div style="float:left;width:400px;margin:17px 0 0 100px;" >
	<div >
		<div>
      <?php
      if(isset($_SESSION["user"])){
      if($_SESSION["rol"] == "admin"){
      echo'  <div class="input-group" id="adv-search" style="width:400px;">

            <input id="buscar"  type="text" style="width:300px;text-align:center;font-weight:bold;background-color:#CECEF6" class="form-control" placeholder="Zona de Administración " disabled />


        </div>';

      }else {
        echo '<div class="input-group" id="adv-search" style="width:400px;">

            <input id="buscar" type="text" style="width:300px;" class="form-control" placeholder="Buscar título o género del disco:"  />


        </div>';
      }
    }else{


            echo '<div class="input-group" id="adv-search" style="width:400px;">

                <input id="buscar" type="text" style="width:300px;" class="form-control" placeholder="Buscar título o género del disco:"  />


            </div>';
          }
          ?>
          </div>
        </div>
	</div>
