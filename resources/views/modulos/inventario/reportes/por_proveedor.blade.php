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
						
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE ACTIVIDADES POR PROVEEDOR</strong>
						
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

<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tbody align="center" style="text-align: center;" >
		<td width="100%">
			<h3>Relacion de movimientos de inventario por proveedor</h3>
		</td>
	</tbody>
</table>
<table border="0" cellpadding="0" align="center" cellspacing="0" width="100%">
	<tbody>
		<tr align="center">
			<td width="10%" style="text-align: right;">
				<strong>Proveedor: </strong>
			</td>
			<td width="25%" style="text-align: left;">
				<strong>{{ $proveedor->razon_social }}</strong>
			</td>
		</tr>
		<tr align="center">
			<td width="10%" style="text-align: right;">
				<strong>{{ $proveedor->tipo_identificacion }}: </strong>
			</td>
			<td width="25%" style="text-align: left;">
				<strong>{{ $proveedor->nro_identificacion }}</strong> 
			</td>
		</tr>
		<tr align="center">
			<td width="12%" style="text-align: right;">
				<strong>Representante: </strong>
			</td>
			<td width="15%" style="text-align: left;">
				<strong>{{ $proveedor->representante_legal }}</strong>
			</td>
		</tr>
	</tbody>
</table>
<table border="0" style="text-align: center;" class="body" width="100%" cellspacing="0" cellpadding="0">
	
	<thead>
		<tr>
			<th>
				Material
			</th>
			<th>
				Tipo
			</th>
			<th>
				UMD
			</th>
			<th>
				Cantidad
			</th>
			<th>
				Factura
			</th>
			<th>
				P/Unitario
			</th>
			<th>
				IVA
			</th>
			<th>
				Total
			</th>
		</tr>
	</thead>
	<tbody>
		@php
			$total_p_unit = 0;
			$total_iva = 0;
			$total = 0;
		@endphp
		@foreach($ingresos as $key => $ingreso)
			<tr>
				<td>{{ $ingreso->material->nombre_material }}</td>
				<td>{{ $ingreso->material->tipo->codigo_tipo }}</td>
				<td>{{ $ingreso->material->unidad_medida->codigo_unidad }}</td>
				<td>{{ $ingreso->cantidad }}</td>
				<td>{{ $ingreso->factura }}</td>
				<td>{{ number_format($ingreso->precion, 2) }}</td>
				<td>{{ number_format($ingreso->total_iva, 2) }}</td>
				<td>{{ number_format($ingreso->monto, 2) }}</td>
			</tr>
			@php
				$total_p_unit += $ingreso->precio;
				$total_iva += $ingreso->total_iva;
				$total += $ingreso->monto;
			@endphp
		@endforeach
		<tr>
			<td class="footer-table">
				<strong>TOTALES</strong>
			</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">{{ number_format($total_p_unit, 2) }}</td>
			<td class="footer-table">{{ number_format($total_iva, 2) }}</td>
			<td class="footer-table">{{ number_format($total, 2) }}</td>
		</tr>
	</tbody>

</table>