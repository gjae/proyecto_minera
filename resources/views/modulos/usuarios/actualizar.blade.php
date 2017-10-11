@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('public/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Listado de usuarios del sistema')
@section('contenedor')

<div class="row">

<div class="col-sm-12 col-lg-12 col-md-12">

@if(Session::has('error'))

<div class="alert alert-danger">
	<strong>{{ Session::get('error') }}</strong>
</div>

@elseif( Session::has('correcto') )
<div class="alert alert-success">
	<strong>{{ Session::get('correcto') }}</strong>
</div>

@endif	

</div>

</div>
<input id="modulo" value="usuarios" type="hidden">
<input type="hidden" id="programa" value="usuarios">
<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				<div class="container-fluid">
					<form action="{{ url('dashboard/usuarios/usuarios/crud/editar') }}">
						<div class="row">
							<input type="hidden" name="accion" value="editar" id="accion">
							{{ csrf_field() }}
							<input type="hidden" name="user_id" value="{{ $user->id }}">
							<div class="col-sm-12 col-md-5 col-lg-5">
								<label for="">NOMBRE(s)</label>
								<input type="text" value="{{ $user->nombre }}" maxlength="170" required name="nombre" id="nombre" class="form-control">
							</div>
							<div class="col-sm-12 col-md-5 col-lg-5">
								<label for="">APELLIDO(s)</label>
								<input type="text" value="{{ $user->apellido }}" maxlength="170" required name="apellido" id="apellido" class="form-control">
							</div>

						</div>

						<div class="row">
							<div class="col-sm-12 col-lg-5 col-md-5">
								<label for="">NOMBRE DE USUARIO</label>
								<input type="text" readonly value="{{ $user->email }}" maxlength="100" class="form-control" required name="email" id="email">
							</div>
							<div class="col-sm-12 col-lg-5 col-md-5">
								<label for="">TIPO DE USUARIO</label>
								<select readonly name="tipo_usuario" required id="tipo_usuario" class="form-control">
									<option value="">-- SELECCIONE UNA --</option>
									<option {{ $user->tipo_usuario == 'ADMINISTRADOR' ? 'selected' : '' }} value="ADMIN">ADMINISTRADOR</option>
									<option {{ $user->tipo_usuario == 'USUARIO' ? 'selected' : '' }} value="USER">USUARIO</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-lg-5 col-md-5">
								<label for="">INGRESE UNA CLAVE (PARA CAMBIO DE CLAVE)</label>
								<input type="password" minlength="6" maxlength="12" name="password" class="form-control" id="password_1">
							</div>
							<div class="col-sm-12 col-lg-5 col-md-5">
								<label for="">REPITA LA CLAVE (PARA CAMBIO DE CLAVE)</label>
								<input type="password" minlength="6" maxlength="12" name="password2" class="form-control" id="password_2">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-12 col-lg-12">
								<button class="btn btn-success" type="submit">
									<strong>SALVAR</strong>
								</button>
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
	<div class="modal fade" id="modal-usuarios" tabindex="-1" role="dialog">
	    <div class="modal-dialog modal-lg" role="document">
	        <div class="modal-content">
	           	<div class="modal-header">
	                <h4 class="modal-title" id="largeModalLabel">Gestion de usuarios</h4>
	            </div>
	            <div class="modal-body">
	             	<form action="#" method="post" id="form-modal">
	             		
	             	</form>
	            </div>
	   		</div>
	    </div>
	</div>
</section>
@endsection
@section('jquery')
<!-- Jquery DataTable Plugin Js -->
<script src="{{ asset('public/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/jszip.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
<script src="{{ asset('public/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>
<script src="{{ asset('public/js/inventario/inventario.js') }}"></script>
    <!-- Demo Js -->
<script src="{{ asset('public/js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function eliminar(e, boton){
	if(confirm('¿Usted esta seguro de eliminar esta publicacion?, una vez realizada esta accion no podra ser reversada')){
		var url = 'http://'+location.host+'/dashboard/publicaciones/publicaciones/eliminar'

		var token = document.getElementById('token').value
		$.post(url, {'id': boton.getAttribute('data-id'), '_token':token}, function(resp){
			alert(resp.mensaje)
			if(! resp.error)
				location.reload()
		})
	}
}

</script>
@endsection