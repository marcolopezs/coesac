<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$colores_articulo=$_POST["colores_articulo"];
$colores_cantidad=$_POST["colores_cantidad"];

//Recorremos todas las preguntas
for($i=1; $i<=$colores_cantidad; $i++){
	$colores_cuerpo_impresor=$_POST["colores_cuerpo_impresor$i"];
	$colores_cilindro=$_POST["colores_cilindro$i"];
	$colores_anilox=$_POST["colores_anilox$i"];
	$colores_viscocidad=$_POST["colores_viscocidad$i"];
	$colores_area_impresa=$_POST["colores_area_impresa$i"];
	$colores_art_tintas=$_POST["colores_art_tintas$i"];
	$colores_art_cushion=$_POST["colores_art_cushion$i"];
	$colores_art_stickback=$_POST["colores_art_stickback$i"];
	
	$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_colores (id_articulo,
	cuerpo_impresor_colores,
	id_articulo_tintas,
	id_articulo_cushion,
	id_articulo_stickback,
	cilindro_engranaje_colores,
	anilox_colores,
	viscosidad_colores,
	area_impresa_colores)
	VALUES ($colores_articulo,
	$colores_cuerpo_impresor,
	$colores_art_tintas,
	$colores_art_cushion,
	$colores_art_stickback,
	$colores_cilindro,
	$colores_anilox,
	$colores_viscocidad,
	$colores_area_impresa)", $conexion);
}

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:../lista.php?m=1");
}

?>