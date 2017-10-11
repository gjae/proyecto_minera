<div class="container">
	{{ csrf_field() }}
	<div class="row">
		<input type="hidden" id="accion" value="editar" >
		<input type="hidden" name="unidad_id" value="{{ $id }}">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">NOMBRE</label>
			<input type="text" value="{{ \App\Models\inventario\UnidadMedida::find($id)->descripcion_unidad }}" class="form-control" name="descripcion_unidad" id="descripcion_unidad">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">CODIGO DE LA UNIDAD</label>
			<input type="text" value="{{ \App\Models\inventario\UnidadMedida::find($id)->codigo_unidad }}" class="form-control" name="codigo_unidad" id="codigo_unidad">
		</div>

	</div>

</div>