<div class="container">
	@if (isset($desde_form))
		<input type="hidden" id="desde_form" name="desde_form" value="{{$desde_form}}">
	@endif
	<div class="row">
		<input type="hidden" name="material_id" id="material_reporte" value="{{ $id }}">
		<div class="col-sm-9 col-lg-8 col-md-8">
			<label for="">TIPO DE REPORTE</label>
			<select name="tipo" onchange="buscar_tipo(event, this)" id="tipo_reporte" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				@if(isset($ref))
					<option value="datos_generales">MOVIMIENTOS DEL MATERIAL</option>
					<option value="actividad_en_fechas">ACTIVIDAD ENTRE FECHAS</option>
					<option value="formatoNomina">FORMATO DE NOMINA</option>
				@else
					<option value="datos_generales">DATOS DEL ARTICULO</option>
					<option value="actividad_en_fechas">ACTIVIDAD ENTRE FECHAS</option>
					@if( App\Models\inventario\Material::find($id)->ficha != null)
						<option value="ficha">VER FICHA</option>
					@endif
				@endif
			</select>
		</div>

	</div>
	<div class="row hidden" id="rango_fechas">
		<div class="col-sm-4 col-lg-3 col-md-3">
			<label for="">FECHA DESDE (DD-MM-AAAA)</label>
			<input type="date" class="form-control" value="01-01-{{ Carbon\Carbon::now()->format('Y') }}" name="fecha_desde" id="fecha_desde">
		</div>
		<div class="col-sm-4 col-lg-3 col-md-3">
			<label for="">FECHA HASTA (DD-MM-AAAA)</label>
			<input type="date" class="form-control" value="01-01-{{ Carbon\Carbon::now()->format('Y') }}" name="fecha_hasta" id="fecha_hasta">
		</div>
		<div class="col-sm-4 col-lg-2 col-md-2">
			<label for="">Tipo</label>
			<select name="tipo_reporte_generar" id="tipo_reporte_generar" class="form-control">
				<option value="PDF">PDF</option>
				<option value="EXCEL">EXCEL</option>
			</select>
		</div>
	</div>
	<div class="row hidden" id="filtro_persona">
		<div class="col-sm-12 col-lg-8 col-md-8">
			<label for="">Filtrar por identificacion</label>
			<input type="text" name="cedula" id="identificacion" class="form-control">
		</div>
	</div>
</div>