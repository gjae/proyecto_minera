<div class="conainer">
	
	<div class="row">
		<div class="col-sm-9 col-md-9 col-lg-9">
			
			<div class="table-responsive">
				
				<table class="table">
					
					<thead>
						<tr>
							<th>IDENTIFICACION</th>
							<th>NOMBRS</th>
							<th>APELLIDOS</th>
							<th>CARGO</th>
							<th>ACCIONES</th>
						</tr>
					</thead>
					<tbody>
						@foreach(\App\Models\personal\Persona::all() as $persona)
							<tr>
								<td>{{ $persona->identificacion }}</td>
								<td>{{ $persona->primer_nombre.' '.$persona->segundo_nombre }}</td>
								<td>{{ $persona->primer_apellido.' '.$persona->segundo_apellido }}</td>
								<td>{{ $persona->cargo->descripcion_cargo }}</td>
								<td>
									<a 
										onclick="agregar_persona(event, this)"
										data-id="{{ $persona->id }}"
										identificacion="{{ $persona->identificacion }}"
										nombre="{{ $persona->primer_nombre.' '.$persona->primer_apellido }}"
									 	class="btn btn-success">	
										<strong>AGREGAR</strong>
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