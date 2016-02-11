$(document).ready(function(){

	$(".acciones").on('click', function(){

		var modal = $("#modal-compras");
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
		url+='/'+$(this).attr('role')
		url+='?codigo='+$(this).attr('codigo')
		//alert(url)
		$.get(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show :true})
			}
		})

	})

	$("#guardar").on('click', function(){
		var datos = $("#analisis").serialize();
		if(datos.indexOf('=&') != -1){
			alert("AUN LE FALTAN DATOS DEL FORMULARIO POR COMPLETAR");
			return false;
		}
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
		url += '/'+$(this).attr('role')
		
		//alert(datos)
		$.post(url, datos, function(resp){
			alert(resp.mensaje)
			if( !resp.error )
				location.reload()
		})
	})

})

function cargarRegistro(evento, boton){
	var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/cargarRegistro?codigo='+boton.getAttribute('codigo')
	location.href = url;
}