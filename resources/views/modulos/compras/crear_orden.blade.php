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
				
				<form action="#" method="post" id="emision">
                {{ csrf_field() }}
					<div class="container">
                        <div class="row">
                            
                            <div class="col-sm-12 col-lg-3 col-md-3">
                                
                                <a class="btn btn-success acciones" role="buscarAnalisis">
                                    <strong>AGREGAR ANALISIS</strong>
                                </a>

                            </div>
                            @if( !is_bool($analisis) )
                            <input type="hidden" name="proveedor_id" value="{{ $analisis->proveedor_id }}">
                                <div class="col-sm-12 col-lg-2 col-md-2">
                                    <label for="">Analisis / codigo</label>
                                 <input type="text" style="text-align: center;" name="codigo_analisis" readonly="" id="codigo_analisis" value="{{ $analisis->codigo }}" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <label for="">FORMA DE PAGO</label>
                                    <input type="text" style="text-align: center;" value="{{ $analisis->cotizacion->forma_pago }}" class="form-control" name="forma_pago" readonly="" id="forma_pago">
                                </div>
                                <div class="col-sm-9 col-md-2 col-lg-2">
                                    <label for="">Proveedor</label>
                                    <input type="text" style="text-align: center;"  value="{{ $analisis->proveedor->razon_social }}" class="form-control" name="proveedor" readonly="" id="proveedor">
                                </div>
                                <div class="col-sm-6 col-sm-4 col-lg-4">
                                    <label for="">CODIGO DE ORDEN</label>
                                    <input type="text" style="text-align: center;"  value="{{ $codigo_orden }}" class="form-control" name="codigo_orden" readonly="" id="codigo_orden">
                                </div>
                                <div class="col-sm-6 col-sm-4 col-lg-4">
                                    <label for="">TIPO DE ORDEN</label>
                                    <input type="text" style="text-align: center;"  value="{{ $tipo }}" class="form-control" name="tipo_orden" readonly="" id="tipo_orden">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <label for="">OBJETO Y CONSIDERACIONES</label>
                                    <input type="text" name="concepto" id="concepto" class="form-control">
                                </div>
                            @endif
                        </div>

                        @if(! is_bool($analisis))
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="">TIEMPO DE PAGO DE FACTURA</label>
                                        <input type="number" name="tiempo_pago" class="form-control" id="tiempo_pago">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="">FECHA DE INICIO DEL TRABAJO (AAAA-MM--DD)</label>
                                        <input type="date" name="fecha_inicio" class="form-control" id="date">
                                    </div>
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="">FECHA DE FIN DEL TRABAJO (AAAA-MM--DD)</label>
                                        <input type="date" name="fecha_fin" class="form-control" id="date">
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <!--LADO DEL PROVEEDOR -->
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="row">
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h3 class="page-header">Datos del contratista</h3>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="DIR"> DIR: </label>
                                            <input type="text" class="form-control" name="contta_dir" id="contta_dir">
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="DIR"> NIT / CC </label>
                                            <input type="text" class="form-control" name="contta_nit_cc" id="contta_nit_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="DIR"> RESPONSABLE LEGAL </label>
                                            <input type="text" class="form-control" name="contta_resp_legal" id="contta_rep_legal">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contta_resp" id="contta_resp">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> NIT / CC </label>
                                            <input type="text" class="form-control" name="contta_nit_cc" id="contta_nit_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> CC RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contta_resp_cc" id="contta_resp_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> EMAIL / RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contta_resp_email" id="contta_resp_email">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> CARGO DEL RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contta_resp_cargo" id="contta_resp_cargo">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> TLF. RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contta_rep_telf" id="contta_rep_telf">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-6 col-md-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <h3 class="page-header">Datos del contratante</h3>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="">NOMBRE DEL CONTRATANTE</label>
                                            <input type="text" class="form-control" name="contte_nombre" id="contte_nombre">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="">NIT / CC CONTRATANTE</label>
                                            <input type="text" class="form-control" name="contte_nit_cc" id="contte_nit_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> DIR: </label>
                                            <input type="text" class="form-control" name="contte_dir" id="contte_dir">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> TLF. CONTRATANTE </label>
                                            <input type="text" class="form-control" name="contte_telefono" id="contte_telfono">
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="DIR"> NIT / CC </label>
                                            <input type="text" class="form-control" name="contte_nit_cc" id="contte_nit_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <label for="DIR"> RESPONSABLE LEGAL </label>
                                            <input type="text" class="form-control" name="contte_rep_legal" id="contte_rep_legal">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contte_resp" id="contte_resp">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> NIT / CC </label>
                                            <input type="text" class="form-control" name="contte_cc" id="contte_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> CC RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contte_resp_cc" id="contte_resp_cc">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> EMAIL / RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contte_resp_email" id="contte_resp_email">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> CARGO DEL RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contte_resp_cargo" id="contte_resp_cargo">
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6">
                                            <label for="DIR"> TLF. RESPONSABLE </label>
                                            <input type="text" class="form-control" name="contte_rep_telf" id="contte_resp_telf">
                                        </div>
                                    </div>
                                </div>

                                <!-- FIN DEL LADO DEL PROVEEDOR -->
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 col-lg-4">
                                        <label for="">MES ANTICIPADO</label>
                                        <select name="mes_anticipo" id="mes_anticipo" class="form-control">
                                            <option value="M">NO</option>
                                            <option value="S">SI</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8 col-md-12 col-lg-12">
                                        <h3 class="page-header">Detalles de la orden</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>DESCRIPCION</th>
                                                        <th>UND</th>
                                                        <th>CANT</th>
                                                        <th>VR / UNIT</th>
                                                        <th>VR / TOTAL</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($ac_totales as $key => $detalle)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>
                                                                {{ $detalle->cotizacion->material->nombre_material }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle->cotizacion->material->unidad_medida->codigo_unidad }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle->cotizacion->cantidad }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle->cotizacion->cotizacion }}
                                                            </td>
                                                            <td>
                                                                {{ $detalle->cotizacion->cotizacion * $detalle->cotizacion->cantidad}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>                                                
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    
                                </div>
    

                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">TOTAL ANTES DE DESCUENTO</label>
                                        <input type="text" value="{{ $sub_total }}" class="form-control" name="total_sin_descuento" readonly="" id="total_sin_descuento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">MONTO DE DESCUENTO</label>
                                        <input type="text" onkeyup="calcularSubTotal(event, this)" class="form-control" value="0" name="descuento" id="descuento">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">SUBTOTAL</label>
                                        <input type="text" value="{{ $sub_total }}" class="form-control" name="subtotal" readonly="" id="subtotal">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">IVA</label>
                                        <input type="text" value="{{ $iva }}" class="form-control" name="iva" readonly="" id="iva">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">RETEFUENTE</label>
                                        <input type="text" onkeyup="calcularSubTotal(event, this)" class="form-control" value="0" name="retefuente" id="retefuente">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-4 col-lg-4">
                                        <label for="">TOTAL</label>
                                        <input type="text" value="{{ ($sub_total + $iva) }}" class="form-control" name="total" id="total">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9 col-md-5 col-lg-5">
                                        <a id="guardar" class="btn btn-success">
                                            <strong>GUARDAR ORDEN</strong>
                                        </a>
                                    </div>
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
</script>
@endsection