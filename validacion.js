function validar() {
	//valida el nombre y la contraseña del formulario
	var exp = /[A-Za-z0-9]/;
	if (document.inicio.usuario.value.length < 8) {
		alert("El nombre de usuario tiene que tener al menos 8 caracteres.")
		document.inicio.usuario.focus()
		return 0;
	}
	else if(! exp.test(document.inicio.usuario.value.toString())){
		alert("El nombre de usuario sólo puede contener caracteres alfanuméricos.")
		document.inicio.usuario.focus()
		return 0;
	}
	
	if (document.inicio.pass.value.length < 8) {
		alert("La contraseña tiene que tener al menos 8 caracteres.")
		document.inicio.pass.focus()
		return 0;
	}
	else if(! exp.test(document.inicio.pass.value.toString())){
		alert("La contraseña sólo puede contener caracteres alfanuméricos.")
		document.inicio.pass.focus()
		return 0;
	}
	
	//Si todo es correcto se hace un submit del formulario
	document.inicio.submit();
	
}
