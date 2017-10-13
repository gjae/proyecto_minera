<div class="container">
	{{ csrf_field() }}
	<input type="hidden" name="accion" id="accion" value="ingresarMaterial">
	<input type="hidden" name="_archivo" id="_archivo" value="inventario">
	<input type="hidden" name="material_id" value="{{ $id }}">
	<input type="hidden" name="fecha_ingreso" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">

	<div class="row clearfix">
		
		<div class="container">
			
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
				<div class="col-sm-12 col-md-4 col-lg-4">
					
					<label for="">Cantidad ingresada</label>
					<input type="number" style="text-align: center;" class="form-control" name="cantidad" placeholder="Ingrese el número de ingresos" id="cantidad">

				</div>
				<div class="col-sm-12 col-md-3 col-lg-3">
					<label for="">Valor</label>
					<input type="text" value="0" placeholder="Monto por unidad" class="form-control" name="monto" id="monto">
				</div>

			</div>

		</div>

	</div>

</div>