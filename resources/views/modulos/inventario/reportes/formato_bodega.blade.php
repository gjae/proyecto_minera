<style>
	body{
		font-family: Helvetica;
	}
	thead{
		border: 1px solid black;
	}
	thead th{
		border: 1px solid black;
		height: 52px;
		width: 32px;
	}
	table.body{
		border: 1px solid black;
	}
	body.cuerto tr{
		border: 1px solid black;
	}

</style>
<img src="{{ public_path().'/images/logo.png' }}" alt="" style="max-width: 310px; max-height: 210px;">
<table border="0" cellpadding="0" cellspacing="0" class="body" style="text-align: center;">

<thead >
	<tr bgcolor="#92D050">
		<th>
			FECHA
		</th>
		<th>CODIGO</th>
		<th>DESCRIPCION</th>
		<th>UNIDAD</th>
		<th>ENTRADA</th>
		<th>SALIDA</th>
		<th>ENTREGADO A</th>
		<th>CENTRO COSTO</th>
		<th>ET. PRODUCCION</th>
		<th>DICIPLINA</th>
	</tr>
</thead>
<body >

@foreach($materiales as $material)

@foreach($material->egresos as $egreso)

<tr>
	<td>{{ $egreso->created_at->format('d-M-Y') }}</td>
	<td>{{ $egreso->material->codigo_material }}</td>
	<td> {{ $egreso->material->nombre_material }} </td>
	<td> {{ $egreso->material->unidad_medida->codigo_unidad }} </td>
	<td>&nbsp;</td>
	<td> {{ $egreso->cantidad_salida }} </td>
	<td> 
		{{ $egreso->persona->primer_nombre }}
	</td>
	<td>
		{{ $egreso->centro_costo->nombre_centro }}
	</td>
	<td>
		{{ $egreso->etapa_produccion->nombre_etapa }}
	</td>
	<td>
		{{ $egreso->diciplina->nombre_diciplina }}
	</td>
</tr>

@endforeach

@foreach($material->ingresos as $ingreso)

<tr>
	<td>
		{{ $ingreso->created_at->format('d-M-Y') }}
	</td>
	<td>
		{{ $ingreso->material->codigo_material }}
	</td>
	<td>
		{{ $ingreso->material->nombre_material }}
	</td>
	<td>
		{{ $ingreso->material->unidad_medida->codigo_unidad }}
	</td>
	<td>
		{{ $ingreso->cantidad }}
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>{{ $ingreso->centro_costo->nombre_centro }}</td>
	<td>{{ $ingreso->etapa_produccion->nombre_etapa }}</td>
	<td>a</td>
</tr>
@endforeach


@endforeach
</body>

</table>