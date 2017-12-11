<select required name="etapas_id[]" class="form-control">
	<option value="">-- SELECCIONE UNO --</option>
	@foreach( App\Models\requisicion\EtapaProduccion::where('edo_reg', 1)->get() as $etapa)
		<option value="{{ $etapa->id }}">
			{{ $etapa->nombre_etapa }}
		</option>
	@endforeach
</select>
