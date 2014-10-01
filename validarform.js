function vCanalC() {
	if (document.crearC.nomcanalC.value.length == 0) {
		alert("Ingrese el nombre del canal.");
		document.crearC.nomcanalC.focus();
		return 0;
	}
	if (document.crearC.numcanalC.value.length == 0) {
		alert("Ingrese el número del canal.");
		document.crearC.numcanalC.focus();
		return 0;
	}
	document.crearC.submit();
}

function vCanalM() {
	if (document.modificarC.ncanalM.value.length == 0) {
		alert("No se ha seleccionado ningún canal.");
		document.modificarC.ncanalM.focus();
	}
	if (document.modificarC.nomcanalM.value.length == 0) {
		alert("Ingrese el nombre del canal.");
		document.modificarC.nomcanalM.focus();
		return 0;
	}
	if (document.modificarC.numcanalM.value.length == 0) {
		alert("Ingrese el número del canal.");
		document.modificarC.numcanalM.focus();
		return 0;
	}
	document.modificarC.submit();
}

function vCanalE() {
	if (document.eliminarC.bcanal.value.length == 0) {
		alert("No se ha seleccionado ningún canal.");
		document.eliminarC.bcanal.focus();
		return 0;
	}
	document.eliminarC.submit();
}

function vProgC() {
	var fec = /(19|20)\d\d[- -.](0[1-9]|1[012])[- -.](0[1-9]|[12][0-9]|3[01])/;
	if (document.crearP.nomprogC.value.length == 0) {
		alert("Ingrese el nombre del programa.");
		document.crearP.nomprogC.focus();
		return 0;
	}
	if (document.crearP.descripC.value.length == 0) {
		alert("Ingrese una descripción para el programa.");
		document.crearP.descripC.focus();
		return 0;
	}
	if (! fec.test(document.crearP.fecC.value)) {
		alert("La fecha debe tener el formato 'aaaa-mm-dd'");
		document.crearP.fecC.focus();
		return 0;
	}
	if (document.crearP.minutosC.value.length == 0) {
		alert("Ingrese la duración del programa.");
		document.crearP.minutosC.focus();
		return 0;
	}
	else if (document.crearP.minutosC.value % 30 != 0) {
		alert("La duración del programa debe ser un múltiplo de 30. Ej: 30, 60, 90, 120, etc.");
		document.crearP.minutosC.focus();
		return 0;
	}
	if (document.crearP.canalC.value.length == 0) {
		alert("No se ha seleccionado ningún canal para este programa.");
		document.crearP.canalC.focus();
		return 0;
	}
	if (document.crearP.cateC.value.length == 0) {
		alert("No se ha seleccionado ninguna categoría para este programa.");
		document.crearP.cateC.focus();
		return 0;
	}
	document.crearP.submit();
}

function vProgM() {
	var fec = /(19|20)\d\d[- -.](0[1-9]|1[012])[- -.](0[1-9]|[12][0-9]|3[01])/;
	if (document.modificarP.nomprograma.value.length == 0) {
		alert("No se ha seleccionado ningún programa.");
		document.modificarP.nomprograma.focus();
		return 0;
	}
	if (document.modificarP.nomprogM.value.length == 0) {
		alert("Ingrese el nombre del programa.");
		document.modificarP.nomprogM.focus();
		return 0;
	}
	if (document.modificarP.descripM.value.length == 0) {
		alert("Ingrese una descripción para el programa.");
		document.modificarP.descripM.focus();
		return 0;
	}
	if (! fec.test(document.modificarP.fecM.value)) {
		alert("La fecha debe tener el formato 'aaaa-mm-dd'");
		document.modificarP.fecM.focus();
		return 0;
	}
	if (document.modificarP.minutosM.value.length == 0) {
		alert("Ingrese la duración del programa.");
		document.modificarP.minutosM.focus();
		return 0;
	}
	else if (document.modificarP.minutosM.value % 30 != 0) {
		alert("La duración del programa debe ser un múltiplo de 30. Ej: 30, 60, 90, 120, etc.");
		document.modificarP.minutosM.focus();
		return 0;
	}
	if (document.modificarP.canalM.value.length == 0) {
		alert("No se ha seleccionado ningún canal para este programa.");
		document.modificarP.canalM.focus();
		return 0;
	}
	if (document.modificarP.cateM.value.length == 0) {
		alert("No se ha seleccionado ninguna categoría para este programa.");
		document.modificarP.cateM.focus();
		return 0;
	}
	document.modificarP.submit();
}

function vProgE() {
	if (document.eliminarP.bprograma.value.length == 0) {
		alert("No se ha seleccionado ningún programa.");
		document.eliminarP.bprograma.focus();
		return 0;
	}
	document.eliminarP.submit();
}

function vCatC() {
	if (document.crearCat.nomcatC.value.length == 0) {
		alert("Ingrese el nombre de la categoría.");
		document.crearCat.nomcatC.focus();
		return 0;
	}
	document.crearCat.submit();
}

function vCatM() {
	if (document.modificarCat.catsecM.value.length == 0) {
		alert("No se ha seleccionado ninguna categoría.");
		document.modificarCat.catsecM.focus();
		return 0;
	}
	if (document.modificarCat.nomcatM.value.length == 0) {
		alert("Ingrese el nombre de la categoría.");
		document.modificarCat.nomcatM.focus();
		return 0;
	}
	document.modificarCat.submit();
}

function vCatE() {
	if (document.eliminarCat.catsec.value.length == 0) {
		alert("No se ha seleccionado ninguna categoría.");
		document.eliminarCat.catsec.focus();
		return 0;
	}
	document.eliminarCat.submit();
}
