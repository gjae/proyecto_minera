@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de requisiciones')
@section('contenedor')

<div class="row clearfix">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

<div class="card">
	
	<div class="body">
		<form action="#" method="post" id="form-requisicion">
			{{ csrf_field() }}
			<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
			<div class="container">
				<div class="row">
					<div class="col-sm-10 col-md-9 col-lg-9">
						
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover" id="dataTables-example">
								<thead>
									<tr>
										<th>CODIGO</th>
										<th>CONCEPTO</th>
										<th>TIPO</th>
										<th>ESTADO</th>
										<th>C. COSTOS</th>
										<th>E. PRODUC.</th>
										<th>ACCIONES</th>
									</tr>
								</thead>
								<tbody>
									@foreach($requisiciones as $requisicion)
										<tr>
											<td>{{ $requisicion->codigo_requisicion }}</td>
											<td>{{ $requisicion->concepto_requisicion }}</td>
											<td>{{ $requisicion->tipo_requisicion == 'BIENES' ? 'COMPRA': 'SERVICIOS' }}</td>
											<td>{{ $requisicion->estado_requisicion }}</td>
											<td>{{ $requisicion->centro_costo->nombre_centro }}</td>
											<td>{{ $requisicion->etapa_produccion->nombre_etapa }}</td>
											<td>
												<a class="btn btn-danger">
													ANULAR
												</a>
												<a  class="btn btn-primary">
													IMPRIMIR
												</a>
											</td>
										</tr>
									@endforeach
								</tbody>

							</table>		
						</div>

					</div>
				</div>
			</div>

		</form>
	</div>

</div>

</div>

</div>

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

<script src="{{ asset('js/requisiciones/requisicion.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection