@extends("index")

@section('titulo', 'Modulo de configuracion - Cargos')

@section('contenedor')

<input type="hidden" id="modulo" value="configuracion">

<input type="hidden" id="programa" value="vehiculos">

<div class="row clearfix">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="container-fluid">
				<section id="botonera">
					
					<div class="row">
						<br><br>
						<div class="col-sm-12 col-md-12 col-lg-8">
							<a  class="btn btn-primary actions"
								role="crear"
								data-id=""
							>
								CREAR NUEVO
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
								<th>Fecha de insercion</th>
								<th width="12%">Placa</th>
								<th width="22%">Tipo de vehiculo</th>
								<th>Marca</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($vehiculos as $key => $vehiculo)
								<tr>
									<td>
										{{ $vehiculo->created_at->format('d-m-Y') }}
									</td>
									<td>{{ $vehiculo->placa }}</td>
									<td> {{ $vehiculo->tipo_vehiculo == 'T_PERSONAL'? 'TRANSPORTE DE PERSONAS' : $vehiculo->tipo_vehiculo }} </td>
									<th>{{ $vehiculo->marca }}</th>
									<td>
										<a role="editar" 
											class="btn btn-success  actions"
											data-id="{{ $vehiculo->id }}"
										>
											EDITAR REGISTRO
										</a>
										<a role="eliminar" 
											class="btn btn-danger  actions"
											data-id="{{ $vehiculo->id }}"
											token ="{{ csrf_token() }}"
										>
											ELIMINAR REGISTRO
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
</div>


<section id="modals">
	<!-- Large Size -->
	<div class="modal fade" id="modal-coniguracion" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	           	<div class="modal-header">
	                <h4 class="modal-title" id="largeModalLabel">Gestion de vehiculos</h4>
	            </div>
	            <div class="modal-body">
	             	<form action="#" id="form-modal">
	             		

	             	</form>
	            </div>
	            <div class="modal-footer">
	            	<div id="footer-datos">
		                <button type="button" id="salvar" class="btn btn-link waves-effect">Guardar datos</button>
		                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
	                </div>
	                <div id="footer-reportes" class="hidden">
		                <button type="button" id="reporte" class="btn btn-link waves-effect">Generar reporte</button>
		                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
	                </div>
	            </div>
	   		</div>
	    </div>
	</div>
</section>
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
<script src="{{ asset('js/configuracion/funciones.js') }}"></script>
<script src="{{ asset('js/funciones.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection