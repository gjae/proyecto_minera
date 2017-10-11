<select required name="centros_id[]" class="form-control">
	<option value="">-- SELECCIONE UNO --</option>
	@foreach( App\Models\requisicion\CentroCosto::all() as $centro)
		<option value="{{ $centro->id }}">
			{{ $centro->nombre_centro }}
		</option>
	@endforeach
</select>