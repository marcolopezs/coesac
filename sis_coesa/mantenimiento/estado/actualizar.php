<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$estado_id=$_POST["estado_id"];
$estado_nombre=$_POST["estado_nombre"];

//ACTUALIZAR
$rst_guardar=mysql_query("UPDATE syCoesa_mantenimiento_estado SET nombre_estado='$estado_nombre' WHERE id_estado=$estado_id;", $conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:lista.php?m=4");
} else {
	mysql_close($conexion);
	header("Location:lista.php?m=3");
}

?>