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
						
						<strong style="font-size: 12pt; font-family: Helvetica;">REPORTE DE DATOS DE ANAQUEL POR ITEM<</strong>
						
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

<br>
<br>
<strong style="margin-left: 125px;">REPORTE DE RELACION DE INVENTARIO POR ITEM  </strong>
<br>

<strong style="margin-left: 125px;">
DESDE {{ Carbon\Carbon::parse($fecha_desde)->format('d-m-Y') }}  
HASTA {{ Carbon\Carbon::parse($fecha_hasta)->format('d-m-Y') }}
</strong>

<br>
<strong style="margin-left: 125px;">CODIGO  {{ $material->codigo_material }}</strong>
<br>
<strong style="margin-left: 125px;">DESCRIPCION {{ $material->nombre_material }}</strong>
<br>
<br>

<table border="0" width="100%" style="text-align: center;" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr>
			<th>
			
			Fecha de creacion
			
			</th>
			<th>
				
				Unidad de medida
				
			</th>
			<th>
			
			Cantidad disponible
			
			</th>
			<th>
			
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
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr style="text-align: center;">
			<th>
			
			Fecha de ingreso
			
			</th>
			<th>
				
				Cantidad
				
			</th>
			<th>
				Monto
			</th>
			<th>
			
			Disciplina
			
			</th>
			<th>
			
			Centro de costos
			</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
	 	@foreach($material->ingresos()->where('created_at', '>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )->where('created_at', '<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )->get()  as $key => $ingreso)
		<tr style="text-align: center;">
			<td>
				{{ $ingreso->created_at->format('d-m-Y h:i A') }}
			</td>
			<td>
				{{ $ingreso->cantidad }}
			</td>
			<td>
				<strong>{{ number_format($ingreso->monto, 2) }}</strong>
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
				<strong>PROMEDIO </strong>
			</td class="footer-table">
			<td>
				&nbsp;
			</td>
			<td class="footer-table">
				<strong>{{ 
					$material->ingresos()
								->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
								->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
								->avg('monto') 
				}}</strong>
			</td>
			
		</tr>
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
				<strong>TOTAL DE INGRESOS</strong>
			</td >
			<td class="footer-table">
				<strong>{{ 
					$material->ingresos()
								->where('created_at','>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )
								->where('created_at','<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )
								->sum('cantidad') 
				}}</strong>
			</td>
			
		</tr>
	</tbody>
</table>

<br>
<strong style="margin-left: 240px; ">RELACION DE EGRESOS</strong>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="body">
	<thead>
		<tr style="text-align: center;">
			<th>
			
			Fecha de ingreso
			
			</th>
			<th>
				
				Cantidad
				
			</th>
			<th>
			
			Disciplina
			
			</th>
			<th>
			
			Centro de costos
			
			</th>
			<th>
				
				Entregado A 
			</th>
		</tr>
	</thead>
	<tbody style="text-align: center;">
	 	@foreach($material->egresos()->where('created_at', '>=', Carbon\Carbon::parse($fecha_desde)->format('Y-m-d') )->where('created_at', '<=', Carbon\Carbon::parse($fecha_hasta)->format('Y-m-d') )->get()  as $key => $egreso)
		<tr style="text-align: center;">
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
				@if($egreso->persona_id != 0)
				{{ $egreso->persona->primer_nombre.' '.$egreso->persona->primer_apellido }}
				@else
				<strong>NO APLICA</strong>
				@endif
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