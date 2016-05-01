
//iframe
$(document).ready(function() {
    $("#pos").click(function(){
        $("#lugar",window.parent.document).css("display" , "inline");
        
    
    });
    
    $("#pos").siblings().click(function(){
        $("#lugar",window.parent.document).css("display" , "none");
        
    
    });
    
});
//Boton Ir arriba
$(document).ready(function(){
 
	$('.ir-arriba').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.ir-arriba').slideDown(300);
		} else {
			$('.ir-arriba').slideUp(300);
		}
	});
 
});



    


