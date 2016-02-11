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
	td.date-box{ border-left: 1px solid #000; text-align: center; background-color: #E9E9E9; }
	td.title{ border-left: 1px solid #000; text-align: right;}
	.header { top: 0px; position: fixed; margin-bottom: 8px;  }
	td.td-title{ border-bottom: 1px solid black; }
	td.footer-table{ border-top: 1px solid black;  }
	td.box{ border-right: 1px solid #000; border-bottom: 1px solid #000;  }
	.page_break { page-break-inside: avoid; }
	
	td.h1{
		border-top:  1px solid #000;
		border-bottom:  1px solid #000;
		border-right:  1px solid #000;
	}
	td.h2{
		border-top:  1px solid #000;
		border-bottom:  1px solid #000;
		border-left:  1px solid #000;
	}
	td.h{border: 1px solid #000;}
</style>
<div class="header">
<table border="1" cellpadding="0" width="100%" cellspacing="0">
	<tr>
		<td width="10%">
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td width="57%" style="text-align: center;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr align="center">
					<td class="td-title" >
						<strong style="font-size: 12pt; font-family: Helvetica;">COMPRAS Y CONTRATACION.</strong>
						<br>

					</td>
				</tr>
				<tr align="center">
					<td>
						<strong style="font-size: 12pt; font-family: Helvetica;">PROVEEDOR GANADOR</strong>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" width="100%" cellpadding="0">

				<tr>
					<td class="td-title">
						&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;">CODIGO: {{ $analisis[0]->codigo }}</strong>
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
<table border="0" style="text-align: center;" cellspacing="0" width="100%" cellpadding="0">
	<tr>
		<td width="100%">
			
			<table border="1" width="100$" cellpadding="0" cellspacing="0">
				
				<tr>
					<td>
						<strong>PROYECTO:</strong>
					</td>
					<td>
						<strong>{{ "-" }}</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Cliente:</strong>
					</td>
					<td>
						<strong>{{ $analisis[0]->proveedor->razon_social }}</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Requisicion: </strong>
					</td>
					<td>
						<strong>{{ $analisis[0]->cotizacion->solicitud->requisicion->codigo_requisicion }}</strong>
					</td>
				</tr>
				<tr>
					<td>
						<strong>Fecha: </strong>
					</td>
					<td>
							<strong>{{ $analisis[0]->cotizacion->solicitud->requisicion->created_at->format('d-m-Y') }}</strong>
					</td>
				</tr>

			</table>

		</td>
	</tr>

</table>
<table border="0" cellpadding="0" width="100%" cellspacing="0"> 

<tr style="text-align: center;">
	<td class="h2">&nbsp;</td>
	<td class="h1">
		<strong>MEJOR PROVEEDOR</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>PROPONENTE</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->proveedor->representante_legal }}</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>CONTACTO</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>-</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>CEL</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->proveedor->telefono_representante }}</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>FECHA</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->created_at->format('d-m-Y') }}</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>VALIDEZ</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>&nbsp;</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>CORREO</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->proveedor->email_representante }}</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>TERMINOS DE PAGO</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->cotizacion->forma_pago }}</strong>
	</td>
</tr>
<tr>
	<td style="text-align: right;">
		<strong>TERMINOS DE ENTREGA</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->cotizacion->terminos_entrega }}</strong>
	</td>
</tr>

<tr>
	<td style="text-align: right;">
		<strong>TIEMPO DE ENTREGA</strong>
	</td>
	<td class="h" style="text-align: center">
		<strong>{{ $analisis[0]->cotizacion->plazo_entrega }} Dias</strong>
	</td>
</tr>
</table>
<table border="0" class="body" style="text-align: center;" width="100%" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th>No</th>
			<th>DESCRIPCION</th>
			<th>UM</th>
			<th>CANT</th>
			<th>VR/UNIT</th>
			<th>VR/TOTAL</th>
			<th>MARCA</th>
			<th>ENTREGA</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$subtotal = 0;
		?>
		@foreach($analisis[0]->cotizacion->solicitud->registros_cotizacion as $key => $reg )
			<tr>
				<td>{{ $key +1 }}</td>
				<td>{{ $reg->material->nombre_material }}</td>
				<td>{{ $reg->material->unidad_medida->codigo_unidad }}</td>
				<td>{{ $reg->cantidad }}</td>
				<td>{{ number_format($reg->cotizacion, 2) }}</td>
				<td>{{ number_format($reg->cotizacion * $reg->cantidad, 2) }}</td>
				<td>{{ $reg->marca }}</td>
				<td>-</td>
			</tr>
			<?php
				$subtotal += ($reg->cotizacion  *$reg->cantidad);
			?>
		@endforeach
</table>
<table class="body" style="text-align: right;" width="100%" border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table">&nbsp;</td>
			<td class="footer-table" width="78%">
				<strong>SUB TOTAL COSTO</strong>
			</td>
			<td class="footer-table">{{ number_format($subtotal, 2) }}</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<strong>IVA</strong>
			</td>
			<td>
				{{ number_format(($analisis[0]->cotizacion->solicitud->registros_cotizacion[0]->porcentaje_impuesto * $subtotal)/100, 2) }}
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>
				<strong>COSTO TOTAL ESTIMADO</strong>
			</td>
			<td>
				{{ number_format((($analisis[0]->cotizacion->solicitud->registros_cotizacion[0]->porcentaje_impuesto * $subtotal)/100) + $subtotal, 2) }}
			</td>
		</tr>
	</tbody>
</table>
<table class="body" style="text-align: center;" border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td>
			<strong>
			CONSIDERACIONES Y OBSERVACIONES
			</strong>
		</td>
	</tr>
	<tr>
		<td>
			<strong>
			{{ $analisis[0]->observacion }}
			</strong>
		</td>
	</tr>
</table>