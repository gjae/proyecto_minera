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
			<h1>CONTROL DE PERSONAL</h1>
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
			<th>
				<h4>IDENTIFICACION</h4>
			</th>
			<th>
				<h4>NOMBRE</h4>
			</th>
			<th>
				<h4>CARGO</h4>
			</th>
			<th>
				<h4>CIUDAD</h4>
			</th>
			<th>
				<h4>TELEFONO</h4>
			</th>
			<th>
				<h4>PENSION</h4>
			</th>
			<th>
				<h4>RH</h4>
			</th>
			<th>
				<h4>EPS</h4>
			</th>
			<th>
				<h4>FECHA DE INGRESO</h4>
			</th>
			<th>
				<h4>SITIO DE TRABAJO</h4>
			</th>
		</tr>
	</thead>
	<tbody>
		@foreach($personas as $persona)
		<tr>
				<td><strong>{{ $persona->identificacion }}</strong></td>
				<td><strong>{{ $persona->primer_nombre.' '.$persona->segundo_nombre.' '.$persona->primer_apellido }}</strong></td>
				<td><strong>{{ $persona->cargo->descripcion_cargo }}</strong></td>
				<td><strong>{{ $persona->ciudad->nombre_ciudad }}</strong></td>
				<td><strong>{{ $persona->telefono }}</strong></td>
				<td><strong>{{ $persona->pension }}</strong></td>
				<td><strong>{{ $persona->tipo_sangre->abreviatura_tipo }}</strong></td>
				<td><strong>{{ $persona->eps }}</strong></td>
				<td><strong>{{ $persona->fecha_ingreso->format('d-m-Y') }}</strong></td>
				<td><strong>{{ $persona->sitio_trabajo->nombre_sitio }}</strong></td>
		</tr>
		@endforeach
	</tbody>
</table>