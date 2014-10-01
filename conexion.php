<?php
// archivo conexion.php
function conectar(){
$link = mysqli_connect("localhost", "grupo25", "grupo2508", "grupo25") 
or die("Error " . mysqli_error($link));
return $link;
}
?>
