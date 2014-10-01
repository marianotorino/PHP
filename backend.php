<?php
include_once("conexion.php");
include_once("autorizar.php");
session_start();
$link=conectar();
try {
	if (isset($_REQUEST["usuario"]) && isset($_REQUEST["pass"])) {
		Autorizacion::validar($_REQUEST["usuario"], $_REQUEST["pass"]);
		Autorizacion::login($_REQUEST["usuario"], $_REQUEST["pass"]);
	}
	else {
		Autorizacion::autorizar();
	}
}
catch(Exception $e) {
	session_unset();
	session_destroy();
	echo "Error: excepción capturada. " . $e->getMessage() . "<br>";
	?>
	<a href="index.php">Volver a la página anterior</a>
	<?php
	exit();
	}
	?>

<!DOCTYPE html>
<html>

<head>
	<title>Backend</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="validarform.js" language="javascript" type="text/javascript"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function(){
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});
	</script>
</head>

<body>
	<h1>Backend</h1>
	<a href="logout.php" class="menu">Cerrar Sesión</a>&nbsp;<a href="index.php" class="menu">Ver Grilla de Programación</a>
	<br>
	<br>
	<form method="post" action="backend.php" name="accion" id="form2">
		<fieldset>
		Ingrese el contenido que desea actualizar:<br>
		<input type="radio" name="group1" value="Canal"> Canal<br>
		<input type="radio" name="group1" value="Categoría"> Categoría<br>
		<input type="radio" name="group1" value="Programa" checked> Programa<br>
		Ingrese la acción que desea realizar:<br>
		<input type="radio" name="group2" value="Eliminar"> Eliminar<br>
		<input type="radio" name="group2" value="Modificar"> Modificar<br>
		<input type="radio" name="group2" value="Crear" checked> Crear<br>
		<input type="submit" value="Continuar">
		</fieldset>
	</form>
	
	<?php
	if (isset($_REQUEST["group1"])) {
	if ($_REQUEST["group1"] == "Canal" && $_REQUEST["group2"] == "Crear") {
	?>
	<h2>Crear canal</h2>
	<form method="post" action="actualizar.php" name="crearC">
	Nombre: <input type="text" name="nomcanalC"><br>
	Número: <input type="text" name="numcanalC"><br>
	<input type="button" value="Crear" onclick="vCanalC()">
	</form>
	<?php } else
	if ($_REQUEST["group1"] == "Canal" && $_REQUEST["group2"] == "Modificar") {
	?>
	<h2>Modificar canal</h2>
	<form method="post" action="actualizar.php" name="modificarC">
	Canal: <select name="ncanalM">
	<?php
		$result = mysqli_query($link, "SELECT * FROM canal");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select><br>
	Nombre: <input type="text" name="nomcanalM"><br>
	Número: <input type="text" name="numcanalM"><br>
	<input type="button" value="Modificar" onclick="vCanalM()">
	</form>
	<?php }
	else
	if ($_REQUEST["group1"] == "Canal" && $_REQUEST["group2"] == "Eliminar") {
	?>
	<h2>Eliminar canal</h2>
	<form method="post" action="actualizar.php" name="eliminarC">
	Canal: <select name="bcanal">
	<?php
		$result = mysqli_query($link, "SELECT * FROM canal");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<option>{$row['nombre']}</option>";
		}
		if (! $result) echo "Error: " . mysqli_error($link);
		mysqli_free_result($result);
	?>
	</select>
	<input type="button" value="Eliminar" onclick="vCanalE()">
	</form>
	<?php } 
	else
	if ($_REQUEST["group1"] == "Programa" && $_REQUEST["group2"] == "Crear") {
	?>
	<h2>Crear programa</h2>
	<form method="post" action="actualizar.php" name="crearP">
	Nombre: <input type="text" name="nomprogC"><br>
	Descripción: <input type="textarea" name="descripC"><br>
	Fecha: <input type="text" id="datepicker" name="fecC"><br>
	Hora: <select name="horaC">
		<option>00:00</option>
		<option>00:30</option>
		<option>01:00</option>
		<option>01:30</option>
		<option>02:00</option>
		<option>02:30</option>
		<option>03:00</option>
		<option>03:30</option>
		<option>04:00</option>
		<option>04:30</option>
		<option>05:00</option>
		<option>05:30</option>
		<option>06:00</option>
		<option>06:30</option>
		<option>07:00</option>
		<option>07:30</option>
		<option>08:00</option>
		<option>08:30</option>
		<option>09:00</option>
		<option>09:30</option>
		<option>10:00</option>
		<option>10:30</option>
		<option>11:00</option>
		<option>11:30</option>
		<option>12:00</option>
		<option>12:30</option>
		<option>13:00</option>
		<option>13:30</option>
		<option>14:00</option>
		<option>14:30</option>
		<option>15:00</option>
		<option>15:30</option>
		<option>16:00</option>
		<option>16:30</option>
		<option>17:00</option>
		<option>17:30</option>
		<option>18:00</option>
		<option>18:30</option>
		<option>19:00</option>
		<option>19:30</option>
		<option>20:00</option>
		<option>20:30</option>
		<option>21:00</option>
		<option>21:30</option>
		<option>22:00</option>
		<option>22:30</option>
		<option>23:00</option>
		<option>23:30</option>
	</select><br>
	Duración (en minutos): <input type="text" name="minutosC"><br>
	Canal: <select name="canalC">
	<?php
		$result = mysqli_query($link, "SELECT * FROM canal");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>	
	</select><br>
	Categoria: <select name="cateC">
	<?php
		$result = mysqli_query($link, "SELECT * FROM categoriaprograma");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select><br>
	<input type="button" value="Crear" onclick="vProgC()">
	</form>
	<?php } ?>
		<?php
	if ($_REQUEST["group1"] == "Programa" && $_REQUEST["group2"] == "Modificar") {
	?>
	<h2>Modificar programa</h2>
	<form method="post" action="actualizar.php" name="modificarP">
	Programa: <select name="nomprograma">
	<?php
		$result = mysqli_query($link, "SELECT * FROM programa");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select><br>
	Nombre: <input type="text" name="nomprogM"><br>
	Descripción: <input type="text" name="descripM"><br>
	Fecha: <input type="text" id="datepicker" name="fecM"><br>
	Hora: <select name="horaM">
		<option>00:00</option>
		<option>00:30</option>
		<option>01:00</option>
		<option>01:30</option>
		<option>02:00</option>
		<option>02:30</option>
		<option>03:00</option>
		<option>03:30</option>
		<option>04:00</option>
		<option>04:30</option>
		<option>05:00</option>
		<option>05:30</option>
		<option>06:00</option>
		<option>06:30</option>
		<option>07:00</option>
		<option>07:30</option>
		<option>08:00</option>
		<option>08:30</option>
		<option>09:00</option>
		<option>09:30</option>
		<option>10:00</option>
		<option>10:30</option>
		<option>11:00</option>
		<option>11:30</option>
		<option>12:00</option>
		<option>12:30</option>
		<option>13:00</option>
		<option>13:30</option>
		<option>14:00</option>
		<option>14:30</option>
		<option>15:00</option>
		<option>15:30</option>
		<option>16:00</option>
		<option>16:30</option>
		<option>17:00</option>
		<option>17:30</option>
		<option>18:00</option>
		<option>18:30</option>
		<option>19:00</option>
		<option>19:30</option>
		<option>20:00</option>
		<option>20:30</option>
		<option>21:00</option>
		<option>21:30</option>
		<option>22:00</option>
		<option>22:30</option>
		<option>23:00</option>
		<option>23:30</option>
	</select><br>
	Duración (en minutos): <input type="text" name="minutosM"><br>
	Canal: <select name="canalM">
	<?php
		$result = mysqli_query($link, "SELECT * FROM canal");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>	
	</select><br>
	Categoria: <select name="cateM">
	<?php
		$result = mysqli_query($link, "SELECT * FROM categoriaprograma");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select><br>
	<input type="button" value="Modificar" onclick="vProgM()">
	</form>
	<?php }
	else
	if ($_REQUEST["group1"] == "Programa" && $_REQUEST["group2"] == "Eliminar") {
	?>
	<h2>Eliminar programa</h2>
	<form method="post" action="actualizar.php" name="eliminarP">
	Programa: <select name="bprograma">
	<?php
	$result = mysqli_query($link, "SELECT * FROM programa");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select>
	<input type="button" value="Eliminar" onclick="vProgE()">
	</form>
	<?php } 
	else
	if ($_REQUEST["group1"] == "Categoría" && $_REQUEST["group2"] == "Crear") {
	?>
	<h2>Crear categoría</h2>
	<form method="post" action="actualizar.php" name="crearCat">
	Nombre: <input type="text" name="nomcatC"><br>
	<input type="button" value="Crear" onclick="vCatC()">
	</form>
	<?php }
	else
	if ($_REQUEST["group1"] == "Categoría" && $_REQUEST["group2"] == "Eliminar") {
	?>
	<h2>Eliminar categoría</h2>
	<form method="post" action="actualizar.php" name="eliminarCat">
	Categoría: <select name="catsec">
	<?php
	$result = mysqli_query($link, "SELECT * FROM categoriaprograma");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select>
	<input type="button" value="Eliminar" onclick="vCatE()">
	</form>
	<?php }
	else
	if ($_REQUEST["group1"] == "Categoría" && $_REQUEST["group2"] == "Modificar") {
	?>
	<h2>Modificar categoría</h2>
	<form method="post" action="actualizar.php" name="modificarCat">
	Categoría: <select name="catsecM">
	<?php
		$result = mysqli_query($link, "SELECT * FROM categoriaprograma");
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>{$row['nombre']}</option>";
		}
		mysqli_free_result($result);
	?>
	</select><br>
	Nombre: <input type="text" name="nomcatM"><br>
	<input type="button" value="Modificar" onclick="vCatM()">
	</form>
	<?php }
	} 
	?>
</body>

</html>
