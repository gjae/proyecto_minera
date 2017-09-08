@extends("index")

@section('titulo', 'Modulo de configuracion - Cargos')

@section('contenedor')

<input type="hidden" id="modulo" value="configuracion">
<input type="hidden" id="programa" value="Cargos">

<div class="row clearfix">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="container-fluid">
				<section id="botonera">
					
					<div class="row">
						<br><br>
						<div class="col-sm-12 col-md-12 col-lg-8">
							<a  formulario="crearMaterial" class="btn btn-primary actions">
								CREAR NUEVO
							</a>
							<a  formulario="insertarUnidadMedida" class="btn btn-success actions">
								AGREGAR UNIDAD DE MEDIDA
							</a>
							<a  formulario="insertarUnidadMedida" role="controlBodega" class="btn btn-success reportes">
								REPORTE - CONTROL DE BODEGA
							</a>
						</div>

					</div>

				</section>
			</div>
			<div class="body">
				<div class="table-responsive">				
					<table class="table table-bordered table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="12%">Codigo</th>
								<th width="22%">Nombre</th>
								<th width="12%">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cargos as $key => $cargo)
								<tr>
									<td>{{ $cargo->codigo_cargo }}</td>
									<td>{{ $cargo->descripcion_cargo }}</td>
									<td>
										<a class="btn btn-primary acions"
											role="crear"
											data-id=""
										>CREAR CARGO</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('jquery')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('js//configuracion/funciones.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection