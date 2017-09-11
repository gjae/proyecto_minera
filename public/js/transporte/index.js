$(document).ready(function(){
	$(".acciones").on('click', function(){

		var modal = $("#modal");
		var url = 'http://'+location.host +'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
		url+='/'+$(this).attr('role')

		$.getJSON(url, {}, function(resp){
			modal.modal({show: true})
			$("#form-modal").html(resp.formulario)
		})
	} ) ;
})

function cargar_vehiculo(e, boton){

	location.href = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/cargar_vehiculo?id='+boton.getAttribute('data-id')

}

function agregar_persona(event, boton){
	boton.classList.add('disabled')
	$("#persona_id").val(boton.getAttribute('data-id'));
	$("#persona").html(boton.getAttribute('nombre'))
}

function calcularCombustible(){
	var precio_combustible = document.getElementById('precio_x_lts_combustible')
	var lts_usados = document.getElementById('combustible_viaje')

	document.getElementById('precio_combustible').value = parseFloat(precio_combustible.value) * parseFloat(lts_usados.value)
}

function calcularPeso(){
	var kgs = document.getElementById('kilo_viajes')
	var precio =document.getElementById('precio_kilo')

	document.getElementById('total_peso_viaje').value = parseFloat(kgs.value) * parseFloat(precio.value)
}

function calcularMaterial(){
	var kgs = document.getElementById('total_kilo_material')
	var precio =document.getElementById('total_kilo_viaje_material')

	document.getElementById('total_viaje_kilos').value = parseFloat(kgs.value) * parseFloat(precio.value)	
}