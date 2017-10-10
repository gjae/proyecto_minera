@extends('index')

@section('css')
 <!-- JQuery DataTable Css -->
<link href="{{ asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">

@endsection

@section('titulo', 'Modulo de compras y serivicios - emitir')
@section('contenedor')

<input type="hidden" id="modulo" value="compras">
<input type="hidden" id="programa" value="Ordenes">
<input type="hidden" id="accion" value="buscarProveedores">
<div class="row clearfix">
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="card">
			<div class="body">
				
				<form action="{{ url('dashboard/compras/ordenes/guardar_archivos') }}" enctype="multipart/form-data" method="post" id="emision">
                {{ csrf_field() }}
                <input type="hidden" name="orden_id" value="{{ $orden->id }}">
                    <div id="archivos">
    					<div class="row">
                            <div class="col-sm-12 col-lg-5  col-md-5 ">
                                <label for="">ARCHIVO</label>
                                <input type="file" name="archivos[]" onchange="otro(event, this)" class="form-control">
                            </div>
                            <div class="col-sm-12 col-lg-5 col-md-5 ">
                                <label for="">COMENTARIO DEL ARCHIVO</label>
                                <input type="text" name="comentarios[]" id="comentarios" class="form-control">
                            </div>               
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-5">
                            <input type="submit" value="cargar" class="btn btn-success">
                        </div>
                    </div>
				</form>

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
<script src="{{ asset('js/compras/ordenes.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script>
$('#dataTables-example').DataTable({
    responsive: true
});

function otro(ev, field){
    var inps = `
        <div class="row">
            <div class="col-sm-12 col-lg-5  col-md-5 ">
                <label for="">ARCHIVO</label>
                <input type="file" name="archivos[]" onchange="otro(event, this)" class="form-control">
            </div>
            <div class="col-sm-12 col-lg-5 col-md-5 ">
                <label for="">COMENTARIO DEL ARCHIVO</label>
                <input type="text" name="comentarios[]" id="comentarios" class="form-control">
            </div>               
        </div>
    `
    $("#archivos").append(inps)
}

</script>
@endsection