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
	td.contenido{ border: 1px solid #000; text-align: center;  }
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
						<strong style="font-size: 12pt; font-family: Helvetica;">SOCIEDAD MINERA DEL NORTE LTDA</strong>
						<br>

					</td>
				</tr>
				<tr align="center">
					<td class="td-title">
						<strong style="font-size: 12pt; font-family: Helvetica;">PROCESO DE MANTENIMIENTO DE EQUIPOS</strong>
					</td>
				</tr>
				<tr align="center">
					<td class="td-title">
						<strong style="font-size: 12pt; font-family: Helvetica;">FORMATO DE HOJA DE VIDA DE EQUIPOS</strong>
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" width="100%" cellpadding="0">
				<tr style="outline: thin solid;" >
					<td >
					&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;">{{ Carbon\Carbon::now()->format('d-M-Y') }}</strong>
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<table style="text-align: center;" width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<strong>VIGENTE DESDE: 24-11-2017</strong>
		</td>
		<td>
			<strong>VERSION: 01</strong>
		</td>
		<td>
			<strong>AÑO DE FABRICACION: {{ $material->ficha->anio_fabricacion }}</strong>
		</td>
	</tr>
</table>
<br>
<img src="data:image/png;base64,{{$codigo}}" />
<br>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="15%">
			<strong>SERVICIO: </strong>
		</td>
		<td class="contenido" width="32%">
			<strong>
				{{ $material->ficha->servicio }}
			</strong>
		</td>
		<td width="17%" style="text-align: right;">
			<strong>UBICACION: </strong>
		</td>
		<td class="contenido" width="32%">
			<strong>{{ $material->ficha->ubicacion->nombre_ubicacion }}</strong>
		</td>
	</tr>
</table>
<br>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
	<tr>
		<td width="32%">
			<strong>NOMBRE DEL EQUIPO</strong>
		</td>
		<td class="contenido" width="68%">
			<strong>{{ $material->nombre_material }}</strong>;
		</td>
	</tr>
</table>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="15%">
			<strong>MARCA </strong>
		</td>
		<td class="contenido" width="22%">
			<strong>
				{{ $material->ficha->marca }}
			</strong>
		</td>
		<td width="17%" style="text-align: right;">
			<strong>MODELO: </strong>
		</td>
		<td class="contenido" width="23%">
			<strong>{{ $material->ficha->modelo }}</strong>
		</td>
		<td width="12%" style="text-align: right;">
			<strong>SERIE: </strong>
		</td>
		<td class="contenido"  width="22%">
			<strong>{{ $material->ficha->serie }}</strong>
		</td>
	</tr>
</table>
<br><br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td width="17%">
			<strong>FABRICANTE: </strong>
		</td>
		<td class="contenido">
			<strong>{{ $material->ficha->fabricante->nombre_fabricante }}</strong>
		</td>
		<td width="17%">
			<strong>PAIS: </strong>
		</td>
		<td width="17%"  class="contenido">
			<strong>{{ $material->ficha->fabricante->pais->nombre_pais }}</strong>
		</td>
		<td width="17%" >
			<strong>TELEFONO: </strong>
		</td>
		<td width="17%" class="contenido">
			<strong>{{$material->ficha->fabricante->telefono}}</strong>
		</td>
	</tr>
	<tr>
		<td width="17%">
			<strong>DISTRIBUIDOR: </strong>
		</td>
		<td class="contenido">
			<strong>{{ $material->ficha->distribuidor->nombre_distribuidor }}</strong>
		</td>
		<td width="17%">
			<strong>CIUDAD: </strong>
		</td>
		<td width="17%"  class="contenido">
			<strong>{{ $material->ficha->distribuidor->ciudad->nombre_ciudad }}</strong>
		</td>
		<td width="17%" >
			<strong>TELEFONO: </strong>
		</td>
		<td width="17%" class="contenido">
			<strong>{{$material->ficha->distribuidor->telefono}}</strong>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td width="13%">
			<strong>REPRESENTANTE: </strong>
		</td>
		<td width="13%" class="contenido">
			<strong>{{ $material->ficha->representante }}</strong>
		</td>
		<td width="13%">
			<strong>CIUDAD: </strong>
		</td>
		<td width="13%"  class="contenido">
			<strong>{{ \App\Models\Ciudad::find($material->ficha->ciudad_representante)->nombre_ciudad }}</strong>
		</td>
		<td width="13%" >
			<strong>TELEFONO: </strong>
		</td>
		<td width="13%" class="contenido">
			<strong>{{$material->ficha->telefono_representante}}</strong>
		</td>
		<td width="13%">
			<strong>CEDULA</strong>
		</td>
		<td width="13%" class="contenido">
			<strong>{{ $material->ficha->cedula_representante }}</strong>
		</td>
	</tr>
	
</table>
<table border="1" style="text-align: center;" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<strong>MANERA DE ADQUISICION: </strong>
		</td>
		<td>
			<strong>{{ $material->ficha->tipo_adquisicion }}</strong>
		</td>
	</tr>
</table>
<table border="1" style="text-align: center;" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td width="5%">
			<strong>COMPRA</strong>
		</td>
		<td>
			<strong>{{ $material->ficha->fecha_compra->format('d-m-Y') }}</strong>
		</td>
		<td>
			<strong>INSTALACION</strong>
		</td>
		<td>
			<strong>{{ $material->ficha->fecha_instalacion->format('d-m-Y') }}</strong>
		</td>
		<td>
			<strong>INICIO DE OPERACIONES</strong>
		</td>
		<td>
			<strong>{{ $material->ficha->fecha_inicio_operaciones->format('d-m-Y') }}</strong>
		</td>
	</tr>
</table>
<table border="0" style="text-align: center;" width="100%" class="body" cellpadding="0" cellspacing="0">
	
	<thead>
		<tr>
			<th>
				DATOS DE FUNCIONAMIENTO
			</th>
			<th>
				DATOS DE USO Y CALIFICACION
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>TIPO DE MANTENIMIENTO: <span>{{ $material->ficha->tipo_mantenimiento }}</span></strong> 
				<br>
				<strong>FUENTE DE ENERGIA: <span>{{ $material->ficha->fuente_energia }}</span></strong>
				<br>
				<strong>MANTENIMIENTO: <span>{{ $material->ficha->mantenimiento }}</span></strong>
			</td>
			<td>
				<strong>TIPO DE USO: <span>{{ $material->ficha->tipo_uso }}</span> </strong>
				<br>
				<strong>TIPO DE EQUIPO: <span>{{ $material->ficha->equipo }}</span></strong>
				<br>
				<strong>CALIFICACION BIOMEDICA:  <span>{{ $material->ficha->calif_biomedica }}</span></strong>
				<br>
				<strong>TECNOLOGIA USADA: <span>{{ $material->ficha->tecn_predeterminada }}</span></strong>
				<br>
				<strong>NIVEL DE RIESGO: <span>{{ $material->ficha->tipo_riesgo }}</span></strong>
			</td>
		</tr>
	</tbody>

</table>

<table border="0" style="text-align: center;" width="100%" class="body" cellpadding="0" cellspacing="0">
	
	<thead>
		<tr>
			<th width="20%">
				CARACTERISTICAS
			</th>
			<th>
				DATOS DE USO Y CALIFICACION
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<strong>VOLTAJE</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->voltaje, 2) }}</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>AMPERAJE</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->amperaje, 2) }}</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>POTENCIA</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->potencia, 2) }}</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>FRECUENCIA</strong>
			</td>
			<td>
				<strong>{{ $material->ficha->frecuencia }}</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>PRESION</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->presion, 2) }} PSI</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>VEL</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->vel, 2) }} RPM </strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>TEMPERATURA</strong>
			</td>
			<td>
				<strong>{{ number_format($material->ficha->temperatura, 2) }} °C</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>PESO</strong>
			</td>
			<td>
				<strong>
					{{ number_format($material->ficha->peso, 2) }}  KG
				</strong>
			</td>
		</tr>
		<tr>
			<td>
				<strong>VIDA UTIL</strong>
			</td>
			<td>
				<strong>{{ $material->ficha->vida_util }} MESES</strong>
			</td>
		</tr>
	</tbody>

</table>
<h2>MANUALES</h2>
<strong>
MANUAL DE USUARIO: <span>{{ $material->ficha->manuales_usuario }}</span> / <br>
MANUAL DE COMPONENTES: <span>{{ $material->ficha->manuales_componentes }}</span> / <br>
MANUAL DE SERVICIO: <span>{{ $material->ficha->manuales_servicio }}</span> / <br>
MANUAL DESPECIE: <span>{{ $material->ficha->manuales_despiece }}</span>
</strong>