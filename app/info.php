						<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Ayuda
					</div>
    	    <p id="form_interior">
						<span class=titulo_interior>Asistencia Remota</span>
						<br><br>
						<span class=texto_interior>Te permite registrar asistencia en cualquier lugar, siempre y cuando tengas conexi&oacute;n a Internet, mediante 3G o Wifi.</span>
						
					</p>      
					
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Sincronizaci&oacute;n
					</div>
					<p id="form_interior">					
						<div id=id_sync_info></div>
					</p>
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Informaci&oacute;n
					</div>
    	    <p id="form_interior">					
						
						<span class=texto_interior>Cualquier inquietud comun&iacute;cate v&iacute;a contacto@architeq.cl<br>Todos los derechos reservados a Architeq.cl</span>
						
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
					