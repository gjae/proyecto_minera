<div class="container">
	<div class="row">
		<div class="col-sm-8 col-md-8 col-lg-8">
			<label for="">Seleccione proveedor</label>
			<select name="proveedor_id" id="proveedor" class="form-control">
				@foreach(App\Models\compras\Proveedor::get() as $proveedor)
					<option value="{{ $proveedor->id }}">{{ $proveedor->razon_social }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>