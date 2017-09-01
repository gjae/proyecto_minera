<div class="container">
	<div class="row">
		<div class="col-sm-10 col-md-9 col-lg-9">
			
			<table class="table table-stripped">
				
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Concepto</th>
						<th>Tipo</th>
						<th>Total</th>
						<th>Accion</th>
					</tr>
				</thead>
				<tbody id="requisiciones">
					@foreach($requisiciones as $requisicion)
						<tr>
							<td>{{ $requisicion->codigo_requisicion }}</td>
							<td>{{ $requisicion->concepto_requisicion }}</td>
							<td>{{ $requisicion->tipo_requisicion }}</td>
							<td>{{ $requisicion->total_requisicion }}</td>
							<td>
								<button class="btn btn-success"
										data-id="{{ $requisicion->id }}"
										codigo="{{ $requisicion->codigo_requisicion }}"
										concepto="{{ $requisicion->concepto_requisicion }}"
										tipo="{{ $requisicion->tipo_requisicion }}"
										total="{{ $requisicion->total_requisicion }}"
										onclick="agregarRequisicion(event, this)"
								>
									AGREGAR
								</button>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>