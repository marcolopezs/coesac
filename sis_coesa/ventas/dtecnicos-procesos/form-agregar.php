<?php
session_start();
require_once("../../../connect/conexion.php");
require_once("../../../connect/function.php");
require_once("../../../connect/sesion/verificar_sesion.php");

//WEB
$web="http://coesac.marostsac.com/";

//CLIENTE
$rst_maquina=mysql_query("SELECT * FROM syCoesa_mantenimiento_maquinas ORDER BY nombre_maquina ASC;", $conexion);

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

<!-- COMBO -->
<link rel="stylesheet" href="/libs_js/jquery_ui/themes/base/jquery.ui.all.css">
<script src="/libs_js/jquery-1.7.2.min.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.core.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.widget.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.button.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.position.js"></script>
<script src="/libs_js/jquery_ui/ui/jquery.ui.autocomplete.js"></script>
<style>
.ui-combobox {
	position: relative;
	display: inline-block;
}
.ui-button {
	position: absolute;
	top: 0;
	bottom: 0;
	margin-left: -1px;
	padding: 0;
	/* adjust styles for IE 6/7 */
	*height: 1.7em;
	*top: 0.1em;
}
.ui-autocomplete-input {
	margin: 0;
	padding: 0.3em;
}
</style>
<script>
var jcmb = jQuery.noConflict();
(function( jcmb ) {
	jcmb.widget( "ui.combobox", {
		_create: function() {
			var input,
				self = this,
				select = this.element.hide(),
				selected = select.children( ":selected" ),
				value = selected.val() ? selected.text() : "",
				wrapper = jcmb( "<span>" )
					.addClass( "ui-combobox" )
					.insertAfter( select );

			input = jcmb( "<input>" )
				.appendTo( wrapper )
				.val( value )
				.addClass( "ui-state-default" )
				.autocomplete({
					delay: 0,
					minLength: 0,
					source: function( request, response ) {
						var matcher = new RegExp( jcmb.ui.autocomplete.escapeRegex(request.term), "i" );
						response( select.children( "option" ).map(function() {
							var text = jcmb( this ).text();
							if ( this.value && ( !request.term || matcher.test(text) ) )
								return {
									label: text.replace(
										new RegExp(
											"(?![^&;]+;)(?!<[^<>]*)(" +
											jcmb.ui.autocomplete.escapeRegex(request.term) +
											")(?![^<>]*>)(?![^&;]+;)", "gi"
										), "<strong>$1</strong>" ),
									value: text,
									option: this
								};
						}) );
					},
					select: function( event, ui ) {
						ui.item.option.selected = true;
						self._trigger( "selected", event, {
							item: ui.item.option
						});
					},
					change: function( event, ui ) {
						if ( !ui.item ) {
							var matcher = new RegExp( "^" + jcmb.ui.autocomplete.escapeRegex( jcmb(this).val() ) + "$", "i" ),
								valid = false;
							select.children( "option" ).each(function() {
								if ( jcmb( this ).text().match( matcher ) ) {
									this.selected = valid = true;
									return false;
								}
							});
							if ( !valid ) {
								jcmb( this ).val( "" );
								select.val( "" );
								input.data( "autocomplete" ).term = "";
								return false;
							}
						}
					}
				})
				.addClass( "ui-widget ui-widget-content ui-corner-left" );

			input.data( "autocomplete" )._renderItem = function( ul, item ) {
				return jcmb( "<li></li>" )
					.data( "item.autocomplete", item )
					.append( "<a>" + item.label + "</a>" )
					.appendTo( ul );
			};

			jcmb( "<a>" )
				.attr( "tabIndex", -1 )
				.attr( "title", "Show All Items" )
				.appendTo( wrapper )
				.button({
					icons: {
						primary: "ui-icon-triangle-1-s"
					},
					text: false
				})
				.removeClass( "ui-corner-all" )
				.addClass( "ui-corner-right ui-button-icon" )
				.click(function() {
					if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
						input.autocomplete( "close" );
						return;
					}
					jcmb( this ).blur();
					input.autocomplete( "search", "" );
					input.focus();
				});
		},
		destroy: function() {
			this.wrapper.remove();
			this.element.show();
			jcmb.Widget.prototype.destroy.call( this );
		}
	});
})( jQuery );

jcmb(function() {
	jcmb( "#procesos_maquina" ).combobox();
});
</script>

<!-- SPRY -->
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextField.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationSelect.css">
<link rel="stylesheet" type="text/css" href="/libs_js/SpryAssets/SpryValidationTextarea.css">
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationSelect.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextField.js"></script>
<script type="text/javascript" src="/libs_js/SpryAssets/SpryValidationTextarea.js"></script>

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

<?php include("../../../sis_coesa/header.php"); ?>

<section id="cuerpo">
  
  	<?php require_once("../../../sis_coesa/menu.php"); ?>
    
    <section id="contenido">
    	
        <div id="datos_procesos">
        	
            <div class="formulario_datos">

              <div class="frmdt_cabecera"><h6>Datos Técnicos Procesos</h6></div>
            
                <div class="frmdt_contenido">
                    
                  <form action="guardar.php" method="post">
                        
                        <fieldset class="alto50">
                          <label for="procesos_maquina">Máquina:</label>
                          <span id="spry_procesos_maquina">
                          <select name="procesos_maquina" id="procesos_maquina">
                            <option value>[ Seleccionar opcion ]</option>
                            <?php while($fila_maquina=mysql_fetch_array($rst_maquina)){
								//VARIABLES
								$maquina_id=$fila_maquina["id_maquina"];
								$maquina_nombre=$fila_maquina["nombre_maquina"];
							?>
                            <option value="<?php echo $maquina_id; ?>"><?php echo $maquina_nombre; ?></option>
                            <?php } ?>
                          </select>
                          <span class="selectInvalidMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span>
                          <span class="selectRequiredMsg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="procesos_grm2">Gr x m2:</label>
                          <span id="spry_procesos_grm2">
                          <input type="text" name="procesos_grm2" id="procesos_grm2" size="50" class="an50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                        <fieldset class="alto50">
                            <label for="procesos_velocidad">Velocidad:</label>
                          <span id="spry_procesos_velocidad">
                          <input type="text" name="procesos_velocidad" id="procesos_velocidad" size="50" class="an50">
                          <span class="textfieldRequiredMsg">(*)</span>
                          <span class="textfieldInvalidFormatMsg">(*)</span></span>
                        </fieldset>
                        
                   		<fieldset>
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("spry_procesos_grm2", "real");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_procesos_velocidad", "integer");
var spryselect1 = new Spry.Widget.ValidationSelect("spry_procesos_maquina", {invalidValue:"-1"});
</script>
</body>
</html>