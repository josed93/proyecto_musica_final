//GESTIONAR DISCOGRÁFICA PARA FILTRAR
$(function(){
    $("#sdi").on('keyup',function(){
        var datos=$("#sdi").val();
        
        var uri = '../php/filtrar_disco.php';
        var array_dato = {"dato":datos};
        
        
        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#tdi").html(data);
            }
        
        
        })
        
    
    });

});