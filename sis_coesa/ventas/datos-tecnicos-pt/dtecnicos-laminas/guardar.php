<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES
$did=$_POST["dato_tecnico"];
$dart=$_POST["dart"];
$clt=$_POST["clt"];
$codUnico=$_POST["cun"];

//LAMINA 1
if($_POST["dt_articulo1"]==""){ $lamina1=0;}else{ $lamina1=$_POST["dt_articulo1"]; };
if($_POST["extrusion1"]==""){ $lamina1_extrusion=0;}else{ $lamina1_extrusion=$_POST["extrusion1"]; };
if($_POST["impresion1"]==""){ $lamina1_impresion=0;}else{ $lamina1_impresion=$_POST["impresion1"]; };
if($_POST["grm2_tintaseca"]==""){ $lamina1_impresion_grm2=0;}else{ $lamina1_impresion_grm2=$_POST["grm2_tintaseca"]; };
if($_POST["bilaminado1"]==""){ $lamina1_bilaminado=0;}else{ $lamina1_bilaminado=$_POST["bilaminado1"]; };
if($_POST["trilaminado1"]==""){ $lamina1_trilaminado=0;}else{ $lamina1_trilaminado=$_POST["trilaminado1"]; };
if($_POST["rebobinado1"]==""){ $lamina1_rebobinado=0;}else{ $lamina1_rebobinado=$_POST["rebobinado1"]; };
if($_POST["habilitado1"]==""){ $lamina1_habilitado=0;}else{ $lamina1_habilitado=$_POST["habilitado1"]; };
if($_POST["cortefinal1"]==""){ $lamina1_cortefinal=0;}else{ $lamina1_cortefinal=$_POST["cortefinal1"]; };
if($_POST["sellado1"]==""){ $lamina1_sellado=0;}else{ $lamina1_sellado=$_POST["sellado1"]; };

//LAMINA 2
if($_POST["dt_articulo2"]==""){ $lamina2=0;}else{ $lamina2=$_POST["dt_articulo2"]; };
if($_POST["extrusion2"]==""){ $lamina2_extrusion=0;}else{ $lamina2_extrusion=$_POST["extrusion2"]; };
if($_POST["impresion2"]==""){ $lamina2_impresion=0;}else{ $lamina2_impresion=$_POST["impresion2"]; };
if($_POST["bilaminado2"]==""){ $lamina2_bilaminado=0;}else{ $lamina2_bilaminado=$_POST["bilaminado2"]; };
if($_POST["grm2_bilaminado"]==""){ $lamina2_bilaminado_grm2=0;}else{ $lamina2_bilaminado_grm2=$_POST["grm2_bilaminado"]; };
if($_POST["trilaminado2"]==""){ $lamina2_trilaminado=0;}else{ $lamina2_trilaminado=$_POST["trilaminado2"]; };
if($_POST["rebobinado2"]==""){ $lamina2_rebobinado=0;}else{ $lamina2_rebobinado=$_POST["rebobinado2"]; };
if($_POST["habilitado2"]==""){ $lamina2_habilitado=0;}else{ $lamina2_habilitado=$_POST["habilitado2"]; };
if($_POST["cortefinal2"]==""){ $lamina2_cortefinal=0;}else{ $lamina2_cortefinal=$_POST["cortefinal2"]; };
if($_POST["sellado2"]==""){ $lamina2_sellado=0;}else{ $lamina2_sellado=$_POST["sellado2"]; };

//LAMINA 3
if($_POST["dt_articulo3"]==""){ $lamina3=0;}else{ $lamina3=$_POST["dt_articulo3"]; };
if($_POST["extrusion3"]==""){ $lamina3_extrusion=0;}else{ $lamina3_extrusion=$_POST["extrusion3"]; };
if($_POST["impresion3"]==""){ $lamina3_impresion=0;}else{ $lamina3_impresion=$_POST["impresion3"]; };
if($_POST["bilaminado3"]==""){ $lamina3_bilaminado=0;}else{ $lamina3_bilaminado=$_POST["bilaminado3"]; };
if($_POST["trilaminado3"]==""){ $lamina3_trilaminado=0;}else{ $lamina3_trilaminado=$_POST["trilaminado3"]; };
if($_POST["grm2_trilaminado"]==""){ $lamina3_trilaminado_grm2=0;}else{ $lamina3_trilaminado_grm2=$_POST["grm2_trilaminado"]; };
if($_POST["rebobinado3"]==""){ $lamina3_rebobinado=0;}else{ $lamina3_rebobinado=$_POST["rebobinado3"]; };
if($_POST["habilitado3"]==""){ $lamina3_habilitado=0;}else{ $lamina3_habilitado=$_POST["habilitado3"]; };
if($_POST["cortefinal3"]==""){ $lamina3_cortefinal=0;}else{ $lamina3_cortefinal=$_POST["cortefinal3"]; };
if($_POST["sellado3"]==""){ $lamina3_sellado=0;}else{ $lamina3_sellado=$_POST["sellado3"]; };

//GUARDAR
$rst_guardar=mysql_query("INSERT INTO syCoesa_datos_tecnicos_laminas_procesos (id_articulo_prin, 
id_cliente, 
id_datos_tecnicos,
lamina1,
lamina1_extrusion,
lamina1_impresion,
lamina1_impresion_grm2,
lamina1_bilaminado,
lamina1_trilaminado,
lamina1_rebobinado,
lamina1_habilitado,
lamina1_cortefinal,
lamina1_sellado,
lamina2,
lamina2_extrusion,
lamina2_impresion,
lamina2_bilaminado,
lamina2_bilaminado_grm2,
lamina2_trilaminado,
lamina2_rebobinado,
lamina2_habilitado,
lamina2_cortefinal,
lamina2_sellado,
lamina3,
lamina3_extrusion,
lamina3_impresion,
lamina3_bilaminado,
lamina3_trilaminado,
lamina3_trilaminado_grm2,
lamina3_rebobinado,
lamina3_habilitado,
lamina3_cortefinal,
lamina3_sellado,
cod_unico)
VALUES ($dart, 
$clt,   
$did,
$lamina1,
$lamina1_extrusion,
$lamina1_impresion,
$lamina1_impresion_grm2,
$lamina1_bilaminado,
$lamina1_trilaminado,
$lamina1_rebobinado,
$lamina1_habilitado,
$lamina1_cortefinal,
$lamina1_sellado,
$lamina2,
$lamina2_extrusion,
$lamina2_impresion,
$lamina2_bilaminado,
$lamina2_bilaminado_grm2,
$lamina2_trilaminado,
$lamina2_rebobinado,
$lamina2_habilitado,
$lamina2_cortefinal,
$lamina2_sellado,
$lamina3,
$lamina3_extrusion,
$lamina3_impresion,
$lamina3_bilaminado,
$lamina3_trilaminado,
$lamina3_trilaminado_grm2,
$lamina3_rebobinado,
$lamina3_habilitado,
$lamina3_cortefinal,
$lamina3_sellado,
'$codUnico');", $conexion);

if (mysql_errno()!=0){
	echo "ERROR: ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {	
	mysql_close($conexion);
	if($accion=="add"){ header("Location:lista.php?did=$did&dart=$dart&clt=$clt&m=1"); }
	else{ header("Location:../lista.php?m=1"); }
}

?>