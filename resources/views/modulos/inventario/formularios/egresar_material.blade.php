<div class="container">
	{{ csrf_field() }}
	<input type="hidden" name="accion" id="accion" value="egresarMaterial">
	<input type="hidden" name="_archivo" id="_archivo" value="inventario">
	<input type="hidden" name="material_id" value="{{ $id }}">
	<input type="hidden" name="fecha_ingreso" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">

	<div class="row clearfix">
		
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-6 col-lg-6">
					<label>Fecha (FORMATO: AAAA-MM-DD)</label>
					<input class="form-control" name="created_at" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" >
				</div>
			</div>			
			<div class="row clearfix">
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Centro de costos</label>
					<select name="centro_costo_id" id="centro_costo_id" class="form-control">
						<option value="">Seleccione uno</option>
						@foreach(App\Models\requisicion\CentroCosto::all() as $centro)
							<option value="{{ $centro->id }}">
								{{ $centro->nombre_centro }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Diciplina</label>
					<select name="diciplina_id" id="diciplina_id" class="form-control">
						<option value="">Seleccione uno</option>
						@foreach(App\Models\requisicion\Diciplina::all() as $diciplina)
							<option value="{{ $diciplina->id }}">
								{{ $diciplina->nombre_diciplina }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-10 col-md-3 col-lg-3">
					<label for="">Etapa de producción</label>
					<select name="etapa_produccion_id" id="etapa_produccion_id" class="form-control">
						<option value="">Seleccione uno</option>
						@foreach(App\Models\requisicion\EtapaProduccion::all() as $etapa)
							<option value="{{ $etapa->id }}">
								{{ $etapa->nombre_etapa }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-sm-12 col-lg-3 col-md-3">
					<label for="">Proceso</label>
					<select name="proceso_id" id="proceso_id" required="" class="form-control">
						<option value="">-- SELECCIONE UNO --</option>
						@foreach (App\Models\personal\Proceso::all() as $proceso)
							<option value="{{ $proceso->id }}">
								{{ $proceso->nombre_proceso }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-12 col-lg-3 col-md-3">
					<label for="">Frente</label>
					<select name="frente_id" id="proceso_id" required="" class="form-control">
						<option value="">-- SELECCIONE UNO --</option>
						@foreach (App\Models\personal\Frente::all() as $Frente)
							<option value="{{ $Frente->id }}">
								{{ $Frente->nombre_frente }}
							</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-12 col-lg-3 col-md-3">
					<label for="">Nivel</label>
					<select name="nivel_id" id="proceso_id" required="" class="form-control">
						<option value="">-- SELECCIONE UNO --</option>
						@foreach (App\Models\personal\Nivel::all() as $nivel)
							<option value="{{ $nivel->id }}">
								{{ $nivel->nombre_nivel }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="row clearfix">
				<div class="col-sm-9 col-md-4 col-lg-4">
					
					<label for="">Cantidad egresada</label>
					<input type="number" style="text-align: center;" class="form-control" name="cantidad_salida" placeholder="Ingrese el número de egresos" id="cantidad_salida">

				</div>
				<div class="col-sm-9 col-md-4 col-lg-4">
					<label for="">Persona solicitante</label>
					<select name="persona_id" id="persona_id" class="form-control">
						<option value="">Seleccione uno</option>
						<option value="0">Nadie</option>
						@foreach(App\Models\personal\Persona::where('estado_persona', 'ACTIVA')->get() as $persona)
							<option value="{{ $persona->id }}">
								{{ $persona->primer_nombre.' '.$persona->segundo_nombre.' '.$persona->primer_apellido.' '.$persona->segundo_apellido }}
							</option>
						@endforeach
					</select>
				</div>

			</div>

		</div>

	</div>

</div>
