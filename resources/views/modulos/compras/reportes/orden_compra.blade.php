<style>
	.page_break { page-break-before: always; }
	body{ font-family: Helvetica;  }
</style>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td >
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">COMPRAS Y CONTRATACION</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<br>

					</td>
				</tr>
				<tr>
					<td>
						------------------------------------------------------------------------
					</td>
				</tr>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">ORDEN DE {{ $orden->tipo_orden }}</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr style="outline: thin solid;">
					<td> &nbsp; </td>
				</tr>
				<tr>
					<td>
						<strong style="font-size: 10pt; font-family: Helvetica;">Paginas: 1 de 2</strong>
					</td>
				</tr>
				<tr>
					<td>-------------------------------</td>
				</tr>
				<tr style="outline: thin solid;">
					<td>
						<strong style="font-size: 10pt; font-family: Helvetica;">Fecha: </strong>
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
							CONSECUTIVO
						</strong>
					</td>
					<td>
						&nbsp;&nbsp;&nbsp;
						<strong style="font-family: Helvetica;">
							{{ substr($orden->tipo_orden, 0, 2).'-'.$orden->codigo_orden }}
						</strong>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0">
	
	<tr>
		<td> &nbsp; </td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DIA 
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			 MES 
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
			AÑO 
		</td>
	</tr>

</table>
<table border="1" cellpadding="0" cellspacing="0" >
	<tr style="height: 13px;">
		<td>
			 &nbsp; &nbsp;
			<strong>FECHA</strong>
			 &nbsp; &nbsp;
		</td>
		<td bgcolor="#F2F2F2">
			 &nbsp; &nbsp;
			<strong> 00 </strong>
			 &nbsp; &nbsp;
		</td>
		<td bgcolor="#F2F2F2">
			 &nbsp; &nbsp;
			<strong> 00 </strong>
			 &nbsp; &nbsp;
		</td>
		<td bgcolor="#F2F2F2">
			 &nbsp; &nbsp;
			<strong> AAAA </strong>
			 &nbsp; &nbsp;
		</td>
		<td>
			<strong>PROYECTO</strong>
		</td>
		<td>
			SOCIEDAD MINERA DEL NORTE
		</td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="0" style="text-align: center;">
	
	<tr>
		<td>
			&nbsp; &nbsp;
			<strong>REQUISICION NO.</strong>
			&nbsp; &nbsp;
		</td>
		<td bgcolor="#F2F2F2">
			&nbsp; &nbsp;
			<strong>
				{{ $analisis[0]->cotizacion->solicitud->requisicion->codigo_requisicion }}
			</strong>
			&nbsp; &nbsp;
		</td>
		<td>
			<strong>CENTRO DE COSTOS</strong>
		</td>
		<td>
			<strong>
			{{ $analisis[0]->cotizacion->solicitud->requisicion->centro_costo->nombre_centro }}
			</strong>
		</td>
	</tr>
</table>
<table border="1" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<strong>ETAPA DE EXPLOTACION</strong>
		</td>
		<td bgcolor="#F2F2F2">
			<strong>
			{{ $analisis[0]->cotizacion->solicitud->requisicion->etapa_produccion->nombre_etapa }}
			</strong>
		</td>
		<td>
			&nbsp; &nbsp;
			<strong>DICIPLINA</strong>
			&nbsp; &nbsp;
		</td>
		<td bgcolor="#F2F2F2">
		&nbsp; &nbsp;
			<strong>
			{{ $analisis[0]->cotizacion->solicitud->requisicion->diciplina->nombre_diciplina }}
			</strong>
			&nbsp; &nbsp;
		</td>
	</tr>
</table>

<strong>1. INFORMACION DEL CONTRATANTE</strong>
<table border="1" cellpadding="0" cellspacing="0" style="text-align: center;">

	<tr>
		<td>
			&nbsp; &nbsp;
			<br>
			<strong>NOMBRE</strong>
			&nbsp; &nbsp;
			<br>
		</td>	
		<td bgcolor="#F2F2F2">	
			&nbsp; &nbsp;
			<br>
			<strong>
				{{ $orden->contte_nombre }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			&nbsp; &nbsp;
			<br>
			<strong>
				RESPONSABLE
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>
				{{ $orden->contte_resp }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>
				NIT / CC
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>
				{{ $orden->contte_nit_cc }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CC</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_resp_cc }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>DIR</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>-</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CARGO</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_resp_cargo }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>TEL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_telefono }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>MAIL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			<strong>{{ $orden->contte_resp_email }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>MAIL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>-</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>TEL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_rep_telf}}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>REP / LEGAL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_rep_legal }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
		</td>
	</tr>

	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CC</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contte_cc }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
		</td>
	</tr>
</table>
<br>
<strong>2. INFORMACION DEL CONTRATISTA</strong>
<table border="1" cellpadding="0" cellspacing="0" style="text-align: center;">

	<tr>
		<td>
			&nbsp; &nbsp;
			<br>
			<strong>NOMBRE</strong>
			&nbsp; &nbsp;
			<br>
		</td>	
		<td bgcolor="#F2F2F2">	
			&nbsp; &nbsp;
			<br>
			<strong>
				{{ $orden->proveedor->razon_social }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			&nbsp; &nbsp;
			<br>
			<strong>
				RESPONSABLE
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>
				{{ $orden->contta_resp }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>
				NIT / CC
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>
				{{ $orden->contta_nit_cc }}
			</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CC</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contta_resp_cc }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>DIR</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			<strong>{{ $orden->contta_dir }}</strong>
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CARGO</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contta_resp_cargo }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>TEL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->proveedor->telefono }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>MAIL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			<strong>{{ $orden->contta_resp_email }}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>MAIL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->proveedor->email }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>TEL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contta_rep_telf}}</strong>
		</td>
	</tr>
	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>REP / LEGAL</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->contta_resp_legal }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
		</td>
	</tr>

	<tr>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>CC</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td bgcolor="#F2F2F2">
			<br>
			&nbsp; &nbsp;
			<strong>{{ $orden->proveedor->nro_identificacion }}</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
			&nbsp; &nbsp;
			<br>
		</td>
		<td>
			<br>
			&nbsp; &nbsp;
			<strong>&nbsp;</strong>
		</td>
	</tr>
</table>

<strong>3. OBJETOS Y CONSIDERACIONES</strong>
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			&nbsp; &nbsp;&nbsp; &nbsp;
			<br>
			<strong>{{ $orden->concepto }}</strong>
			<br>
			&nbsp; &nbsp;&nbsp; &nbsp;
		</td>
	</tr>
</table>
<div class="page_break"></div>

<table border="1" cellpadding="0" cellspacing="0" style="text-align: center;">  
	<thead>
		<tr>
			<th>
				&nbsp;&nbsp;&nbsp;
				ID
				&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				DESCRIPCION
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;
				UND
				&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;
				CANT
				&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;
				VR / UNIT
				&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;
			VR/ TOTAL
			&nbsp;&nbsp;
			</th>
		</tr>
	</thead>
	<tbody>
        @foreach($analisis as $key => $detalle)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>
                    {{ $detalle->cotizacion->material->nombre_material }}
                </td>
                 <td>
                    {{ $detalle->cotizacion->material->unidad_medida->codigo_unidad }}
                 </td>
                 <td>
                    {{ $detalle->cotizacion->cantidad }}
                 </td>
                 <td>
                    {{ $detalle->cotizacion->cotizacion }}
                 </td>
                 <td>
                    {{ $detalle->cotizacion->cotizacion * $detalle->cotizacion->cantidad}}
                 </td>
            </tr>
          @endforeach
	</tbody>
</table>
<table border="1" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			SUBTOTAL ANTES DEL DESCUENTO
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->total_sin_descuento, 2) }}
			&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			DESCUENTO
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->descuento, 2) }}
			&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			SUBTOTAL
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->subtotal, 2) }}
			&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			IVA
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->total_iva, 2) }}
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			RETEFUENTE
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->retefuente, 2) }}
			&nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			TOTAL A PAGAR
		</td>
		<td>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			{{ number_format($orden->total, 2) }}
			&nbsp;&nbsp;&nbsp;
		</td>
	</tr>



</table>

<br>
<strong>
5. 
</strong>
<strong>FORMA DE PAGO</strong> CONTADO [ {{ ($analisis[0]->cotizacion->forma_pago == 'CONTADO') ? 'X' : '&nbsp;' }} ] CREDITO [{{ ($analisis[0]->cotizacion->forma_pago == 'CREDITO') ? 'X' : '&nbsp;' }}]
<br>
<strong>PLAZO EN DIAS CALENDARIO PARA PAGO DE FACTURA RADICADA:</strong> {{ $orden->tiempo_pago }} Dias
<br>
<strong>FACTURACION: </strong> MES VENCIDO [ {{ ($orden->mes_anticipo == 'M' || $orden->mes_anticipo == 'N') ? 'X' : '&nbsp;' }} ] MES ANTICIPO [{{ ($orden->mes_anticipo == 'S' ) ? 'X' : '&nbsp;' }}]
<br>
<strong>CUENTA A CONSIGNAR: </strong> {{ $orden->proveedor->cuenta_bancaria }} 
<strong>BANCO: </strong> {{ $orden->proveedor->banco->nombre_banco }} 
