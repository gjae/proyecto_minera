<div class="container">
	
	<div class="row">
		<input type="hidden" name="viaje_id" value="{{ $id }}">
		<div class="col-sm-9 col-lg-9 col-md-9">
			<label for="">TIPO DE REPORTE</label>
			<select name="tipo_reporte" id="tipo_reporte" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option value="viajes">CONTROL DE VIAJES</option>
				<option value="control_combustible">CONTROL DE COMBUSTIBLE</option>
			</select>
		</div>

	</div>
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			<h3 class="page-header">RANGO DE FECHAS</h3>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">FECHA DESDE</label>
			<input type="date" name="fecha_desde" id="fecha_desde" class="form-control">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">FECHA HASTA</label>
			<input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-md-9-col-lg-9">
			<h3 class="page-header">FILTROS POR PERSONA</h3>
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">IDENTIFICAICON DEL CONDUCTOR</label>
			<input type="text" value="--" name="identificacion" class="form-control">
		</div>
	</div>
</div>