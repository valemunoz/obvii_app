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
	
}else
{
	$usuarios=getUsuarios(" and estado=0 and id_cliente=".$_SESSION['id_cliente_web']."");
	$new_us=getUsuarios(" and estado=0 and id_cliente=".$_SESSION['id_cliente_web']." and fecha_registro >='".getFechaLibre(24)."'");
	$disposs=getDispositivos(" and estado=1 and id_cliente=".$_SESSION['id_cliente_web']."");
	$marcas=getMarcaciones(" and id_cliente=".$_SESSION['id_cliente_web']." and fecha_registro >='".getFechaLibre(744)."' order by fecha_registro desc");
	$marcas_hoy=getMarcaciones(" and id_cliente=".$_SESSION['id_cliente_web']." and fecha_registro >='".date("Y-m-d")." 00:00:00'");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta charset="utf-8">
    <title>Obvii- Administrador</title>
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
    <!--script src="bower_components/jquery/jquery.min.js"></script-->
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
        
    </ul>
</div>
<div class=" row">
    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?=count($new_us)?> Miembros nuevos" class="well top-block" href="us_buscar.php">
            <i class="glyphicon glyphicon-user blue"></i>

            <div>Total Usuarios</div>
            <div><?=count($usuarios)?></div>
            <span class="notification"><?=count($new_us)?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?=count($disposs)?> Dispositivos en espera" class="well top-block" href="dispositivos.php">
            <i class="glyphicon glyphicon-bookmark green"></i>

            <div>Dispositivos</div>
            
            <span class="notification green"><?=count($disposs)?></span>
        </a>
    </div>

    <div class="col-md-3 col-sm-3 col-xs-6">
        <a data-toggle="tooltip" title="<?=count($marcas_hoy)?> Marcaciones hoy" class="well top-block" href="marcaciones.php">
            <i class="glyphicon glyphicon-tags yellow"></i>

            <div>Lugares/Marcas</div>
            <div><?=count($marcas)?></div>
            <span class="notification yellow"><?=count($marcas_hoy)?></span>
            
        </a>
    </div>

    
</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Introduction</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    <h1>Obvii <br>
                        <small>free, premium quality, responsive, multiple skin admin template.</small>
                    </h1>
                    <p>Its a live demo of the template. I have created Charisma to ease the repeat work I have to do on my
                        projects. Now I re-use Charisma as a base for my admin panel work and I am sharing it with you
                        :)</p>

                    
                </div>
  

             

            </div>
        </div>
    </div>
</div>

<div class="row">


    <div class="box col-md-4">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-user"></i> Actividad de Usuarios</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="box-content">
                    <ul class="dashboard-list">
                        	<?php
                    	foreach($marcas as $i => $marc)
                    	{
                    	?>
                        <li>
                            <a href="#">
                                
                            <strong>Name:</strong> <a href="#"><?=$marc[1]?>
                            </a><br>
                            <strong>Fecha:</strong> <?=$marc[3]?><br>
                            <?php
                            if($marc[10]==0)
                            {
                            ?>
                            	<strong>Marca:</strong> <span class="label-success label label-default">Entrada</span>
                            <?php
                          	}else
                          	{
                          		?>
                          		<strong>Marca:</strong> <span class="label-default label label-danger">Salida</span>
                          		<?php
                          	}
                            ?>
                        </li>
                        <?php
                        if($i==9)
                        {
                        	break;
                        }
                      }
                        ?>
                                      
            
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--/span-->

    <div class="box col-md-4">
        <div class="box-inner homepage-box">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-list-alt"></i> Publicidad</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i
                            class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <h3>banner/img 320x300</h3>
                

            </div>
        </div>
    </div>
    <!--/span-->
</div><!--/row-->


    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->



    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

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
<script>
	//$('#myModal').modal('show');
	</Script>
</body>
</html>
