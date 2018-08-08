<div class="container">
	
	<div class="row">
		
		<divl class="col-sm-12 col-md-9 col-lg-9">
			<div class="table-responsive">
				
				<table class="table" id="dataTables-example">
					
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Fecha de ingreso</th>
							<th>Cedula</th>
							<th>Sueldo base (MENSUAL)</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach($personas as $persona)
							<tr>
								<th>{{ $persona->primer_nombre.' '.$persona->segundo_nombre }}</th>
								<th>{{ $persona->primer_apellido.' '.$persona->segundo_apellido }}</th>
								<th>{{ $persona->fecha_ingreso->format('d-m-Y') }}</th>
								<th>{{ $persona->identificacion  }}</th>
								<th>{{ number_format($persona->sueldo_basico, 2) }}</th>
								<th>
									<a 
										class="btn btn-success"
										persona-id="{{ $persona->id }}"
										onclick="cargarPersona(event, this)"
									>
										<strong>AGREGAR</strong>
									</a>
								</th>
							</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</divl>

	</div>

</div>
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>