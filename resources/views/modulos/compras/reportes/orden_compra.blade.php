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

	td.totales{  border-left: 1px solid #000; }
</style>
<div class="header">
<table border="1" cellpadding="0" width="100%" cellspacing="0">
	<tr>
		<td width="10%">
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td width="63%" style="text-align: center;">
			<table border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr align="center">
					<td class="td-title" >
						<strong style="font-size: 12pt; font-family: Helvetica;">COMPRAS Y CONTRATACION.</strong>
						<br>

					</td>
				</tr>
				<tr align="center">
					<td>
						<strong style="font-size: 12pt; font-family: Helvetica;">ORDEN DE {{ $orden->tipo_orden }}</strong>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" width="100%" cellpadding="0">

				<tr>
					<td class="td-title">
						&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;">CODIGO: {{ $orden->codigo_orden }}</strong>
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

<table class="body head" border="0" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td>
			<strong>FECHA: </strong>
		</td>
		<td class="date-box">
			<strong>{{ $orden->created_at->format('d') }}</strong>
		</td>	
		<td class="date-box">
			<strong>{{ $orden->created_at->format('m') }}</strong>
		</td>
		<td class="date-box">
			<strong>{{ $orden->created_at->format('Y') }}</strong>
		</td>
		<td class="title"> 
			<strong>PROYECTO: </strong>
		</td>
		<td class="date-box">
			<strong>{{ $orden->proyecto }}</strong>
		</td>
		<td class="title">
			<strong>CONSECUTIVO:</strong>
		</td>
		<td class="date-box" width="11%">
			<strong>{{ substr($orden->tipo_orden, 0, 2).'-'.$orden->codigo_orden }}</strong>
		</td>
	</tr>
</table>
<table class="body" border="0" cellpadding="0" cellspacing="0">

	<tr>
		<td>
			<strong>REQUISICION:</strong>
		</td>
		<td class="date-box footer-table">
			<strong>{{ $requisicion->id }}</strong>
		</td>
		<td class="title footer-table">
			<strong>CENTRO DE COSTOS</strong>
		</td>
		<td class="date-box">
			<strong>{{ $requisicion->centro_costo->nombre_centro }}</strong>
		</td>
		<td class="title">
			<strong>ETAPA DE EXPLOTACION</strong>
		</td>
		<td class="date-box">
			<strong>{{ $requisicion->etapa_produccion->nombre_etapa }}</strong>
		</td>
		<td class="title">
			<strong>DICIPLINA</strong>
		</td>
		<td class="date-box">
			<strong>{{ $requisicion->diciplina->nombre_diciplina }}</strong>
		</td>
	</tr>
</table>
<strong>1. INFORMACION DEL CONTRATANTE</strong>

<table class="body" border="0" width="100%"  cellspacing="0" cellpadding="0">
	<tr>
		<td width="12%">
			<strong>NOMBRE: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contte_nombre }}</strong>
		</td>
		<td width="12%">
			<strong>RESPONSABLE: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contte_resp }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>NIT /CC: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contte_nit_cc }}</strong>
		</td>
		<td width="12%">
			<strong>CC: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contte_resp_cc }}</strong>
		</td>
	</tr>

	<tr>
		<td width="12%">
			<strong>DIR: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong> -- </strong>
		</td>
		<td width="12%">
			<strong>CARGO :</strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contte_resp_cargo }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>TEL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contte_telefono }}</strong>
		</td>
		<td width="12%">
			<strong>EMAIL: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contte_resp_email }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>MAIL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>--</strong>
		</td>
		<td width="12%">
			<strong>TEL: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contte_rep_telf }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>REP/LEGAL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contte_rep_legal }}</strong>
		</td>
		<td width="12%">
			&nbsp;
		</td>
		<td width="38%">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>CC: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contte_cc }}</strong>
		</td>
		<td width="12%">
			&nbsp;
		</td>
		<td width="38%">
			&nbsp;
		</td>
	</tr>
</table>
<strong>2. INFORMACION DEL CONTRATISTA</strong>
<table class="body" border="0" width="100%"  cellspacing="0" cellpadding="0">
	<tr>
		<td width="12%">
			<strong>NOMBRE: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $analisis->proveedor->razon_social }}</strong>
		</td>
		<td width="12%">
			<strong>RESPONSABLE: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contta_resp }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>NIT /CC: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contta_nit_cc }}</strong>
		</td>
		<td width="12%">
			<strong>CC: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contta_resp_cc }}</strong>
		</td>
	</tr>

	<tr>
		<td width="12%">
			<strong>DIR: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contta_dir }} </strong>
		</td>
		<td width="12%">
			<strong>CARGO :</strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contta_resp_cargo }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>TEL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $analisis->proveedor->telefono }}</strong>
		</td>
		<td width="12%">
			<strong>EMAIL: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contta_resp_email }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>MAIL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $analisis->proveedor->telefono }}</strong>
		</td>
		<td width="12%">
			<strong>TEL: </strong>
		</td>
		<td class="date-box" width="38%">
			<strong>{{ $orden->contta_rep_telf }}</strong>
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>REP/LEGAL: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $orden->contta_resp_legal }}</strong>
		</td>
		<td width="12%">
			&nbsp;
		</td>
		<td width="38%">
			&nbsp;
		</td>
	</tr>
	<tr>
		<td width="12%">
			<strong>CC: </strong>
		</td>
		<td width="38%" class="date-box">
			<strong>{{ $analisis->proveedor->cedula }}</strong>
		</td>
		<td width="12%">
			&nbsp;
		</td>
		<td width="38%">
			&nbsp;
		</td>
	</tr>
</table>
<strong>3. OBJETO Y CONSIDERACIONES </strong>
<table class="body" border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			{{ $orden->concepto }}
		</td>
	</tr>
</table>
<strong>4. </strong>
<table class="body" width="100%" style="text-align: center;" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>ID</th>
			<th>DESCRIPCION</th>
			<th>UNIDAD</th>
			<th>CANT.</th>
			<th> VR/ UNIT. </th>
			<th>VR/ TOTAL</th>
		</tr>
	</thead>
	@foreach($solicitud->registros_cotizacion as $key => $registro)
		<tr>
			<td>{{ $key+1 }}</td>
			<td>{{ $registro->material->nombre_material }}</td>
			<td>{{ $registro->material->unidad_medida->codigo_unidad }}</td>
			<td>{{ $registro->cantidad }}</td>
			<td>{{ $registro->cotizacion }}</td>
			<td>{{ $registro->total_cotizacion }}</td>
		</tr>
	@endforeach
	<tr>
		<td class="footer-table">&nbsp;</td>
		<td class="footer-table">&nbsp;</td>
		<td class="footer-table">&nbsp;</td>
		<td class="footer-table">&nbsp;</td>
		<td class="footer-table" style="text-align: right;">
			<strong>TOTAL ANTES DE DESCUENTO</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->total_sin_descuento, 2) }}
		</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align: right;">
			<strong>DESCUENTO</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->descuento, 2) }}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align: right;">
			<strong>SUBTOTAL</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->subtotal, 2) }}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align: right;">
			<strong>IVA</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->total_iva, 2) }}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align: right;">
			<strong>RETEFUENTE</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->retefuente, 2) }}
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td style="text-align: right;">
			<strong>TOTAL A PAGAR</strong>
		</td>
		<td class="footer-table totales">
			{{ number_format($orden->total, 2) }}
		</td>
	</tr>
	
</table>