<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	<div class="row">
		<div class="col-sm-8 col-lg-8 col-md-8">
			<h3 class="page-header">DATOS DEL VEHICULO</h3>
		</div>
	</div>
	<div class="row">
		
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">MARCA</label>
			<input type="text" maxlength="88" class="form-control" placeholder="MARCA DEL VEHICULO" name="marca" id="marca">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">MODELO DEL VEHICULO</label>
			<input type="text" placeholder="MODELO DEL VEHICULO" maxlength="39" class="form-control" name="modelo" id="modelo">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">PLACA DEL VEHICULO</label>
			<input type="text" maxlength="22" placeholder="PLACA DEL VEHICULO" style="text-align: center;" class="form-control" name="placa" id="placa">
		</div>

	</div>
	<div class="row">
		<div class="col-sm-5 col-lg-5 col-md-5">
			<label for="">TIPO DE VEHICULO</label>
			<select name="tipo_vehiculo" id="tipo_vehiculo" class="form-control">
				<option value="">-- SELECCIONE UNO --</option>
				<option value="CARGA">VEHICULO DE CARGA</option>
				<option value="PARTICULAR">VEHICULO DE USO PARTICULAR</option>
				<option value="T_PERSONAL">VEHICULO DE TRANSPORTE DE PERSONAL</option>
			</select>
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">FECHA DE ADQUISICION</label>
			<input type="date" placeholder="FORMATO DD-MM-AAAA"  class="form-control" name="fecha_adquisicion" id="fecha_adquisicion">
		</div>
	</div>
	
	<div class="row">
		<div class="col-sm-9">
			<h3 class="page-header">DATOS DE CAPACIDADES DEL VEHICULOS</h3>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">CAPACIDAD DE TANQUE (EN LITROS)</label>
			<input type="number" placeholder="CAPACIDAD MAXIMA EN LITROS DE COMBUSTIBLE" class="form-control" name="capacidad_tanque" id="capacidad_tanque">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">CAPACIDAD MAXIMA DE CARGA</label>
			<input type="number"  class="form-control" name="capacidad_carga" id="capacidad_carga">
		</div>
		<div class="col-sm-3 col-md-3 col-lg-3">
			<label for="">CANTIDAD DE ASIENTOS</label>
			<input type="number" class="form-control" name="cantidad_personas" id="capacidad_personas">
		</div>

	</div>
</div>