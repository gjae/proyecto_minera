<div class="container">
	
<div class="row">

<div class="col-sm-12 col-md-9 col-lg-9">
	
<div class="table-responsive">
	
	<table class="table table-stripped">
		
		<thead>
			<tr>
				<th>Codigo</th>
				<th>Descripcion</th>
				<th>Opciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach($registros as $registro)
				<tr>
					<td>
						{{ $registro->solicitud->codigo }}
					 </td>
					<td>	
						{{ $registro->observacion }}
					</td>
					<td>
						<a class="btn btn-success"
							codigo="{{ $registro->solicitud->codigo }}"
							onclick="cargarRegistro(event, this)"
							role="emitir"
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