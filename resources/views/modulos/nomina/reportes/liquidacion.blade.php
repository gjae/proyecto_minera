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
	
	table.data{
		margin-left: 45px;
		padding: 2px 2px 2px 2px;
	}

	span.divider{
		border: 1px solid #000;
	}

	th{
		margin-left: 13px;
	}
	.header { top: 0px; position: fixed; margin-bottom: 8px;  }
	td.td-title{ border-bottom: 1px solid black; }
	td.footer-table{ border-top: 1px solid black;  }
	.page_break { page-break-before: always; }
.page-header {
  padding-bottom: 9px;
  margin: 40px 0 20px;
}
h1 {
  margin: .67em 0;
  font-size: 2em;
  margin-left: 190px;
}
</style>
<table border="0"  cellpadding="0" cellspacing="0" width="100%" center;">
	<thead>
		<tr>
			<td>
				<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 290px; max-height: 210px;">
			</td>
			<td width="64%" style="text-align: center;">
				<h5>SOCIEDAD MINERA DEL NORTE</h5>
				<h5>NIT. 826.003.999</h5>
				<h5>LIQUIDACION CONTRATO DE TRABAJO</h5>
				<h5>{{ $meses[$liquidacion->created_at->format('m')].' '.$liquidacion->created_at->format('Y') }}</h5>
			</td>
		</tr>
	</thead>
</table>
<table border="0" class="body" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<strong>NOMBRE DEL TRABAJADOR</strong>
		</td>
		<td>
			<strong>
				{{ $liquidacion->persona->primer_apellido.' '.$liquidacion->persona->segundo_apellido.' '.$liquidacion->persona->primer_nombre.' '.$liquidacion->persona->segundo_nombre }}
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>IDENTIFICACION</strong>
		</td>
		<td>
			<strong>{{ $liquidacion->persona->identificacion }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>FECHA DE INGRESO</strong>
		</td>
		<td>
			<strong>{{ $meses[$liquidacion->persona->fecha_ingreso->format('m')].' '.$liquidacion->persona->fecha_ingreso->format('d').' De '.$liquidacion->persona->fecha_ingreso->format('Y') }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>FECHA DE SALIDA</strong>
		</td>
		<td>
			<strong>{{ $meses[$liquidacion->fecha_retiro->format('m')].' '.$liquidacion->fecha_retiro->format('d').' De '.$liquidacion->fecha_retiro->format('Y') }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>DIAS A LIQUIDAR</strong>
		</td>
		<td>
			<strong>{{ $liquidacion->dias_liquidacion }}</strong>
		</td>
	</tr>
</table>
<table class="body" width="100%" border="0" cellspacing="0" cellpadding="0">
	
	<tr>
		<td>
			<strong>SALARIO BASE DE LIQUIDACION</strong>
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td>
			<strong>$ {{ number_format($liquidacion->persona->sueldo_basico, 2) }}</strong>
		</td>
	</tr>
	@foreach($liquidacion->detalles as $key => $detalle)
		<tr>
			<td>
				<strong> {{ $detalle->ajuste_persona->ajuste->nombre_ajuste }} </strong>
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td>
				<strong>{{ number_format($detalle->total_ajuste, 2) }}</strong>
			</td>
		</tr>
	@endforeach
	<tr>
		<td>
			<strong>TOTAL</strong>
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td>
			<strong>{{ number_format($liquidacion->detalles()->sum('total_ajuste') + $liquidacion->persona->sueldo_basico, 2) }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>CESANTIAS</strong>
		</td>
		<td style="text-align: center;">
			<strong>
				{{ number_format($liquidacion->detalles()->sum('total_ajuste') + $liquidacion->persona->sueldo_basico, 2) }} * {{ $liquidacion->dias_liquidacion }}
				<br>
				________________________
				<br>
				360
			</strong>
		</td>
		<td>
			<strong>{{ number_format($liquidacion->total_cesantias, 2) }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>INTERESES/CESANTIAS</strong>
		</td>
		<td style="text-align: center;">
			<strong>
				{{ number_format($liquidacion->total_cesantias, 2) }} * {{ $liquidacion->porcentaje_intereses }} * {{ $liquidacion->dias_liquidacion }}
				<br>
				________________________
				<br>
				360
			</strong>
		</td>
		<td>
			<strong>{{ number_format(App\Http\Controllers\nomina\Liquidacion::calcularInteresesCesantias($liquidacion->total_cesantias, $liquidacion->porcentaje_intereses, $liquidacion->dias_liquidacion), 2) }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>PRIMA</strong>
		</td>
		<td style="text-align: center;">
			<strong>
				{{ number_format($liquidacion->detalles()->sum('total_ajuste') + $liquidacion->persona->sueldo_basico, 2) }} * {{ $liquidacion->dias_liquidacion }}
				<br>
				________________________
				<br>
				360
			</strong>
		</td>
		<td>
			<strong>{{ number_format($liquidacion->total_prima, 2) }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>VACACIONES</strong>
		</td>
		<td style="text-align: center;">
			<strong>
				{{ number_format($liquidacion->persona->sueldo_basico, 2) }} * {{ $liquidacion->dias_liquidacion }}
				<br>
				________________________
				<br>
				720
			</strong>
		</td>
		<td>
			<strong>{{ number_format($liquidacion->total_vacaciones, 2) }}</strong>
		</td>
	</tr>
</table>
<table class="body" width="100%" border="0" cellspacing="0" cellspacing="0">
	<tr>
		<td>
			<strong>TOTAL LIQUIDACION</strong>
		</td>
		<td>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</td>
		<td width="12%" style="text-align: center;">
			<strong>{{ number_format($liquidacion->total_liquidacion, 2) }}</strong>
		</td>
	</tr>
</table>