<?php
	session_start();
	include_once("conexion.php");
	$link=conectar();
	$exp = '/(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])/';
	if ((! isset($_COOKIE['day'])) or ( isset($_REQUEST['dia']) and (! preg_match($exp, $_REQUEST['dia'])))) {
		setcookie("day", date('Y-m-d'), time()+60*60*24*30);
		$dia = date('Y-m-d');
		}
	else if (isset($_REQUEST['dia'])) {
		setcookie("day", $_REQUEST['dia'], time()+60*60*24*30);
		$dia = $_REQUEST['dia'];
		}
		else {
			$dia = $_COOKIE['day'];
		}
	$categoria = ( isset( $_REQUEST['categoria'] ) ? $_REQUEST['categoria'] : "Todas");
	$fec = strtotime($dia);
	$dias=array('Thu'=>'Jueves','Sun'=>'Domingo','Mon'=>'Lunes','Tue'=>'Martes','Wed'=>'Miercoles','Fri'=>'Viernes','Sat'=>'Sabado');
	$meses=array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');
?>
<!DOCTYPE html>
<html>

<head>
	<title>Programación</title>
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
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="style.css" rel="stylesheet" type="text/css">
	<script src="validacion.js" language="javascript" type="text/javascript"></script>
</head>

<body>
	<h1>Programación</h1>
	<?php
	if (! isset($_SESSION['logged'])) {
		$_SESSION['logged'] = false;
	}
	if ($_SESSION['logged'] == false) {
	?>
	<form method="post" action="backend.php" name="inicio" id="form1">
		<p><fieldset>
		Usuario: <input type="text" name="usuario" />
		Contraseña: <input type="password" name="pass" />
		<input type="button" value="Iniciar Sesión" onclick="validarLogin()">
		</fieldset></p>
	</form>
	<?php } 
	if ($_SESSION['logged']) { ?>
	<a href="logout.php" class="menu">Cerrar Sesión</a>&nbsp;<a href="backend.php" class="menu">Administrar contenido</a>
	<?php } 
	?>
	<h3>Grilla de programas del dia <?php echo $dias[date('D', $fec)]." ".date('d', $fec)." de ".$meses[date('m', $fec)]." del ".date('Y'); ?></h3>
	<form method="GET" action="index.php" name="search" id="form1">Búsqueda:<br>
	<p><fieldset>
		Por Categoría:
		<select name="categoria">
			<option>Todas</option>
		<?php 
			$result = mysqli_query($link, "SELECT * FROM categoriaprograma");
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				echo "<option>{$row['nombre']}</option>";
			}
			mysqli_free_result($result);
		?>
		</select>
		Por Fecha:
		<input type="text" id="datepicker" name="dia">

		<input type="button" value="Buscar" onclick="validarForm()">
		</fieldset></p>
	</form><br>
	<?php
	$diaAnterior = strtotime('-1 day', strtotime($dia));
	$diaAnterior = date('Y-m-d', $diaAnterior);
	echo "<a href=\"index.php?categoria={$categoria}&dia={$diaAnterior}\">Anterior</a><br><br>"
	?>
	<table class="grilla">
		<tr>
			<th>Canal</th>
			<th>00:00</th>
			<th>00:30</th>
			<th>01:00</th>
			<th>01:30</th>
			<th>02:00</th>
			<th>02:30</th>
			<th>03:00</th>
			<th>03:30</th>
			<th>04:00</th>
			<th>04:30</th>
			<th>05:00</th>
			<th>05:30</th>
			<th>06:00</th>
			<th>06:30</th>
			<th>07:00</th>
			<th>07:30</th>
			<th>08:00</th>
			<th>08:30</th>
			<th>09:00</th>
			<th>09:30</th>
			<th>10:00</th>
			<th>10:30</th>
			<th>11:00</th>
			<th>11:30</th>
			<th>12:00</th>
			<th>12:30</th>
			<th>13:00</th>
			<th>13:30</th>
			<th>14:00</th>
			<th>14:30</th>
			<th>15:00</th>
			<th>15:30</th>
			<th>16:00</th>
			<th>16:30</th>
			<th>17:00</th>
			<th>17:30</th>
			<th>18:00</th>
			<th>18:30</th>
			<th>19:00</th>
			<th>19:30</th>
			<th>20:00</th>
			<th>20:30</th>
			<th>21:00</th>
			<th>21:30</th>
			<th>22:00</th>
			<th>22:30</th>
			<th>23:00</th>
			<th>23:30</th>
		</tr>
		<?php
			$horas = array();
			$horas[]='00:00:00';
			$horas[]='00:30:00';
			$horas[]='01:00:00';
			$horas[]='01:30:00';
			$horas[]='02:00:00';
			$horas[]='02:30:00';
			$horas[]='03:00:00';
			$horas[]='03:30:00';
			$horas[]='04:00:00';
			$horas[]='04:30:00';
			$horas[]='05:00:00';
			$horas[]='05:30:00';
			$horas[]='06:00:00';
			$horas[]='06:30:00';
			$horas[]='07:00:00';
			$horas[]='07:30:00';
			$horas[]='08:00:00';
			$horas[]='08:30:00';
			$horas[]='09:00:00';
			$horas[]='09:30:00';
			$horas[]='10:00:00';
			$horas[]='10:30:00';
			$horas[]='11:00:00';
			$horas[]='11:30:00';
			$horas[]='12:00:00';
			$horas[]='12:30:00';
			$horas[]='13:00:00';
			$horas[]='13:30:00';
			$horas[]='14:00:00';
			$horas[]='14:30:00';
			$horas[]='15:00:00';
			$horas[]='15:30:00';
			$horas[]='16:00:00';
			$horas[]='16:30:00';
			$horas[]='17:00:00';
			$horas[]='17:30:00';
			$horas[]='18:00:00';
			$horas[]='18:30:00';
			$horas[]='19:00:00';
			$horas[]='19:30:00';
			$horas[]='20:00:00';
			$horas[]='20:30:00';
			$horas[]='21:00:00';
			$horas[]='21:30:00';
			$horas[]='22:00:00';
			$horas[]='22:30:00';
			$horas[]='23:00:00';
			$horas[]='23:30:00';

			$canales_query = mysqli_query($link, "SELECT nombre, id FROM canal");
			$canales = array();
			
			while ($row = mysqli_fetch_array($canales_query, MYSQLI_ASSOC))
				$canales[] = array( 
					'id' => $row['id'],
					'nombre' => $row['nombre']
				);
			
			if ($categoria != "Todas") {
				$categorias = mysqli_query($link, "SELECT * FROM categoriaprograma WHERE nombre = '{$categoria}'");
				$cat = mysqli_fetch_array($categorias, MYSQLI_ASSOC);
				$cat_id = $cat['id'];
				$sql = "SELECT * FROM `programa` WHERE `categoriaprograma_id`='{$cat_id}' AND (`fecha`='{$dia}' OR (`fecha`=ADDDATE('{$dia}', -1) AND ADDTIME(`horainicio`, SEC_TO_TIME(`duracion`*60) ) > '24:00' )) ORDER BY `canal_id`, `horainicio`";
			}
			else {
				$sql = "SELECT * FROM `programa` WHERE `fecha`='{$dia}' OR (`fecha`=ADDDATE('{$dia}', -1) AND ADDTIME(`horainicio`, SEC_TO_TIME(`duracion`*60) ) > '24:00' ) ORDER BY `canal_id`, `horainicio`";
			}
			
			$programas = mysqli_query($link, $sql);
			
			$programa = mysqli_fetch_array($programas, MYSQLI_ASSOC);
			
			$to = count($canales);
			for( $i = 0 ; $i < $to ; $i++ ){
				echo "<tr><th>{$canales[$i]['nombre']}</th>";
				$espacio_libre = 48;
				$hora = 0;
				while( $espacio_libre > 0){
					if( $programa['canal_id'] == $canales[$i]['id']) {
						$duracion = $programa['duracion']/30;
						if( ( 48 - $hora ) < $duracion )
							$duracion = 48 - $hora;
						if ($programa['fecha'] != $dia) {
							for ($j = 0; $j < 48; $j++) {
								if ($horas[$j] == $programa['horainicio']) 
									$duracion -= 48 - $j; 
								}
							echo "<td class=\"contenido\" colspan=\"$duracion\">{$programa['nombre']}</td>";
							$programa = mysqli_fetch_array($programas, MYSQLI_ASSOC);
							$espacio_libre -= $duracion;
							$hora += $duracion;
						}
						else if ($horas[$hora] == $programa['horainicio']) {
							echo "<td class=\"contenido\" colspan=\"$duracion\">{$programa['nombre']}</td>";
							$programa = mysqli_fetch_array($programas, MYSQLI_ASSOC);
							$espacio_libre -= $duracion;
							$hora += $duracion;
						}
						else{
							$hora++;
							$espacio_libre--;
							echo "<td></td>";
						}
					}else{
						$hora++;
						$espacio_libre--;
						echo "<td></td>";
					}	
				}
				echo "</tr>";
			}
		?>
	</table><br>
	
	<?php
	$diaSiguiente = strtotime('+1 day', strtotime($dia));
	$diaSiguiente = date('Y-m-d', $diaSiguiente);
	echo "<a href=\"index.php?categoria={$categoria}&dia={$diaSiguiente}\">Siguiente</a>"
	?>


</body>

</html>
