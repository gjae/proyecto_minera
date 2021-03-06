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

@if( $persona )
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
 <table border="0" cellpadding="0" align="center" cellspacing="0" align="center">
	
	<tr>
		<td align="left">
			
			<strong>NOMINA</strong>
		</td>
		<td align="right">
		</td>
	<tr>
		<td align="left">
			
			<strong>DESDE {{ is_null($fecha_desde) ? 'S/E' : \Carbon\Carbon::parse($fecha_desde)->format('d-m-Y') }}</strong>
		</td>
		<td align="right">
			
			<strong>HASTA {{ is_null( $fecha_hasta ) ? 'S/E' : \Carbon\Carbon::parse($fecha_hasta)->format('d-m-Y') }}</strong>
		</td>
	</tr>

</table>
<br>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="text-align: center;">
	<tr>
		<td>
			<strong>
				REPORTE DE NOMINA POR MINA, CORRESPONDIENTE A: {{ $persona->primer_nombre.' '.$persona->segundo_nombre.' ( '.$persona->identificacion.' )' }}
			</strong>
		</td>
	</tr>
</table>
<br>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="body">
	
	<thead style="text-align: center;">
				<tr class="borderOK" >
					<th>
						FECHA
					</th>
					<th >
						
						U. MEDIDA
						
					</th>
					<th>
						
						DESCRIPCION
						
					</th>
					<th>
						
						CANT. INGRESADA
						
					</th>
					<th>
						VALORACION COP$
					</th>
					<th>
						
						TOTAL COP$ 
						
					</th>
				</tr>
	</thead>
		@php
			$total=0;
		@endphp
		<tbody>
			@foreach( $movimientos as $movimiento )
						<tr align="center">
							<td> {{ $movimiento->fecha_ingreso->format('d/m/Y') }} </td>
							<td>
								{{ App\Models\inventario\UnidadMedida::where('codigo_unidad', '=', $movimiento->peso_en)->first()->descripcion_unidad  }}
							</td>
							<td>
								{{ $movimiento->observacion }}
							</td>
							<td>
								{{ $movimiento->cantidad_ingreso }}
							</td>
							<td align="right">
								{{ number_format($movimiento->monto_tonelada, 2, '.', ',') }}
							</td>
							<td align="right">
								@php $total += $movimiento->total_movimiento ; @endphp
								{{ number_format( $movimiento->total_movimiento, 2, '.', ',' ) }}
							</td>
						</tr>
			@endforeach
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr >
				<td class="footer-table">
					
				</td>
				<td class="footer-table">
					
				</td>
				<td class="footer-table">
					
				</td>
				<td class="footer-table">
					
				</td>
				<td class="footer-table" style="text-align: right;">
					<strong>TOTAL</strong>
				</td>
				<td class="footer-table" style="text-align: right;">
					<strong>{{ number_format($total, 2) }}</strong>
				</td>
			</tr>
		</tbody>

</table>

<div class="page_break"></div>
@endif

