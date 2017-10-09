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
	}

	th{
		margin-left: 13px;
	}
	.header { top: 0px; position: fixed; margin-bottom: 8px;  }
	td.td-totales{ border-top: 1px solid black; border-bottom: 1px solid black; }
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
						
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE MOVIMIENTO DE MINAS</strong>
						
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

<table class="body" style="text-align: center;" width="100%" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Material</th>
			<th>UMD</th>
			<th>Mina</th>
			<th>Fecha movimiento</th>
			<th>Concepto</th>
			<th>Ingreso</th>
			<th>Egreso</th>
			<th>Responsable</th>
			<th>Peso en</th>
			<th>Precio / TON</th>
			<th>Monto total</th>
		</tr>
	</thead>
	<tbody>
@foreach($materiales as $key => $material)
	
	@php
		$total_movimientos = 0;
		$egreso = 0;
		$ingreso = 0;
	@endphp
	@foreach($material->movimientos as $key => $movimiento )
		<tr>
			<td>{{ $material->descripcion }}</td>
			<td>{{ $material->unidad_medida->codigo_unidad }}</td>
			<td>{{ $movimiento->mina->nombre_mina }}</td>
			<td>{{ ( is_null($movimiento->fecha_ingreso) )? $movimiento->fecha_salida->format('d-m-Y') : $movimiento->fecha_ingreso->format('d-m-Y') }}</td>
			<td>{{ $movimiento->observacion }}</td>
			<td>{{ number_format($movimiento->cantidad_ingreso, 2)  }}</td>
			<td>{{ number_format($movimiento->cantidad_salida , 2) }}</td>
			<td>{{ $movimiento->persona->primer_nombre.' '.$movimiento->persona->primer_apellido }}</td>
			<td>{{ $movimiento->peso_en }}</td>
			<td>{{ number_format($movimiento->monto_tonelada, 2) }}</td>
			<td>{{ number_format($movimiento->total_movimiento, 2) }}</td>
			@php
				if( $movimiento->cantidad_salida > 0 )
					$egreso += $movimiento->total_movimiento;
				else
					$ingreso += $movimiento->total_movimiento;
			@endphp
		</tr>

		@if( $key > 0 && isset($material->movimientos[$key+1]) && $material->movimientos[$key]->created_at->format('d-m-Y') != $material->movimientos[$key+1]->created_at->format('d-m-Y') )
			<tr>
				<td class="td-totales">
					<strong>HASTA</strong>
				</td>
				<td class="td-totales">
					<strong>LA</strong>
				</td>
				<td class="td-totales">
					<strong>FECHA: </strong>
				</td>
				<td class="td-totales">
					<strong>{{ $movimiento->created_at->format('d-m-Y') }}</strong>
				</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">&nbsp;</td>
				<td class="td-totales">
					<strong>{{ number_format($ingreso - $egreso , 2) }}</strong>
				</td>
			</tr>
		@endif
	@endforeach
		<tr>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">&nbsp;</td>
			<td class="td-totales">
				<strong>{{ number_format($ingreso - $egreso, 2) }}</strong>
			</td>
		</tr>
	</tbody>

@endforeach
</table>