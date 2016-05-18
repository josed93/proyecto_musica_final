$(document).ready(function(){

        var consulta;

         //hacemos focus al campo de búsqueda
        $("#buscar").focus();

        //comprobamos si se pulsa una tecla
        $("#buscar").keyup(function(e){

              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#buscar").val();

              //hace la búsqueda

              $.ajax({
                    type: "POST",
                    url: "../php/buscar.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                          //imagen de carga
                          $("#resultado").html();
                    },
                    error: function(){
                    },
                    success: function(data){
                          $("#resultado").empty();
                          $("#resultado").append(data);

                    }
              });


        });

});

$(document).ready(function(){
$("div:not(#resultado)").on("click", function(event) {
    $("#buscar").val("");
    //obtenemos el texto introducido en el campo de búsqueda
    consulta = $("#buscar").val();

    //hace la búsqueda

    $.ajax({
          type: "POST",
          url: "../php/buscar.php",
          data: "b="+consulta,
          dataType: "html",
          beforeSend: function(){
                //imagen de carga
                $("#resultado").html();
          },
          error: function(){
                alert("error petición ajax");
          },
          success: function(data){
                $("#resultado").empty();
                $("#resultado").append(data);

          }
    });

})
});
