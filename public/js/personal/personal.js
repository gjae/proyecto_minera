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
			'primer_nombre', 'segundo_nombre',
			'identificacion'
		];
		var form_completo = true;

		console.log(data.length)

		for(var i = 0; i < data.length; i++){
			if( $("#"+data[i]).val() == "" ){
				$("#"+data[i]).addClass('has-error');
				form_completo = false;
			}
		}
		if( !form_completo )
			alert("AUN HAY CAMPOS POR COMPLETAR")
	})
})