<div class="container">
{{ csrf_field() }}
	<input type="hidden" name="accion" id="accion" value="guardarUnidadMedida">
	<input type="hidden" name="_archivo" id="_archivo" value="medidas">
	<div class="row clearfix">
		<div class="col-sm-10 col-md-3 col-lg-3">
			<label for="">Abreviatura de la unudad de medida</label>
			<input type="text" value="" placeholder="Agrega un codigo a la unidad" class="form-control" id="codigo_unidad" name="codigo_unidad">
		</div>
		<div class="col-sm-10 col-md-5 col-lg-5">
			<label for="">Descripcion de la unidad de medida</label>
			<input type="text" value="" placeholder="Descripcion de la unidad" class="form-control" id="descripcion_unidad" name="descripcion_unidad">
		</div>
	</div>

</div>