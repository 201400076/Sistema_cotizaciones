$(document).ready(function(){
    $("#unidades").hide();
    function ShowHideElement(){
        let text = "";
        if($("#rolUser").text() === "Usuario de Unidad de Gasto"){
            $("#unidades").Show();
        }

    }
})