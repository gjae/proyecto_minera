@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de persoal y nomina')
@section('contenedor')

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
										<i class="large material-icons btn-options" data-id="{{ $material->id }}" role="delete">delete</i>
										<i class="large material-icons btn-options actions" 
											formulario="ingreso_material"  
											data-id="{{ $material->id }}" role="ingresar">
											add_circle
										</i>

										<i class="large material-icons btn-options actions" formulario="egresar_material" role="egresar" data-id="{{ $material->id }}">highlight_off</i>
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
                <button type="button" id="salvar" class="btn btn-link waves-effect">Guardar datos</button>
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</button>
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
<script src="{{ asset('js//inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection