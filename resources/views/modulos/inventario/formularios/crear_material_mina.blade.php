<div class="container">
	
	{{ csrf_field() }}
	<input type="hidden" name="accion" id="accion" value="guardarMaterial">
	<input type="hidden" name="_archivo" id="_archivo" value="minas">
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			<label for="">Nombre</label>
			<input type="text" class="form-control" id="descripcion" name="descripcion">
		</div>
	</div>

	<div class="row">
		
		<div class="col-sm-9 col-md-4 col-lg-4">
			<label for="">Unidad de medida</label>
			<select name="unidad_medida_id" id="unidad_medida_id" class="form-control">
				<option value="">Seleccione una opcion</option>
				@foreach(App\Models\inventario\UnidadMedida::where('edo_reg', 1)->get() as $unidad)
					<option value="{{ $unidad->id }}">
						{{ $unidad->descripcion_unidad }}
					</option>
				@endforeach
			</select>
		</div>
		<div class="col-sm-9 col-md-4 col-lg-4">
			<label for="">Tipo de material</label>
			<select name="tipo_material_id" id="tipo_material_id" class="form-control">
				<option value="">Seleccione una opcion</option>
				@foreach(App\Models\inventario\TipoMaterial::where('edo_reg', 1)->get() as $tipo)
					<option value="{{ $tipo->id }}">
						{{ $tipo->descripcion_tipo }}
					</option>
				@endforeach
			</select>
		</div>

	</div>

</div>