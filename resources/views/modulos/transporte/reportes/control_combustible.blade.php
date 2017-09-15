<style>
	*{
		font-family: Helvetica;
		margin: 0px;
		padding: 0px;
	}
</style>
<table border="0" width="100%" class="header" cellpadding="0" cellspacing="0">
	<tr  bgcolor="#92D050">
		<td width="25%">
			&nbsp;
		</td>
		<td width="50%" style="text-align: center;">
			<br>
			<h1>CONTROL DE VIAJES</h1>
			<br>
		</td>
		<td width="25%">
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
	</tr>
</table>

<table class="body" style="text-align: center;" width="100%" border="1" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>IDENTIFICACION.</th>
			<th>CONDUCTOR</th>
			<th>PLACA DEL VEHICULO</th>
			<th>ORIGEN</th>
			<th>DESTINO</th>
			<th>FECHA DEL VIAJE</th>
			<th>VR TOTAL</th>
			<th>VR A FACTURAR</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($transportes as $key => $transporte)
			<tr>
				<td>{{ $transporte->conductor->identificacion }}</td>
				<td>{{ $transporte->conductor->primer_nombre.' '.$transporte->conductor->primer_apellido }}</td>
				<td>{{ $transporte->vehiculo->placa }}</td>
				<td>{{ $transporte->procedencia }}</td>
				<td>{{ $transporte->destino }}</td>
				<td>{{ $transporte->fecha_salida->format('d-m-Y') }}</td>
			</tr>
		@endforeach
	</tbody>
</table>