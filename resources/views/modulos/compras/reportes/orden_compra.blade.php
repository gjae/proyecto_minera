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
						<strong style="font-size: 12pt; font-family: Helvetica;">INVITACION A COTIZAR</strong>
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
<table border="1" cellspacing="0" cellpadding="0" align="center">
	
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
		<td></td>
	</tr>

</table>