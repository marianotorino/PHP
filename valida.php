<?php 
	session_start();
	include_once("conexion.php");
	include_once("autorizar.php");
	$link=conectar();
	if (isset($_REQUEST["usuario"]) && isset($_REQUEST["pass"])) {
		try {
			Autorizacion::validar($_REQUEST["usuario"], $_REQUEST["pass"]);
			Autorizacion::login($_REQUEST["usuario"], $_REQUEST["pass"]);
			header("Location: backend.php");
		}
		catch(Exception $e) {
			$msg = "Error: excepción capturada. " . $e->getMessage() . "<br>";
			
		}
		/*$exp= '/\W/';
		$user = $_REQUEST["usuario"];
		$pw = $_REQUEST["pass"];
		if (strlen($user) < 8 || preg_match($exp, (string)$user) || strlen($pw) < 8 || preg_match($exp, (string)$pw)) {
			$msg = "ERROR!: El usuario y la contraseña deben ser caracteres alfanuméricos y deben contener al menos 8 caracteres.";
			
		}
		else {
			$result = mysqli_query($link, "SELECT * FROM usuario WHERE nombreusuario = '$user' AND clave = '$pw'");
			if ($result) {
				if (mysqli_num_rows($result) == 0) {
					$msg = "ERROR!: Usuario y/o contraseña inválidos.";
				}
				else{ 
					$_SESSION['logged'] = true;
					mysqli_free_result($result);
					header("Location: backend.php");
				}
			}
			else {
				$msg = "ERROR!: " . mysqli_error($link);
			}
		}*/
	}
	else {
		$msg = "ERROR!: Alguno de los campos no ha sido completado.";
		}
?>
<html>
<head>
	<title>Error</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php echo "<p>$msg</p>" ?>
	<a href="index.php">Volver a la página anterior</a>
</body>
</html>
