<style>
	.page_break { page-break-before: always; }
</style>

@foreach( $solicitudes as $key => $solicitud )
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<h1>HEHE WE</h1>
		</td>
		<td >
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">COMPRAS Y CONTRATACION</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<br>

					</td>
				</tr>
				<tr>
					<td>
						------------------------------------------------------------------------
					</td>
				</tr>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">INVITACION A COTIZAR</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr style="outline: thin solid;">
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td>
						<strong style="font-size: 10pt; font-family: Helvetica;">Paginas: 1 de 2</strong>
					</td>
				</tr>
				<tr>
					<td>-------------------------------</td>
				</tr>
				<tr style="outline: thin solid;">
					<td>
						<strong style="font-size: 10pt; font-family: Helvetica;">Fecha: </strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>							
		<td>
			<table border="1" cellspacing="0" cellpadding="">
				<tr>
					<td>
						<strong style="font-family: Helvetica;">
							Invitacion a Cotizar No. 
						</strong>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;
						<strong style="font-family: Helvetica;">
							{{ substr($solicitudes[0]->requisicion->tipo_requisicion, 0, 2).'-'.$solicitudes[0]->codigo }}
						</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td >
			<p style="font-family: Helvetica; "> Duitama, DD, MM, AAAA </p>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0">
	<tr >
		<td width="100%" >
			<p style="font-family: Helvetica">
				<strong>OBJETO: </strong> {{ $solicitudes[0]->concepto_solicitud }}
			</p>
		</td>
	</tr>
</table>
<p style="font-family: Helvetica;">
	<strong>SEÑOR {{ $solicitudes[$key]->proveedor->razon_social }}:</strong>
	<br>
	Por medio de la presente queremos solicitarles se sirvan cotizar dentro de los 3 dias siguientes al recibo de esta invitacion, los productos, teniendo en cuenta la siguiente tabla.
</p>
<table border="1" cellspacing="0" cellpadding="0">
	<thead>
		<tr bgcolor="#333399" style="font-family: Arial;">
			<td>
				&nbsp;&nbsp;&nbsp;No.&nbsp;&nbsp;&nbsp;
			</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DESCRIPCION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;UND&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;CANT&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;VR. UNITARIO&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;VR. TOTAL&nbsp;&nbsp;&nbsp;</td>
			<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MARCA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
	</thead>
	<tbody>
		@foreach($solicitudes[0]->requisicion->detalles as $key => $detalle)
			<tr align="center" style="font-family: Helvetica;">
				<td>{{ $key+1 }}</td>
				<td>{{ $detalle->material->nombre_material }}</td>
				<td>{{ $detalle->material->unidad_medida->codigo_unidad }}</td>
				<td>{{ $detalle->cantidad_pedida }}</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
		@endforeach
	</tbody>
</table>

@if( $solicitudes[($key+1)] )
<div class="page_break"></div>
@endif
@endforeach