<?php
$distribuidor = \App\Models\Distribuidor::find($distribuidor_id);
?>
<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="editar">
	<input type="hidden" name="distribuidor_id" value="{{ $distribuidor_id }}">
	<div class="row">
		<div class="col-sm-7 col-lg-7 col-md-7">
			<label for="">Nombre del distribuidor</label>
			<input type="text" class="form-control" maxlength="60" value="{{ $distribuidor->nombre_distribuidor }}" name="nombre_distribuidor" id="nombre_ubicacion">
		</div>

		<div class="col-sm-2 col-lg-2 col-md-2">
			<label for="">Codigo</label>
			<input type="text" style="text-align: center;" value="{{ $distribuidor->codigo_distribuidor }}" name="codigo_distribuidor" readonly="" class="form-control" id="codigo">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-9 col-md-9-col-lg-9">
			<label for="">DIRECCION</label>
			<input type="text" value="{{ $distribuidor->direccion }}" maxlength="255" class="form-control" name="direccion" id="direccion">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">TELEFONO</label>
			<input type="text" maxlength="22" value="{{ $distribuidor->telefono }}" class="form-control" name="telefono" id="telefono">
		</div>
		<div class="col-sm-4 col-md-4 col-lg-4">
			<label for="">CIUDAD</label>
			<select required name="ciudad_id" id="ciudad_id" class="form-control">
				@foreach(\App\Models\Ciudad::all() as $key => $ciudad)
					<option {{ $ciudad->id== $distribuidor->ciudad_id? 'selected' : '' }} value="{{ $ciudad->id }}">{{ $ciudad->nombre_ciudad }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>