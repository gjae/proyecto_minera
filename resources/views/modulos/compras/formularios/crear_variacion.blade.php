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
				<form action="{{ url('dashboard/compras/Variaciones/guardar') }}" method="post">
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
							<label for="">COD. VARIACION</label>
							<input type="text" value="{{ App\Models\compras\Variacion::getConsecutivo() }}" class="form-control" name="codigo_valuacion" id="codigo_valuacion">
						</div>
						<div class="col-sm-12 col-md-7 col-lg-7">
							<label for="">CONCEPTO DE LA VARIACION</label>
							<input type="text" name="concepto" class="form-control" placeholder="Ingrese el concepto de esta variacion" required>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">FECHA DE SUSPENSION</label>
							<input type="date" class="form-control" name="fecha_suspencion" id="fecha_inicio">
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">FECHA DE REINICIO</label>
							<input type="date" class="form-control" name="fecha_reinicio" id="fecha_reinicio">
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">CANTIDAD / DIAS</label>
							<input type="date" class="form-control" name="cantidad_dias_variacion" id="cantidad_dias_variacion" value="0">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3">
						<label for="">MONTO DE LA ORDEN</label>
						<input readonly class="form-control" type="text" id="total" value="{{ $orden->total }}">

					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3">
						<label for="">MONTO COMPROMETIDO</label>
						<input readonly class="form-control" type="text" id="comprometido" value="{{$orden->valuaciones()->where('estatus','<>', 'AN')->sum('monto_valuacion')  }}">

					</div>
					<div class="col-sm-12 col-md-3 col-lg-3">
						<label for="">MONTO VARIADO</label>
						<input readonly class="form-control" type="text" id="variado" value="{{$orden->variaciones()->where('estatus', '<>', 2)->sum('monto_variacion') }}">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12 col-md-3 col-lg-3">
						<label for="">MONTO DISPONIBLE</label>
						<input readonly class="form-control" type="text" id="disponible" value="{{ ( $orden->total - $orden->valuaciones()->where('estatus','<>', 'AN')->sum('monto_valuacion') ) + $orden->variaciones()->where('estatus', '<>', 2)->sum('monto_variacion') }}">
					</div>
					<div class="col-sm-12 col-md-3 col-lg-3">
						<label for="">NUEVO MONTO / VARIACION</label>
						<input class="form-control" type="text" name="monto_variacion" id="monto_variacion" value="0" onkeyup="calcularVariacion(event, this)">
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
<script src="{{ asset('js//compras/ordenes.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function calcularVariacion(e, field){
	var comprometido = document.getElementById('comprometido')
	var total = document.getElementById('total')
	var variado = document.getElementById('variado')
	var resultado = 0;

	if( ! isNaN( parseFloat(field.value) ) )
		resultado = ( ( parseFloat(total.value) - parseFloat(comprometido.value) ) + parseFloat(variado.value) + parseFloat(field.value) )
	else
		resultado = ( ( parseFloat(total.value) - parseFloat(comprometido.value) ) + parseFloat(variado.value) + 0 )

	document.getElementById('disponible').value = resultado
}
</script>
@endsection