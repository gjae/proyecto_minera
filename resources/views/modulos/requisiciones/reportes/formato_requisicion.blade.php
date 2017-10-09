<table style="color: #fff; font-family: Helvetica;" border="0" cellspacing="0" cellpadding="0">
	
	<tr bgcolor="#0D0D0D" style="padding-top: 13px; ">
		<td>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>SOCIEDAD MINERA DEL NORTE</strong>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br>
		</td>
		<td>
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="z-index: 9999; max-width: 180px; max-height: 210px;">
		</td>
	</tr>
	<tr bgcolor="#222A35">
		<td>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<strong>REQUISICION DE BIENES Y SERVICIO</strong>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<br>
		</td>
		<td>&nbsp;</td>		
	</tr>

</table>
<table border="1" style="font-family: Helvetica;" cellpadding="0" cellspacing="0">
		<tr>
			<td>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>ELABORADO POR: </strong>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br>
			</td>
			<td>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>REQUISICIÓN No.: </strong>
			</td>
			<td>
				<br>
				<strong>{{ $requisiciones->codigo_requisicion }}</strong>
			</td>
			<td>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>
					{{ $requisiciones->ciudad->nombre_ciudad }}
				</strong>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>COM 01 2017</strong>
				&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
				<br>
				&nbsp;
			</td>
			<td>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>FECHA: </strong>
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				<br>
				<strong>{{ $requisiciones->created_at->format('d-m-Y') }}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>VERSION </strong>
			</td>
			<td>&nbsp;</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<strong>Hoja 1 de</strong>
			</td>
		</tr>
</table>
<table border="1" style="font-family: Helvetica;" cellpadding="0" cellspacing="0" >
	<thead>
		<tr bgcolor="#333F50" align="center">
			<td>
				<strong>ITEM</strong>	
			</td>
			<td>
				<strong>DESCRIPCION </strong>
			</td>
			<td>
				<strong>UNIDAD</strong>
			</td>
			<td>
				<strong>CANT. SOLICITADA</strong>
			</td>
			<td>
				<strong>CANT. APROBADA</strong>
			</td>
			<td bgcolor="#548235">
				
				<strong>CENTRO DE COSTOS</strong>
			</td>
			<td bgcolor="#548235">
				
				<strong>ETAPA DE 
				PRODUCCION </strong> 
			</td>
			<td bgcolor="#548235">
				<strong>
				DICIPLINA 
				</strong>
			</td>
			<td>
				<strong>RESPONSABLE</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		@foreach($requisiciones->detalles as $detalle)
			<tr align="center">
				<td>{{ $detalle->material->codigo_material }}</td>
				<td>{{ $detalle->material->nombre_material }}</td>
				<td>{{ $detalle->material->unidad_medida->codigo_unidad }}</td>
				<td>{{ $detalle->cantidad_pedida }}</td>
				<td>{{ $detalle->cantidad_aprobada }}</td>
				<td>{{ $detalle->centro_costos->nombre_centro }}</td>
				<td>{{ $detalle->etapa_produccion->nombre_etapa }}</td>
				<td>{{ $detalle->disciplina->nombre_diciplina }}</td>
				<td>&nbsp;</td>
			</tr>
		@endforeach
	</tbody>
</table>