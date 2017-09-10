function guardar(e, formulario){
	e.preventDefault();
	var regex = /^\d{2}\-\d{2}\-\d{4}/
	var regex_inverse = /^\d{4}\-\d{2}\-\d{2}/

	alert($("#fecha_retiro").val())

	if( regex.test($("#fecha_retiro").val() ) || regex_inverse.test( $("#fecha_retiro").val() ) ){
		if(confirm("¿SEGURO QUE DESEA GUARDAR ESTOS DATOS?")){
			formulario.submit()
		}
	}else{
		alert("EL FORMATO DE LA FECHA NO ES CORRECTA, DEBE POSEER LA SIGUIENTE ESTRUCTURA: DIA-MES-AÑO O AÑO-MES-DIA")
		document.getElementById('fecha_retiro').focus()
	}
}