@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras - listado')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="analisis">

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
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
		<div class="card">
			<div class="body">
				<form action="{{ url('dashboard/compras/Valuaciones/guardar') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" name="orden_id" value="{{ $orden->id }}">
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">ORDEN</label>
							<input type="text" class="form-control" readonly value="{{ $orden->codigo_orden }}" id="orden">
						</div>
						<div class="col-sm-12 col-md-7 col-lg-7">
							<label for="">CONCEPTO DE LA ORDEN</label>
							<input type="text" required class="form-control" readonly value="{{ $orden->concepto }}">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">COD. VALUACION</label>
							<input type="text" value="{{ App\Models\compras\Valuacion::getANewCode() }}" class="form-control" name="codigo_valuacion" id="codigo_valuacion">
						</div>
						<div class="col-sm-12 col-md-7 col-lg-7">
							<label for="">CONCEPTO DE LA VALUACION</label>
							<input type="text" name="concepto_valuacion" class="form-control" placeholder="Ingrese el concepto de esta valuacion" required>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-4 col-lg-4">
							<label for="">FECHA DE INICIO</label>
							<input type="date" required class="form-control" name="fecha_inicio" id="fecha_inicio">
						</div>
						<div class="col-sm-12 col-md-4 col-lg-4">
							<label for="">FECHA DE TOPE</label>
							<input type="date" required class="form-control" name="fecha_tope" id="fecha_tope">
						</div>
					</div>
				</div>
				<input type="hidden" id="valor_original" value="{{ $orden->total }}">
				<div class="row">
					<div class="col-sm-12 col-lg-10 col-md-10">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Concepto</th>
										<th>Estado</th>
										<th>Fecha de inicio</th>
										<th>Fecha tope</th>
										<th>Monto</th>
									</tr>
								</thead>
								<tbody>
								@php
									$valuaciones = $orden->valuaciones()->where('estatus', '<>', 'AN')->get();
								@endphp
									@foreach($valuaciones as $key => $valuacion)
										<tr>
											<td>{{ $valuacion->codigo_valuacion }}</td>
											<td>{{ $valuacion->concepto_valuacion }}</td>
											<td>{{ $valuacion->estatus }}</td>
											<td>{{ $valuacion->fecha_inicio->format('d-m-Y') }}</td>
											<td>{{ $valuacion->fecha_tope->format('d-m-Y') }}</td>
											<td>{{ number_format($valuacion->monto_valuacion, 2) }}</td>
										</tr>
									@endforeach
									<tr>
										<td> </td>
										<td> </td>
										<td> </td>
										<td> <strong>TOTAL A LA FECHA</strong> </td>
										<td></td>
										<td>
											{{ number_format( $orden->valuaciones()->where('estatus', '<>', 'AN')->sum('monto_valuacion', 2) ) }}
										</td>
									</tr>
									<tr>
										<td> </td>
										<td> </td>
										<td> </td>
										<td> <strong>POR COMPROMETER</strong> </td>
										<td></td>
										<td>
											<input type="text" id="por_comprometer" class="form-control" readonly value="{{ $orden->total - $orden->valuaciones()->where('estatus', '<>', 'AN')->sum('monto_valuacion')  }}" name="pendiente_por_valuar">
										</td>
									</tr>
									<tr>
										<td> </td>
										<td> </td>
										<td> </td>
										<td> <strong>COMPROMETER COP$</strong> </td>
										<td></td>
										<td>
											<input type="text" class="form-control" onkeyup="calcular_valuacion(event, this)" name="monto_valuacion">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-sm-12 col-md-9 col-lg-9">
						<input type="submit" value="Guardar" class="btn btn-success">
					</div>
				</div>
				</form>
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
	                <h4 class="modal-title" id="largeModalLabel">Gestion de analisis de cotizacion</h4>
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
</script>
@endsection