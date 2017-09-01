@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras y serivicios - invitaciones')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="invitaciones">
<input type="hidden" id="accion" value="buscarProveedores">
<div class="row clearfix">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
				<div class="container">
					<form action="#" method="post" id="invitacion">
						{{ csrf_field() }}
						<div class="row">
							<div class="col-sm-12 col-md-2 col-lg-2">
								<label for="">Codigo</label>
								<input type="text" value="{{ $codigo }}" class="form-control" id="codigo" name="codigo" readonly="">
							</div>
							<div class="col-sm-12 col-md-2 col-lg-2">
								<label for="">Estado</label>
								<input type="text" class="form-control" name="estado_registro" value="ACTIVA" readonly="" id="estado_registro">
							</div>
							<div class="col-sm-12 col-md-5 col-lg-5">
								<label for="">Concepto de la invitacion</label>
								<input type="text" class="form-control" name="concepto_solicitud" placeholder="Ingrese el concepto de esta invitacion">
							</div>
						</div>
						<div class="row">
							<a class="btn btn-primary actions" role="buscarProveedores">
								Agregar proveedores
							</a>
						</div>
						<div class="row">
								
							<div class="col-sm-12 col-md-9 col-lg-9">
								<h3 class="page-header">Proveedores invitados</h3>
								<table class="table table-stripped">
									<thead>
										<tr>
											<th>Razon social</th>
											<th>Identificacion</th>
											<th>Cedula</th>
											<th>Telefono</th>
										</tr>
									</thead>
									<tbody id="proveedores"></tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<a class="btn btn-primary actions" role="buscarRequisiciones">
									Agregar requisicion
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-9 col-lg-9">
								<h3 class="page-header">Requisicion</h3>
								<table class="table table-stripped">
									<thead>
										<tr>
											<th>Codigo</th>
											<th>Concepto</th>
											<th>Tipo</th>
											<th>Total COP$</th>
										</tr>
									</thead>
									<tbody id="table-requisiciones"></tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<br>
							<div class="col-sm-12 col-md-9 col-lg-9">
								<a class="btn btn-success" id="guardar" role="guardarInvitacion" form-id="invitacion">
									GUARDAR DATOS
								</a>
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

<script src="{{ asset('js/compras/solicitudes.js') }}"></script>

<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});
</script>
@endsection