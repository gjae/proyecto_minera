$(document).ready(function(){

	$(".acciones").on('click', function(){
		var modal = $("#modal-compras");
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
		url+='/'+$(this).attr('role')
		$.getJSON(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show :true})
			}
		})

	})

})