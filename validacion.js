function validarLogin() {
	//valida el nombre y la contraseña del formulario
	var exp = /\W/;
	if (document.inicio.usuario.value.length < 8) {
		alert("El nombre de usuario tiene que tener al menos 8 caracteres.")
		document.inicio.usuario.focus()
		return 0;
	}
	else if(exp.test(document.inicio.usuario.value.toString())){
		alert("El nombre de usuario sólo puede contener caracteres alfanuméricos.")
		document.inicio.usuario.focus()
		return 0;
	}
	
	if (document.inicio.pass.value.length < 8) {
		alert("La contraseña tiene que tener al menos 8 caracteres.")
		document.inicio.pass.focus()
		return 0;
	}
	else if(exp.test(document.inicio.pass.value.toString())){
		alert("La contraseña sólo puede contener caracteres alfanuméricos.")
		document.inicio.pass.focus()
		return 0;
	}
	
	//Si todo es correcto se hace un submit del formulario
	document.inicio.submit();
	
}

function validarForm() {
	var fec = /(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/;
	if (document.search.categoria.value.length == 0) {
		alert("El campo de la categoria está vacío.");
		document.search.categoria.focus();
		return 0;
	}
	else if (! fec.test(document.search.dia.value)) {
		alert("La fecha debe tener el formato 'aaaa-mm-dd'");
		document.search.dia.focus();
		return 0;
	}
	
	document.search.submit();
}


