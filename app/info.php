					<?php
					include("funciones.php");
					session_start();	
					if($_SESSION["demo_us"])
					{
					?>
						<div class="ui-bar ui-bar-a" style="text-align:center;">
					 		<?=MSG_DEMO?>
						</div>
						<br><br>
					<?php
					}
					?>
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Informaci&oacute;n
					</div>
    	    <p id="form_interior">
						<span class=titulo_interior>Asistencia Remota</span>
						<br>
						<span class=texto_interior>Te permite registrar asistencia en cualquier lugar, siempre y cuando tengas conexi&oacute;n a Internet, mediante 3G o Wifi.</span>
						
					</p>      
					
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Sincronizaci&oacute;n
					</div>
					<p id="form_interior">					
						<div id=id_sync_info></div>
					</p>
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Ayuda
					</div>
					<p id="form_interior">
						<span class=titulo_interior>Como realizar una marcaci&oacute;n</span>
						<br>
						<span class=texto_interior>Para realizar una marcaci&oacute;n debe seleccionar un lugar de la lista de marcaciones o favoritos.<br>Algunas marcaciones son configuradas para marcar Entrada o Salida, si esta opci&oacute;n no est&aacute; configurada por defecto la marcaci&oacute;n se considera Entrada. </span>
						
					</p>   
					<p id="form_interior">
						<span class=titulo_interior>Marcaciones Offline</span>
						<br>
						<span class=texto_interior>Cuando el dispositivo se encuentra sin internet este pasa a modo Offline. Todas las marcaciones que se realicen ser&aacute;n almacenadas localmente hasta que el dispositivo se vuelva a conectar a internet y se le de la orden de sincronizar. Para realizar la sincronizaci&oacute;n debe seguir los pasos se&ntilde;alados en la secci&oacute;n sincronizaci&oacute;n. </span>
						
					</p>   
    	    <p id="form_interior">
						<span class=titulo_interior><img src="images/fav2.png" width=20px> Favoritos</span>
						<br>
						<span class=texto_interior>En esta secci&oacute;n podr&aacute;n almacenar sus accesos directos a marcaciones que seleccione el usuario desde Marcaciones.</span>
						
					</p>      
					<p id="form_interior">
						<span class=titulo_interior><img src="images/icon-servicios.png" width=20px> Marcaciones</span>
						<br>
						<span class=texto_interior>En esta secci&oacute;n se listaran el total de marcaciones disponibles para el usuario. Para realizar una marcaci&oacute;n seleccione de la lista el lugar y siga los pasos. </span>
						
					</p>   
					<p id="form_interior">
						<span class=titulo_interior><img src="images/historial.png" width=20px> Historial</span>
						<br>
						<span class=texto_interior>En esta secci&oacute;n se listaran las marcaciones ya realizadas hasta 1 mes. </span>
						
					</p>   
					<p id="form_interior">
						<span class=titulo_interior><img src="images/ticket-32.png" width=20px> Listado</span>
						<br>
						<span class=texto_interior>Una vez realizada la marcaci&oacute;n se listara  la asistencia o  procedimientos asociados a la marcaci&oacute;n. Esta opci&oacute;n solo est&aacute; disponible para para plan full. <br>Si quiere hacer upgrade de su cuenta contacte a <?=CORREO_COORPORATIVO?></span>
						<span class=texto_interior><br><br> Esta opci&oacute;n solo esta disponible cuando el dispositivo esta conectado a internet ya sea Wi-fi o datos moviles.</span>
						
					</p>   
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Contacto
					</div>
    	    <p id="form_interior">					
						
						<span class=texto_interior>Cualquier inquietud comun&iacute;cate v&iacute;a <?=CORREO_COORPORATIVO?><br>Todos los derechos reservados a Architeq.cl</span>
						
					</p>          
					<script>
						
						if(TOT_MARCAS > 0)
 						{ 							
 							$("#id_sync_info").html("Existen "+TOT_MARCAS+" marca(s) registradas de manera offline disponibles para sincronizaci&oacute;n.<br><input type='button' value='Sincronizar' onclick='checkInternet(2);'>");
 						}else
 						{ 							
 							$("#id_sync_info").html("No hay marcas disponibles para sincronizaci&oacute;n");
 						}
					</script>
					