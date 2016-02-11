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
	.header { top: 0px; position: fixed; margin-bottom: 8px;  }
	td.td-title{ border-bottom: 1px solid black; }
	td.footer-table{ border-top: 1px solid black;  }
	.page_break { page-break-before: always; }
</style>
<div class="header">
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
</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
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
					<td style="text-align: right;">
						{{ number_format($totales[$ajuste->tipo_ajuste][$ajuste->nombre_ajuste], 2) }}
					</td>
				</tr>
			@endforeach
			<tr >
				<td class="footer-table">
					&nbsp;
				</td>
				<td class="footer-table">
					&nbsp;
				</td>
				<td class="footer-table" style="text-align: right;">
					<strong>TOTAL - BONOS</strong>
					<br>
					<strong>TOTAL - DEDUCCIONES</strong>
				</td>
				<td class="footer-table" style="text-align: right;">
					{{ number_format($totales['TOTAL_BONO'], 2) }}
					<br>
					{{ number_format($totales['TOTAL_DEDUCCION'], 2) }}
				</td>
			</tr>
		</tbody>

</table>

<div class="page_break"></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
@foreach($nomina->detalles as $key => $detalle)

@if($key == 0)
	<table border="0">
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <strong>REPORTE DE NOMINA POR PERSONA - {{ $detalle->persona->primer_nombre }}</strong>
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" class="body" >
		<thead>
			<tr>
				<th>
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
		<tbody>
			@foreach($nomina->detalles as $key_2 => $detalle_person)
				@if( $detalle_person->persona->identificacion == $detalle->persona->identificacion  )
				<tr style="text-align: center;">
					<td>
						{{ $detalle_person->ajuste->ajuste->codigo_ajuste }}
					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->tipo_ajuste }}
					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->nombre_ajuste }}
					</td>
					<td>
						@if( $detalle_person->ajuste->ajuste->cantidad_ajuste > 0 )
							{{ number_format($detalle_person->ajuste->ajuste->cantidad_ajuste, 2) }}
							@else
							{{ 
								number_format((\App\Models\personal\Persona::getSalario($nomina->tipo_nomina,$detalle_person->persona->sueldo_basico) * $detalle_person->ajuste->ajuste->porcentaje_ajuste)/100, 2)
							 }}
						@endif
					</td>
				</tr>
				@endif
			@endforeach
			<tr style="text-align: right;">
				<td class="footer-table">&nbsp;</td>
				<td class="footer-table">&nbsp;</td>
				<td class="footer-table">
					<strong>TOTAL - BONOS</strong>
					<br>
					<strong>TOTAL - DEDUCCIONES</strong>
					<br>
					<strong>TOTAL - BASE</strong>
					<br>
					<strong>TOTAL A PAGAR</strong>
				</td>
				<td class="footer-table">
					<strong> {{ number_format($detalle->total_bonos, 2) }} </strong>
					<br>
					<strong> {{ number_format($detalle->total_deducciones, 2) }} </strong>
					<br>
					<strong> {{ number_format(\App\Models\personal\Persona::getSalario($nomina->tipo_nomina, $detalle->persona->sueldo_basico), 2) }} </strong>
					<br>
					<strong>
						{{ 
						number_format((\App\Models\personal\Persona::getSalario($nomina->tipo_nomina, $detalle->persona->sueldo_basico) - $detalle->total_deducciones) + $detalle->total_bonos, 2)
						}}
					</strong>
				</td>
			</tr>
		</tbody>
	</table>
@elseif( $key > 0 && $detalle->persona->identificacion != $nomina->detalles[($key - 1)]->persona->identificacion)
	<div class="page_break"></div>
	<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
	<table border="0">
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 <strong>REPORTE DE NOMINA POR PERSONA - {{ $detalle->persona->primer_nombre }}</strong>
			</td>
		</tr>
	</table>
	<table border="0" cellpadding="0" cellspacing="0" class="body" >
		<thead>
			<tr>
				<th>
					&nbsp;&nbsp;&nbsp;
					CODIGO
					&nbsp;&nbsp;&nbsp;
				</th>
				<th>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					TIPO
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
		<tbody>
			@foreach($nomina->detalles as $key_2 => $detalle_person)
				@if( $detalle_person->persona->identificacion == $detalle->persona->identificacion  )
				<tr style="text-align: center;">
					<td>
						{{ $detalle_person->ajuste->ajuste->codigo_ajuste }}
					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->tipo_ajuste }}
					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->nombre_ajuste }}
					</td>
					<td>
						@if( $detalle_person->ajuste->ajuste->cantidad_ajuste > 0 )
							{{ number_format($detalle_person->ajuste->ajuste->cantidad_ajuste, 2) }}
							@else
							{{ 
								number_format((\App\Models\personal\Persona::getSalario($nomina->tipo_nomina,$detalle_person->persona->sueldo_basico) * $detalle_person->ajuste->ajuste->porcentaje_ajuste)/100, 2)
							 }}
						@endif
					</td>
				</tr>
				@endif
			@endforeach
			<tr style="text-align: right;">
				<td class="footer-table">&nbsp;</td>
				<td class="footer-table">&nbsp;</td>
				<td class="footer-table">
					<strong>TOTAL - BONOS</strong>
					<br>
					<strong>TOTAL - DEDUCCIONES</strong>
					<br>
					<strong>TOTAL - BASE</strong>
					<br>
					<strong>TOTAL A PAGAR</strong>
				</td>
				<td class="footer-table">
					<strong> {{ number_format($detalle->total_bonos, 2) }} </strong>
					<br>
					<strong> {{ number_format($detalle->total_deducciones, 2) }} </strong>
					<br>
					<strong> {{ number_format(\App\Models\personal\Persona::getSalario($nomina->tipo_nomina, $detalle->persona->sueldo_basico), 2) }} </strong>
					<br>
					<strong>
						{{ 
						number_format((\App\Models\personal\Persona::getSalario($nomina->tipo_nomina, $detalle->persona->sueldo_basico) - $detalle->total_deducciones) + $detalle->total_bonos, 2)
						}}
					</strong>
				</td>
			</tr>
		</tbody>
	</table>
@endif

@endforeach