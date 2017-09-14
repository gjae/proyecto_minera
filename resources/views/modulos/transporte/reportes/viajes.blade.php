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
			<th>IDENT.</th>
			<th>CONDUCTOR</th>
			<th>FECHA</th>
			<th>RECIBO</th>
			<th>PLACA</th>
			<th>PROCEDENCIA</th>
			<th>PESO</th>
			<th>FLETE / KILO</th>
			<th>TOTAL / PESO</th>
			<th>PESO DE MATERIAL</th>
			<th>PRECIO / PESO MATERIAL</th>
			<th>TOTAL / PESO MATERIAL</th>
			<th>TOTAL FACTURA</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($transportes as $key => $transporte)
			<tr>
				<td>{{ $transporte->conductor->identificacion }}</td>
				<td>{{ $transporte->conductor->primer_nombre.' '.$transporte->conductor->segundo_nombre }}</td>
				<td>{{ $transporte->created_at->format('d-m-Y') }}</td>
				<td>{{ $transporte->recibo }}</td>
				<td>{{ $transporte->vehiculo->placa }}</td>
				<td>{{ $transporte->procedencia }}</td>
				<td>{{ $transporte->kilo_viajes }}</td>
				<td>{{ number_format($transporte->precio_kilo, 2) }}</td>
				<td>{{ number_format(($transporte->precio_kilo * $transporte->kilo_viajes), 2) }}</td>
				<td>{{ $transporte->total_kilo_material }}</td>
				<td>{{ number_format($transporte->total_kilo_viaje_material, 2) }}</td>
				<td>{{ number_format( ($transporte->total_kilo_material * $transporte->total_kilo_viaje_material), 2 ) }}</td>
				<td>{{
						number_format(($transporte->precio_kilo * $transporte->kilo_viajes) + ($transporte->total_kilo_material * $transporte->total_kilo_viaje_material), 2)
					}}</td>
			</tr>
		@endforeach
	</tbody>
</table>