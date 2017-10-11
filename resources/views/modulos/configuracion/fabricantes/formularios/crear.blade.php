<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Nombre del fabricante</label>
			<input type="text" class="form-control" maxlength="60" name="nombre_fabricante" id="nombre_ubicacion">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\Fabricante::getNewCode() }}" name="codigo_fabricante" readonly="" class="form-control" id="codigo">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">TELEFONO</label>
			<input type="text" maxlength="22" class="form-control" name="telefono" id="telefono">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">PAIS</label>
			<select required name="pais_id" id="pais_id" class="form-control">
				@foreach(\App\Models\Pais::all() as $key => $pais)
					<option value="{{ $pais->id }}">{{ $pais->nombre_pais }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>