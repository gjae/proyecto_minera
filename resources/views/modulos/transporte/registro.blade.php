@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de transporte')
@section('contenedor')

<input type="hidden" id="modulo" value="viajes">
<input type="hidden" id="programa" value="Registrar">
<div class="row clearfix">

<section id="alert">
@if(Session::has('correcto'))

<div class="col sm-12 col-lg-12 col-md-12">
	<div class="alert alert-success">
		<strong>{{ Session::get('correcto') }}</strong>
	</div>
</div>
@elseif(Session::has('error'))

<div class="col sm-12 col-lg-12 col-md-12">
	<div class="alert alert-warning">
		<strong>{{ Session::get('error') }}</strong>
	</div>
</div>

@endif
</section>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="table-responsive">

					
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<a class="btn btn-success acciones" role="reportes">
								<strong>REPORTES</strong>
							</a>
						</div>
					</div>
					<table class="table table-bordered table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="14%">FECHA DE SALIDA</th>
								<th width="18%">FECHA DE LLEGADA</th>
								<th>PROCEDENCIA</th>
								<th>DESTINO</th>
								<th>NRO FACTURA</th>
								<th>ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($viajes as $key => $viaje)
								<tr>
									<td>{{ $viaje->fecha_salida->format('d-m-Y') }}</td>
									<td>{{ $viaje->fecha_llegada->format('d-m-Y') }}</td>
									<td>{{ $viaje->procedencia }}</td>
									<td>{{ $viaje->destino }}</td>
									<td>{{ $viaje->nro_factura }}</td>
									<td>
										<a 
											class="btn btn-success factura" 
											role="reportes"
											id-transporte="{{ $viaje->id }}"
										>
											<strong>RECIBO</strong>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           	<div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Gestion de transporte</h4>
            </div>
            <div class="modal-body">
             	<form action="#" id="form-modal">
             		

             	</form>
            </div>
            <div class="modal-footer">
            	<button id="reportes" class="btn btn-link waves-effect hidden">Generar reporte</button>
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
<script src="{{ asset('js/transporte/index.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection