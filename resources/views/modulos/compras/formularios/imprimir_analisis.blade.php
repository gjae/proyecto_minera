<div class="container">
	<div class="row">
		<div class="col-sm-9 col-lg-9 col-md-9">
			
			<div class="table-responsive">
				
				<table class="table table-stripped">
					
					<thead>
						<tr>
							<th>CODIGO</th>
							<th>OBSERVACION</th>
							<th>ACCIONES</th>
						</tr>
					</thead>
					<tbody>
						@foreach($ac as $key => $analisis)
							<tr>
								<td>{{ $analisis->codigo }}</td>
								<td>{{ $analisis->observacion }}</td>
								<td>
									<a 
										class="btn btn-success"
										codigo = "{{ $analisis->codigo }}"
										onclick="imprimir(event, this)"
									>
										<strong>IMPRIMIR</strong>
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