<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Descripcion del banco</label>
			<input type="text" class="form-control" maxlength="60" name="nombre_banco" id="nombre_banco">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\administracion\Banco::getNewCode() }}" name="codigo_banco" readonly="" class="form-control" id="codigo_banco">
		</div>
	</div>
</div>