        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <ul class="nav nav-pills nav-stacked main-menu">
                        <li class="nav-header">Main</li>
                        <li><a class="ajax-link" href="index.php"><i class="glyphicon glyphicon-home"></i><span> Inicio</span></a>
                        </li>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-user"></i><span> Usuarios</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="us_buscar.php">Buscar</a></li>
                                <li><a href="us_nuevo.php">Nuevo</a></li>
                            </ul>
                        </li>
                        
                                       <?php
               if($_SESSION['tip_cli_web']==1) //uuario+ lista asistencia alumno
               {
               	
               	?>
               	<li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-user"></i><span> Usuarios  Lista</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="us_buscar_int.php">Buscar</a></li>
                                <li><a href="us_nuevo_int.php">Nuevo</a></li>
                            </ul>
                        </li>
               	
               	<?php
               }
               ?>
                        <li class="accordion">
                            <a href="#"><i class="glyphicon glyphicon-tags"></i><span> Lugares</span></a>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="lugar_buscar.php">Buscar</a></li>
                                <li><a href="lugar_nuevo.php">Nuevo</a></li>
                            </ul>
                        </li>
                        <li><a class="ajax-link" href="marcaciones.php"><i class="glyphicon glyphicon-ok"></i><span> Marcaciones</span></a>
                        </li>
                        <li><a class="ajax-link" href="dispositivos.php"><i class="glyphicon glyphicon-bookmark"></i><span> Dispositivos</span></a>
                        </li>
                        <li><a class="ajax-link" href="mapa.php"><i class="glyphicon glyphicon-map-marker"></i><span> Mapa</span></a>
                        </li>
                       
                    </ul>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->