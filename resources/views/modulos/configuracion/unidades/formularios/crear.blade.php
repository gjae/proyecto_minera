<div class="container">
	{{ csrf_field() }}
	<div class="row">
		<input type="hidden" id="accion" value="guardar" >
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">NOMBRE</label>
			<input type="text" class="form-control" name="descripcion_unidad" id="descripcion_unidad">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">CODIGO DE LA UNIDAD</label>
			<input type="text" class="form-control" name="codigo_unidad" id="codigo_unidad">
		</div>

	</div>

</div>