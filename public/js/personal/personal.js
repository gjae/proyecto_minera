$(document).ready(function(){
	$(".actions").on('click', function(){
		var btn = $(this)

		if(btn.attr('action') == 'formularios'){
			var modal = $("#modal-personal")
			var url = location.href +'/formulario?form='+btn.attr('formulario')+'&persona='+(btn.attr('persona') || 0)
			//alert(url)
			$.get(url, '', function(resp){
				if(! resp.error){
					modal.modal({show : true})
					$("#form-modal").html(resp.formulario)
				}
			})
		}
	})


	$("#salvar").on('click', function(event){
		var url = location.href;
		var datos = $("#form-modal").serialize();
		//alert(datos)
		if( datos.indexOf('=&') != -1 ){
			alert("AUN HAY CAMPOS POR COMPLETAR")
			return false;
		}
		else{
			$.post(url+'/'+$("#accion").val(), datos, function(resp){
				alert(resp.mensaje)
				if(! resp.error)
					location.reload()
			})
		}
	})
})