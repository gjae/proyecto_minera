<div class="container">
	<div class="row">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="imprimir_formato">
	<input type="hidden" name="tipo_formato" value="listado_personal">
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">FECHA DESDE (FORMATO DD-MM-AAAA)</label>
			<input type="date" name="fecha_desde" class="form-control" placeholder="FECHA DE INGRESO DESDE">
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">FECHA HASTA (FORMATO DD-MM-AAAA)</label>
			<input type="date" name="fecha_hasta" class="form-control" placeholder="FECHA DE INGRESO HASTA">
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-lg 4 col-md-4">
			<label for="">MOSTRAR SOLO</label>
			<select name="estado" id="estado" class="form-control">
				<option value="T">TODOS</option>
				<option value="INACTIVA">INACTIVOS</option>
				<option value="ACTIVA">ACTIVOS</option>
			</select>
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">FILTRAR POR CARGO</label>
			<select name="filtro_cargo" id="filtro_cargo" class="form-control">
				<option value="T">TODOS</option>
				@foreach(\App\Models\personal\Cargo::where('edo_cargo', 1)->get() as $cargo )
					<option value="{{ $cargo->id }}">{{ $cargo->descripcion_cargo }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>