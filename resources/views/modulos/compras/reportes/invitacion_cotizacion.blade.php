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
	td.title{ border-left: 1px solid #fff; text-align: right;}
	.header { top: 0px; position: fixed; margin-bottom: 8px;  }
	td.td-title{ border-bottom: 1px solid black; }
	td.footer-table{ border-top: 1px solid black;  }
	td.box{ border-right: 1px solid #000; border-bottom: 1px solid #000;  }
	.page_break { page-break-before: always; }
	td.pagina2{
		border-left: 1px solid #000;
	}
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
	body{ font-family: Helvetica;  }
</style>

@foreach( $solicitudes as $key => $solicitud )
@if( $key > 0)
<div class="page_break"></div>
@endif
<table border="1" style="text-align: center;" cellpadding="0" width="100%" cellspacing="0">
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
						<strong style="font-size: 12pt; font-family: Helvetica;">INVITACION A COTIZAR</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;</td>	
		<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>							
		<td>
			<table border="1" cellspacing="0" cellpadding="">
				<tr>
					<td>
						<strong style="font-family: Helvetica;">
							Invitacion a Cotizar No. 
						</strong>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;
						<strong style="font-family: Helvetica;">
							{{ substr($solicitudes[0]->requisicion->tipo_requisicion, 0, 2).'-'.$solicitudes[0]->codigo }}
						</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td >
			<p style="font-family: Helvetica; "> Duitama, {{ $solicitud->created_at->format('d') }}, {{ $solicitud->created_at->format('m') }}, {{ $solicitud->created_at->format('Y') }}</p>
		</td>
	</tr>
</table>
<table border="1" cellpadding="0" width="100%" cellspacing="0">
	<tr >
		<td width="100%" >
			<p style="font-family: Helvetica">
				<strong>OBJETO: </strong> {{ $solicitudes[0]->concepto_solicitud }}
			</p>
		</td>
	</tr>
</table>
<p style="font-family: Helvetica;">
	<strong>SEÑOR {{ $solicitudes[$key]->proveedor->razon_social }}:</strong>
	<br>
	Por medio de la presente queremos solicitarles se sirvan cotizar dentro de los 3 dias siguientes al recibo de esta invitacion, los productos, teniendo en cuenta la siguiente tabla.
</p>
<table border="1" width="100%" cellspacing="0" cellpadding="0">
	<thead>
		<tr bgcolor="#5353AA" style="text-align: center; font-family: Helvetica;">
			<td>
				No.
			</td>
			<td>DESCRIPCION</td>
			<td>UND</td>
			<td>CANT</td>
			<td>VR. UNITARIO</td>
			<td>VR. TOTAL</td>
			<td>MARCA</td>
		</tr>
	</thead>
	<tbody>
		@foreach($solicitudes[0]->requisicion->detalles as $key => $detalle)
			<tr align="center" style="font-family: Helvetica;">
				<td>{{ $key+1 }}</td>
				<td>{{ $detalle->material->nombre_material }}</td>
				<td>{{ $detalle->material->unidad_medida->codigo_unidad }}</td>
				<td>{{ $detalle->cantidad_pedida }}</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
		@endforeach
	</tbody>
</table>
<table border="1" width="84.7%" cellpadding="0" cellspacing="0" style="text-align: center; font-family: Helvetica;">
	<tr bgcolor="#BDDAF7">
		<td bgcolor="">
			<strong>SUB TOTAL</strong>
		</td>
		<td bgcolor="#D0D0D0">
			&nbsp;&nbsp;
		</td>
	</tr>
	<tr bgcolor="#6CEEEE">
		<td>
		
			<strong>IVA</strong>
		</td>
		<td bgcolor="#C0BEBE">
			&nbsp;
		</td>
	</tr>
	<tr bgcolor="#7575CD">
		<td>
			<strong style="color: #fff;">TOTAL</strong>
		</td>
		<td bgcolor="#8A8A8A">
			&nbsp;
		</td>
	</tr>
</table>



@endforeach

<div class="page_break"></div>
<strong>
Tener en cuenta la siguiente especificacion para los productos: 
<br>
1. El proponente debe especificar el costo de transporte poniendo los productos en la ciudad de {{ $solicitudes[0]->ciudad->nombre_ciudad }}.
</strong>
<table border="0" width="100%" cellpadding="0" cellspacing="0" class="body">
	<tr>
		<td width="50%">
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0" >
				<thead>
					<tr style="text-align: center;">
						<th>
							FORMA DE PAGO
						</th>
					</tr>
				</thead>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
				<tr>
					<td class="h1" width="12%" style="text-align: center;">
						ANTICIPO
					</td>
					<td width="7%" class="date-box">&nbsp;</td>
					<td width="12%" style="text-align: left;" class="pagina2">
						%
					</td>
					<td style="text-align: center;" width="7%" class="pagina2">
						NO
					</td>
					<td width="12%" class="date-box">
						&nbsp;
					</td>
				</tr>
			</table>
			<table class="body" width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="44%" style="text-align: center;">
						Pagos parciales
					</td>
					<td class="date-box" width="36%">
						&nbsp;
					</td>
				</tr>
			</table>

		</td>
		<td width="50%">
			<table class="body" border="0" cellpadding="0" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="text-align: center;" class="date-box">
							VIGENCIA DE LA PROPUESTA
						</th>
					</tr>
				</thead>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="body">
				<tr>
					<td width="50%" class="date-box" >
						&nbsp;
					</td>
					<td width="50%" class="pagina2" style="text-align: left;">
						MESES
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="44%" style="text-align: center;">
						&nbsp;
					</td>
					<td width="36%">
						&nbsp;
					</td>
				</tr>
			</table>

		</td>
	</tr>
</table>

<br>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="50%">
			<table class="" width="100%" border="0" cellpadding="0" cellpadding="0">
				<thead>
					<tr>
						<th style="text-align: center;" width="100%">
							PLAZO DEL SERVICIO
						</th>
					</tr>
				</thead>
			</table>

			<table width="100%" border="0" class="body" cellspacing="0" cellpadding="0">
				<tr>
					<td class="pagina2" width="32%">
						EJECUCION
					</td>
					<td class="date-box" width="22%">
						&nbsp;
					</td>
					<td class="pagina2" width="24%">
						MES/DIA
					</td>
					<td class="date-box">
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table class="" width="100%" border="0" cellpadding="0" cellpadding="0">
				<thead>
					<tr>
						<th style="text-align: center;" width="100%">
							TRANSPORTE
						</th>
					</tr>
				</thead>
			</table>

			<table width="100%" border="0" class="body" cellspacing="0" cellpadding="0">
				<tr>
					<td class="pagina2" width="50%">
						&nbsp;
					</td>
					<td class="date-box" width="50%">
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="50%">
			<table class="" width="100%" border="0" cellpadding="0" cellpadding="0">
				<thead>
					<tr>
						<th style="text-align: center;" width="100%">
							PLAZO DE ENTREGA
						</th>
					</tr>
				</thead>
			</table>

			<table width="100%" border="0" class="body" cellspacing="0" cellpadding="0">
				<tr>
					<td class="pagina2" width="32%">
						ENTREGA
					</td>
					<td class="date-box" width="22%">
						&nbsp;
					</td>
					<td class="pagina2" width="24%">
						MES/DIA
					</td>
					<td class="date-box">
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table class="" width="100%" border="0" cellpadding="0" cellpadding="0">
				<thead>
					<tr>
						<th style="text-align: center;" width="100%">
							LUGAR DE ENTREGA
						</th>
					</tr>
				</thead>
			</table>

			<table width="100%" border="0" class="body" cellspacing="0" cellpadding="0">
				<tr>
					<td class="date-box" width="100%">
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br><br>
<table class="body" width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<strong>1. DOCUMENTOS QUE SE DEBEN ADJUNTAR UNA VEZ ACEPTADA SU PROPUESTA</strong>
			<br>
			a. Registro Único Tributario - RUT.
			b. Certificacion Bancaria
			c. Cedula de Ciudadanina
			d. Certificación de declarante o no declarante
		</td>
	</tr>
	<tr>
		<td>
			<strong>2. CONDICIONES GENERALES DE OBLIGATORIO CUMPLIMIENTO</strong>
			<br>
			a. Si bien se describe una duración del servicio (plazo) y cantidades del bien a comprar, el plazo final a ejecutar y el valor total  final  de la orden de compra  es el que resulte de multiplicar las cantidades realmente compradas por el valor unitario relacionadas en el cuadro superior y recibidos a satisfaccion por el contratante; mas el impuesto a aplicar, si la compra se entrega por dias a partir del primer mes se pagara valor parcial.
		</td>
	</tr>
	<tr>
		<td>
			<strong>3. GARANTIAS DE LA PROPUESTA</strong>
			<br>
			a. No aplica
		</td>
	</tr>
	<tr>
		<td>
			<strong>4. ACTIVIDADES A DESARROLLAR</strong>
			<br>
			<br>
			<br>
		</td>
	</tr>
</table>