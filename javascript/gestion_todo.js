//GESTIONAR TIENDA PARA FILTRAR
$(function(){
    $("#sti").on('keyup',function(){
        var datos=$("#stii").val();

        var uri = '../php/filtrar_todo.php';
        var array_dato = {"dato":datos};


        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#dtii").html(data);
            }


        })


    });

});
