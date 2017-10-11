@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de requisiciones')
@section('contenedor')

<input type="hidden" id="modulo" value="viajes">
<input type="hidden" id="programa" value="registrar">
<div class="row clearfix">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

@if(Session::has('correcto'))
<div class="alert alert-success">
	<strong>
		{{ Session::get('correcto') }}
	</strong>
</div>
@elseif( Session::has('error') )
<div class="alert alert-danger">
	<strong>
		{{ Session::get('correcto') }}
	</strong>
</div>
@endif
<div class="card">
	
	<div class="body">
		<form action="{{ url('dashboard/viajes/registrar/guardar') }}" method="post" id="form">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-lg-7 col-md-7">
						<a role="buscar_vehiculos" class="btn btn-primary acciones">
							<strong>BUSCAR VEHICULO</strong>
						</a>
						@if( !is_bool($vehiculo) )
							<strong>{{ $vehiculo->placa }}</strong>
							<input type="hidden" name="vehiculo_id" value="{{ $vehiculo->id }}">
							<input type="hidden" id="capacidad_carega" value="{{ $vehiculo->capacidad_carga }}">
							<input type="hidden" required name="persona_id" id="persona_id" value="0">
						@endif
					</div>
					<div class="col-sm-3 col-lg-3 col-md-3">
						<a role="buscar_personas" class="btn btn-primary acciones">
							<strong>PERSONA</strong>
						</a>
						<strong id="persona"></strong>
					</div>
				</div>

				@if( !is_bool($vehiculo))
					<div class="row">
						<div class="col-sm-2 col-md-2 col-lg-2 offset-md-4 offset-lg-4 offset-sm-4">
							<label for="">CODIGO / FACTURA</label>
							<input type="text"  style="text-align: center;" value="{{ \App\Models\transporte\Transporte::getNewCode() }}" class="form-control" name="nro_factura" id="nro_factura">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TIPO DE MATERIAL</label>
							<select required name="tipo_material_id" id="tipo_material_id" class="form-control">
								<option value="">-- SELECCIONE UNO --</option>
								@foreach(\App\Models\inventario\TipoMaterial::where('edo_reg', 1)->get() as $tipo)
									<option value="{{ $tipo->id }}">
										{{ $tipo->descripcion_tipo }}
									</option>
								@endforeach
							</select>
						</div>
						<div class="col-sm-5 col-lg-5 col-md-5">
							<label for="">RECIBO</label>
							<input type="text" maxlength="10" required placeholder="RECIBO DEL VIAJE" style="text-align: center;" class="form-control" name="recibo" id="recibo">
						</div>
					</div>
					<div class="row">

						<div class="col-sm-9 col-lg-9 col-md-9">
							<label for="">CONCEPTO DEL VIAJE</label>
							<input type="text" class="form-control" name="concepto_viaje" id="concepto_viaje">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-3 col-lg-43col-md-3">
							<label for="">ORIGEN</label>
							<input type="text" placeholder="LUGAR DE SALIDA" style="text-align: center;" class="form-control" maxlength="160" name="procedencia" id="procedencia">
						</div>
						<div class="col-sm-3 col-lg-3 col-md-3">
							<label for="">DESTINO</label>
							<input type="text" class="form-control" maxlength="160" placeholder="DESTINO DEL VIAJE" style="text-align: center;" name="destino" id="destino">
						</div>
						<div class="col-sm-3 col-lg-3 col-md-3">
							<label for="">DISTANCIA ESTIMADA (KM)</label>
							<input type="text" class="form-control" maxlength="160" placeholder="DESTINO DEL VIAJE" style="text-align: center;" name="distancia_recorrida" id="distancia_recorrida" value="0">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">COSTO / KM</label>
							<input type="text" style="text-align: center;" placeholder="PRECIO / KM" value="0" class="form-control" name="total_km_viaje" id="total_km_viaje">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-4 col-md-4 col-lg-4">
							<label for="">FECHA DE SALIDA</label>
							<input type="date" placeholder="FECHA DE SALIDA FORMATO DD-MM-AAAA" class="form-control" name="fecha_salida" id="fecha_salida">
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<label for="">FECHA DE LLEGADA</label>
							<input type="date" placeholder="FECHA DE LLEGADA AL DESTINO FORMATO DD-MM-AAAA" class="form-control" name="fecha_llegada" id="fecha_llegada">
						</div>
					</div>

					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">VALOR DE COMBUSTIBLE</label>
							<input type="text" placeholder="MONTO POR LTS" class="form-control" onkeyup="calcularCombustible()" required name="precio_x_lts_combustible" id="precio_x_lts_combustible">
						</div>	
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">COMPUSTIBLE USADO</label>
							<input type="text" value="0" required placeholder="LTS USADOS PARA EL VIAJE" onkeyup="calcularCombustible()" class="form-control" name="combustible_viaje" id="combustible_viaje">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TOTAL EN COMBUSTIBLE</label>
							<input type="text" value="0" required readonly class="form-control" name="precio_combustible" id="precio_combustible">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">PESO DEL VIAJE (KG)</label>
							<input type="text" value="0" onkeyup="calcularPeso()" required class="form-control" name="kilo_viajes" id="kilo_viajes">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">VALOR / KG</label>
							<input type="text" value="0" onkeyup="calcularPeso()" required class="form-control" name="precio_kilo" id="precio_kilo">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TOTAL EN KG DEL VIAJE</label>
							<input type="text" readonly value="0" required class="form-control" name="total_peso_viaje" id="total_peso_viaje">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TOTAL DE KILOS DE MATERIAL</label>
							<input type="text" value="0" class="form-control" required="" name="total_kilo_material" onkeyup="calcularMaterial()" id="total_kilo_material">
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<label for="">COSTO DEL FLETE / KG MATERIAL</label>
							<input type="text" onkeyup="calcularMaterial()" required value="0" class="form-control" name="total_kilo_viaje_material" id="total_kilo_viaje_material">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TOTAL FLETE / MATERIAL</label>
							<input type="text" readonly value="0" class="form-control" name="total_viaje_kilos" id="total_viaje_kilos">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9 col-md-9 col-lg-9">
							<h3 class="page-header">DATOS DEL CLIENTE</h3>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">RAZON SOCIAL DEL CLIENTE</label>
							<input type="text" class="form-control" maxlength="200" placeholder="RAZON SOCIAL" class="form-conrol" name="razon_social_cliente" id="razon_social_cliente">
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<label for="">IDENTIFICACION DEL CLIENTE</label>
							<input type="text" maxlength="22" minlength="7" placeholder="IDENTIFICACION DEL CLIENTE" class="form-control" name="ident_cliente" id="ident_cliente">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">NRO. REMISION</label>
							<input type="text" placeholder="NRO. DE REMISION DEL CLIENTE" maxlength="17" class="form-control" name="remision_cli" id="remision_cli">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">TELEFONO DEL CLIENTE</label>
							<input type="tel" required class="form-control" name="telefono_cliente" id="telefono_cliente">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">NIT DEL CLIENTE</label>
							<input type="text" placeholder="NIT DEL CLIENTE" maxlength="23" class="form-control" name="nit_cliente" id="nit_cliente">
						</div>
						<div class="col-sm-4 col-md-4 col-lg-4">
							<label for="">CORREO ELECTRONICO</label>
							<input required type="email" class="form-control" name="email_cliente" placeholder="DIRECCION EMAIL DEL CLIENTE">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-5 col-lg-5 col-md-5">
							<button type="submit" class="btn btn-success">
								<strong>SALVAR DATOS</strong>
							</button>
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

@endsection