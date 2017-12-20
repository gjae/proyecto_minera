<div class="container">
	<input type="text" id="tipo_reporte" value="por_proveedor">
	<div class="row">
		<div class="col-sm-8 col-md-8 col-lg-8">
			<label for="">Seleccione proveedor</label>
			<select name="proveedor_id" id="proveedor_id" class="form-control">
				@foreach(App\Models\compras\Proveedor::get() as $proveedor)
					<option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">Fecha desde (DD-MM-AAAA)</label>
			<input type="date" id="fecha_desde" class="form-control" name="fecha_desde">
		</div>
		<div class="col-sm-4 col-lg-4 col-md-4">
			<label for="">Fecha hasta (DD-MM-AAAA)</label>
			<input type="date" id="fecha_hasta" class="form-control" name="fecha_hasta">
			
		</div>
	</div>
</div>