@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras y serivicios - registro de cotizaciones')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="Cotizaciones">
<input type="hidden" id="accion" value="buscarProveedores">
<div class="row clearfix">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
				<form action="#" method="post" id="registro">
				{{ csrf_field() }}
				<input type="hidden" name="proveedor_id" value="{{ ($solicitud != false) ? $solicitud->proveedor_id : '' }}" id="proveedor_id">
				<input type="hidden" name="invitacion_codigo" value="{{ ($solicitud != false) ? $solicitud->codigo : '' }}" id="invitacion">
				<input type="hidden" name="solicitud_cotizacion_id" value="{{ ($solicitud != false) ? $solicitud->id : '' }}" id="solicitud">
				<div class="container">
					
					<div class="row">
						
						<div class="col-sm-12 col-md-5 col-lg-5">
							<a class="btn btn-success actions" role="buscarProveedores">
								PROVEEDOR
							</a> 
							<span >
								<strong id="nombre_proveedor">
								{{ ($solicitud != false) ? $solicitud->proveedor->razon_social : '' }}
								</strong>
							</span>
						</div>
						<div class="col-sm-12 col-md-5 col-lg-5">
							<a id="buscarInvitacion" role="buscarInvitacion" class="btn btn-warning">
								BUSCAR INVITACION
							</a>
							<span>
								<strong id="invitacion_concepto">
									{{ ($solicitud != false) ? $solicitud->concepto_solicitud : '' }}
								</strong>
							</span>

						</div>

					</div>

					@if($requisicion != false)
					
					<div class="row">
						
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">Plazo de entrega (DIAS)</label>
							<input type="number" name="pazo_entrega" id="plazo_entrega" class="form-control">
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">Forma de pago</label>
							<select name="forma_pago" id="forma_pago" class="form-control">
								<option value="">Seleccione uno</option>
								<option value="CONTADO">Contado</option>
								<option value="CREDITO">Credito</option>
								<option value="CHEQUE">Cheque</option>
								<option value="CARTA_DE_CREDITO">Carta de credito</option>
								<option value="ABONO_A_CUENTA">Abono a cuenta</option>
								<option value="OTROS">Otros</option>
							</select>
						</div>
						<div class="col-sm-12 col-md-3 col-lg-3">
							<label for="">Termino de entrega</label>
							<select name="terminos_entrega" id="terminos_entrega" class="form-control">
								<option value="">Seleccione uno</option>
								<option value="NUEVO">Nuevo</option>
								<option value="USADO">Usado</option>
								<option value="REPARADO">Reparado / Repotenciado</option>
							</select>
						</div>

					</div>
					<div class="row">
						<div class="col-sm-12 col-md-9 col-lg-9">
							<label for="">Observacion</label>
							<input type="text" name="observacion" placeholder="Ingrese aqui una observacion" id="observacion" class="form-control">
						</div>
					</div>

					@endif

					<div class="row">
						
						<div class="col-sm-12 col-md-9 col-lg-9">
							<h3 class="page-header">Detalles de requisicion</h3>
						</div>
						<div class="col-sm-12 col-md-12 col-lg-12">
							<table class="table table-stripped">
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Descripcion</th>
										<th>U. Medida</th>
										<th>Cantidad</th>
										<th>Vr / Unitario</th>
										<th>% Impuesto</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									@if($requisicion != false)
									@foreach($requisicion->detalles as $key => $detalle)
										<input type="hidden" name="material[]" value="{{ $detalle->material->id }}">
										<tr>
											<td>{{ $detalle->material->codigo_material }}</td>
											<td>{{ $detalle->material->nombre_material }}</td>
											<td>{{ $detalle->material->unidad_medida->codigo_unidad }}</td>
											<td>
												<input type="text" class="form-control cantidades" id="cantidades{{$key}}" name="cantidades[]" indice="{{ $key }}" value="{{ $detalle->cantidad_pedida }}" >
											</td>
											<td>
												<input type="number" onkeyup="calcularTotal(event, this)"  class="form-control cantidades" style="text-align: left;" id="cotizaciones{{$key}}" name="cotizaciones[]" indice="{{ $key }}"  >
											</td>
											<td>
												<input type="number" onkeyup="calcularTotal(event, this)" value="0" id="porcentajes{{$key}}" name="porcentajes[]" indice="{{ $key }}" class="form-control cifras">
											</td>
											<td>
												<input type="number" readonly onkeyup="calcularTotal(event, this)" class="form-control cifras" id="totales{{$key}}" value="0" name="totales[]" indice="{{ $key }}">
											</td>
										</tr>
									@endforeach
									@endif
								</tbody>
							</table>
						</div>

					</div>

				</div>
				<div class="container">
					<div class="row">
						<div class="col-sm-12 col-md-12 col-lg-12">
							<a id="guardar" class="btn btn-success">
								GUARDAR
							</a>
						</div>
					</div>
				</div>
				</form>

			</div>
		</div>

	</div>
</div>

<section id="modals">
<!-- Large Size -->
<div class="modal fade" id="modal-compras" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
           	<div class="modal-header">
                <h4 class="modal-title" id="largeModalLabel">Gestion de compras</h4>
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

<script src="{{ asset('js/compras/cotizaciones.js') }}"></script>

<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection