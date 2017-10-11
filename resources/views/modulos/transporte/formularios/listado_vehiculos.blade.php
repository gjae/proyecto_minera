<div class="container">
	<div class="row">
		<div class="col-sm-9 col-lg-9 col-md-9">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>PLACA</th>
							<th>TIPO DE VEHICULO</th>
							<th>CAPACIDAD DE TANQUE</th>
							<th>CAPACIDAD DE CARGA</th>
							<th>ACCIONES</th>
						</tr>
					</thead>
					<tbody>
						@foreach($vehiculos as $key => $vehiculo)
							<tr>
								<td>
									{{ $vehiculo->placa }}
								</td>
								<td>
									{{ $vehiculo->tipo_vehiculo }}
								</td>
								<td>
									{{ $vehiculo->capacidad_tanque }} LTS
								</td>
								<td>
									{{ $vehiculo->cantidad_carga }} KG's
								</td>
								<td>
									<a 
										onclick="cargar_vehiculo(event, this)"
										data-id="{{ $vehiculo->id }}"
									 	class="btn btn-success">
									 	<strong>CARGAR</strong>
									 </a>
								</td>
							</tr>
						@endforeach
					</tbody>

				</table>
			</div>
		</div>
	</div>
</div>