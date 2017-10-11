$(document).ready(function(){

	$(".actions").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		var modal = $("#modal-compras");
		$.getJSON(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true});
			}
		})
	});

	$("#buscarInvitacion").on('click', function(){
		if( $("#proveedor_id").val() == "" ){
			alert("NO SE HA AGREGADO UN PROVEEDOR")
			return false;
		}
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		url+='?proveedor_id='+$("#proveedor_id").val()
		var modal = $("#modal-compras");
		$.getJSON(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true});
			}
		})	
	})

	$("#guardar").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/guardarRegistro';
		//alert(url)

		if($("#registro").serialize().indexOf('=&') != -1){
			alert("USTED POSEE DATOS SIN LLENAR DENTRO DEL FORMULARIO!")
			return false;
		}
		$.post(url, $("#registro").serialize(), function(resp){
			alert(resp.mensaje)
			if(! resp.error)
				location.href = 'http://'+location.host+'/index.php/dashboard/compras/Cotizaciones/registrar';
		})
	})

	$("#agregarRequisicion").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		url+='?invitacion='+$("#solicitud").val()
		alert(url)
		return false;
		var modal = $("#modal-compras");
		$.getJSON(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true});
			}
		})			
	})

})

function agregarProveedor(event, boton){
	if( !boton.classList.contains('disabled') )
	{
		$("#proveedor_id").val(boton.getAttribute('data-id'))
		$("#nombre_proveedor").html(boton.getAttribute('razon-social'))
		boton.classList.add('disabled')
	}
}

function agregarInvitacion(event, boton){

	if( !boton.classList.contains('disabled') )
	{
		$("#invitacion_codigo").val(boton.getAttribute('codigo'));
		$("#invitacion_concepto").html(boton.getAttribute('descripcion'));
		$("#solicitud").val(boton.getAttribute('data-id'))
		boton.classList.add('disabled');
	}
	var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/detalles'
	url += '?proveedor_id='+$("#proveedor_id").val()+'&solicitud='+boton.getAttribute('codigo')
	location.href = url;
}

function calcularTotal(event, input){
	var total = 0;
	total = $("#cantidades"+input.getAttribute('indice')).val() * $("#cotizaciones"+input.getAttribute('indice')).val() 
	
	total = total + ( $("#porcentajes"+input.getAttribute('indice')).val() * total ) /100
	$("#totales"+input.getAttribute('indice')).val( total )
}