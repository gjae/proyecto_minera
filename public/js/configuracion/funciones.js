$(document).ready(function(){

	$(".actions").on('click', function(){
		var modal = $("#modal-coniguracion")
		var url = location.href+'/formularios?form='+$(this).attr('role')
		url+= '&id='+$(this).attr('data-id')

		//alert($(this).attr('role'))
		if($(this).attr('role') != 'eliminar'){

			$.getJSON(url, {}, function(resp){
				if(! resp.error){
					modal.modal({show: true});
					$("#form-modal").html(resp.formulario)
				}
			})
		}
		else{
			if(confirm("¿SEGURO QUE DESEA ELIMINAR ESTE REGISTRO?")){
				var url = location.href+'/'+$(this).attr('role')
		
				$.post(url, {'_token': $(this).attr('token'), 'id': $(this).attr('data-id')}, function(resp){
					alert(resp.mensaje)
					if( !resp.error)
						location.reload()
				})
			}
		}
	})

	$("#salvar").on('click', function(){
		var datos = $("#form-modal").serialize()
		var url = location.href+'/'+$("#accion").val()
		//alert(datos)
		console.log(datos.indexOf('=&'))
		if( datos.indexOf('=&') == -1 && confirm("¿SEGURO QUE DESEA GUARDAR ESTOS DATOS?")){
			$.post(url, datos, function(resp){
				alert(resp.mensaje)
				if(! resp.error)
					location.reload()
			})
		}
		else if(datos.indexOf('=&') != -1)
			alert("AUN HAY DATOS PENDIENTES POR COMPLETAR EN EL FORMULARIO")
	})

})