$(document).ready(function(){
	$(".actions").on('click', function(){
		var btn = $(this)

		if(btn.attr('action') == 'formularios'){
			var modal = $("#modal-personal")
			var url = location.href +'/formulario?form='+btn.attr('formulario')+'&persona='+(btn.attr('persona') || 0)
			//alert(url)
			//
			if( $(this).attr('role') == 'reportes' ){
				$("#salvar").addClass('hidden')
				$("#generar").removeClass('hidden')
			}
			else{
				$("#salvar").removeClass('hidden')
				$("#generar").addClass('hidden')
			}
			$.get(url, '', function(resp){
				if(! resp.error){
					modal.modal({show : true})
					$("#form-modal").html(resp.formulario)
				}
			})
		}
	})

	$(".print").on('click', function(){
		switch( $(this).attr('role') ){
			case 'liquidacion' :{
				var url = 'http://'+location.host+'/index.php/dashboard/nomina/liquidacion/imprimir?liquidacion='+$(this).attr('liquidacion')
				window.open(url, 'RECIBO DE LIQUIDACION' ,"width=800,height=900");
				break;
			}
		}
	})

	$("#salvar").on('click', function(event){
		var url = location.href;
		var datos = $("#form-modal").serialize();
		//alert(datos)
		if(confirm('¿Seguro de que desea guardar estos datos?'))
		{
			if( datos.indexOf('=&') != -1 ){
				alert("AUN HAY CAMPOS POR COMPLETAR")
				return false;
			}
			else{
				$.post(url+'/'+$("#accion").val(), datos, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
	})

	$("#generar").on('click', function(){
		var filtros = $("#form-modal").serialize();
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/reportes'
		url+='?'+filtros
		//alert(url)
		window.open(url, 'REPORTE DE PERSONAL', 'width=950,height=850');
	})
})