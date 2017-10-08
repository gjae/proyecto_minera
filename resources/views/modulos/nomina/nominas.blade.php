@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de personal y nomina')
@section('contenedor')

<input type="hidden" id="modulo" value="nomina">
<input type="hidden" id="programa" value="Nomina">
<div class="row clearfix">

<section id="alert">
@if(Session::has('correcto'))

<div class="col sm-12 col-lg-12 col-md-12">
	<div class="alert alert-success">
		<strong>{{ Session::get('correcto') }}</strong>
	</div>
</div>
@elseif(Session::has('error'))

<div class="col sm-12 col-lg-12 col-md-12">
	<div class="alert alert-warning">
		<strong>{{ Session::get('error') }}</strong>
	</div>
</div>

@endif
</section>

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="table-responsive">

					<div class="row">
						<div class="col-sm-12 col-md-9 col-lg-9">
							<button type="button red pull-right" action="formularios" role="crearNomina" class="btn btn-default waves-effect m-r-20 actions">Abrir nomina</button>	
						</div>
					</div>
						
					<table class="table table-bordered table-striped table-hover" id="dataTables-example">
						<thead>
							<tr>
								<th width="14%">Codigo</th>
								<th width="18%">Periodo</th>
								<th>Estado</th>
								<th>Total (hasta la fecha)</th>
								<th>Total (deducciones hasta la fecha)</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach(App\Models\personal\Nomina::all() as $nomina)
								<tr>
									<td>
										{{ $nomina->codigo_nomina }}
									</td>
									<td>
										{{ $nomina->periodo_nomina->format('d-m-Y') }}
									</td>
									<td>
										{{ $nomina->estado_nomina }}
									</td>
									<td>
										<strong>COP$</strong>
										@if($nomina)
											{{ number_format($nomina->total_nomina, 2) }}
										@endif
									</td>
									<td>
										<strong>COP$</strong>
										{{ number_format($nomina->total_deducciones, 2) }}
									</td>
									<td>
										<a class="btn btn-success reportes"
											codigo-nomina="{{ $nomina->codigo_nomina }}"
											 role="tipoReporte"
										>
											<i class="material-icons">local_printshop</i>
											imprimir
										</a>

										@if( $nomina->estado_nomina == 'ABIERTA' )
										<a href="{{ url('dashboard/nomina/Nomina/trabajar?codigo_nomina='.$nomina->codigo_nomina) }}" class="btn btn-success">
											Trabajar
										</a>
										<a 
											nomina-id="{{ $nomina->id }}"
											class="btn btn-danger"
											id="cerrar" 
											token="{{ csrf_token() }}"
										>
											<strong>CERRAR</strong>
										</a>
										@endif


										<button type="button red pull-right" action="formularios"  action="formularios" role="reportes_nomina" nomina="{{ $nomina->codigo_nomina }}" class="btn btn-warning waves-effect m-r-20 actions">Reportes</button>
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
				<button type="button" id="reportes" class="btn btn-link waves-effect hidden">Generar reporte</button>
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
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection