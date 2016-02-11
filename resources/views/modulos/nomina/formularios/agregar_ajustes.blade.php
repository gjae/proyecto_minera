<div class="container">
	{{ csrf_field() }}
	<input type="hidden" id="accion" value="guardarAjusteAPersona">
	<input type="hidden" name="persona_id" value="{{ $persona->id }}">
	<div class="row">
		<div class="col-sm-10 col-lg-9 col-md-9">
			<label for="">AGREGAR AJUSTE A {{ $persona->primer_nombre.' '.$persona->segundo_nombre }}</label>
			<select name="ajuste_id" id="" class="form-control">
			<option value="">-- SELECCIONE UNO --</option>
			@foreach(\App\Models\personal\Ajuste::whereNotIn('id', $ids)->get() as $ajuste)
				<option value="{{ $ajuste->id }}">{{ $ajuste->nombre_ajuste }}</option>
			@endforeach
			</select>

		</div>
	</div>
</div>