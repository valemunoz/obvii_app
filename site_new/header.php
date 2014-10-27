<div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"> 
                <img src="images/obvii-logo-white.png" id="img_header"></a>

            <!-- user dropdown starts -->
            <div class="btn-group pull-right">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-user"></i><span class="hidden-sm hidden-xs"> <?=$_SESSION["usuario_web"]?></span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    
                    <li class="divider"></li>
                    <li><a href="login.php">Salir</a></li>
                </ul>
            </div>
            <!-- user dropdown ends -->

     

            <ul class="collapse navbar-collapse nav navbar-nav top-menu">
                <li><a href="http://www.architeq.cl/obvii.html" target=_BLANK><i class="glyphicon glyphicon-globe"></i> Ir al sitio</a></li>

            </ul>

        </div>
    </div>