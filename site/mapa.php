<?php
include("../includes/funciones.php");

$estado_web=estado_sesion_web();
if($estado_web!=0)
{
	?>
	<script>
		window.location="login.php";
	</script>
	<?php 
	
}

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

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Inicio</a>
            </li>
            <li>
                <a href="mapa.php">Mapa</a>
            </li>
        </ul>
    </div>
<div class="row" id="filtro_user">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Filtro</h2>

                <div class="box-icon">
                   
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <label class="control-label" for="selectError">Vista</label>

                    <div class="controls ">
                        <select id="em_estado" name="em_estado" data-rel="chosen">
                            
                           <option value=0 checked>Linea</option>
												<option value=1>Punto</option>
                            
                        </select>
                    </div>
                    
                </div>

                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Usuario</label>
                    <input type="text" class="form-control" id="nom_em" name="nom_em">
                </div>
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Desde</label>
                    <input type="text" class="form-control" id="desde" name="desde" value="<?=date("Y-m-d")?>">
                </div> 
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Hasta</label>
                    <input type="text" class="form-control" id="hasta" name="hasta">
                </div> 
                <br>
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">B&uacute;squeda</label><br>
                    <input type="radio"  id="opc_1" name="group2" checked>Ruta  <input type="radio"  id="opc_2" name="group2">Marcaciones  <input type="radio"  id="opc_3" name="group2">Ultimas Marcaciones
                  
                </div> 
                </br>
                <div class="input-group col-md-4">
                	<button type="submit" class="btn btn-default" onclick="loadMapaData();">Generar</button>
                   
                </div>
            </div>
        </div>
    </div>
    <!--/span-->

</div><!--/row-->
<div class="row" >
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" >
                <h2><i class="glyphicon glyphicon-globe"></i> Mapa</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-50 col-md-12">
                   <div id="mapa"></div>
                </div>
 

            </div>
        </div>
    </div>
</div>

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

<script src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false"></script>
<script src="js/funciones.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.datetimepicker.css"/ >

<script src="../js/jquery.datetimepicker.js"></script>

  <script src="http://www.chilemap.cl/OpenLayers/OpenLayers.js"></script>
	 	<script src="http://www.chilemap.cl/js/funciones_api_v2.js"></script>
  
  <script>
  	


		 $(function() {
    		//$( "#desde" ).datepicker({dateFormat:"yy-mm-dd"});
    		$( "#desde" ).datetimepicker({format:'Y-m-d H:i:00',lang:'es'});
  			});	

		 $(function() {
    		//$( "#hasta" ).datepicker({dateFormat:"yy-mm-dd"});
    		$( "#hasta" ).datetimepicker({format:'Y-m-d H:i:00',lang:'es'});
  			});	
  			

		
	var CM_farma_turno=false;	
	init("mapa");
  //loadMapaData();
	</script>
	<div id="output"></div>


</body>
</html>
