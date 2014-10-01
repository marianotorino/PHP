<?php
	class Autorizacion
	{
		public static function validar($user, $pass) 
			{
				$exp= '/\W/';
				if ((strlen($user) < 8) || preg_match($exp, $user)) {
					throw new Exception("El nombre de usuario debe tener al menos 8 caracteres alfanuméricos.");
				}
				if ((strlen($pass) < 8) || preg_match($exp, $pass)) {
					throw new Exception("La contraseña debe tener al menos 8 caracteres alfanuméricos.");	
				}
			}
			
		public static function login($user, $pass)
		{
			$link = mysqli_connect("localhost", "grupo25", "grupo2508", "grupo25") or die("Error: " . mysqli_error($link));
			$sql = "SELECT * FROM usuario WHERE nombreusuario ='{$user}' AND clave ='{$pass}'";
			if ($res = mysqli_query($link, $sql)) {
				if (mysqli_num_rows($res) != 0) {
					$_SESSION['logged'] = true;
				}
				else {
					throw new Exception("El nombre de usuario o la contraseña son inválidos.");
				}
			}
			else {
				throw new Exception("Hubo un error en la base de datos: " . mysqli_error($link));
			}
		}
		public static function autorizar()
		{
			if ((! isset($_SESSION['logged'])) || (! $_SESSION['logged'])) {
				throw new Exception("El usuario no está autorizado para entrar a este sitio.");
			}
		}
	}

?>
