//GESTIONAR USUARIO PARA FILTRAR
$(function(){
    $("#sea").on('keyup',function(){
        var datos=$("#sea").val();
        
        var uri = '../php/filtrar_usu.php';
        var array_dato = {"dato":datos};
        
        
        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#tu").html(data);
            }
        
        
        })
        
    
    });

});