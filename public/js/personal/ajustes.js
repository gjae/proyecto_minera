$(document).ready(function(){

	$(".actions").on('click', function(){
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		var modal = $("#modal-personal")

		$.getJSON(url, {}, function(resp){
			if(resp.error){
				alert(resp.mensaje)
			}
			else
			{
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true})
			}
		})
	})

	$("#salvar").on('click', function(){
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$("#accion").val()
		var datos = $("#form-modal").serialize();

		if( datos.indexOf('=&') == -1 ){
			if(confirm('¿SEGURO DE QUE DESEA GUARDAR ESTOS DATOS?')){
				$.post(url, datos, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
		else alert("AUN EXISTEN DATOS SIN COMPLETAR");
	})
})