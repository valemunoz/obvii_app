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
$lugares=getLugares(" and id_cliente=".$_SESSION['id_cliente_web']." order by nombre");
						
						
		$checB="";
		$checA="";
		if($_SESSION['web_opcion']==2)
		{
			$checB="checked";	
		}else
		{
			$checA="checked";	
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
    <script src="../js/jquery-1.10.2.min.js"></script>

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

       

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    <ul class="breadcrumb">
        <li>
            <a href="index.php">Inicio</a>
        </li>
        <li>
            <a href="us_buscar.php">Nuevo Usuario</a>
        </li>
    </ul>
</div>

<div class="row" id="filtro_user">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Formulario Registro</h2>

                <div class="box-icon">
                   
                   
                    
                </div>
            </div>
            <form enctype="multipart/form-data" class="formulario">
            <div class="box-content">
                

                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Nombre</label>
                    <input type="text" class="form-control" id="nom_us" name="nom_us">
                </div>
                <div class="control-group">
                    <label class="control-label" for="selectError">Estado</label>

                    <div class="controls">
                        <select id=est_us name=est_us data-rel="chosen">
                            <option value=0 selected>Activo</option>
                            <option value=1>Inactivo</option>
                            
                            
                        </select>
                    </div>
                    
                </div>
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Tipo Lista</label>
                    <input type="radio"  id="lug" name="group2" checked><img src="img/student-64.png" width=20px> <input type="radio"  id="lug2" name="group2"><img src="img/ticket.png" width=20px>
                </div> 
                
                 <div class="control-group">
                    <label class="control-label" for="selectError">Lugar</label>

                    <div class="controls">
                    	<select id=tipo_us name=tipo_us data-rel="chosen">
							<?php
							foreach($lugares as $lug)
							{
								$check="";
								
								if($_SESSION['web_lugar']==$lug[0])
								{
									$check="selected";
								}
								?>
								<option value='<?=$lug[0]?>' <?=$check?>><?=ucwords($lug[1])?></option>
								<?php
							}
							?>
						</select>		
                    </div>
                    
                </div>
                <div class="input-group col-md-4" >
                    <label class="control-label" for="inputSuccess1">Imagen</label>
                    <input type="file" name="i_file" id="i_file" value="" class="form-control">
                </div>
                                
                <div class="input-group col-md-4">
                    <label class="control-label" for="inputSuccess1">Descripci&oacute;n</label>
                    <textarea name="descript" id="descript" rows="4" cols="50" class=form-control></textarea>
                </div> 
               
                
               
                <br>
                <div id="msg_error_add" class="msg_error"></div>
                <div class="input-group col-md-4">
                	<input type="button" onclick="saveUsuarioInt();" value="Registrar">
                   
                </div>
            </div>
          </form>
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
<script src="js/funciones.js"></script>
<div id="output"></div>
<script>
	limpiarNewUSInt();
	</script>
</body>
</html>

