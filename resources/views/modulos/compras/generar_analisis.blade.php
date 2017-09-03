@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras y serivicios - registro de cotizaciones')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="Analisis">
<input type="hidden" id="accion" value="buscarProveedores">
<div class="row clearfix">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
				<form action="#" method="post" id="analisis">
					{{ csrf_field() }}
					<div class="container">
						
						<div class="row">
							<div class="col-sm-12 col-md-5 col-lg-5">
								<a class="btn btn-success acciones" id="buscarCotizaciones" role="buscarCotizaciones">
									<strong>AGREGAR COTIZACIONES</strong><span>
								</a>
							</div>
							<div class="col-sm-3 col-lg-2 col-md-2">
								<input type="text" value="{{ ($solicitud != false) ? $solicitud[0]->codigo : '' }}" class="form-control" name="codigo_solicitud" readonly="" id="codigo">	
								</span>
							</div>

						</div>
						@if($solicitud != false)
						
						<div class="row">
							<div class="col-sm-3 col-md-2 col-lg-2">
								<label for="">Codigo</label>
								<input type="text" value="{{ $codigo }}" class="form-control" name="codigo" readonly="" id="codigo">
							</div>
							<div class="col-sm-7 col-md-7 col-lg7">
								<label for="">Concepto / observacion del analisis</label>
								<input type="text" class="form-control" name="observacion" placeholder="Ingrese el texto de la observacion que desee" id="observacion">
							</div>
						</div>

						@endif

						@if( $solicitud != false )
						<div class="row">
							<div class="col-sm-12 col-md-11 col-lg-11">
								<a role="recomendaciones" codigo="{{ $solicitud[0]->codigo }}" class="btn btn-danger acciones">
									<strong>VER ANALISIS / RECOMENDACION</strong>
								</a>
							</div>
						</div>
						<div class="row">
							
							<div class="col-sm-9 col-md-9 col-lg-9">
								<div class="table-responsive">
									<table class="table table-stripped">
										<thead>
											<tr>
												<th>Codigo</th>
												<th>Concepto</th>
												<th>Proveedor ganador</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<th>{{ $solicitud[0]->codigo }}</th>
												<th>{{ $solicitud[0]->concepto_solicitud }}</th>
												<th>
													<select name="proveedor_id" id="" class="form-control">
														<option value="">Elija uno</option>
													@foreach($solicitud as $sc)
														<option value="{{ $sc->proveedor_id }}">
															{{ $sc->proveedor->razon_social }}
														</option>
													@endforeach
													</select>
												</th>
											</tr>
										</tbody>

									</table>
								</div>
							</div>

						</div>

						<div class="row">
							<div class="col-sm-7 col-md-7 col-lg-7">
								<a role="guardarAnalisis" id="guardar" class="btn btn-primary">
									GUARDAR DATOS
								</a>
							</div>
						</div>
						@endif

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

<script src="{{ asset('js/compras/analisis.js') }}"></script>

<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection