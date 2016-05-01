//GESTIONAR USUARIO PARA FILTRAR
$(function(){
    $("#scan").on('keyup',function(){
        var datos=$("#scan").val();
        
        var uri = '../php/filtrar_autor.php';
        var array_dato = {"dato":datos};
        
        
        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#tcan").html(data);
            }
        
        
        })
        
    
    });

});