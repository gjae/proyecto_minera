$(document).ready(function(){
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