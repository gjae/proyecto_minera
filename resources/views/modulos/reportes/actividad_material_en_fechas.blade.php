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
						<strong style="font-size: 10pt; font-family: Helvetica;">{{ Carbon\Carbon::now()->format('d-m-Y') }}</strong>
						&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<br>
<br>
<strong style="margin-left: 125px;">REPORTE DE RELACION DE INVENTARIO POR ITEM  </strong>
<br>

<strong style="margin-left: 125px;">
DESDE {{ Carbon\Carbon::parse($fecha_desde)->format('d-m-Y') }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
HASTA {{ Carbon\Carbon::parse($fecha_hasta)->format('d-m-Y') }}
</strong>

<br>
<strong style="margin-left: 125px;">CODIGO &nbsp;&nbsp;&nbsp;&nbsp; {{ $material->codigo_material }}</strong>
<br>
<strong style="margin-left: 125px;">DESCRIPCION &nbsp;&nbsp;&nbsp;&nbsp;{{ $material->nombre_material }}</strong>
<br>
<br>

<table border="0" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr>
			<th>
			&nbsp;&nbsp;
			Fecha de creacion
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;
				Unidad de medida
				&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;
			Cantidad disponible
			&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;
			Cantidad minima
			</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
		<tr>
			<td>
				{{ $material->created_at->format('d-m-Y h:i A') }}
			</td>
			<td>
				{{ $material->unidad_medida->codigo_unidad }}
			</td>
			<td>
				{{ 
					$material->ingresos()
								->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
								->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
								->sum('cantidad')  - 
					$material->egresos()
								->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
								->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
								->sum('cantidad_salida') 

				}}
			</td>
			<td>
				
				{{ $material->existencia_minima }}

			</td>
			
		</tr>
	</tbody>
</table>

<br>
<strong style="margin-left: 240px; ">RELACION DE INGRESOS</strong>
<br>
<table border="0" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr>
			<th>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Fecha de ingreso
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Cantidad
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Diciplina
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Centro de costos
			</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
	 	@foreach($material->ingresos()->where('created_at', '>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )->where('created_at', '<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )->get()  as $key => $ingreso)
		<tr>
			<td>
				{{ $ingreso->created_at->format('d-m-Y h:i A') }}
			</td>
			<td>
				{{ $ingreso->cantidad }}
			</td>
			<td>
				{{ $ingreso->diciplina->nombre_diciplina }}
			</td>
			<td>
				
				{{ $ingreso->centro_costo->nombre_centro }}

			</td>
			
		</tr>
		@endforeach
		<tr>
			<td class="footer-table">
				&nbsp;
			</td>
			<td class="footer-table">
				&nbsp;
			</td>
			<td class="footer-table">
				<strong>TOTAL DE EGRESOS</strong>
			</td >
			<td class="footer-table">
				{{ 
					$material->ingresos()
								->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
								->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
								->sum('cantidad') 
				}}
			</td>
			
		</tr>
	</tbody>
</table>

<br>
<strong style="margin-left: 240px; ">RELACION DE EGRESOS</strong>
<br>
<table border="0" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr>
			<th>
			&nbsp;&nbsp;&nbsp;
			Fecha de ingreso
			&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;&nbsp;
				Cantidad
				&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;
			Diciplina
			&nbsp;&nbsp;
			</th>
			<th>
			&nbsp;&nbsp;&nbsp;
			Centro de costos
			&nbsp;&nbsp;&nbsp;
			</th>
			<th>
				&nbsp;
				Entregado A 
			</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
	 	@foreach($material->egresos()->where('created_at', '>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )->where('created_at', '<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )->get()  as $key => $egreso)
		<tr>
			<td>
				{{ $egreso->created_at->format('d-m-Y h:i A') }}
			</td>
			<td>
				{{ $egreso->cantidad_salida }}
			</td>
			<td>
				{{ $egreso->diciplina->nombre_diciplina }}
			</td>
			<td>
				
				{{ $egreso->centro_costo->nombre_centro }}

			</td>
			<td>
				{{ $egreso->persona->primer_nombre.' '.$egreso->persona->primer_apellido }}
			</td>
			
		</tr>
		@endforeach
		<tr>
			<td class="footer-table">
				&nbsp;
			</td>
			<td class="footer-table">
				&nbsp;
			</td>
			<td class="footer-table">
				&nbsp;
			</td>
			<td class="footer-table">
				<strong>TOTAL DE EGRESOS</strong>
			</td >
			<td class="footer-table">
				{{ 
					$material->egresos()
					->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
					->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
					->sum('cantidad_salida') 
				}}
			</td>
			
		</tr>
	</tbody>
</table>