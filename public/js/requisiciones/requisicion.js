var filas = 0;
function agregarFila(event, inputs){
	var fila = `
		<tr>
			<td>
				<input class="form-control" name="codigos[]" id="fila${filas}" data-fila="${filas}" onkeypress="agregarDetalle(event, this)" >
			</td>
			<td id="descipcion${filas}">
				
			</td>
			<td id="unidades${filas}">
				
			</td>
			<td>
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<input type="number" value="0" onkeypress="calcularTotal(event, this)" name="cantidades[]" id="cantidades${filas}" data-fila="${filas}" />
					</div>
				</div>
			</td>
			<td>
				<input type="text" value="0" onkeypress="calcularTotal(event, this)" name="costo_estimado[]" id="costo_estimado${filas}" data-fila="${filas}" />
			</td>
			<td>
				<input type="text" value="0" onkeypress="calcularTotal(event, this)" name="porcentaje_impuesto[]" id="porcentaje_impuesto${filas}" data-fila="${filas}" />
			</td>
			<td>
				<input type="text" value="0" readonly name="totales[]" id="totales${filas}" data-fila="${filas}" />
			</td>
			<td>
				<div id="centros${filas}">
				</div>
			</td>

			<td>
				<div id="etapas${filas}">
				</div>
			</td>
			<td>
				<div id="disciplinas${filas}">
				</div>
			</td>
		</tr>
	`
	filas ++;
	$("#filas_detalles").append(fila);
}
function agregarDetalle(event, codigo){
	if( event.keyCode == 13){
		var url = location.host+'/index.php/dashboard/requisicion/requisicion/consultarMaterial?codigo='+codigo.value
		if( codigo.value == "" ){
			alert("NO SE HA INGRESADO UN CODIGO VALIDO")
			return false;
		}
		console.log(codigo.getAttribute('data-fila'))
		$.get('http://'+url, {}, function(resp){
			if(! resp.error){
				console.log(resp.material.nombre_material)
				var ids = "#descipcion"+codigo.getAttribute('data-fila')
				$(ids).html("<strong>"+resp.material.nombre_material+"</strong>")
				$("#unidades"+codigo.getAttribute('data-fila')).html("<strong>"+resp.unidad_medida.codigo_unidad+"</strong>")
				$("#centros"+codigo.getAttribute('data-fila')).html(resp.centros)
				$("#etapas"+codigo.getAttribute('data-fila')).html(resp.etapas)
				$("#disciplinas"+codigo.getAttribute('data-fila')).html(resp.disciplinas)
			}
		})	
	}
}

function calcularTotal(event, fila){

	if(event.keyCode == 13){
		var nro_fila = fila.getAttribute('data-fila')
		var costo = ( parseFloat($("#cantidades"+nro_fila).val()) * parseFloat($("#costo_estimado"+nro_fila).val()) ) 
		costo += (costo * parseFloat( $("#porcentaje_impuesto"+nro_fila).val() )) / 100
		//$("totales"+nro_fila).val( costo )
		document.getElementById('totales'+nro_fila).value = costo
		console.log( document.getElementById('totales'+nro_fila) )
	}

}

function guardar(event, datos){

	if( !$( "#"+datos.getAttribute('id') ).hasClass('disabled') )
	{
		var datos = $("#form-requisicion").serialize();
		if(datos.indexOf("=&") != -1){
			alert("El formulario aun tiene datos que no han sido completados");
			return false;
		}
		var url = location.host +'/index.php/dashboard/requisicion/requisicion/guardar';
		$.post('http://'+url, datos, function(resp){
			alert(resp.mensaje)
			if(!resp.error)
			{
				var url = location.host +'/index.php/dashboard/requisicion/requisicion/printRequisicion?codigo='+resp.codigo;
				window.open('http://'+url, "INVITACIONES"  ,"width=800,height=900")
				filas = 0
				location.reload()
			}
		})
	}
	else
		alert("AUN NO SE HA CALCULADO LA REQUISICION")
}

function imprimir(event, click){
	var url = location.host +'/index.php/dashboard/requisicion/requisicion/printRequisicion?codigo='+resp.codigo;
}

function calcular(event, button){

	if( filas > 0 ){
		var subtotal = 0;
		var total_impuesto = 0;
		for (var i = 0; i < filas; i++) {
			total_impuesto += ( ( ( parseFloat( $("#cantidades"+i).val() ) * parseFloat( $("#costo_estimado"+i).val() ) )  ) * parseFloat( $("#porcentaje_impuesto"+i).val() ) ) /100
			subtotal += parseFloat( $("#cantidades"+i).val() ) * parseFloat( $("#costo_estimado"+i).val() );
		}
		$("#sub_total").val(subtotal);
		$("#total_impuestos").val(total_impuesto)
		$("#total_requisicion").val( total_impuesto + subtotal)
		if( $("#guardar").hasClass('disabled'))
			$("#guardar").removeClass('disabled')

	}
}
