@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de inventario y minas')
@section('contenedor')

<div class="row">

<div class="col-sm-12 col-lg-12 col-md-12">

@if(Session::has('error'))

<div class="alert alert-danger">
	<strong>{{ Session::get('error') }}</strong>
</div>

@elseif( Session::has('correcto') )
<div class="alert alert-success">
	<strong>{{ Session::get('correcto') }}</strong>
</div>

@endif	

</div>

</div>
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
							<a  formulario="reportePorProveedor" role="reportes" class="btn btn-success" onclick="click_action(event, this)">
								REPORTE - POR PROVEEDO
							</a>
							<a class="btn btn-success" onclick="formato_almacen()">
								DESCARGAR FORMATO DE ALMACEN
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
								<th width="12%">U. medida</th>
								<th width="20%">Tipo de material</th>
								<th width="20%">Cantidad disponible</th>
								<th width="20%">Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach(App\Models\inventario\Material::where('estado_material', 'ACTIVO')->get() as $key => $material)
								<tr>
									<td>
										{{ $material->codigo_material }}
									</td>
									<td>
										{{ $material->nombre_material }}
									</td>
									<td>
										{{ $material->unidad_medida->codigo_unidad }}
									</td>
									<td>
										{{ $material->tipo->descripcion_tipo }}
									</td>
									<td>
										{{ $material->ingresos->sum('cantidad') - $material->egresos->sum('cantidad_salida') }}
									</td>
									<td>
										<a class="btn btn-danger" onclick="click_option(event, this)" role="delete" data-id="{{ $material->id }}">
											<i class="large material-icons btn-options"  >delete</i>
										</a>

										<a class="btn btn-success" onclick="click_action(event, this)"
											formulario="ingreso_material"  
											data-id="{{ $material->id }}" role="ingresar"
										>
											<i class="large material-icons btn-options " 
												>
												add_circle
											</i>
										</a>
										
										<a class="btn btn-warning" onclick="click_action(event, this)" data-id="{{ $material->id }}" formulario="egresar_material" role="egresar" >
											<i class="large material-icons btn-options "  >highlight_off</i>
										</a>
										<a class="btn btn-primary" onclick="click_action(event, this)" data-id="{{ $material->id }}" formulario="reportePor" role="reportes">
											<i class="material-icons actions">local_printshop</i>
										</a>
										@if(is_null($material->ficha))
											<a href="{{ url('dashboard/inventario/HojaVida/crear?id='.$material->id) }}" class="btn btn-success">
												<strong>CREAR HOJA DE VIDA</strong>
											</a>
										@endif
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
	<div class="modal fade" id="modal-inventario" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	           	<div class="modal-header">
	                <h4 class="modal-title" id="largeModalLabel">Gestion de inventario</h4>
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
		                <button type="button" class="reporte btn btn-link waves-effect">Generar reporte</button>
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
<script src="{{ asset('js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function formato_almacen(){
	var url = location.protocol+'//'+location.host+'/index.php/dashboard/compras/ordenes/formato_almacen';
	window.open(url, 'formato', 'width=800,height=900')
}

</script>
@endsection