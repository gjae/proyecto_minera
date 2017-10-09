<div class="container">
	{{ csrf_field() }}
	<input type="hidden" name="accion" id="accion" value="ingresarMaterial">
	<input type="hidden" name="_archivo" id="_archivo" value="minas">
	<input type="hidden" name="material_mina_id" value="{{ $id }}">
	<input type="hidden" name="fecha" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">

	<div class="row clearfix">
		
		<div class="container">
			
			<div class="row clearfix">
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Concepto</label>
					<input type="text" class="form-control" name="observacion" value="-" placeholder="Ingrese una observacion">
				</div>
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Responsable</label>
					<select name="persona_id" id="diciplina_id" class="form-control">
						<option value="">Seleccione uno</option>
						@foreach(App\Models\personal\Persona::where('estado_persona', 'ACTIVA')->get() as $persona)
							<option value="{{ $persona->id }}">
								{{ $persona->primer_nombre.' '.$persona->primer_apellido }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Mina</label>
					<select name="mina_id" id="etapa_produccion_id" class="form-control">
						<option value="">Seleccione uno</option>
						@foreach(App\Models\Mina::where('edo_reg', 1)->get() as $mina)
							<option value="{{ $mina->id }}">
								{{ $mina->nombre_mina }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-12 col-md-3 col-lg-3">
					<label for="">Tipo de movimiento</label>
					<select name="tipo_movimiento" id="" class="form-control">
						<option value="">-- SELECCIONE UNO --</option>
						<option value="salida">Egreso</option>
						<option value="ingreso">Ingreso</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<label for="">Unidad de peso</label>
					<select name="peso_en" onchange="calcularTotal(event, this)" id="peso_en" class="form-control">
						<option value="">-- SELECCIONE UNO --</option>
						<option value="TON">Tonelada</option>
						<option value="KG">Kilogramos</option>
						<option value="GR">Gramos</option>
					</select>
				</div>
				<div class="col-sm-12 col-md-2 col-lg-2">
					<label for="">Valor / tonelada</label>
					<input type="text" name="monto_tonelada" onkeyup="calcularTotal(event, this)" class="form-control" id="monto_tonelada" >
				</div>
				<div class="col-sm-12 col-md-2 col-lg-2">
					<label for="">Cantidad / movimiento</label>
					<input type="text" name="cantidad"  onkeyup="calcularTotal(event, this)" class="form-control" id="cantidad" value="0">
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-sm-9 col-md-9 col-lg-9">
					
					<label for="">Total del movimiento</label>
					<input type="text" style="text-align: center;" class="form-control" name="total_movimiento" readonly value="0" placeholder="Ingrese el número de ingresos" id="total_movimiento">

				</div>

			</div>

		</div>

	</div>

</div>