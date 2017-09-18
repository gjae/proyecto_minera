<style>
	body{
		font-family: Helvetica;
	}
	table.firma{
		border: 1px solid  #000;
	}
</style>
<table border="1" style="text-align: center;" cellspacing="0" width="100%" cellpadding="0">
	<tr bgcolor="#C9C9C9">
		<td height="34px">
			<strong>FECHA</strong>
		</td>
		<td>
			<strong>NUMERO REMISION CLIENTE</strong>
		</td>
		<td>
			<strong>FACTURA</strong>
		</td>	
	</tr>
	<tr bgcolor="#C9C9C9">
		<td>
			<strong>{{ $transporte->fecha_salida->format('d/m/Y') }}</strong>
		</td>
		<td>
			<strong>{{ $transporte->remision_cli }}</strong>
		</td>
		<td>
			<strong>{{ $transporte->nro_factura }}</strong>
		</td>
	</tr>
</table>
<table border="1" width="100%" style="text-align: center;" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#C9C9C9" width="13%" height="34px">
			<strong>PROVEEDOR: </strong>
		</td>
		<td width="48%">
			<strong> SOCIEDAD MIERA DEL NORTE LTDA. </strong>
		</td>
		<td width="15%" bgcolor="#C9C9C9">
			<strong>NIT:</strong>
		</td>
		<td width="30%" bgcolor="#C9C9C9"> 
			<strong> 826.003.999</strong>
		</td>
	</tr>
</table>

<table border="1" width="100%" style="text-align: center;" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#C9C9C9" width="15%" height="34px">
			<strong>MUNICIPIO: </strong>
		</td>
		<td width="28%">
			<strong> MARACAIBO </strong>
		</td>
		<td width="30%" bgcolor="#C9C9C9">
			<strong>TIPO DE MATERIAL:</strong>
		</td>
		<td width="25%"> 
			<strong>{{ $transporte->tipo_material_transportado->descripcion_tipo }}</strong>
		</td>
	</tr>
</table>
<table border="1" width="100%" style="text-align: center;" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#C9C9C9" width="15%" height="34px">
			<strong>DESTINO: </strong>
		</td>
		<td width="29%">
			<strong>{{ $transporte->destino }}</strong>
		</td>
		<td width="18%" bgcolor="#C9C9C9">
			<strong>PROCEDENCIA:</strong>
		</td>
		<td width="38%"> 
			<strong>{{ $transporte->procedencia }}</strong>
		</td>
	</tr>
</table>
<table border="1" width="100%" style="text-align: center;" cellpadding="0" cellspacing="0">
	<tr>
		<td bgcolor="#C9C9C9" width="15%" height="34px">
			<strong>VEHICULO: </strong>
		</td>
		<td width="14%">
			<strong>{{ $transporte->vehiculo->placa }}</strong>
		</td>
		<td width="12%" bgcolor="#C9C9C9">
			<strong>CONDUCTOR:</strong>
		</td>
		<td width="18%"> 
			<strong>{{ $transporte->conductor->primer_nombre.' '.$transporte->conductor->primer_apellido }}</strong>
		</td>
		<td width="15%" bgcolor="#C9C9C9">
			<strong>IDENTIFICACION:</strong>
		</td>
		<td>
			<strong>{{ $transporte->conductor->identificacion }}</strong>
		</td>
	</tr>
</table>
<table width="100%" border="0" class="firma" cellspacing="0" cellpadding="0">
	<tr>
		<td height="190px" style="text-align: center;">
			<strong>_______________________________</strong> <br>
			<strong>FIRMA CONDUCTOR</strong>
		</td>
		<td style="text-align: center;">
			<strong>_______________________________</strong><br>
			<strong>FIRMA DESPACHADOR</strong>
		</td>
	</tr>
</table>
