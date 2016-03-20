//GESTIONAR TIENDA PARA FILTRAR
$(function(){
    $("#sti").on('keyup',function(){
        var datos=$("#sti").val();

        var uri = '../php/filtrar_tienda.php';
        var array_dato = {"dato":datos};


        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#dti").html(data);
            }


        })


    });

});
