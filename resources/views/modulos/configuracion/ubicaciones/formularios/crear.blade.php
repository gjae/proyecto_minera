<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Nombre de la ubicacion</label>
			<input type="text" class="form-control" maxlength="60" name="nombre_ubicacion" id="nombre_ubicacion">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\Ubicacion::getNewCode() }}" name="codigo" readonly="" class="form-control" id="codigo">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			<label for="">Direccion de la ubicacion</label>
			<input type="text" maxlength="255" class="form-control" name="direccion_ubicacion" id="direccion_ubicacion">
		</div>
	</div>
</div>