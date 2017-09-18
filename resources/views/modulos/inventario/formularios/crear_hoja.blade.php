@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de persoal y nomina')
@section('contenedor')

<div class="row">

<div class="col-sm-12 col-lg-12 col-md-12">

@if(Session::has('error'))

<div class="alert alert-danger">
	<strong>{{ Session::get('error') }}</strong>
</div>

@else
<div class="alert alert success">
	<strong>{{ Session::get('correcto') }}</strong>
</div>

@endif	

</div>

</div>
<div class="row clearfix">
	<input type="hidden" id="token" value="{{ csrf_token() }}">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="container">
					<form action="#" method="post" id="ficha">
						<div class="row">
							<div class="col-sm-12 col-md-2 col-lg-2">
								<label for="">CODIGO</label>
								<input type="text" readonly value="{{ $material->codigo_material }}" class="form-control" name="codigo_material" id="codigo_material">
							</div>
							<div class="col-sm-12 col-lg-6 col-md-6">
								<label for="">DESCRIPCION DEL EQUIPO</label>
								<input type="text" readonly value="{{ $material->nombre_material }}" class="form-control" name="descripcion_material" id="descripcion_material">
							</div>
						</div>

						<div class="row">
							
							<div class="col-sm-6 col-md-3 col-lg-3">
								<label for="">SERVICIO</label>
								<input type="text" maxlength="160" pattern="/[a-zA-Z0-9_]/" required class="form-control" name="servicio" id="servicio">
							</div>
							<div class="col-sm-6 col-lg-3 col-md-3">
								<label for="">UBICACION</label>
								<select name="ubicacion_id" required id="ubicacion_id" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									@foreach(\App\Models\Ubicacion::all( ) as $ubicacion)
										<option value="{{ $ubicacion->id }}">{{ $ubicacion->nombre_ubicacion }}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-6 col-md-2 col-lg-2">
								<label for="">MARCA</label>
								<input type="text" maxlength="40" class="form-control" name="marca" required="" id="marca">
							</div>
							<div class="col-sm-6 col-md-2 col-lg-2">
								<label for="">MODELO</label>
								<input type="text" maxlength="40" name="modelo" required="" id="modelo" class="form-control">
							</div>
							<div class="col-sm-6 col-md-2 col-lg-2">
								<label for="">SERIE</label>
								<input type="text" name="serie" required="" id="serie" class="form-control">
							</div>
						</div>

						<div class="row">
							
							<div class="col-sm-6 col-md-8 col-lg-6">
								<label for="">SELECCIONE UN FABRICANTE</label>
								<select required name="fabricante_id" id="fabricante_id" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									@foreach(\App\Models\Fabricante::all() as $fabricante)
										<option value="{{ $fabricante->id }}">
											{{ $fabricante->nombre_fabricante }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<label for="">SELECCIONE UN DISTRIBUIDOR</label>
								<select name="distribuidor_id" required id="distribuidor_id" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									@foreach(\App\Models\Distribuidor::all() as $distribuidor)
										<option value="{{ $distribuidor->id }}">
											{{ $distribuidor->nombre_distribuidor }}
										</option>
									@endforeach
								</select>
							</div>
							
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">REPRESENTANTE</label>
								<input type="text" maxlength="160" class="form-control" name="representante" id="representante" value="REPRESENTANTE DE ADQUISICION">
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">CIUDAD DEL REPRESENTANTE</label>
								<select name="ciudad_representante" id="ciudad_representante" required class="form-control" required="">
									<option value="">-- SELECCIONE UNO --</option>
									@foreach(\App\Models\Ciudad::all() as $ciudad)
										<option value="{{ $ciudad->id }}">
											{{ $ciudad->nombre_ciudad }}
										</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">TELEFONO DEL REPRESENTANTE</label>
								<input type="text" maxlength="25" class="form-control" name="telefono_representante" id="telefono_representante">
							</div>
						</div>

						<div class="row">
							
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">AÑO DE FABRICACION</label>
								<input type="text" maxlength="4" minlength="4" required pattern="/\d/" class="form-control" name="anio_fabricacion" id="anio_fabricacion">
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">VALOR</label>
								<input type="number" class="form-control" name="valor" id="valor">
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">GARANTIA</label>
								<input type="number" pattern="/\d/" class="form-control" name="garantia" id="garantia">
							</div>

						</div>

						<div class="row">
							
							<div class="col-sm-4 col-md-4 col-lg-4">
								<label for="">FECHA DE COMPRA (DD-MM-AAAA O AAAA-MM-DD)</label>
								<input type="date" required class="form-control" name="fecha_compra" id="fecha_compbra">
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<label for="">FECHA DE INSTALACION (DD-MM-AAAA O AAAA-MM-DD)</label>
								<input type="date" class="form-control" name="fecha_instalacion" required id="fecha_instalacion">
							</div>
							<div class="col-sm-4 col-md-4 col-lg-4">
								<label for="">INICIO DE OPERACIONES (DD-MM-AAAA O AAAA-MM-DD)</label>
								<input type="date" class="form-control" name="fecha_inicio_operaciones" id="fecha_inicio_operaciones">
							</div>

						</div>

						<div class="row">
							
							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">FORMA DE ADQUISICION</label>
								<select required name="tipo_adquisicion" id="tipo_adquisicion" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="COMPRA">POR COMPRA</option>
									<option value="COMODATO">A COMODATO</option>
									<option value="DONACION">DONADO</option>
									<option value="CAMBIO">POR CAMBIO</option>
									<option value="C/PAGO">COMO MEDIO DE PAGO</option>
								</select>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">TIPO DE MANTENIMIENTO</label>
								<select name="tipo_mantenimiento" required id="tipo_mantenimiento" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="PREVENTIVO">PREVENTIVO</option>
									<option value="CORRECTIVO">CORRECTIVO</option>
									<option value="PREDICTIVO">PREDICTIVO</option>
								</select>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">MANTENIMIENTO</label>
								<select name="mantenimiento" id="mantenimiento" required class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="PROPIO">MANTENIMIENTO PROPIO</option>
									<option value="CONTRATADO">POR CONTRATO</option>
								</select>
							</div>

							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">FUENTE DE ENERGIA</label>
								<select required name="fuente_energia" id="fuente_energia" class="form-control">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="AGUA">AGUA</option>
									<option value="GAS">GAS</option>
									<option value="ELECTRICIDAD">ELECTRICIDAD</option>
									<option value="VAPOR">VAPOR</option>
									<option value="NUCLEAR">NUCLEAR</option>
									<option value="TERMICO">TERMICO</option>
									<option value="QUIMICO">QUIMICO</option>
									<option value="BIOLOGICO">BIOLOGICO</option>
									<option value="MECANICO">MECANICO</option>
								</select>
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">CALIFICACION POR USO</label>
								<select name="tipo_uso" id="tipo_uso" class="form-control" required="">
									<option value="">-- SELECCIONE UNO --</option>
									<option value="MEDICO">MEDICO</option>
									<option value="APOYO">DE APOYO</option>
									<option value="BASICO">BASICO</option>
								</select>
							</div>
							<div class="col-sm-4 col-lg-4 col-md-4">
								<label for="">EQUIPO</label>
								<select name="equipo" id="equipo" class="form-control" required>
									<option value="">-- SELECCIONE UNO --</option>
									<option value="FIJO">EQUIPO FIJO</option>
									<option value="MOVIL">EQUIPO MOVIBLE</option>
								</select>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-3 col-md-3 col-lg-3">
								<label for="">CALIFICACION BIOMEDICA</label>
								<select name="calif_biomedica" id="calif_biomedica" class="form-control" required>
									<option value="">-- SELECCIONE UNO --</option>
									<option value="NINGUNO"> NO APLICA </option>
									<option value="DIAGNOSTICO">EQUIPO DE DIAGNOSTICO MEDICO</option>
									<option value="TR/MANT-VID">TRATAMIENTO Y MANT. DE VIDA</option>
									<option value="PREVENCION">PREVENTIVO</option>
									<option value="REHABILITACION">EQUIPO DE REHABILITACION</option>
									<option value="ANL/LABORATORIO">ANALISIS DE LABORATORIO</option>
								</select>
							</div>
							<div class="col-sm-3 col-md-3 col-lg-3">
								

							</div>
							<div class="col-sm-3 col-md-3 col-lg-3">
								
							</div>
						</div>
					</form>
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
<script src="{{ asset('js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection