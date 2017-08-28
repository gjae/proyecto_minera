$(document).ready(function(){
	$(".actions").on('click', function(){
		var btn = $(this)
		var url = location.href + '/formularios?formulario='+btn.attr('formulario')
		var modal = $("#modal-inventario")
		modal.modal({show: true})
		$.get(url, {}, function(resp){
			if( !resp.error){
				$("#form-modal").html(resp.formulario)
			}
		})
	});

	$("#salvar").on('click', function(resp){
		var datos = $("#form-modal").serialize()
		//alert(datos)
		if( datos.indexOf("=&") != -1 ){
			alert("EL FORMULARIO AUN TIENE DATOS SIN COMPLETAR, VERIFIQUE");
			return false;
		}
		else{
			var url = 'http://'+location.host+'/dashboard/inventario/'+$("#_archivo").val()+'/'+$("#accion").val()
			//alert(url)

			if(confirm("¿Seguro de guardar estos datos?")){
				$.post(url, datos, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload();
				})
			}
		}
	});

	$(".btn-options").on('click', function(){
		if( $(this).attr('role') == 'delete' ){
			if(confirm("¿Seguro que desea eliminar este item?")){
				var url = location.href+'/eliminarMaterial';
				$.post(url, {id: $(this).attr('data-id'), '_token': $("#token").val() }, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
	})
})