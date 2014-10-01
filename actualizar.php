<?php 
include_once("conexion.php");
session_start();
$link=conectar();
if ($_SESSION['logged']) {
	if (isset($_REQUEST['nomcanalC'])) {
		if (strlen($_REQUEST['nomcanalC']) > 0 && strlen($_REQUEST['numcanalC']) > 0) {
			$nom = $_REQUEST['nomcanalC'];
			$num = $_REQUEST['numcanalC'];
			$sql = "INSERT INTO canal (nombre, numero) VALUES ('$nom', '$num')";
			$result = mysqli_query($link, $sql);
			if ($result) {
				$msg = "Se ha agregado el canal " . $nom . " exitosamente!";
			}
			else {
				$msg = "No se ha podido agregar el canal. Error: " . mysqli_error($link);
			}
		}
		else {
			$msg = "ERROR!: Alguno de los campos se ha enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['nomcanalM'])) {
		if (strlen($_REQUEST['nomcanalM']) > 0 && strlen($_REQUEST['numcanalM']) > 0) {
			$nom = $_REQUEST['nomcanalM'];
			$num = $_REQUEST['numcanalM'];
			$canal = $_REQUEST['ncanalM'];
			$sql = "UPDATE canal SET nombre='$nom', numero='$num' WHERE nombre='$canal'";
			$result = mysqli_query($link, $sql);
			if ($result) {
				$msg = "El canal " . $nom . " ha sido modificado exitosamente!";
			}
			else {
				$msg = " No se ha podido modificar el canal. Error: " . mysqli_error($link);
			}
		}
		else {
			$msg = "ERROR!: Alguno de los campos se ha enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['bcanal'])) {
		$nom = $_REQUEST['bcanal'];
		$sql = "DELETE FROM canal WHERE nombre = '$nom'";
		$result = mysqli_query($link, $sql);
		if ($result){
			$msg = "El canal " . $nom . " se ha borrado exitosamente!";
		}
		else {
			$msg = "No se ha podido borrar el canal. Error: " . mysqli_error($link);
		}
	}
	elseif (isset($_REQUEST['nomprogC'])) {
		$exp = '/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/';
		$nom = $_REQUEST['nomprogC'];
		$desc = $_REQUEST['descripC'];
		$fec = $_REQUEST['fecC'];
		$duracion = $_REQUEST['minutosC'];
		$hora = $_REQUEST['horaC'];
		$canal = $_REQUEST['canalC'];
		$categoria = $_REQUEST['cateC'];
		if (strlen($nom) > 0 && strlen($desc) > 0 && strlen($fec) > 0 && strlen($duracion) > 0 && strlen($hora) > 0 && strlen($canal) > 0 && strlen($categoria) > 0) {
			if (preg_match($exp, $fec)) {
			if ($duracion % 30 == 0) {  
				$sql = "SELECT id FROM canal WHERE nombre = '$canal'";
				$result = mysqli_query($link, $sql);
				if ($result) {
					while ($row = mysqli_fetch_row($result)) {
						$idcanal = $row[0];
					}
					mysqli_free_result($result);
					$sql = "SELECT id FROM categoriaprograma WHERE nombre = '$categoria'";
					$result = mysqli_query($link, $sql);
					if ($result) {
						while ($row = mysqli_fetch_row($result)) {
							$idcat = $row[0];
						}
						mysqli_free_result($result);
						$sql = "INSERT INTO programa (nombre, descripcion, fecha, horainicio, duracion, categoriaprograma_id, canal_id) VALUES ('$nom', '$desc', '$fec', '$hora', '$duracion', '$idcat', '$idcanal')";
						$result = mysqli_query($link, $sql);
						if ($result) {
							$msg = "El programa " . $nom . " ha sido agregado exitosamente";
						}
						else {
							$msg = "No se ha podido agregar el programa. Error: " . mysqli_error($link);
						}
					}
					else {
						$msg = "Hubo un error al buscar la categoría " . $categoria . ". Error: " . mysqli_error($link);
					}
				}
				else {
					$msg = "Hubo un error al buscar el canal " . $canal . ". Error: " . mysqli_error($link);
				}
			}
			else {
				$msg = "ERROR!: La duración del programa debe ser un múltiplo de 30. Ejemplos: 30, 60, 90, 120, 150, etc.";
			}
		} else {
			$msg = "ERROR!: La fecha del programa debe estar en el formato 'aaaa-mm-dd'";
		}
		}
		else {
			$msg = "ERROR!: Alguno de los campos ha sido enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['nomprogM'])) {
		$exp = '/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/';
		$nom = $_REQUEST['nomprogM'];
		$desc = $_REQUEST['descripM'];
		$fec = $_REQUEST['fecM'];
		$duracion = $_REQUEST['minutosM'];
		$hora = $_REQUEST['horaM'];
		$canal = $_REQUEST['canalM'];
		$categoria = $_REQUEST['cateM'];
		$prog = $_REQUEST['nomprograma'];
		if (strlen($nom) > 0 && strlen($desc) > 0 && strlen($fec) > 0 && strlen($duracion) > 0 && strlen($hora) > 0 && strlen($canal) > 0 && strlen($categoria) > 0 && strlen($prog) > 0) {
			if (preg_match($exp, $fec)) {
			if ($duracion % 30 == 0) {
				$sql = "SELECT id FROM canal WHERE nombre = '$canal'";
				$result = mysqli_query($link, $sql);
				if ($result) {
					while ($row = mysqli_fetch_row($result)) {
						$idcanal = $row[0];
					}
					mysqli_free_result($result);
					$sql = "SELECT id FROM categoriaprograma WHERE nombre = '$categoria'";
					$result = mysqli_query($link, $sql);
					if ($result) {
						while ($row = mysqli_fetch_row($result)) {
							$idcat = $row[0];
						}
						mysqli_free_result($result);
						$sql = "UPDATE programa SET nombre='$nom', descripcion='$desc', fecha='$fec', horainicio='$hora', duracion='$duracion', categoriaprograma_id='$idcat', canal_id='$idcanal' WHERE nombre='$prog'";
						$result = mysqli_query($link, $sql);
						if ($result) {
							$msg = "El programa " . $nom . " ha sido modificado exitosamente";
						}
						else {
							$msg = "No se ha podido modificar el programa. Error: " . mysqli_error($link);
						}
					}
					else {
						$msg = "Hubo un error al buscar la categoría " . $categoria . ". Error: " . mysqli_error($link);
					}
				}
				else {
					$msg = "Hubo un error al buscar el canal " . $canal . ". Error: " . mysqli_error($link);
				}
			}
			else {
				$msg = "ERROR!: La duración del programa debe ser un múltiplo de 30. Ejemplos: 30, 60, 90, 120, 150, etc.";
			}
		} else {
			$msg = "ERROR!: La fecha del programa debe estar en formato 'aaaa-mm-dd'";
		}
		}
		else {
			$msg = "ERROR!: Alguno de los campos ha sido enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['bprograma'])) {
		$nom = $_REQUEST['bprograma'];
		$sql = "DELETE FROM programa WHERE nombre = '$nom'";
		$result = mysqli_query($link, $sql);
		if ($result){
			$msg = "El programa " . $nom . " se ha borrado exitosamente!";
		}
		else {
			$msg = "No se ha podido borrar el programa. Error: " . mysqli_error($link);
		}
	}
	elseif (isset($_REQUEST['nomcatC'])) {
		if (strlen($_REQUEST['nomcatC']) > 0) {
			$nom = $_REQUEST['nomcatC'];
			$sql = "INSERT INTO categoriaprograma (nombre) VALUES ('$nom')";
			$result = mysqli_query($link, $sql);
			if ($result) {
				$msg = "La categoría " . $nom . " ha sido agregada exitosamente.";
			}
			else {
				$msg = "No se ha podido agregar la categoría. Error:" . mysqli_error($link);
			}
		}
		else {
			$msg = "ERROR!: Alguno de los campos se ha enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['nomcatM'])) {
		if (strlen($_REQUEST['nomcatM']) > 0) {
			$nom = $_REQUEST['nomcatM'];
			$sql = "UPDATE categoriaprograma SET nombre='$nom'";
			$result = mysqli_query($link, $sql);
			if ($result) {
				$msg = "La categoría " . $nom . " ha sido modificada exitosamente.";
			}
			else {
				$msg = "No se ha podido modificar la categoría. Error:" . mysqli_error($link);
			}
		}
		else {
			$msg = "ERROR!: Alguno de los campos se ha enviado vacío.";
		}
	}
	elseif (isset($_REQUEST['catsec'])) {
		$nom = $_REQUEST['catsec'];
		$sql = "DELETE FROM categoriaprograma WHERE nombre = '$nom'";
		$result = mysqli_query($link, $sql);
		if ($result){
			$msg = "La categoría " . $nom . " se ha borrado exitosamente!";
		}
		else {
			$msg = "No se ha podido borrar la categoría. Error: " . mysqli_error($link);
		}
	}
	else {
		$msg = "ERROR!: No se han enviado los datos necesarios para poder realizar la actualización.";
	}
} else {
	header("Location: index.php");
}
?>
<html>
<head>
	<title>Actualización</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php echo "<p>$msg</p>" ?>
	<a href="backend.php">Volver a la página anterior</a>
</body>
</html>
