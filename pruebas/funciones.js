    
$("#enviar").click(function(){
    avion=$.trim($("#avion").val());
    if(avion==''){
        alert(avion);
    }else{
        alert("seleccione dato");
    }
}); 