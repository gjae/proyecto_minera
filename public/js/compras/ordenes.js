$(document).ready(function(){

	$(".acciones").on('click', function(){

		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
		url += '/'+$(this).attr('role')
		var modal = $("#modal-compras");
		$.getJSON(url, {}, function(resp){
			if(! resp.error){
				$("#form-modal").html(resp.formulario)
				modal.modal({show: true})
			}
		})

	})

	$("#guardar").on('click', function(){
		var datos = $("#emision").serialize();
		alert(datos)
		if( datos.indexOf('=&') == -1){
			if(confirm('¿SEGURO QUE DESEA GUARDAR ESTOS DATOS?')){

				var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val();
				
				$.post(url+'/guardar', datos , function(resp){
					alert(resp.mensaje);
				})
			}
		}
		else alert('AUN HAY DATOS PENDIENTES POR COMPLETAR')
	})

})

function cargarAnalisis(event, boton){
	var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
	url += '/'+boton.getAttribute('role')+'?codigo='+boton.getAttribute('codigo')
	location.href = url
}

function calcularSubTotal(event, input){

	var cantidad = input.value;
	var tot_sin_desc = document.getElementById('total_sin_descuento').value
	var iva = document.getElementById('iva')
	var total = document.getElementById('total')
	var subtotal =document.getElementById('subtotal')

	subtotal.value = ( parseFloat(tot_sin_desc) - cantidad )
	total.value = ( parseFloat(subtotal.value)  + parseFloat(iva.value) )
}