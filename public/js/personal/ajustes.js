 $(document).ready(function(){

	$(".actions").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		var modal = $("#modal-personal")
		var nomina = $(this).attr('nomina')

		if( typeof(nomina) != undefined ){
			url += '?nomina='+nomina+'&ref=nomina_index'
		}

		$.getJSON(url, {}, function(resp){
			if(resp.error){
				alert(resp.mensaje)
			}
			else
			{
				if( resp.reporte ){
					$("#reportes").removeClass('hidden')
					$("#salvar").addClass('hidden')
				}else{
					$("#reportes").addClass('hidden')
					$("#salvar").removeClass('hidden')
				}
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true})
			}
		})
	})

	$("#cerrar").on('click', function(){
		if(confirm("¿ESTA SEGURO DE REALIZAR ESTA ACCION? UNA VEZ CERRADA NO PODRA SEGUIR TRABAJANDOLA")){
			var url = 'http://'+location.host+'/index.php/dashboard/nomina/nomina/cerrar';
			$(this).addClass('disabled')
			$.post(url, {'_token': $(this).attr('token'), 'nomina': $(this).attr('nomina-id')}, function(resp){
				
				var alert = '';
				if(! resp.error){
					alert= `
						<div class="col-sm-12 col-md-12.col-lg-12" >
							<div class="alert alert-success">
								<strong>${resp.mensaje}</strong>
							</div>
						</div>
					`
				}else{
					alert= `
						<div class="col-sm-12 col-md-12.col-lg-12" >
							<div class="alert alert-danger">
								<strong>${resp.mensaje}</strong>
							</div>
						</div>
					`

				}
				$("#alert").show(15000, function(){
					$(this).html(alert)
					setTimeout(function(){
						location.reload()
					},1100);
				})
			})
		}
	})

	$("#salvar").on('click', function(){
		//alert("SI")
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$("#accion").val()
		var datos = $("#form-modal").serialize();

		if( datos.indexOf('=&') == -1 ){
			if(confirm('¿SEGURO DE QUE DESEA GUARDAR ESTOS DATOS?')){
				$.post(url, datos, function(resp){
					alert(resp.mensaje)
					if(! resp.error)
						location.reload()
				})
			}
		}
		else alert("AUN EXISTEN DATOS SIN COMPLETAR");
	})

	$("#agregar_persona").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		var modal = $("#modal-personal")

		$.getJSON(url, {}, function(resp){
			if(resp.error){
				alert(resp.mensaje)
			}
			else
			{
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true})
			}
		})
	})

	$("#guardarTrabajo").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		var datos = $("#"+$(this).attr('formulario')).serialize()
		if( confirm('¿SEGURO DE GUARDAR ESTOS DATOS?') ){
			$.post(url, datos, function(resp){
				alert(resp.mensaje)
				if(! resp.error)
					location.href = 'http://'+location.host+'/index.php/dashboard/nomina/Nomina/trabajar';
			})
		}
	})

	$(".reportes").on('click', function(){
		var url = 'http://'+location.host+'/index.php/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		window.open(url+'?codigo_nomina='+$(this).attr('codigo-nomina'), "REPORTE DE NOMINA HASTA ESTE MOMENTO"  ,"width=800,height=900")
	});

	$("#reportes").on('click', function(){
		var datos = $("#form-modal").serialize();
		var url = location.protocol+'//'+location.host+'/index.php/dashboard/nomina/Nomina/reportes?'+datos
		window.open(url, 'RECIBOS DE NOMINA', 'width=800,height=900')
	})
})

function cargarPersona(event, boton){
	var url = 'http://'+location.host+'/index.php/dashboard/nomina/Nomina/trabajarPersona?codigo_nomina='+$("#codigo_nomina").val()
	url += '&persona='+boton.getAttribute('persona-id');
	location.href = url
}

function calcularMonto(event, select){
	var total_persona = document.getElementById('total_persona')
	var bonos = document.getElementById('total_bonos')
	var deducciones = document.getElementById('total_deducciones')
	var total = document.getElementById('total')

	switch(select.getAttribute('tipo')){
		case 'BONO':{

			if( select.getAttribute('medio') == 'CANTIDAD'){
				//alert(select.getAttribute('medio'))
				if( parseFloat(select.value) > 0)
					bonos.value = parseFloat( select.getAttribute('monto') ) + parseFloat( bonos.value )
				else
					bonos.value = parseFloat( select.getAttribute('monto') ) - parseFloat( bonos.value )
			}
			else{
				var monto = ( parseFloat(total_persona.value) * parseFloat(select.getAttribute('monto')) ) / 100;
				
				if( parseFloat(select.value) > 0)
				{

					bonos.value = parseFloat( bonos.value ) + monto
				}
				else
					bonos.value = parseFloat( bonos.value ) - monto
			}
			break;
		}
		case 'DEDUCCION':{

			if( select.getAttribute('medio') == 'CANTIDAD'){
				//alert(select.getAttribute('medio'))
				if( parseFloat(select.value) > 0)
					deducciones.value = parseFloat( select.getAttribute('monto') ) + parseFloat( deducciones.value )
				else
					deducciones.value = parseFloat( select.getAttribute('monto') ) - parseFloat( deducciones.value )
			}
			else{
				var monto = ( parseFloat(total_persona.value) * parseFloat(select.getAttribute('monto')) ) / 100;
				//alert(monto)
				if( parseFloat(select.value) > 0)
				{

					deducciones.value = parseFloat( deducciones.value ) + monto
				}
				else
					deducciones.value = parseFloat( deducciones.value ) - monto
			}
			break;
		}
	}

	total.value = ( parseFloat(total_persona.value) - parseFloat(deducciones.value) ) + parseFloat(bonos.value)
}