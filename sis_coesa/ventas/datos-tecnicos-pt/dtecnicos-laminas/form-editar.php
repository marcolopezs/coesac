<?php
session_start();
require_once("../../../../connect/conexion.php");
require_once("../../../../connect/function.php");
require_once("../../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["idlmpr"];
$did=$_REQUEST["did"];
$dart=$_REQUEST["dart"];
$clt=$_REQUEST["clt"];
$cont=0;

//SELECCIONAR LOS DATOS TECNICOS BASICOS
$rst_did=mysql_query("SELECT * FROM syCoesa_datos_tecnicos WHERE id_datos_tecnicos=$did", $conexion);
$fila_did=mysql_fetch_array($rst_did);

//MAXIMO REFILE DE MAQUINAS
$rst_maq=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas_datos ORDER BY refile_maquina DESC;", $conexion);
$fila_maq=mysql_fetch_array($rst_maq);
$maq_refile=$fila_maq["refile_maquina"];

//FORMULA: ANCHO FINAL * BANDAS + REFILE
$did_ancho_final=$fila_did["ancho_final_datos_tecnicos"];
$did_nro_bandas=$fila_did["nro_bandas_datos_tecnicos"];

//FILTRO
$formula_filtro_lamina=$did_ancho_final * $did_nro_bandas + $maq_refile;
$formula_filtro_manga=$did_ancho_final * $did_nro_bandas;
$formula_filtro_polietileno=0;

//LAMINAS
$rst_lamina=mysql_query("SELECT * FROM syCoesa_datos_tecnicos_laminas_procesos WHERE id_laminas_procesos=$id_registro;", $conexion);
$fila_lamina=mysql_fetch_array($rst_lamina);

//VARIABLES
$lamina_datos_tecnicos=$fila_lamina["id_datos_tecnicos"];

//LAMINA 1
$lamina1=$fila_lamina["lamina1"];
$lamina1_extrusion=$fila_lamina["lamina1_extrusion"];
$lamina1_impresion=$fila_lamina["lamina1_impresion"];
$lamina1_impresion_grm2=$fila_lamina["lamina1_impresion_grm2"];
$lamina1_rebobinado=$fila_lamina["lamina1_rebobinado"];

//LAMINA 2
$lamina2=$fila_lamina["lamina2"];
$lamina2_extrusion=$fila_lamina["lamina2_extrusion"];
$lamina2_bilaminado=$fila_lamina["lamina2_bilaminado"];
$lamina2_bilaminado_grm2=$fila_lamina["lamina2_bilaminado_grm2"];

//LAMINA 3
$lamina3=$fila_lamina["lamina3"];
$lamina3_extrusion=$fila_lamina["lamina3_extrusion"];
$lamina3_trilaminado=$fila_lamina["lamina3_trilaminado"];
$lamina3_trilaminado_grm2=$fila_lamina["lamina3_trilaminado_grm2"];

//ACBADO
$lamina1_cortefinal=$fila_lamina["lamina1_cortefinal"];
$lamina1_sellado=$fila_lamina["lamina1_sellado"];

//DATOS DE LAMINA
$lamina1_dato=seleccionTabla($lamina1, "id_articulo", "syCoesa_articulo", $conexion);
$lamina2_dato=seleccionTabla($lamina2, "id_articulo", "syCoesa_articulo", $conexion);
$lamina3_dato=seleccionTabla($lamina3, "id_articulo", "syCoesa_articulo", $conexion);

//PRODUCTO TERMINADO
$producto_nombre=seleccionTabla($fila_did["id_articulo"], "id_articulo", "syCoesa_articulo", $conexion);

//LAMINAS - POLIETILENO
$rst_lamina1=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion);
$rst_lamina2=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion);
$rst_lamina3=mysql_query("SELECT * FROM syCoesa_articulo WHERE (id_tipo_articulo=3 AND mostrar_articulo=1) OR (id_tipo_articulo=6 AND mostrar_articulo=1) OR (id_tipo_articulo=13 AND mostrar_articulo=1) ORDER BY nombre_articulo ASC;", $conexion);

?>
<!DOCTYPE HTML>
<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/estilos_sis_coesa.css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

<!-- MENU -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jzScrollHorizontalPane.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.dimensions.js"></script>
<script type="text/javascript" src="/libs_js/effc_menu/jscript_jquery.mousewheel.min.js"></script>
<script type="text/javascript">
var jmenu = jQuery.noConflict();
jmenu(document).ready(function(){
	if(jmenu("#nav")) {
		jmenu("#nav dd").hide();
		jmenu("#nav dt b").click(function() {
			if(this.className.indexOf("clicked") != -1) {
				jmenu(this).parent().next().slideUp(200);
				jmenu(this).removeClass("clicked");
			}
			else {
				jmenu("#nav dt b").removeClass();
				jmenu(this).addClass("clicked");
				jmenu("#nav dd:visible").slideUp(200);
				jmenu(this).parent().next().slideDown(500);
			}
			return false;
		});
	}
});
</script>

<!-- COMBO -->
<link rel="stylesheet" href="/libs_js/jquery_ui/themes/base/jquery.ui.all.css">
<script src="/libs_js/jquery-1.7.2.min.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.core.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.button.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.position.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.autocomplete.js"></script>
<link rel="stylesheet" href="/libs_js/combo/css-select.css">
<script src="/libs_js/combo/js-select.js"></script>

<!-- SELECCION DE PROCESOS -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jLamProcSelc=jQuery.noConflict();
jLamProcSelc(document).ready(function(){
	
	jLamProcSelc("#lamina1_select").click(function(){	
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina1=jLamProcSelc("#dt_articulo1").val();
		
		jLamProcSelc.post("seleccionar-procesos.php", {lamina1: lamina1},
			function(data){
				jLamProcSelc("#lamina1_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
	jLamProcSelc("#lamina2_select").click(function(){
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina2=jLamProcSelc("#dt_articulo2").val();
		
		jLamProcSelc.post("seleccionar-procesos.php", {lamina2: lamina2},
			function(data){
				jLamProcSelc("#lamina2_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
	jLamProcSelc("#lamina3_select").click(function(){
		jLamProcSelc("#progressbar").removeClass("ocultar");
		var lamina3=jLamProcSelc("#dt_articulo3").val();
		
		jLamProcSelc.post("seleccionar-procesos.php", {lamina3: lamina3},
			function(data){
				jLamProcSelc("#lamina3_procesos").html(data);
				jLamProcSelc("#progressbar").addClass("ocultar");
			});
	});
	
});
</script>

</head>

<body>

<?php include("../../../header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_colores">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
            <h6>Datos Técnicos Básicos Laminas | <?php echo $producto_nombre["nombre_articulo"]; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                    <form action="actualizar.php" method="post">
                      
                      <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Monocapa</h2><br>
                                
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo1">Laminas:</label>
                                  <select name="dt_articulo1" id="dt_articulo1" class="cmbSlc w180">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina1=mysql_fetch_array($rst_lamina1)){
											//VARIABLES
											$lamina1_id=$fila_lamina1["id_articulo"];
											$lamina1_nombre=$fila_lamina1["nombre_articulo"];
											$lamina1_ancho=$fila_lamina1["ancho_articulo"];
											$lamina1_tipo=$fila_lamina1["id_tipo_articulo"];
											
											//FILTRO POLIETILENO
											$filtro1_polietileno=BuscarPalabra("POLIETILENO", $lamina1_nombre);
											$filtro1_pebd=BuscarPalabra("PEBD", $lamina1_nombre);
											$filtro1_pead=BuscarPalabra("PEAD", $lamina1_nombre);
											$filtro1_ppp=BuscarPalabra("PPP", $lamina1_nombre);
											
											if($lamina1==$lamina1_id){?>
										<option selected value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
									<?php }elseif($filtro1_polietileno==1 or $filtro1_pead==1 or $filtro1_pebd==1 or $filtro1_ppp==1){
												if($lamina1_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}elseif($lamina1_tipo<>13){
												if($lamina1_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}elseif($lamina1_tipo==13){
												if($lamina1_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina1_id; ?>"><?php echo $lamina1_nombre; ?></option>
                                    <?php }}} ?>
                                    
                                  </select>
                                  
                                    <a id="lamina1_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>

                                <div id="lamina1_procesos" class="w245 float_left">
                                	
                                    <?php if($lamina1>0){ ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina1_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina1_ancho" type="text" id="lamina1_ancho" value="<?php echo $lamina1_dato["ancho_articulo"]; ?>" readonly>
                                    </fieldset>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina1_grm2">GR / M2</label>
                                        <input class="w100 texto_der" name="lamina1_grm2" type="text" id="lamina1_grm2" value="<?php echo $lamina1_dato["grm2_articulo"]; ?>" readonly>
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <?php if($lamina1_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion1" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>
                                    </fieldset>
                                                                        
                                    <fieldset class="w235">
                                        <?php if($lamina1_impresion==1){ ?>
                                        <label><input checked id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_4" class="procesos_maquinas" name="impresion1" type="checkbox" value="1">&nbsp;Impresión</label>
                                        <?php } ?>
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <label for="grm2_tintaseca">GR / m2 (Tinta seca)</label>
                                      <input class="w140 texto_der" name="grm2_tintaseca" type="text" id="grm2_tintaseca" value="<?php echo $lamina1_impresion_grm2; ?>">
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <?php if($lamina1_rebobinado==1){ ?>
                                        <label><input checked id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_9" class="procesos_maquinas" name="rebobinado1" type="checkbox" value="1">&nbsp;Rebobinado</label>
                                        <?php } ?>
                                    </fieldset>
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 1 -->
                            
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Bilaminado</h2><br>
                                
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo2">Laminas:</label>
                                  <select name="dt_articulo2" id="dt_articulo2" class="cmbSlc">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina2=mysql_fetch_array($rst_lamina2)){
											//VARIABLES
											$lamina2_id=$fila_lamina2["id_articulo"];
											$lamina2_nombre=$fila_lamina2["nombre_articulo"];
											$lamina2_ancho=$fila_lamina2["ancho_articulo"];
											$lamina2_tipo=$fila_lamina2["id_tipo_articulo"];
											
											//FILTRO POLIETILENO
											$filtro2_polietileno=BuscarPalabra("POLIETILENO", $lamina2_nombre);
											$filtro2_pebd=BuscarPalabra("PEBD", $lamina2_nombre);
											$filtro2_pead=BuscarPalabra("PEAD", $lamina2_nombre);
											$filtro2_ppp=BuscarPalabra("PPP", $lamina2_nombre);
											
									if($lamina2==$lamina2_id){?>
										<option selected value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
									<?php }elseif($filtro2_polietileno==1 or $filtro2_pead==1 or $filtro2_pebd==1 or $filtro2_ppp==1){
												if($lamina2_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}elseif($lamina2_tipo<>13){
												if($lamina2_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}elseif($lamina2_tipo==13){
												if($lamina2_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina2_id; ?>"><?php echo $lamina2_nombre; ?></option>
                                    <?php }}} ?>
                                                                       
                                  </select>
                                  
                                    <a id="lamina2_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>
                                
                                <div id="lamina2_procesos" class="w245 float_left">
                                	
                                    <?php if($lamina2>0){ ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina2_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina2_ancho" type="text" id="lamina2_ancho" value="<?php echo $lamina2_dato["ancho_articulo"]; ?>" readonly>
                                    </fieldset>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina2_grm2">GR / M2</label>
                                        <input class="w100 texto_der" name="lamina2_grm2" type="text" id="lamina2_grm2" value="<?php echo $lamina2_dato["grm2_articulo"]; ?>" readonly>
                                    </fieldset>
                                   
                                    <fieldset class="w235">
                                        <?php if($lamina2_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion2" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>
                                    </fieldset>
                                                                                                           
                                    <fieldset class="w235">
                                    	<input id="procesos_maquinas_5" name="bilaminado2" type="hidden" value="1">
                                        <label for="grm2_bilaminado">GR / m2 (Adhesivo)</label>
                                      <input class="w140 texto_der" name="grm2_bilaminado" type="text" id="grm2_bilaminado" value="<?php echo $lamina2_bilaminado_grm2; ?>">
                                    </fieldset>
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 2 -->
                            
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Trilaminado</h2><br>
                            
                                <fieldset class="alto50 w235">
                                  <label for="dt_articulo3">Laminas:</label>
                                  <select name="dt_articulo3" id="dt_articulo3" class="cmbSlc">
                                    <option value>[ Seleccionar opcion ]</option>
                                    <?php while($fila_lamina3=mysql_fetch_array($rst_lamina3)){
											//VARIABLES
											$lamina3_id=$fila_lamina3["id_articulo"];
											$lamina3_nombre=$fila_lamina3["nombre_articulo"];
											$lamina3_ancho=$fila_lamina3["ancho_articulo"];
											$lamina3_tipo=$fila_lamina3["id_tipo_articulo"];
											
											$filtro3_polietileno=BuscarPalabra("POLIETILENO", $lamina3_nombre);
											$filtro3_pebd=BuscarPalabra("PEBD", $lamina3_nombre);
											$filtro3_pead=BuscarPalabra("PEAD", $lamina3_nombre);
											$filtro3_ppp=BuscarPalabra("PPP", $lamina3_nombre);
											
									if($lamina3==$lamina3_id){?>
										<option selected value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
									<?php }elseif($filtro3_polietileno==1 or $filtro3_pead==1 or $filtro3_pebd==1 or $filtro3_ppp==1){
												if($lamina3_ancho>=$formula_filtro_polietileno){ ?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}elseif($lamina3_tipo<>13){
												if($lamina3_ancho>=$formula_filtro_lamina){ ?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}elseif($lamina3_tipo==13){
												if($lamina3_ancho>=$formula_filtro_manga){?>
										<option value="<?php echo $lamina3_id; ?>"><?php echo $lamina3_nombre; ?></option>
                                    <?php }}} ?>
                                    
                                  </select>
                                  
                                    <a id="lamina3_select" class="boton_lamina"  href="javascript:;"></a>
                                  
                                </fieldset>
                                                            
                                <div id="lamina3_procesos" class="w245 float_left">
                                	
                                    <?php if($lamina3>0){ ?>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina3_ancho">Ancho</label>
                                        <input class="w100 texto_der" name="lamina3_ancho" type="text" id="lamina3_ancho" value="<?php echo $lamina3_dato["ancho_articulo"]; ?>" readonly>
                                    </fieldset>
                                    
                                    <fieldset class="w120">
                                        <label for="lamina3_grm2">GR / M2</label>
                                        <input class="w100 texto_der" name="lamina3_grm2" type="text" id="lamina3_grm2" value="<?php echo $lamina3_dato["grm2_articulo"]; ?>" readonly>
                                    </fieldset>
                                    
                                    <fieldset class="w235">
                                        <?php if($lamina3_extrusion==1){ ?>
                                        <label><input checked id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php }else{ ?>
                                        <label><input id="procesos_maquinas_3" class="procesos_maquinas" name="extrusion3" type="checkbox" value="1">&nbsp;Extrusión</label>
                                        <?php } ?>                                    
                                    </fieldset>
                                                                        
                                    <input id="procesos_maquinas_6" name="trilaminado3" type="hidden" value="1">
                                    
                                    <fieldset class="w235">
                                        <label for="grm2_trilaminado">GR / m2 (Adhesivo)</label>
                                      <input class="w140 texto_der" name="grm2_trilaminado" type="text" id="grm2_trilaminado" value="<?php echo $lamina3_trilaminado_grm2; ?>">
                                    </fieldset>
                                    
                                    <input name="rebobinado2" type="hidden" value="0">
                                	
                                    <?php } ?>
                                    
                                </div>
                                
                            </div><!-- FIN LAMINA 3 -->
                        	
                            <div class="w245 float_left border_der margin_r10">
                            	
                                <h2>Acabado</h2><br>
                                <fieldset class="w245">
                                	<?php if($lamina1_cortefinal==1){ ?>
                                    <label><input checked id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_7" class="procesos_maquinas" name="cortefinal" type="checkbox" value="1">&nbsp;Corte</label>
                                    <?php } ?>
                                </fieldset>
                                
                                <fieldset class="w245">
                                	<?php if($lamina1_sellado==1){ ?>
                                    <label><input checked id="procesos_maquinas_8" class="procesos_maquinas" name="sellado" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php }else{ ?>
                                    <label><input id="procesos_maquinas_8" class="procesos_maquinas" name="sellado" type="checkbox" value="1">&nbsp;Sellado</label>
                                    <?php } ?>
                                </fieldset>
                            
                            </div>
                       
                        <fieldset>
                                <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                                <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php?did=<?php echo $did; ?>&dart=<?php echo $dart; ?>&clt=<?php echo $clt; ?>&idlmpr=<?php echo $id_registro; ?>'">
                                <input name="id_registro" type="hidden" id="id_registro" value="<?php echo $id_registro; ?>">
                                <input name="did" type="hidden" id="did" value="<?php echo $did; ?>">
                                <input name="dart" type="hidden" id="dart" value="<?php echo $dart; ?>">
                                <input name="clt" type="hidden" id="clt" value="<?php echo $clt; ?>">
                            </fieldset>
                            
                        </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->

</body>
</html>