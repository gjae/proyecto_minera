@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras - listado')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="ordenes">
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
<div class="row clearfix">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="container-fluid">
				<section id="botonera">
					
					<div class="row">
						<br>
						<div class="col-sm-12 col-md-5 col-lg-5">
							<button class="btn btn-success" onclick="imprimir_ley()">
								IMPRIMIR CARTA DE LEY
							</button>
						</div>
					</div>

				</section>
			</div>
			<div class="body">
				<div class="table-responsive">				
					<table class="table table-bordered table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th>CODIGO DE ORDEN</th>
								<th>CONSECUTIVO</th>
								<th>TIPO</th>
								<th>ESTADO</th>
								<th>ACCIONES</th>
							</tr>
						</thead>
						<tbody>
							@foreach($ordenes as $orden)
								<tr>
									<td>{{ $orden->codigo_orden }}</td>
									<td>
										{{ substr($orden->tipo_orden, 0, 2).'-'.$orden->codigo_orden }}
									</td>
									<td>
										{{ $orden->tipo_orden }}
									</td>
									<td>
										{{ $orden->estado_orden }}
									</td>
									<td>
										<a
											orden="{{ $orden->id }}"
										 	class="btn btn-success opciones"
										 	role="imprimir"
										 >
										 		<strong>IMPRIMIR</strong>
										 </a>

										<a
											orden="{{ $orden->id }}"
										 	class="btn btn-success opciones"
										 	role="imprimir2"
										 >
										 		<strong>IMPRIMIR PART. 2</strong>
										 </a>
										<a href="{{ url('dashboard/compras/Valuaciones?orden='.$orden->id) }}" class="btn btn-primary">
											<strong>REGISTRO DE VALUACION</strong>
										</a>
										@if( $orden->tipo_orden == 'SERVICIOS' )
										<a href="{{ url('dashboard/compras/Variaciones?orden='.$orden->id) }}" class="btn btn-warning">
											<strong>VARIACIONES</strong>
										</a>
										@endif

										<a
											href="{{ url('dashboard/compras/Ordenes/adjuntar?orden_id='.$orden->id) }}"
										 	class="btn btn-success"
										 >
										 		<strong>ADJUNTAR ARCHIVOS</strong>
										 </a>
										 @if( !empty( $orden->archivos[0] ) )
												
											<a
												href="{{ url('dashboard/compras/Ordenes/archivos?orden_id='.$orden->id) }}"
											 	class="btn btn-success"
											 >
											 		<strong>VER ARCHIVOS</strong>
											 </a>
											<button tipo="{{ $orden->tipo_orden }}" class="btn btn-success" onclick="imprimir_ley(event, this)">
												IMPRIMIR CARTA DE LEY
											</button>
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
	                <h4 class="modal-title" id="largeModalLabel">Gestion de ordenes de compra</h4>
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
<script src="{{ asset('js/compras/ordenes.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function imprimir_ley(e, boton){
	var url = location.protocol+'//'+location.host+'/dashboard/compras/ordenes/imprimir_ley?tipo='+boton.getAttribute('tipo')

	window.open(url, 'CARTA DE LEY', 'width=800,height=900')
}
</script>
@endsection