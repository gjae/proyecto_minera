<table class="table table-stripped">
	<thead>
		<tr>
			<th>Razon social</th>
			<th>Cedula</th>
			<th>Telefono</th>
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		
		@foreach($proveedores as $proveedor)
			<tr>
				<td>
					{{ $proveedor->razon_social }}
				</td>
				<td>
					{{ $proveedor->cedula }}
				</td>
				<td>
					{{ $proveedor->telefono }}
				</td>
				<td>
					<button class="btn btn-success"
							data-id="{{ $proveedor->id }}"
							razon-social="{{ $proveedor->razon_social }}"
							identificacion="{{ $proveedor->identificacion }}"
							cedula="{{ $proveedor->cedula }}"
							telefono="{{ $proveedor->telefono }}"
							onclick="agregarProveedor(event, this)"
					>Agregar</button>
				</td>
			</tr>
		@endforeach

	</tbody>
</table>