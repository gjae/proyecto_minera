<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	
	<div class="row">
		
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">NOMBRE DEL CENTRO</label>
			<input type="text" maxlength="99" class="form-control" name="nombre_centro" id="nombre_centro">
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">CODIGO DEL CENTRO</label>
			<input type="text" maxlength="8" class="form-control" name="codigo_centro" id="codigo_centro">
		</div>

	</div>

</div>