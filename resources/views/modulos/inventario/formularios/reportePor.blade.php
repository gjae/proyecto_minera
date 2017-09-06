<div class="container">
	<div class="row">
		<input type="hidden" name="material_id" id="material_reporte" value="{{ $id }}">
		<div class="col-sm-9 col-lg-8 col-md-8">
			<label for="">TIPO DE REPORTE</label>
			<select name="tipo" onchange="buscar_tipo(event, this)" id="tipo_reporte" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option value="datos_generales">DATOS DEL ARTICULO</option>
				<option value="actividad_en_fechas">ACTIVIDAD ENTRE FECHAS</option>

			</select>
		</div>

	</div>
</div>