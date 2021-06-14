function proceso(){
    var nombre = $('#nombre').val();    
    $.post('p.php',{nom:nombre},function(data){
        window.location.replace('p.php');
        if(data!=null){
            alert(data['nombre']);
        }else{
            alert("no envio");
        }
    });

}