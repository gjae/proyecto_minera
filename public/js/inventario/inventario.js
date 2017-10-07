$(document).ready(function(){
	$(".actions").on('click', function(){
		var btn = $(this)
		var url = location.href + '/formularios?formulario='+btn.attr('formulario')+'&id='+$(this).attr('data-id')
		var modal = $("#modal-inventario")

		if( $(this).attr('role') == 'reportes'){
			if(!$("#footer-datos").hasClass('hidden')){
				$("#footer-datos").addClass('hidden')
				$("#footer-reportes").removeClass('hidden')
			}
		}
		else{
			if( $("#footer-datos").hasClass('hidden')){
				
				$("#footer-datos").removeClass('hidden')
				$("#footer-reportes").addClass('hidden')
			}
		}
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

	$(".reportes").on('click', function(){
		if( $(this).attr('role') =='controlBodega' ){
			var url = location.href+'/'+$(this).attr('role');
			window.open(url, "FORMATO DE CONTROL DE BODEGA"  ,"width=800,height=900")
		}

	})

	$("#reporte").on("click", function(){
		var datos = $("#form-modal")
		
		var tipo = $("#tipo_reporte").val();
		var url = location.host+'/dashboard/inventario/reportes/'+$("#tipo_reporte").val()+'?material_id='+$("#material_reporte").val()
		url +=  '&fecha_desde='+$("#fecha_desde").val()+"&fecha_hasta="+$("#fecha_hasta").val()
		//alert(url)
			//alert(url)			
		window.open('http://'+url, "INVITACIONES"  ,"width=800,height=900")	
	})
	$(".formularios").on('click', function(){
		var url = location.protocol+'//'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/formulario?form='+$(this).attr('formulario')
		
		var id = 0;
		if( $(this).attr('formulario') == 'editar_usuario'   ||  
			$(this).attr('formulario') == 'editar_categoria' ||
			$(this).attr('formulario') == 'autorizar_post'   ||
			$(this).attr('formulario') == 'retirar_autorizacion'

		)
			id = $(this).attr('data-id')

		$.getJSON(url+'&id='+id, {}, function(resp){
			if( !resp.error){
				
				var modal = $("#modal-usuarios");
				

				var footer = `
		            <div class="modal-footer">
		            	<div id="footer-datos">
			                <button type="submit" id="salvar" class="btn btn-link waves-effect">Guardar datos</button>
			                <a  class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</a>
		                </div>
		            </div>

				`

				$("#form-modal").html(resp.formulario+footer);
				$("#form-modal").attr('action', resp.action)				

				modal.modal({show: true});
			}
		})
	})

	$(".eliminar").on('click', function(){
		if(confirm('¿SEGURO QUE DESEA REALIZAR ESTA ACCION?, UNA VEZ ACEPTADA NO PODRA REVERTIRSE'))
		{
			var url = location.protocol+'//'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/eliminar';
			$.post(url, {id: $(this).attr('data-id'), '_token': $("#token").val() }, function(resp){
				alert(resp.mensaje);
				if(! resp.error)
					location.reload()
			})
		}
		
	})
})

function buscar_tipo(event,select){
	//alert(select.value)
	var side_fechas = $("#rango_fechas")
	if( select.value == 'datos_generales' )
	{
		if( !side_fechas.hasClass('hidden')){
			$("#fecha_desde").val('01-01-2017')
			$("#fecha_hasta").val("01-01-2017");
			side_fechas.addClass('hidden')
		}
		var url = location.host+'/dashboard/inventario/reportes/'+select.value+'?material_id='+$("#material_reporte").val()
		window.open('http://'+url, "INVITACIONES"  ,"width=800,height=900")
	}
	else if(select.value == 'actividad_en_fechas'){
		var side_fechas = $("#rango_fechas")
		
		if( side_fechas.hasClass('hidden') )
			side_fechas.removeClass('hidden')
		
	}
}

function verificarClave(e, formulario){
	e.preventDefault();
	if( !( document.getElementById('password_1').value == document.getElementById('password_2').value) ){
		alert('AMBAS CLAVES DEBEN SER IGUALES');
		return false;
	}
	formulario.submit();
}


function actualizar(event, formulario){
	var pass = document.getElementById('password_1').value

	if( pass != '' ){
		if( !(pass == document.getElementById('password_2').value )){
			alert('AMBAS CLAVES DEBEN SER IDENTICAS');
			return false;
		}
	}

	formulario.submit();
}