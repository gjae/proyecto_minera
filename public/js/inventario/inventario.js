$(document).ready(function(){
/*	$(".actions").on('click', function(){
		var btn = $(this)
		var url = location.href + '/formularios?formulario='+btn.attr('formulario');
		var modal = $("#modal-inventario")
		var id = $(this).attr('data-id');

		if( ( typeof(id) != undefined ) )
			url+='&id='+id

		if( $(this).attr('role') == 'reportes'){
			if(!$("#footer-datos").hasClass('hidden')){
				$("#footer-datos").addClass('hidden')
				$("#footer-reportes").removeClass('hidden')
			}
		}
		else{
			if( $("#footer-datos").hasClass('hidden')){
				
				$("#footer-datos").removeClass('hidden')
				$("#footer-reportes").addClass('hidden')
			}
		}
		modal.modal({show: true})
		$.get(url, {}, function(resp){
			if( !resp.error){
				$("#form-modal").html(resp.formulario)
			}
		})
	});
*/
	$("#salvar").on('click', function(resp){
		var datos = $("#form-modal").serialize()
		//alert(datos)
		if( datos.indexOf("=&") != -1 ){
			alert("EL FORMULARIO AUN TIENE DATOS SIN COMPLETAR, VERIFIQUE");
			return false;
		}
		else{
			var url = location.href + '/'+$("#accion").val()
			//alert(url)

			if(confirm("¿Seguro de guardar estos datos?")){
				$.post(url, datos, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload();
				})
			}
		}
	});

	$(".btn-options").on('click', function(){
		if( $(this).attr('role') == 'delete' ){
			if(confirm("¿Seguro que desea eliminar este item?")){
				var url = location.href+'/eliminarMaterial';
				$.post(url, {id: $(this).attr('data-id'), '_token': $("#token").val() }, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
	})

	$(".reportes").on('click', function(){
		if( $(this).attr('role') =='controlBodega' ){

			var ref = $("#ref")
			var url = location.href + '/'+$(this).attr('role');
			if( typeof(ref) != undefined )
			{
				var url = location.href +'/index.php/dashboard/inventario/reportes/datos_generales?ref='+ref.val()
			}

			window.open(url, "FORMATO DE CONTROL DE BODEGA"  ,"width=800,height=900")
		}

	})

	$(".reporte").on("click", function(){

		var datos = $("#form-modal")
		
		var tipo = $("#tipo_reporte").val();
		var url = 'http://'+location.host+'/index.php/dashboard/inventario/Reportes/'+$("#tipo_reporte").val()+'?material_id='+$("#material_reporte").val()
		url +=  '&fecha_desde='+$("#fecha_desde").val()+"&fecha_hasta="+$("#fecha_hasta").val()
		var ref = $("#ref")
		//alert(url)
		
		if( ref.val() != undefined ){
			var url = location.href+'/'+$("#tipo_reporte").val()+'?material_id='+$("#material_reporte").val()
			url +=  '&fecha_desde='+$("#fecha_desde").val()+"&fecha_hasta="+$("#fecha_hasta").val()
			url+='&ref='+ref.val()	
		}
		if( $("#proveedor_id").val() != undefined ){
			url+='&proveedor_id='+$("#proveedor_id").val()
		}

		if( $("#tipo_reporte").val()  == 'formatoNomina'){
			url+='&cedula='+$("#identificacion").val();
		}

		url+='&generar='+$("#tipo_reporte_generar").val();
		window.open(url, "INVITACIONES"  ,"width=800,height=900")	
	})
	$(".formularios").on('click', function(){
		var url = location.protocol+'//'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/formulario?form='+$(this).attr('formulario')
		
		var id = 0;
		if( $(this).attr('formulario') == 'editar_usuario'   ||  
			$(this).attr('formulario') == 'editar_categoria' ||
			$(this).attr('formulario') == 'autorizar_post'   ||
			$(this).attr('formulario') == 'retirar_autorizacion'

		)
			id = $(this).attr('data-id')

		$.getJSON(url+'&id='+id, {}, function(resp){
			if( !resp.error){
				
				var modal = $("#modal-usuarios");
				

				var footer = `
		            <div class="modal-footer">
		            	<div id="footer-datos">
			                <button type="submit" id="salvar" class="btn btn-link waves-effect">Guardar datos</button>
			                <a  class="btn btn-link waves-effect" data-dismiss="modal">Cerrar</a>
		                </div>
		            </div>

				`

				$("#form-modal").html(resp.formulario+footer);
				$("#form-modal").attr('action', resp.action)				

				modal.modal({show: true});
			}
		})
	})

	$(".eliminar").on('click', function(){
		if(confirm('¿SEGURO QUE DESEA REALIZAR ESTA ACCION?, UNA VEZ ACEPTADA NO PODRA REVERTIRSE'))
		{
			var url = location.protocol+'//'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/eliminar';
			$.post(url, {id: $(this).attr('data-id'), '_token': $("#token").val() }, function(resp){
				alert(resp.mensaje);
				if(! resp.error)
					location.reload()
			})
		}
		
	})
})

function buscar_tipo(event,select){
	// alert(select.value)
	var side_fechas = $("#rango_fechas")
	if( select.value == 'datos_generales' )
	{
		if( !side_fechas.hasClass('hidden')){
			$("#fecha_desde").val('01-01-2017')
			$("#fecha_hasta").val("01-01-2017");
			side_fechas.addClass('hidden')
		}
		var url = location.host+'/index.php/dashboard/inventario/reportes/'+select.value+'?material_id='+$("#material_reporte").val()
		if( $("#desde_form").val() !== undefined )
			url = location.host+'/index.php/dashboard/nomina/minas/'+select.value+'?material_id='+$("#material_reporte").val()
		var ref = $("#ref")
		if( ref.val() != undefined )	
			url+='&ref='+ref.val()	

		window.open('http://'+url, "INVITACIONES"  ,"width=800,height=900")
	}
	else if(select.value == 'actividad_en_fechas'){
		var side_fechas = $("#rango_fechas")
		
		if( side_fechas.hasClass('hidden') )
			side_fechas.removeClass('hidden')
		if( !$("#filtro_persona").hasClass('hiddden') )
			$("#filtro_persona").addClass('hidden')
		
	}

	if( select.value == 'formatoNomina' ){
		var filtro = $("#filtro_persona")
		
		if( filtro.hasClass('hidden') )
			filtro.removeClass('hidden')

		if( $("#rango_fechas").hasClass('hidden') )
			$("#rango_fechas").removeClass('hidden');

	}
}

function verificarClave(e, formulario){
	e.preventDefault();
	if( !( document.getElementById('password_1').value == document.getElementById('password_2').value) ){
		alert('AMBAS CLAVES DEBEN SER IGUALES');
		return false;
	}
	formulario.submit();
}


function actualizar(event, formulario){
	var pass = document.getElementById('password_1').value

	if( pass != '' ){
		if( !(pass == document.getElementById('password_2').value )){
			alert('AMBAS CLAVES DEBEN SER IDENTICAS');
			return false;
		}
	}

	formulario.submit();
}


        $(".actions").on('click', function(){
		//alert("gasdasd");  
              var btn = $(this)
                var url = location.href + '/formularios?formulario='+btn.attr('formulario');
                var modal = $("#modal-inventario")
                var id = $(this).attr('data-id');

                if( ( typeof(id) != undefined ) )
                        url+='&id='+id

                if( $(this).attr('role') == 'reportes'){
                        if(!$("#footer-datos").hasClass('hidden')){
                                $("#footer-datos").addClass('hidden')
                                $("#footer-reportes").removeClass('hidden')
                        }
                }
                else{
                        if( $("#footer-datos").hasClass('hidden')){

                                $("#footer-datos").removeClass('hidden')
                                $("#footer-reportes").addClass('hidden')
                        }
                }
                modal.modal({show: true})
                $.get(url, {}, function(resp){
                        if( !resp.error){
                                $("#form-modal").html(resp.formulario)
                        }
                })
        });


function calcularTotal(ev, field){
	var peso_en = document.getElementById('peso_en');
	var cantidad = document.getElementById('cantidad');
	var valor = document.getElementById('monto_tonelada')
	var total_movimiento = document.getElementById('total_movimiento');
	
//	alert('PESO EN '+peso_en.value+' CANTIDAD EN: '+cantidad.value+' VALOR: '+valor.value+' total: '+total_movimiento.value);

	switch(peso_en.value){
		case 'TON':{
			total_movimiento.value = (parseFloat(cantidad.value) * parseFloat(valor.value)).toFixed(2)
			break;
		}

		case 'K':{
			total_movimiento.value =( (parseFloat(cantidad.value)/1000) * parseFloat(valor.value) ).toFixed(2)
			break;
		}

		case 'GR': {
			var kg = ( parseFloat(cantidad.value) * 1 ) / 1000;
			total_movimiento.value =( (parseFloat(kg)/1000) * parseFloat(valor.value) ).toFixed(2)
			break;
		}
		default: {
			var total = ( parseFloat(cantidad.value) * parseFloat(valor.value));
			total_movimiento.value = total;
		}
	}
}

function click_option(event, boton){
		if( boton.getAttribute('role') == 'delete' ){
			if(confirm("¿Seguro que desea eliminar este item?")){
				var url = location.href+'/eliminarMaterial';
				$.post(url, {id: boton.getAttribute('data-id'), '_token': $("#token").val() }, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
}

function click_action(event, boton){
		var btn = boton
		var url = location.href + '/formularios?formulario='+btn.getAttribute('formulario');
		var modal = $("#modal-inventario")
		var id = boton.getAttribute('data-id');

		if( ( typeof(id) != undefined ) )
			url+='&id='+id

		if( boton.getAttribute('role') == 'reportes'){
			if(!$("#footer-datos").hasClass('hidden')){
				$("#footer-datos").addClass('hidden')
				$("#footer-reportes").removeClass('hidden')
			}
		}
		else{
			if( $("#footer-datos").hasClass('hidden')){
				
				$("#footer-datos").removeClass('hidden')
				$("#footer-reportes").addClass('hidden')
			}
		}
		modal.modal({show: true})
		$.get(url, {}, function(resp){
			if( !resp.error){
				$("#form-modal").html(resp.formulario)
			}
		})
}
