<style>
	body{
		font-family: Helvetica;
	}
	thead{
		border: 1px solid black;
	}
	thead th{
		border: 1px solid black;
	}
	table.body{
		border: 1px solid black;
	}
	td.td-title{ border-bottom: 1px solid black; }
</style>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td >
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="td-title">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">SOCIEDAD MINERA DEL NORTE LTDA.</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<br>

					</td>
				</tr>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE NOMINA</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">

				<tr>
					<td class="td-title">
						&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;">Paginas:  de </strong>
					&nbsp;
					</td>
				</tr>
				<tr style="outline: thin solid;">
					<td>
					&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;">{{ Carbon\Carbon::now()->format('d-M-Y') }}</strong>
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br>
<br>

<table border="0" cellpadding="0" cellspacing="0" align="center">
	
	<tr>
		<td> 
			&nbsp;&nbsp;
			<strong>CONSECUTIVO</strong>	
			&nbsp;&nbsp;
		</td>
		<td>
			&nbsp;&nbsp;
			<strong>{{ $nomina->codigo_nomina }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;
			<strong>NOMBRE DE LA NOMINA</strong>
			&nbsp;&nbsp;
		</td>
		<td >
			&nbsp;&nbsp;
			<strong>{{ $nomina->nombre_nomina }}</strong>
			&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;
			<strong>DESDE {{$periodo['desde']->format('d M Y')}}</strong>
		</td>
		<td>
			&nbsp;&nbsp;
			<strong>HASTA {{ $periodo['hasta']->format('d M Y') }}</strong>
		</td>
	</tr>


</table>

<br>
<table border="0">
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 <strong>REPORTE DE TOTALES POR AJUSTES EN NOMINA</strong>
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" class="body">
	
	<thead >
		<tr class="borderOK" >
			<th >
				&nbsp;&nbsp;&nbsp;
				CODIGO
				&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;
				TIPO
				&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				DENOMINACION
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;&nbsp;
				TOTAL COP$ 
				&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
		</tr>
	</thead>
	<tbody >
		<tbody>
			@foreach($ajustes as $key => $ajuste)
				<tr style="text-align: center">
					<td>
						{{ $ajuste->codigo_ajuste }}
					</td>
					<td>
						{{ $ajuste->tipo_ajuste }}
					</td>
					<td>
						{{$ajuste->nombre_ajuste}}
					</td>
					<td>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</tbody>

</table>