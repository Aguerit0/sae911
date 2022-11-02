$(document).ready(function(){
	$("#txtBuscar").keyup(function(){
		var parametros = "txtBuscar"+$(this).val()
		$.ajax({
			data: parametros,
			url: 'salida.php',
			beforeSend: function(){ },
			sucess: function(response){
				$('.salida').html(response):
			},
			error:function(){
				alert("error")
			}
		});
	})
})