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
<table border="1" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="20%">
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td width="65%">
			<table border="0" width="100%" style="text-align: center;" cellpadding="0" cellspacing="0">
				<tr>
					<td class="td-title">
						
						<strong style="font-size: 12pt; font-family: Helvetica;">SOCIEDAD MINERA DEL NORTE LTDA.</strong>
						
						<br>

					</td>
				</tr>
				<tr>
					<td>
						
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE NOMINA</strong>
						
					</td>
				</tr>
			</table>
		</td>
		<td width="15%">
			<table border="0" width="100%" cellspacing="0" cellpadding="0">

				<tr >
					<td>
					
						<strong style="font-size: 10pt; font-family: Helvetica;">{{ Carbon\Carbon::now()->format('d-M-Y') }}</strong>
						
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
			
			<strong>CONSECUTIVO</strong>	
			
		</td>
		<td>
			
			<strong>{{ $nomina->codigo_nomina }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			
			<strong>NOMBRE DE LA NOMINA</strong>
			
		</td>
		<td >
			
			<strong>{{ $nomina->nombre_nomina }}</strong>
			
		</td>
	</tr>
	<tr>
		<td>
			
			<strong>DESDE {{$periodo['desde']->format('d M Y')}}</strong>
		</td>
		<td>
			
			<strong>HASTA {{ $periodo['hasta']->format('d M Y') }}</strong>
		</td>
	</tr>


</table>

<br>
<table border="0" width="100%" style="text-align: center;">
	<tr>
		<td>
			
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
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="body">
	
	<thead style="text-align: center;">
		<tr class="borderOK" >
			<th >
				
				CODIGO
				
			</th>
			<th>
				
				TIPO
				
			</th>
			<th>
				
				DENOMINACION
				
			</th>
			<th>
				
				TOTAL COP$ 
				
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
					
				</td>
				<td class="footer-table">
					
				</td>
				<td class="footer-table" style="text-align: right;">
					<strong>TOTAL - BONOS</strong>
					<br>
					<strong>TOTAL - DEDUCCIONES</strong>
				</td>
				<td class="footer-table" style="text-align: right;">

					{{ number_format(( isset($totales['TOTAL_BONO'])? $totales['TOTAL_BONO']: 0), 2) }}
					<br>
					{{ number_format( (isset($totales['TOTAL_DEDUCCION'])? $totales['TOTAL_DEDUCCION'] : 0), 2) }}
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

@if($key == 0 )
	<table border="0" width="100%">
		<tr style="text-align: center;">
			<td>
				
				 <strong>REPORTE DE NOMINA POR PERSONA - {{ $detalle->persona->primer_nombre.' '.$detalle->persona->primer_apellido .'( '.$detalle->persona->identificacion.' )'}}</strong>
			</td>
		</tr>
	</table>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="body" >
		<thead>
			<tr style="text-align: center;">
				<th>
					CODIGO
				</th>
				<th>
					TIPO
				</th>
				<th>
					DENOMINACION
				</th>
				<th>
				TOTAL COP$ 
				</th>
			</tr>
		</thead>
		<tbody>
			@php
				$total_bonos = 0;
				$total_deducciones = 0;
			@endphp
			@foreach($nomina->detalles as $key_2 => $detalle_person)
				@if( $detalle_person->persona->identificacion == $detalle->persona->identificacion  )
				<tr style="text-align: center;">
					<td>
						{{ $detalle_person->ajuste->ajuste->codigo_ajuste }}
					</td>
					<td>
						@if($detalle_person->ajuste->ajuste->tipo_ajuste == 'BONO')
							@php
								$total_bonos += $detalle_person->total_bonos;
							@endphp
						@else
							@php
								$total_deducciones += $detalle_person->total_deducciones;
							@endphp
						@endif
						{{ $detalle_person->ajuste->ajuste->tipo_ajuste }}

					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->nombre_ajuste }}
					</td>
					<td style="text-align: right;">
						{{ number_format($detalle_person->total_bonos == 0 ? $detalle_person->total_deducciones : $detalle_person->total_bonos, 2) }}
					</td>
				</tr>
				@endif
			@endforeach
			<tr style="text-align: right;">
				<td class="footer-table"></td>
				<td class="footer-table"></td>
				<td class="footer-table">
					<strong>TOTAL - BONOS</strong>
					<br>
					<strong>TOTAL - DEDUCCIONES</strong>
					<br>
					<strong>TOTAL - BASE</strong>
					<br>
					<strong>TOTAL A PAGAR</strong>
				</td>
				<td class="footer-table" style="text-align: right;">
					<strong> {{ number_format($total_bonos, 2) }} </strong>
					<br>
					<strong> {{ number_format($total_deducciones, 2) }} </strong>
					<br>
					<strong> {{ number_format($detalle->persona->sueldo_basico, 2) }} </strong>
					<br>
					<strong>
						{{ 
						number_format( ($detalle->persona->sueldo_basico - $total_deducciones) + $total_bonos , 2)
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
	<table border="0" width="100%" style="text-align: center;">
		<tr>
			<td>
				
				 <strong>REPORTE DE NOMINA POR PERSONA - {{ $detalle->persona->primer_nombre }}</strong>
			</td>
		</tr>
	</table>
	<table border="0" width="100%" cellpadding="0" cellspacing="0" class="body" >
		<thead style="text-align: center;">
			<tr>
				<th>
					
					CODIGO
					
				</th>
				<th>
					
					TIPO
					
				</th>
				<th>
					
					DENOMINACION
					
				</th>
				<th>
				
				TOTAL COP$ 
				
				</th>
			</tr>
		</thead>
		<tbody>
			@php
				$total_bonos = 0;
				$total_deducciones = 0;
			@endphp
			@foreach($nomina->detalles as $key_2 => $detalle_person)
				@if( $detalle_person->persona->identificacion == $detalle->persona->identificacion  )
				<tr style="text-align: center;">
					<td>
						{{ $detalle_person->ajuste->ajuste->codigo_ajuste }}
					</td>
					<td>
						@if($detalle_person->ajuste->ajuste->tipo_ajuste == 'BONO')
							@php
								$total_bonos += $detalle_person->total_bonos;
							@endphp
						@else
							@php
								$total_deducciones += $detalle_person->total_deducciones;
							@endphp
						@endif
						{{ $detalle_person->ajuste->ajuste->tipo_ajuste }}
					</td>
					<td>
						{{ $detalle_person->ajuste->ajuste->nombre_ajuste }}
					</td>
					<td style="text-align: right;">
						{{ number_format($detalle_person->total_bonos == 0 ? $detalle_person->total_deducciones : $detalle_person->total_bonos, 2) }}

					</td>
				</tr>
				@endif
			@endforeach
			<tr style="text-align: right;">
				<td class="footer-table"></td>
				<td class="footer-table"></td>
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
					<strong> {{ number_format($total_bonos, 2) }} </strong>
					<br>
					<strong> {{ number_format($total_deducciones, 2) }} </strong>
					<br>
					<strong> {{ number_format($detalle->persona->sueldo_basico, 2) }} </strong>
					<br>
					<strong>
						{{ 
						number_format( ($detalle->persona->sueldo_basico - $total_deducciones) + $total_bonos , 2)
						}}
					</strong>
				</td>
			</tr>
		</tbody>
	</table>
@endif

@endforeach