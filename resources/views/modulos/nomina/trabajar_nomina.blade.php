@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Trabajar nomina')
@section('contenedor')


<input type="hidden" id="modulo" value="nomina">
<input type="hidden" id="programa" value="Nomina">
<div class="row clearfix">
<input type="hidden" id="codigo_nomina" value="{{ $codigo_nomina }}">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="card">
	
	<div class="body">
		
		<div class="container-fluid clearfix">
			<form action="#" method="post" id="nomina">
				{{ csrf_field() }}
				@if(! is_bool($persona)  )
					<input type="hidden" name="persona_id" value="{{ $persona->id }}">
					<input type="hidden" name="nomina_id" value="{{ $nomina->id }}">
				@endif
				<section id="datos_nomina">
					<div class="row">
						
						<div class="col-sm-3 col-md-4 col-lg-4">
							<label for="">Codigo de nomina</label>
							<input type="text" class="form-control" id="codigo_nomina" name="codigo_nomina" value="{{ $nomina->codigo_nomina }}" readonly="">
						</div>
						<div class="col-sm-3 col-md-4 col-lg-4">
							<label for="">Periodo de la nomina</label>
							<input type="text" value="{{ $nomina->periodo_nomina->format('d-m-Y') }}" class="form-control" id="periodo_nomina" name="periodo_nomina" readonly="">
						</div>
						<div class="col-sm-3 col-md-4 col-lg-4">
							<a role="buscarPersonas" id="agregar_persona" class="btn btn-success">
								<strong>CARGAR PERSONA</strong>
							</a>
							@if(! is_bool($persona))
							<span>
								<strong>{{ $persona->primer_nombre.' '.$persona->primer_apellido }}</strong>
							</span>
							@endif
						</div>

					</div>
					@if(! is_bool($persona))
					<div class="row">
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">Sueldo base (MENSUAL)</label>
							<input type="text" class="form-control" readonly value="{{ $persona->sueldo_basico }}">
						</div>
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">Monto en esta nomina</label>
							<input type="text" readonly id="total_persona" class="form-control" value="{{ $total_para_nomina }}">
						</div>
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">Monto total en bonos</label>
							<input type="text" value="{{ $totales['total_bonos'] }}" readonly id="total_bonos" name="total_bonos" class="form-control" value="0">
						</div>
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">Monto total en deducciones</label>
							<input type="text" value="{{ $totales['total_deducciones'] }}"  readonly name="total_deducciones" id="total_deducciones" class="form-control" value="0">
						</div>
						<div class="col-sm-12 col-md-2 col-lg-2">
							<label for="">Monto total a cobrar</label>
							<input type="text" value="{{ ( $total_para_nomina - $totales['total_deducciones'] ) + $totales['total_bonos'] }}" readonly id="total" name="total_pagar" class="form-control" value="0">
						</div>
					</div>
					<div class="row">
						@foreach($persona->ajustes as $key => $ajuste)

							<div class="col-sm-12 col-md-3 col-lg-3">
								<label for="">{{ $ajuste->ajuste->nombre_ajuste }}</label>
								<select name="ajustes[]" key="{{$key}}" 
										onchange="calcularMonto(event, this)" 
										medio="{{ ($ajuste->ajuste->porcentaje_ajuste > 0) ? 'PORCENTAJE' :'CANTIDAD' }}" 
										tipo="{{ $ajuste->ajuste->tipo_ajuste }}" 
										monto="{{ ($ajuste->ajuste->porcentaje_ajuste > 0) ? $ajuste->ajuste->porcentaje_ajuste : $ajuste->ajuste->cantidad_ajuste }}" 
										id="ajuste{{$key}}" class="form-control">
									<option value="0">QUITAR</option>
									<option {{ ($ajuste->ajuste->ajuste_permanente == 'SI')? 'SELECTED' : '' }} value="{{ $ajuste->id }}">AGREGAR</option>
								</select>
							</div>
							<div class="col-sm-12 col-md-3 col-lg-3">
								<label for="">MONTO DEL AJUSTE</label>
								<input type="text" required class="form-control" name="costos[]">
							</div>

						@endforeach
		
					</div>
					<div class="row">
						<div class="col-sm-12 col-lg-9 col-md-9">
							<a class="btn btn-primary" id="guardarTrabajo" role="guardarTrabajo" formulario="nomina">
								<strong>SALVAR TRABAJO</strong>
							</a>
						</div>
					</div>

					@endif
				</section>


			</form>
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


<script src="{{ asset('js/personal/ajustes.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
@endsection