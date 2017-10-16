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
	td.td-title{ border-bottom: 1px solid black; }
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
<div class="header">
<table border="1" cellpadding="0" cellspacing="0">
	<tr>
		<td>
			<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 150px; max-height: 210px;">
		</td>
		<td >
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td class="td-title">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">SOCIEDAD MINERA DEL NORTE LTDA.</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<br>

					</td>
				</tr>
				<tr>
					<td>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE DATOS DE ANAQUEL POR ITEM</strong>
						&nbsp;&nbsp;&nbsp;&nbsp;
					</td>
				</tr>
			</table>
		</td>
		<td>
			<table border="0" cellspacing="0" cellpadding="0">

				<tr>
					<td class="td-title">
						&nbsp;
						<strong style="font-size: 10pt; font-family: Helvetica;"> </strong>
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

<br>
<br>
<h1 class="page-header" style="text-align: center;">{{ $material->nombre_material }}</h1>

<table width="100%" class="body" border="0" cellspacing="0" cellpadding="0" style="text-align: center; align-content: center;">
	<thead>
		<tr>
			<th>
				FECHA DE INGRSO
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;
				UNIDAD DE MEDIDA
				&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;&nbsp;
				TIPO
				&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
				{{ $material->fecha_ingreso_material->format('d / m / Y') }}
			</td>
			<td>
				{{ $material->unidad_medida->codigo_unidad }}
			</td>
			<td>
				{{ $material->tipo->descripcion_tipo }}
			</td>
		</tr>
	</tbody>
</table>
<table border="1" style="text-align: center;" cellspacing="0" cellpadding="0" class="boddy" width="100%">
	<tr>
		<th style="padding: 29px 29px 29px 29px;">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<img src="data:image/png;base64,{{$codigo}}" alt="">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</th>
	</tr>
</table>