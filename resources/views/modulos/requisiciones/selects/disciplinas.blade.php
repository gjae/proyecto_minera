<select required name="disciplinas_id[]" class="form-control">
	<option value="">-- SELECCIONE UNO --</option>
	@foreach( App\Models\requisicion\Diciplina::where('edo_reg', 1)->get() as $diciplina)
		<option value="{{ $diciplina->id }}">
			{{ $diciplina->nombre_diciplina }}
		</option>
	@endforeach
</select>
