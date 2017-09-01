$(document).ready(function(){


	$(".actions").on('click', function(){
		var modal = $("#modal-compras")
		var url = location.host + '/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role');
		$.getJSON('http://'+url, {}, function(resp){
			if( !resp.error){
				$("#form-modal").html(resp.formulario);
				modal.modal({show: true});
			}
			else alert(resp.mensaje)
		})
	});

	$("#guardar").on('click', function(){
		var datos = $("#"+$(this).attr('form-id')).serialize();
		var url = location.host + '/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role');
		if( $(".requisiciones").val() == undefined || $(".proveedores").val() == undefined  ){
			alert("ASEGURESE DE HABER AGREGADO ALGUN PROVEEDOR Y ALGUNA REQUISICION")
			return false;
		}
		else if( datos.indexOf("=&") != -1 ){
			alert("EL CONCEPTO DE LA INVITACIÓN NO PUEDE ESTAR VACIO")
			return false;
		}

		$.post('http://'+url, datos, function(resp){
			alert(resp.mensaje)
			if(! resp.error)
			{
				var url = location.host + '/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/printInvitacion?codigo='+resp.codigo
				window.open('http://'+url, "INVITACIONES"  ,"width=800,height=900")
				//location.reload();
			}
		});
	})
})

function agregarProveedor(event, boton){
	//alert(boton.getAttribute('data-id'))
	//
	if(! boton.classList.contains('disabled'))
	{
		var tr = `
			<tr>
				<input type="hidden" class="proveedores" name="proveedores[]" value="${boton.getAttribute('data-id')}" class="form-control" />
				
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
		
		$("#proveedores").append(tr)
		boton.classList.remove('btn-success')
		boton.classList.add('disabled')
	}
}

function agregarRequisicion(event, boton){

	if(! boton.classList.contains('disabled'))
	{
		var tr = `
			<tr>
				<input type="hidden" class="requisiciones" name="requisiciones[]" value="${boton.getAttribute('data-id')}" />
				<td>
					<strong>${boton.getAttribute('codigo')}</strong>
				</td>
				<td>
					<strong>${boton.getAttribute('concepto')}</strong>
				</td>
				<td>
					<strong>${boton.getAttribute('tipo')}</strong>
				</td>
				<td>
					<strong>${boton.getAttribute('total')}</strong>
				</td>
			</tr>
		`
		$("#table-requisiciones").append(tr)
		boton.classList.remove('btn-success')
		boton.classList.add('disabled')
	}
}