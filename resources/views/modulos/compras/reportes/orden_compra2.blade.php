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
	.page_break { page-break-before: always; }

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
<table border="1" cellspacing="0" cellpadding="0" width="100%">
	<tr>
		<td>
			Si bien se describe una duración del servicio (plazo) y cantidades de servicio a ejecutar, el plazo final a ejecutar y el valor total  final  de la orden de servicio  es el que resulte de multiplicar las cantidades realmente ejecutadas por el valor unitario relacionadas en el cuadro superior y recibidos a satisfaccion por el contratante; mas el impuesto a aplicar, si el servicio se presta por mas dias a partir del primer mes se pagara valor parcial.
		</td>
	</tr>
</table>
<strong>
	5.FORMA DE PAGO
</strong>
<table border="1" style="text-align: center;" width="50%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="35%" height="19px">
			CONTADO
		</td>
		<td width="15%"> &nbsp; </td>
		<td width="35%">
			CREDITO
		</td>
		<td width="15%"> &nbsp; </td>
	</tr>
</table>
<strong>FACTURACION</strong>
<table border="1" style="text-align: center;" width="50%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="35%" height="19px">
			<strong>MES VENCIDO: </strong>
		</td>
		<td width="15%"> &nbsp; </td>
		<td width="35%">
			<strong>MES ANTICIPO: </strong>
		</td>
		<td width="15%"> &nbsp; </td>
	</tr>
</table>
<table border="1" width="70%" cellspacing="0" cellpadding="0">
	<tr >
		<td height="37px">
			<strong>
				PLAZO EN DIAS CALENDARIO PARA PAGO DE FACTURA RADICADA:
			</strong>
		</td>
		<td style="text-align: center;">
			{{ $orden->tiempo_pago }}
		</td>
	</tr>	
</table>

<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="32%"> 
			<strong>CUENTA A CONSIGNAR: </strong>
		</td>
		<td style="text-align: center;">
			{{ $orden->proveedor->cuenta_bancaria }}
		</td>
	</tr>
</table>
<strong>6. PLAZO DE DURACION DEL SERVICIO</strong>
<table border="1" style="text-align: center;" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td height="27px">
			<strong>INICIO: {{ $orden->fecha_inicio->format('d-m-Y') }}</strong>
		</td>
		<td>
			<strong>FIN: {{ $orden->fecha_fin->format('d-m-Y') }}</strong>
		</td>
	</tr>
</table>

<strong>7. LUGAR DE TRABAJO</strong>
<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td height="27px">
			&nbsp;
		</td>
	</tr>
</table>
<strong>8. ANTICIPO</strong>
<table border="1" width="37%" cellpadding="0" cellspacing="0">
	<tr>
		<td style="text-align: center;">
			<strong>{{ $orden->monto_anticipo }}</strong>
		</td>
	</tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="32%">
			<strong>9. LUGAR DE SERVICIO</strong>
		</td>
		<td width="68%">
			<table border="1" width="100%" class="body" cellspacing="0" cellpadding="0">
				<tr>
					<td height="20px" width="20%">
						<strong>SERVICIO: </strong>
					</td>
					<td width="80%">
						&nbsp;
					</td>
				</tr>
				<tr>
					<td>
						<strong>RESPONSABLE: </strong>
					</td>
					<td style="text-align: center;">
						<strong>{{ $orden->contta_resp }}</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>