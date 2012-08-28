<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//VARIABLES URL
$id_registro=$_REQUEST["id"];

//ARTICULOS
$rst_articulo=mysql_query("SELECT * FROM syCoesa_articulo_tipo WHERE id_tipo_articulo=$id_registro;", $conexion);
$fila_articulo=mysql_fetch_array($rst_articulo);
$num_articulo=mysql_num_rows($rst_articulo);
if($num_articulo==0){ header("Location:lista.php"); }

//ARTICULOS - VARIABLES
$tipo_articulo_id=$fila_articulo["id_tipo_articulo"];
$tipo_articulo_nombre=$fila_articulo["nombre_tipo_articulo"];
$tipo_articulo_abreviado=$fila_articulo["abreviado_tipo_articulo"];
$tipo_articulo_observaciones=$fila_articulo["observaciones_tipo_articulo"];

?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>COESA</title>

<!-- ESTILOS -->
<link rel="stylesheet" type="text/css" href="/css/normalize.css">
<link rel="stylesheet" type="text/css" href="/css/estilos_sis_coesa.css">

<!-- FUENTES -->
<link href='http://fonts.googleapis.com/css?family=Cuprum:400,700' rel='stylesheet' type='text/css'>

<!-- DESHABILITAR ENTER -->
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>
var jEnter = jQuery.noConflict();
jEnter(document).ready(function() {
    jEnter("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

<!-- TEXT AREA -->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/libs_js/jquery.textareaCounter.plugin.js"></script>
<script type="text/javascript">
var jtxtar = jQuery.noConflict();
jtxtar(document).ready(function(){
	var almart_observaciones = {
			'maxCharacterSize': 255,
			'originalStyle': 'originalTextareaInfo',
			'warningStyle' : 'warningTextareaInfo',
			'warningNumber': 40,
			'displayFormat' : '#input/#max'
	};
	jtxtar('#almart_observaciones').textareaCount(almart_observaciones);	
});
</script>

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

</head>

<body>

<?php include("../../header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera">
                <h6>Tipo de Articulos | ID: <?php echo $tipo_articulo_id; ?></h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="actualizar.php" method="post">
                                                
                    	<fieldset class="alto50">
                            <label for="almart_articulo">Nombre:</label>
                            <span id="spry_almart_articulo">
                            <input name="almart_articulo" type="text" id="almart_articulo" value="<?php echo $tipo_articulo_nombre; ?>" size="50">
                            <span class="textfieldRequiredMsg"></span></span>
                      	</fieldset>
                                                                       
                        <fieldset class="alto50">
                            <label for="almart_abreviacion">Abreviación:</label>
                          <span id="spry_almart_abreviacion">
                          <input name="almart_abreviacion" type="text" class="an50" id="almart_abreviacion" value="<?php echo $tipo_articulo_abreviado; ?>" size="50">
                          <span class="textfieldRequiredMsg"></span>
                          <span class="textfieldMaxCharsMsg"></span></span>
                        </fieldset>
                        
                        <fieldset>
                            <label for="almart_observaciones">Observaciones:</label>
                            <textarea name="almart_observaciones" cols="100" rows="8" id="almart_observaciones"><?php echo $tipo_articulo_observaciones; ?></textarea>
                        </fieldset>
                        
                        <fieldset>
                        	<input name="almart_id" type="hidden" id="almart_id" value="<?php echo $tipo_articulo_id; ?>">
                            <input name="dtp_btnenviar" type="submit" id="dtp_btnenviar" value="Guardar datos">
                            <input name="dtp_btnenviar" type="button" id="dtp_btnenviar" value="Cancelar" onClick="parent.location='lista.php'">
                        </fieldset>
                        
                    </form>
                    
                </div>
                     
            </div><!-- FIN FORMULARIO DATOS -->
        
        </div><!-- FIN DATOS PROCESOS -->
    
    </section><!-- FIN SECTION CONTENIDO -->
    
</section><!-- FIN SECTION -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_almart_articulo");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_almart_abreviacion", "none", {maxChars:50});
</script>
</body>
</html>