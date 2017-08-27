$(document).ready(function(){
	$(".actions").on('click', function(){
		var btn = $(this)

		if(btn.attr('action') == 'formularios'){
			var modal = $("#modal-personal")
			var url = location.href +'/formulario?form='+btn.attr('formulario')
			$.get(url, '', function(resp){
				if(! resp.error){
					modal.modal({show : true})
					$("#form-modal").html(resp.formulario)
				}
			})
		}
	})


	$("#salvar").on('click', function(event){
		var data = [
			'primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido',
			'identificacion'
		];

		for(var i = 0; i < data.lenght; i++){
			
		}
	})
})