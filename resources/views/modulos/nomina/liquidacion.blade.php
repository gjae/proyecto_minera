@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo personal - Liquidacion de personal')
@section('contenedor')

<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<form action="{{ url('dashboard/nomina/liquidacion/procesar') }}" onsubmit="guardar(event, this)" id="formulario" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="persona_id" value="{{ $persona->id }}">
					<div class="container">
						<div class="row">
							<div class="col-sm-11 col-lg-11 col-md-11">
								<h3 class="page-header">DATOS DE CALCULO</h3>
							</div>
						</div>
						<div class="row">
							
							<div class="col-sm-5 col-lg-4 col-md-4">
								<label for="">FECHA DE RETIRO (FORMATO DD-MM-AAAA)</label>
								<input type="date" pattern="[0-9]{2}\-[0-9]{2}\-[0-9]{4}" required placeholder="FECHA DE RETIRO DEL EMPLEADO" class="form-control" name="fecha_retiro" id="fecha_retiro">
							</div>
							<div class="col-sm-4 col-lg-3 col-md-3">
								<label for="">PORCENTAJE DE INTERESES</label>
								<input type="number" required name="porcentaje_intereses" id="porcentaje_intereses" class="form-control">
							</div>
							<div class="col-sm-3 col-lg-3 col-md-3">
								<label for="">SUELDO BASE</label>
								<input type="text" readonly value="{{ $persona->sueldo_basico }}" class="form-control" name="sueldo_base" id="sueldo_base">
							</div>
							<div class="col-sm-3 col-lg-3 col-md-3">
								<label for="">DIAS DE LIQUIDACION</label>
								<input type="number" required pattern="/^\d/" class="form-control" name="dias_liquidacion" id="dias_liquidacion">
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">RAZON DE RETIRO</label>
								<select name="razon_retiro" id="razon_retiro" class="form-control" required>
									<option value="">-- SELECCIONE UNO --</option>
									<option value="ENFERMEDAD">ENFERMEDAD</option>
									<option value="DESPIDO">DESPIDO</option>
									<option value="VOLUNTARIO">RETIRO VOLUNTARIO</option>
									<option value="FIN_CONTRATACION">FINALIZACION DE CONTRATO</option>
								</select>
							</div>

						</div>
						<div class="row">
							<div class="col-sm-11 col-lg-11-col-md-11">
								<h3 class="page-header">AJUSTES ASIGNADOS</h3>
							</div>
							<div class="col-sm-11 col-lg-11 col-md-11">
								<p> POR FAVOR, SELECCIONE LOS AJUSTES QUE SE LE ASIGNARAN AL EMPLEADO PARA LA LIQUIDACION </p>
							</div>
						</div>
						<div class="row">
							@foreach($persona->ajustes as $key => $ajuste )
								<div class="col-sm-5 col-lg- 3 col-md-3">
									<label for=""> {{ $ajuste->ajuste->nombre_ajuste }} </label>
									<select name="ajustes[]" id="" class="form-control" key="{{ $key }}" required>
										<option value="">-- SELECCIONE --</option>
										<option 
											tipo="{{ $ajuste->ajuste->cantidad_ajuste > 0 ? 'CANTIDAD' : 'PORCENTAJE' }}"
											value="{{ $ajuste->id }}">AGREGAR</option>
										<option value="-">QUITAR</option>
									</select>
								</div>
							@endforeach
						</div>

						<div class="row">
							
							<div class="col-sm-5 col-lg-5 col-md-5">
								<button class="btn btn-success" type="submit"> 
									<strong>GUARDAR LIQUIDACION</strong>
								</button>
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
<script src="{{ asset('js/personal/liquidacion.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection