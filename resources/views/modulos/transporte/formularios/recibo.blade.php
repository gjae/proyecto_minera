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
		<form action="{{ url('dashboard/viajes/registrar/guardar_recibo') }}" method="post" id="form">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<div class="container">
				<div class="row">
					<div class="col-sm-7 col-lg-7 col-md-7">
						<a role="buscar_vehiculos_recibo" class="btn btn-primary acciones">
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
							<label for="">CODIGO / REMESA</label>
							<input type="text"  style="text-align: center;" value="{{ App\Models\Recibo::getNewCode() }}" class="form-control" name="nro_factura" id="nro_factura">
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
						<div class="col-sm-3 col-lg-43col-md-3">
							<label for="">ORIGEN</label>
							<input type="text" placeholder="LUGAR DE SALIDA" style="text-align: center;" class="form-control" maxlength="160" name="procedencia" id="procedencia">
						</div>
						<div class="col-sm-3 col-lg-3 col-md-3">
							<label for="">DESTINO</label>
							<input type="text" class="form-control" maxlength="160" placeholder="DESTINO DEL VIAJE" style="text-align: center;" name="destino" id="destino">
						</div>
						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">NRO. REMISION</label>
							<input type="text" placeholder="NRO. DE REMISION DEL CLIENTE" maxlength="17" class="form-control" name="remision_cli" id="remision_cli">
						</div>

						<div class="col-sm-3 col-md-3 col-lg-3">
							<label for="">CIUDAD</label>
							<select name='ciudad_id' class="form-control">
								@foreach(App\Models\Ciudad::where('edo_ciudad', 1)->get() as $ciudad)
									<option value="{{ $ciudad->id}}">{{ $ciudad->nombre_ciudad }} </option>
								@endforeach
							</select>
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
