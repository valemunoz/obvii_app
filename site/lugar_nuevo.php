<?php
include("../includes/funciones.php");
//$data=getRegistros();
$estado_web=estado_sesion_web();
if($estado_web!=0)
{
	?>
	<script>
		window.location="login.php";
	</script>
	<?php 
	
}
$empresa=getCliente($_SESSION['id_cliente_web']);
//print_r($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <title>Obvii</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
    <meta name="author" content="Muhammad Usman">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <link href='css/style.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="images/icon.png">
<style>
			#mapa_int , #mapa_int2
				{
					width:500px !important;
					height:400px !important;
				
				}
</style>
</head>

<body>
    <!-- topbar starts -->
    <?php
    include("header.php");
    ?>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
    <?php
    include("left.php");
    ?>

       

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Inicio</a>
        </li>
        <li>
            <a href="us_buscar.php">Nuevo Lugar</a>
        </li>
    </ul>
</div>
    	  <div class="modal fade" id="myMapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Mapa</h3>
                </div>
                <div class="modal-body">
                	<div id="mapa_int"></div>
                    
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <!--a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a-->
                </div>
            </div>
        </div>
    </div>

<div class="row" id="filtro_user">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Formulario Registro</h2>

                <div class="box-icon">
                   
                   
                    
                </div>
            </div>
            <div class="box-content">
                

                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Nombre</label>
                    <input type="text" class="form-control" id="nombre_em" name="nombre_em">
                </div>
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Mail Notificaci&oacute;n</label>
                    <input type="text" class="form-control" id="mail_em" name="mail_em">
                </div> 
                
                <?php
				if($_SESSION['tip_cli_web']==1)
				{
					?>
					 <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Mail Notificaci&oacute;n Lista</label>
                    <input type="text" class="form-control" id="mail2_em" name="mail2_em">
                </div> 
					<div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Orden Listado</label>
                    <input type="radio"  id="opc_1" name="group2" checked>Ingreso <input type="radio"  id="opc_2" name="group2">Nombre
                </div> 
					
				<?php
				}
				?>	
                <div class="control-group">
                    <label class="control-label" for="selectError">Comentario</label>

                    <div class="controls">
                        <select id="slider2" name="slider2" data-rel="chosen">
                            <option value="off" selected>No</option>
                            <option value="on">Si</option>
                            
                            
                        </select>
                    </div>
                    
                </div>
             <div class="control-group">
                    <label class="control-label" for="selectError">Entrada/Salida?</label>

                    <div class="controls">
                        <select name="slider1" id="slider1" data-rel="chosen">
                            <option value="off" selected>No</option>
                            <option value="on">Si</option>
                            
                            
                        </select>
                    </div>
                    
                </div>
                
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Calle</label>
                    <input type="text" class="form-control" id="calle_em" name="calle_em">
                </div> 
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">N&uacute;mero</label>
                    <input type="text" class="form-control" id="num_em" name="num_em">
                </div> 
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Comuna</label>
                    <input type="text" class="form-control" id="com_em" name="com_em">
                </div> 
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Latitud</label>
                    <input type="text" class="form-control" id="lat_em" name="lat_em">
                </div> 
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Longitud</label>
                    <input type="text" class="form-control" id="lon_em" name="lon_em">
                </div> 
                <br>
                <div id="msg_error_add" class="msg_error"></div>
			<div id="msg_ayuda" class="msg_error">
			1: Ingresa los datos: nombre, mail, calle, numero y comuna<br>
			2: Selecciona boton "GEO" para obtener localizaci&oacute;n de la direcci&oacute;n ingresada<br>
			3: Selecciona "Ver Mapa" para confirmar la posicion del lugar<br>
			4: Registra el lugar
		</div>
                <div class="input-group col-md-4">
                	<button type="submit" class="btn btn-default" onclick="BuscarGeo();">GEO</button>
                	<button type="submit" class="btn btn-default" onclick="verMapa(document.getElementById('lat_em').value,document.getElementById('lon_em').value);">Ver Mapa</button>
                	<button type="submit" class="btn btn-default" onclick="saveEmpresa();">Registrar</button>
                   
                </div>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->



    <hr>

   

    <?php
    include("footer.php");
    ?>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
<script src="http://www.chilemap.cl/OpenLayers/OpenLayers.js"></script>
<script src="http://www.chilemap.cl/js/funciones_api.js"></script>
<script src="js/funciones.js"></script>


<script>
limpiarNewEmpresa();	
	</script>
	<div id="output"></div>
</body>
</html>

