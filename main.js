$(buscar_datos());
function buscar_datos(consulta){
	$.ajax({
		url: 'comisarias-tabla.php',
		type:'POST',
		dataType: 'html',
		data: {consulta:consulta},
	})
	.donde(function(respuesta){
		$("datos").html(respuesta);
	})
}

$(document).on('keyup', '#txtBuscar', function(){
	var valor=$(this).val();
	if (valor!="") {
		buscar_datos(valor);
	}else{
		buscar_datos();
	}
})