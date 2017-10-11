<table class="table table-stripped">
	<thead>
		<tr>
			<th>Codigo</th>
			<th>Descripcion</th>
			<th>Fecha de generacion</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		@foreach($invitaciones as $invitacion)
			<tr>
				<td>{{ $invitacion->codigo }}</td>
				<td>{{ $invitacion->concepto_solicitud }}</td>
				<td>{{ $invitacion->created_at->format('d-m-y') }}</td>
				<td>
					<a  
						class="btn btn-primary"
						requisicion-id="{{ $invitacion->requisicion_id }}"
						data-id="{{ $invitacion->id }}"
						descripcion="{{ $invitacion->concepto_solicitud }}"
						codigo="{{ $invitacion->codigo }}"
						onclick="agregarInvitacion(event, this)"
					>
						AGREGAR
					</a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>