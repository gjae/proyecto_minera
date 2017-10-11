<div class="container">
	<div class="row">
		{{ csrf_field() }}
		<input type="hidden" id="accion" value="guardar">
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">NOMBRE DEL TIPO</label>
			<input type="text" maxlength="60" class="form-control" name="descripcion_tipo" id="descripcion_tipo">
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">CODIGO</label>
			<input type="text" maxlength="5" class="form-control" name="codigo_tipo" id="codigo_tipo">
		</div>

	</div>
</div>