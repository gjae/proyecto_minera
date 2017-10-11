<div class="container">
	<input type="hidden" name="nomina" value="{{ $nomina }}">
	<div class="row">
		<div class="col-sm-12 col-md-9 col-lg-9">
			<h3 class="page-header">Generar reporte de nomina</h3>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">IDENTIFICACION</label>
			<input type="text" placeholder="FILTRAR POR PERSONA" name="identificacion" id="identificacion" class="form-control">
		</div>
		<div class="col-sm-12 col-lg-4 col-md-4">
			<label for="">FILTRAR POR MINA</label>
			<select name="mina_id" id="mina_id" class="form-control">
				<option value="-">TODAS</option>
				@foreach(App\Models\Mina::where('edo_reg', 1)->get() as $mina)
					<option value="{{ $mina->id }}">{{ $mina->nombre_mina }}</option>
				@endforeach
			</select>
		</div>
	</div>
</div>