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

})

function cargarRegistro(evento, boton){
	var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/cargarRegistro?codigo='+boton.getAttribute('codigo')
	alert(url)
}