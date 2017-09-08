<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="editar">
	<input type="hidden" name="cargo_id" id="cargo_id" value="{{ \App\Models\personal\Cargo::find($cargo_id)->id }}">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Descripcion del cargo</label>
			<input type="text" class="form-control" value="{{ \App\Models\personal\Cargo::find($cargo_id)->descripcion_cargo }}" maxlength="60" name="descripcion_cargo" id="descripcion_cargo">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\personal\Cargo::find($cargo_id)->codigo_cargo }}" name="codigo_cargo" readonly="" class="form-control" id="codigo_cargo">
		</div>
	</div>
</div>