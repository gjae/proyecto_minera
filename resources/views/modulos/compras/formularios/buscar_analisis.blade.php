<div class="container">
	<div class="row">
		<div class="col-sm-11 col-md-9 col-lg-9">
			<div class="table-responsive">
				
				<table class="table table-sttripped">
					
					<thead>
						<tr>
							<th>Codigo</th>
							<th>Concepto</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($analisis as $ac)
							<tr>
								<td>{{ $ac->codigo }}</td>
								<td>{{ $ac->observacion }}</td>
								<td>
									<a  class="btn btn-success"
										codigo="{{ $ac->codigo }}"
										role="crearOrden"
										onclick="cargarAnalisis(event, this)"
									>
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