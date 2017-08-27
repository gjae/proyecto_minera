@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Trabajar nomina')
@section('contenedor')


<div class="row clearfix">
	
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	
<div class="card">
	
	<div class="body">
		
		<div class="container-fluid clearfix">
			<form action="#" method="post" id="nomina">
				{{ csrf_field() }}
				<section id="datos_nomina">
					<div class="row">
						
						<div class="col-sm-3">
							<label for="">Codigo de nomina</label>
							<input type="text" class="form-control" id="codigo_nomina" name="codigo_nomina" value="{{ $nomina->codigo_nomina }}" readonly="">
						</div>
						<div class="col-sm-3">
							<label for="">Periodo de la nomina</label>
							<input type="text" value="{{ $nomina->periodo_nomina->format('d-m-Y') }}" class="form-control" id="periodo_nomina" name="periodo_nomina" readonly="">
						</div>

					</div>

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
-<script src="{{ asset('js/personal/personal.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('js/demo.js') }}"></script>
@endsection