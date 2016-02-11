<div class="container">
{{ csrf_field() }}
<input type="hidden" id="accion" value="abrirNomina">
	<div class="row">
		<div class="col-sm-12 col-md-3 col-lg-2">
			<label for="">Nombre de la nomina</label>
			<input maxlength="130" type="text" class="form-control" name="nombre_nomina" id="nombre_nomine">
		</div>
		<div class="col-sm-12 col-lg-3 col-md-2">
			<label for="">Codigo</label>
			<input type="text" value="{{ $codigo }}" name="codigo_nomina" readonly="" id="codigo_nomina" class="form-control">
		</div>
		<div class="col-sm-12 col-lg-2 col-lg-2">
			<label for="">Periodo (DD-MM-AAAA)</label>
			<input type="date" class="form-control" id="priodo_nomina" name="periodo_nomina">
		</div>
		<div class="col-sm-12 col-lg-2 col-lg-2">
			<label for="">Tipo</label>
			<select name="tipo_nomina" id="tipo_nomina" class="form-control">
				<option value="Q">Quincenal</option>
				<option value="S">Semanal</option>
				<option value="M">Mensual</option>
			</select>
		</div>
	</div>

</div>