<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardar">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Nombre del distribuidor</label>
			<input type="text" class="form-control" maxlength="60" name="nombre_distribuidor" id="nombre_ubicacion">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ \App\Models\Distribuidor::getNewCode() }}" name="codigo_distribuidor" readonly="" class="form-control" id="codigo">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-md-9-col-lg-9">
			<label for="">DIRECCION</label>
			<input type="text" maxlength="255" class="form-control" name="direccion" id="direccion">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">TELEFONO</label>
			<input type="text" maxlength="22" class="form-control" name="telefono" id="telefono">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">CIUDAD</label>
			<select required name="ciudad_id" id="ciudad_id" class="form-control">
				@foreach(\App\Models\Ciudad::all() as $key => $ciudad)
					<option value="{{ $ciudad->id }}">{{ $ciudad->nombre_ciudad }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>