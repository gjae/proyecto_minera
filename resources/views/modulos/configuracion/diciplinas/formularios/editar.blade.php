<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="editar">
	<input type="hidden" name="diciplina_id" value="{{ $id }}">
	<div class="row">
		
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">NOMBRE DE LA DICIPLINA</label>
			<input type="text" value="{{ \App\Models\requisicion\Diciplina::find($id)->nombre_diciplina }}" maxlength="99" class="form-control" name="nombre_diciplina" id="nombre_diciplina">
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">CODIGO DE LA DICIPLINA</label>
			<input type="text" value="{{ \App\Models\requisicion\Diciplina::find($id)->codigo_diciplina }}" maxlength="8" class="form-control" name="codigo_diciplina" id="codigo_diciplina">
		</div>

	</div>

</div>