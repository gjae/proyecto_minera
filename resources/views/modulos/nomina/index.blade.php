@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de persoal y nomina')
@section('contenedor')

<input type="hidden" id="modulo" value="nomina">
<input type="hidden" id="programa" value="Personal">

<div class="row clearfix">
@if(Session::has('correcto'))
<div class="col-sm-12 col-lg-12 col-md-12">
	<div class="alert alert-success">
		{{ Session::get('correcto') }}
	</div>
</div>
@elseif(Session::has('error'))
<div class="col-sm-12 col-lg-12 col-md-12">
	<div class="alert alert-danger">
		{{ Session::get('error') }}
	</div>
</div>
@endif
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
			<div class="row">
				<div class="col-sm-12 col-lg-12 col-md-12">
					<button type="button red pull-right" action="formularios" formulario="ingresar" class="btn btn-default waves-effect m-r-20 actions">Ingresar persona</button>
					<button 
						role="reportes"
						class="btn btn-success actions"
						formulario="formato_personal"
						action="formularios"
					>
						<strong>LISTADO DE PERSONAL</strong>
					</button>
				</div>
			</div>
				<div class="table-responsive">					
					<table class="table table-bordered table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="24%">Nombre</th>
								<th width="18%">Identificacion</th>
								<th>Telefono</th>
								<th>Fecha de ingreso</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($personas as $persona)
								<tr>
									<td>
										{{ $persona->primer_nombre.' '.$persona->segundo_nombre.' '.$persona->primer_apellido.' '.$persona->segundo_apellido }}
									</td>
									<td>
										{{ $persona->identificacion }}
									</td>
									<td>
										{{ $persona->telefono }}
									</td>
									<td>
										{{ $persona->fecha_ingreso }}
									</td>
									<td>
										<a class="btn btn-success actions" action="formularios" persona="{{ $persona->id }}" formulario="agregar_ajustes">
											<strong>AGREGAR AJUSTE</strong>
										</a>

										<a class="btn btn-success actions" action="formularios" persona="{{ $persona->id }}" formulario="editar_persona">
											<strong>EDITAR</strong>
										</a>

										@if( $persona->estado_persona == 'ACTIVA' )
											<a
												href="{{ url('dashboard/nomina/personal/loquidacion')}}?persona={{$persona->id}}"
												data-id="{{ $persona->id }}"
											 	class="btn btn-warning"
												
											 >
												<strong>LIQUIDACION</strong>
											 </a>
											@else
											<a
												liquidacion="{{ $persona->liquidacion->id }}"
											 	class="btn btn-danger print"
												role="liquidacion"
											 >
											 		<strong>IMPRIMIR LIQUIDACION</strong>
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
<div class="modal fade" id="modal-personal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           	<div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Gestion de personal</h4>
            </div>
            <div class="modal-body">
             	<form action="#" id="form-modal">
             		

             	</form>
            </div>
            <div class="modal-footer">
                <button type="button" id="salvar" class="btn btn-link waves-effect data">Guardar datos</button>

                <button type="button" id="generar" class="btn btn-link waves-effect hidden">Generar reporte</button>

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
<script src="{{ asset('js/personal/personal.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection