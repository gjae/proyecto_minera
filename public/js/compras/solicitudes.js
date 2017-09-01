$(document).ready(function(){


	$(".actions").on('click', function(){
		var modal = $("#modal-compras")
		var url = location.host + '/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$("#accion").val();
		$.getJSON('http://'+url, {}, function(resp){
			if( !resp.error){
				$("#form-modal").html(resp.formulario);
				modal.modal({show: true});
			}
			else alert(resp.mensaje)
		})
	})
})

function agregarProveedor(event, boton){
	var tr = `
		<tr>
			<td>
				<input type="text" readonly name="proveedores[]" vale="${boton.getAttribute('id')}" class="form-control" />
			</td>
			<td>
				<strong>${boton.getAttribute('razon-social')}</strong>
			</td>
			<td>
				<strong>${boton.getAttribute('identificacion')}</strong>
			</td>
			<td>
				<strong>${boton.getAttribute('cedula')}</strong>
			</td>
			<td>
				<strong>${boton.getAttribute('telefono')}</strong>
			</td>
		</tr>
	`
	
}