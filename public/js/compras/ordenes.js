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
		//alert(datos)
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

	$(".opciones").on('click' ,function(){
		var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()+'/'+$(this).attr('role')
		if( !($("#programa").val() == 'analisis') )
			url += '?orden='+$(this).attr('orden')
		else
			url += '?codigo='+$(this).attr('orden')
		//alert(url)
		window.open(url, 'ORDEN', 'width=850,height=800');
	})
})

function cargarAnalisis(event, boton){
	var url = 'http://'+location.host+'/dashboard/'+$("#modulo").val()+'/'+$("#programa").val()
	url += '/'+boton.getAttribute('role')+'?codigo='+boton.getAttribute('codigo')
	location.href = url
}

function calcularSubTotal(event, input){

	var descuento = document.getElementById('descuento') ;
	var tot_sin_desc = document.getElementById('total_sin_descuento')
	var iva = document.getElementById('iva')
	var total = document.getElementById('total')
	var subtotal =document.getElementById('subtotal')
	var anticipo = document.getElementById('monto_anticipo')
	var retefuente = document.getElementById('retefuente')
	subtotal.value = ( parseFloat(tot_sin_desc.value) - parseFloat(descuento.value) )

	if( isNaN(subtotal.value) )
		subtotal.value = redondear(tot_sin_desc.value)
	if( retefuente.value == '' &&  event.keyCode != 8 )
		retefuente.value = 0

	total.value = redondear( ((parseFloat(subtotal.value)+ parseFloat(iva.value)) - anticipo.value) - parseFloat(retefuente.value) )

}

function redondear(num){
	var original = parseFloat(num)
	var result = 0;
	if( ((original * 100)%100) >= 0.5 ){
		
		var result = Math.round(original*100)/100+0.01;
	}
	else{
		var result = Math.round(original*100)/100;
	}

	return result;
}