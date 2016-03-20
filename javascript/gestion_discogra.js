//GESTIONAR DISCOGRÁFICA PARA FILTRAR
$(function(){
    $("#sdisc").on('keyup',function(){
        var datos=$("#sdisc").val();
        
        var uri = '../php/filtrar_discogra.php';
        var array_dato = {"dato":datos};
        
        
        $.ajax({
            type:  "GET",
            url:    uri,
            data: array_dato,
            datatype: "json",
            success:function(data){
                $("#tdisc").html(data);
            }
        
        
        })
        
    
    });

});