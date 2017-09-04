<div class="container">
	<input type="hidden" name="accion" id="accion" value="guardarAjuste">
	{{ csrf_field() }}
	<div class="row">
		
		<div class="col-sm-5 col-lg-5 col-md-5">
			<label for="">Nombre del ajuste</label>
			<input type="text" maxlength="90" placeholder="Nombre del nuevo ajuste" class="form-control" name="nombre_ajuste" id="nombre_ajuste">
		</div>
		<div class="col-sm-3 col-lg-3 col-md-3">
			<label for="">Codigo del ajuste</label>
			<input type="text" style="text-align: center;" class="form-control" name="codigo_ajuste" id="codigo_ajuste" value="{{ $codigo }}"> 
		</div>

	</div>
	<div class="row">
		
		<div class="col-sm-4 col-md-2 col-lg-2">
			<label for="">Porcentaje</label>
			<input class="form-control" type="number" name="porcentaje_ajuste" id="porcentaje_ajuste" maxlength="3" value="0" required>
		</div>
		<div class="col-sm-4 col-md-2 col-lg-2">
			<label for="">Cantidad</label>
			<input class="form-control" type="number" name="cantidad_ajuste" id="cantidad_ajuste" maxlength="3" value="0" required>
		</div>
		<div class="col-sm-3 col-lg-2 col-md-2">
			<label for="">Fecha de inicio</label>
			<input type="date" name="fecha_activdad_desde" value="1900-01-01" id="fecha_activdad_desde" class="form-control">
		</div>
		<div class="col-sm-3 col-lg-2 col-md-2">
			<label for="">Fecha de inicio</label>
			<input type="date" name="fecha_activdad_hasta" value="1900-01-01" id="fecha_activdad_hasta" class="form-control">
		</div>

	</div>
	<div class="row">
		<div class="col-sm-5 col-lg-4 col-md-4">
			<label for="">Tipo de ajuste</label>
			<select name="tipo_ajuste" id="tipo_ajuste" class="form-control">
				<option value="">Seleccione uno</option>
				<option value="BONO">BONO</option>
				<option value="DEDDUCCION">DEDDUCCION</option>
			</select>
		</div>

		<div class="col-sm-5 col-lg-4 col-md-4">
			<label for="">Aportador</label>
			<select name="aportador" id="aportador" class="form-control">
				<option value="">Seleccione uno</option>
				<option value="PERSONA">PERSONA</option>
				<option value="PATRON">PATRON</option>
			</select>
		</div>

	</div>

	<div class="row">
		<div class="col-sm-5 col-lg-4 col-md-4">
			<label for="">Ajuste permanente</label>
			<select name="ajuste_permanente" id="ajuste_permanente" class="form-control">
				<option value="">Seleccione uno</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</div>

		<div class="col-sm-5 col-lg-4 col-md-4">
			<label for="">Ajueste global</label>
			<select name="ajuste_global" id="ajuste_global" class="form-control">
				<option value="">Seleccione uno</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</div>

	</div>

</div>