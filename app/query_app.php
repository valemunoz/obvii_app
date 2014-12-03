<?php
include("funciones.php");
$estado_sesion=estado_sesion();
$data_server= explode("?",$_SERVER['HTTP_REFERER']);
require_once("Mobile_Detect.php");
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
//if(substr(strtolower($data_server[0]),0,strlen(PATH_SITE))==PATH_SITE)
if (isset($_SERVER['HTTP_ORIGIN'])) {  
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");  
    header('Access-Control-Allow-Credentials: true');  
    header('Access-Control-Max-Age: 86400');   
}  
  
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {  
  
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))  
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");  
  
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))  
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");  
}
 $fech=getFechaLibre(DIF_HORA);
 
 if($estado_sesion==0)
 {
 	  $usuar=getUsuario(" and mail ilike '".$_SESSION["id_usuario"]."'");
 	  $id_device=$usuar[8];
 	  if(trim($id_device)=="")
 	  {
 	  	cerrar_sesion();
 	  	?>
						<script>
							deleteUser();
							//window.location.href="index.html";
							
						</script>
		<?php
 	  }
 	  

 }
?>
<script>
	
	var dateNube = new Date('<?=substr($fech, 0,10)?> <?=substr($fech, 10)?>');
	var ub="<?=$fech?>";
	updateNubeUser(ub);
	
	</script>
<?php  

if($_REQUEST['tipo']==1) //check estado sesion
{
	
	$estado_sesion=estado_sesion();
	if($estado_sesion==1)
	{
		?>
		<script>
		//cambiar("mod_sesion");
		$("#ll_dip").show(); 
		stopWatchPosition();
		inicio_ses();
		</script>
		<?php
	}else
	{
		$cliente=getCliente(" and id_cliente=".$_SESSION["id_cliente"]."");
		$_SESSION['documento']=$cliente[0][6];
		?>
		<script>
			$("#ll_dip").hide(); 
			if(watchEstado)
			{
				startWatchPosition();
			}
			loadMenu();	
		loadFav();
		
	  	
		$("#bienvenido_div").html("Bienvenido : <?=$_SESSION['id_usuario']?> <span id=id_sync_wel></span>");	
		var gps="<?=$_SESSION['gps']?>";
		
		
		if(gps=="t" || gps=="true")
		{
			watchEstado=true;
			document.getElementById("checkbox-2a").checked=true;
		}else
			{
				watchEstado=false;
				document.getElementById("checkbox-2a").checked=false;
			}
  	mostrarMenu();	
		
		
		</script>
		<?php
		if($_SESSION["demo_us"])
 	  {
 	  	?>
 	  	<script>
 	  		USER_DEMO=true;
 	  		mensaje(MSG_DEMO,'Demo','myPopup');
 	  		</Script>
 	  	<?php
 	  	
 	  }
		
	}
}elseif($_REQUEST['tipo']==2)
{
			if($_SESSION["tipo_cli"]==1)
			{
			?>
			<script>
				
				$(".ui-page-active .maintenance_tabs").empty();
				var bar='<div data-role="navbar" id=list_nav class="maintenance_tabs">';
				bar +='<ul id="myNavbar">';
				bar +='<li ><a  href="javascript:loadFav();"><img src="images/fav2.png"></a></li>';
				bar +='<li ><a  id=li_home href="javascript:loadHome();"><img src="images/icon-servicios.png"></a></li>';
				bar +='<li ><a  href="javascript:loadAsis();"><img src="images/ticket-32.png"></a></li>';
				bar +='<li><a href="javascript:loadHistorial();"><img src="images/historial.png"></a></li>';
				bar +='<li><a href="javascript:loadInfo();"><img src="images/icon-info.png"></a></li>';
				bar +='</ul>';
				bar +='</div>';
				
  			$(".ui-page-active .maintenance_tabs").append(bar).trigger('create');
				</script>

		
			<?php
		}else
		{
			?>
			<script>
				
				$(".ui-page-active .maintenance_tabs").empty();
				var bar='<div data-role="navbar" id=list_nav class="maintenance_tabs">';
				bar +='<ul id="myNavbar">';
				bar +='<li ><a  href="javascript:loadFav();"><img src="images/fav2.png"></a></li>';
				bar +='<li ><a id=li_home href="javascript:loadHome();"><img src="images/icon-servicios.png"></a></li>';
				
				bar +='<li><a href="javascript:loadHistorial();"><img src="images/historial.png"></a></li>';
				bar +='<li><a href="javascript:loadInfo();"><img src="images/icon-info.png"></a></li>';
				bar +='</ul>';
				bar +='</div>';
				
  			$(".ui-page-active .maintenance_tabs").append(bar).trigger('create');
				</script>
			<?php
		}
			

}elseif($_REQUEST['tipo']==3) //historial
{
	$fecha=getFechaLibre(336); // 31 dias
	$marcaciones=getMarcaciones(" and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' order by fecha_registro desc");
	//echo " and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' order by fecha_registro desc";
	//print_R($marcaciones);
	?>
	
	<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Historial de Asistencia
	</div>
	<span class=texto_interior>Los registros desplegados corresponden a los ultimos 14 d&iacute;as</span>
	<ul data-role="listview"  data-theme="b"  data-filter="true" data-filter-placeholder="Buscar" data-inset="false" id="list_registros">	
				
	
	<?php
	foreach($marcaciones as $marca)
	{
		$lugar=getLugares(" and id_lugar=".$marca[5]."");
		$txt_hora="<img width=20px src='images/icon-servicios.png'>  ";
		if($marca[3]>= date("Y-m-d"))
				$txt_hora .=substr($marca[3], 11);
		else
				$txt_hora .=$marca[3];
		$clase="txt_mini2";
		
		$fecha=$marca[3];
		$segundos=strtotime(getFecha())-strtotime($fecha);
		//$diferencia_dias=intval($segundos/60/60/24);
	  $diferencia_horas=intval($segundos/60/60);

		if($diferencia_horas > 8)
		{
			$clase="txt_mini3";
		}
		$icono="<img class='ui-li-icon ui-corner-none' src='images/entrada.png'>";
		if($marca[10]==1)
		   $icono="<img class='ui-li-icon ui-corner-none' src='images/salida.png'>";
		   $esp="";		   
		$nombre=ucwords($lugar[0][1]);   
		if($marca[4]==1)
		{
		   $esp="marca_esp";
		   $nombre=ucwords($marca[11]);
		 }
		 $largo=10;
		 if($deviceType=="computer")
		 {
		 	$largo=100;
		 }elseif($deviceType=="tablet")
		 {
		 	$largo=40;	
		 }
		 
		 if(strlen($nombre)> $largo)
		 {
		 	$paso=true;
		 	$nom_resto=$nombre;
		 	$nombre_final="";
		 	while($paso)
		 	{ 		
		 	 $nombre2=substr($nom_resto, 0,$largo);	
		 	 $nom=substr($nom_resto, $largo);		 	 
		 	 $nombre_final .="<br>".$nombre2;
		 		if(trim($nom)!="")
		 		{
		 				
		 				$nom_resto=$nom;
		 		}else
		 		{
		 		  $paso=false;		
		 		}
		 	}
		 	$nombre=$nombre_final;
		}
	?>
	
		<li class=<?=$esp?>><?=$icono?><span class=titulo2><?=$nombre?></span><p class="ui-li-aside"><span class=<?=$clase?>><?=$txt_hora?></span></p></li>
	
				
	<?php
	}
	?>
	</ul>	
	<?php
}elseif($_REQUEST['tipo']==4)
{
	?>
						<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Marcaci&oacute;n Libre
					</div>
    	    <p id="form_interior">
						
						<label for="text-basic">Nombre del Lugar</label>
						<input type="text" class=input_form2 name="nom_lug" id="nom_lug" placeholder="ejemplo: Clinica del Norte">						
						<label for="text-basic">Calle</label>
						<input type="text" class=input_form2 name="calle_lug" id="calle_lug" placeholder="juan esteban montero">		
						<label for="text-basic">N&uacute;mero</label>
						<input type="text" class=input_form2 name="num_lug" id="num_lug" placeholder="4550">		
						<label for="text-basic">Comuna</label>
						<input type="text" class=input_form2 name="com_lug" id="com_lug" placeholder="Las condes">		
						<label for="text-basic">Correo Electronico</label>
						<input type="text" class=input_form2 name="mail_lug" id="mail_lug" placeholder="Correo Destino">	
						<label for="text-basic">Comentario</label>	
						<textarea cols="40" rows="4" name="textarea" id="coment_lug" name="coment_lug"></textarea>
						<label for="text-basic">Entrada/Salida?</label>
						<select name="slider1" id="slider1" data-role="slider" data-theme="b">
    					<option value="0" selected>Entrada</option>
    					<option value="1">Salida</option>
    				</select>
							
					</p>          
					<p id="form_login">
						<input type="button" onclick="validaMarcacion();" value="Marcar">
						<br><br>
					</p>

	<?php
}elseif($_REQUEST['tipo']==5)
{
	$estado_sesion=estado_sesion();
$lugares=getLugares(" and id_lugar=".$_REQUEST['id']."");
if($lugares[0][12]=='t')
{
	$comen="SI";
}else
{
	$comen="NO";
}
if($lugares[0][13]=='t')
{
	$marca="Entrada/Salida";
}else
{
	$marca="Entrada";
}

?>
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Descripci&oacute;n Lugar
					</div>
    	    <p id="form_interior">
						
						<label for="text-basic">Nombre del Lugar</label>
						<span class=titulo_basico><?=ucwords($lugares[0][1])?></span>
						<?php
						if(!$_SESSION["demo_us"])
						{
						?>
						<label for="text-basic">Direcci&oacute;n</label>
						<span class=titulo_basico><?=ucwords($lugares[0][6])?> #<?=$lugares[0][7]?>,<?=ucwords($lugares[0][8])?></span>
						<label for="text-basic">Correo Electronico</label>
						<span class=titulo_basico><?=$lugares[0][10]?></span>
						<?php
						}
						?>
						
						<label for="text-basic">Comentario?</label>
						<span class=titulo_basico><?=$comen?></span> <br><span class=texto_interior>Esta opci&oacute;n activa una casilla de comentario cada vez que se ejecute una acci&oacute;n con el lugar registrado.</span>
							<br><br>
							<label for="text-basic">Entrada y Salida??</label>
						<span class=titulo_basico><?=$marca?></span> <br><span class=texto_interior>Esta opci&oacute;n activa la opci&oacute;n de marcar una salida para este lugar.</span>
					</p>          
					<p id="form_login">
						<?php
						
						if(!$_SESSION["demo_us"])
						{
					
							$favorito=getFavoritos(" and id_usuario ilike '".$_SESSION["id_usuario"]."' and estado=0 and id_lugar=".$_REQUEST['id']."");
							?>
								<input type="button" onclick="marcar(<?=$lugares[0][0]?>,'<?=$lugares[0][12]?>','<?=$lugares[0][13]?>');" value="Marcar">
							<?php
							if(count($favorito)> 0)
							{
								?>
								<input type="button" onclick="delFav(<?=$favorito[0][0]?>)" value="Eliminar Favoritos">
								<?php
							}else
							{
								?>
								<input type="button" onclick="addFav(<?=$_REQUEST['id']?>)" value="Agregar Favoritos">
								<?php
							}
							
							$html="<div class=titulo>".ucwords($lugares[0][1])."</div>";
							$html .="<div class=titulo_pop>".ucwords($lugares[0][6])." #".$lugares[0][7].", ".ucwords($lugares[0][8])."</div>";
							?>
							<input type="button" onclick="verMapa(<?=$lugares[0][5]?>,<?=$lugares[0][4]?>,'<?=$html?>');" value="Ver en el Mapa">
							
							<?php
						}else
						{
							$favorito=getFavoritos(" and id_usuario ilike '".$_SESSION["id_usuario"]."' and estado=0 and id_lugar=".$_REQUEST['id']."");
							if(count($favorito)> 0)
							{
							?>
								<input type="button" onclick="mensaje('Este servicio no esta disponible para su tipo de usuario.','Alerta','myPopup');" value="Eliminar Favoritos">
								<?php
							}else
							{
								?>
								<input type="button" onclick="mensaje('Este servicio no esta disponible para su tipo de usuario.','Alerta','myPopup');" value="Agregar Favoritos">
								<?php
							}
						}
						?>
					</p>
<?php
}elseif($estado_sesion==0 and $_REQUEST['tipo']==6)
	{
		
		$fecha=date("Ymd");
		try
		{

			$lugares=getLugares(" and estado=0 and id_cliente=".$_SESSION["id_cliente"]." order by nombre");
			
			if(count($lugares)>0)
			{
					foreach($lugares as $lug)
					{
						$nombre=$lug[1];
						$fav=getFavoritos(" and estado=0 and id_usuario  ilike '".$_SESSION["id_usuario"]."' and id_lugar=".$lug[0]."");
						$favo=0;
						if(count($fav)>0)
						{
						  $favo=1;
						}

					?>
						
						<script>
							//alert('<?=$lug[0]?>');
							addLugarBDLocal('<?=$lug[0]?>','<?=$nombre?>','<?=$lug[6]?> #<?=$lug[7]?>, <?=$lug[8]?>','<?=$favo?>','<?=date("Y-m-d")?>','<?=$lug[12]?>','<?=$lug[13]?>');
						</Script>	
						
				  <?php
					
					}
				
			}
		}catch (Exception $e) 
		{
			
		}
	
 
	}elseif($estado_sesion==0 and $_REQUEST['tipo']==7)
	{
	if(!$_SESSION["demo_us"])
	{
		$cliente=getCliente(" and id_cliente=".$_SESSION["id_cliente"]."");
		$mail_envio=$cliente[0][3];
		
		$ids=explode("|",$_REQUEST['ide']);
		$lat=explode("|",$_REQUEST['lat']);
		$lon=explode("|",$_REQUEST['lon']);
		$fec=explode("|",$_REQUEST['fecha']);
		$descrip=explode("|",$_REQUEST['decrip']);
		$tipo=explode("|",$_REQUEST['tip']);
		$nombre=explode("|",$_REQUEST['nombre']);
		$dir=explode("|",$_REQUEST['direc']);
		$nube=explode("|",$_REQUEST['nub_marca']);
		$local=explode("|",$_REQUEST['loc_marca']);
		$accu=0;
		foreach($ids as $i => $id)
		{
			if(trim($id)!="")
			{
				$lug=getLugares(" and id_lugar=".$id."");
				if(trim($lug[0][10])!="")
				{
					$mail_envio=$lug[0][10];
				}
				if($id!=0)
				{
					try
					{
						$registros=new SoapClient("".PATH_WS_OBVII."".WS_MARCACION."");
						if($lat[$i]==0 or $lon[$i]==0)
						{
							$lat[$i]=-33.000;
							$lon[$i]=-70.000;
						}
					 	$res= $registros->registrarEvento($_SESSION['id_usuario_obvii'], ''.substr($fec,0,10).'', ''.trim(substr($fec,11)).'', ''.$lat[$i].'',''.$lon[$i].'',''.$accu.'',''.$lug[0][1].'','9988776644','478000012',''.$descrip[$i].'','8888999922',''.$mail_envio.'');
					 
					 if($res>0)
					 {
					 	$data=array();
					 	$data[]=$_SESSION["id_usuario"];
					 	$data[]=$_SESSION["id_usuario_obvii"];
					 	$data[]=0;
					 	$data[]=$id;
					 	$data[]=$lat[$i];
					 	$data[]=$lon[$i];
					 	$data[]=0;
					 	$data[]=$descrip[$i];
					 	$data[]=$tipo[$i];
					 	$data[]=$lug[0][1];
					 	$data[]=$_SESSION["id_cliente"];
					 	$data[]="".$lug[0][6]." #".$lug[0][7].", ".$lug[0][8]." ";
					 	$data[]=$fec[$i];
					 	$data[]=$nube[$i];
					 	$data[]=$local[$i];
	
					 	//$data[]=getFechaLibre(DIF_HORA);
					 	//$data[]=getFechaLibre(DIF_HORA);
					 	//$data[]=getFechaLibre(DIF_HORA);
					 	$data[]='true';
					 	
					 	
					 	addMarcacion($data);
					 	
		 				senMailMarcacion(1,$lat[$i],$lon[$i],$tipo[$i],$lug[0][1],$fec[$i],$mail_envio,"",$descrip[$i]."[Marcacion sincronizada]");
		 
	      	
					 	}else
						{
							?>
						<script>
							sync_marca=false;
							
						</script>
						<?php
						}
							
					} catch (Exception $e) 
					{
						?>
						<script>
							sync_marca=false;
							//mensaje("Problemas de conexi&oacute;n, por favor int&eacute;ntelo nuevamente.","ERROR","myPopup_ses");
						</script>
						<?php
					}
				}else //marca libre
				{
					try
					{
						$registros=new SoapClient("".PATH_WS_OBVII."".WS_MARCACION."");
						if($lat[$i]==0 or $lon[$i]==0)
						{
							$lat[$i]=-33.000;
							$lon[$i]=-70.000;
						}
					 	$res= $registros->registrarEvento($_SESSION['id_usuario_obvii'], ''.substr($fec,0,10).'', ''.trim(substr($fec,11)).'', ''.$lat[$i].'',''.$lon[$i].'',''.$accu.'',''.$nube[$i].'','9988776644','478000012',''.$descrip[$i].'','8888999922',''.$mail_envio.'');
					 
					 if($res>0)
					 {
							$data=array();
				 			$data[]=$_SESSION["id_usuario"];
				 			$data[]=$_SESSION["id_usuario_obvii"];
				 			$data[]=1;
				 			$data[]=0;
				 			$data[]=$lat[$i];
				 			$data[]=$lon[$i];
				 			$data[]=0;
				 			$data[]=$descrip[$i];
				 			$data[]=$tipo[$i];
				 			$data[]=$nombre[$i];
				 			$data[]=$_SESSION["id_cliente"];
				 			$data[]=$dir[$i];
				 			$data[]=$fec[$i];
				 			$data[]=$nube[$i];
					 		$data[]=$local[$i];
				 			$data[]='true';
				 			addMarcacion($data);
				 			senMailMarcacion(2,$lat[$i],$lon[$i],$tipo[$i],$nombre[$i],$fec[$i],$mail_envio,$dir[$i],$descrip[$i]);
				 		}
				 	} catch (Exception $e) 
					{
						?>
						<script>
							sync_marca=false;
							mensaje(MSG_ERR_CONEC,"ERROR","myPopup_ses");
						</script>
						<?php
					}
				  
				}
			}
		}
		

	}else
	{
			?>
			<script>
				
				$.mobile.loading( 'hide');
				mensaje(MSG_USER_DEMO,'Alerta','myPopup');
				</Script>
			<?php
	}
	}elseif($_REQUEST['tipo']==8) //dispositivos
	{
		$usuario=getUsuario(" and nickname ilike '".trim(strtolower($_REQUEST['mail']))."' and estado=0");
		if(count($usuario)>0)
		{
			$data=array();
			$data[]=$_REQUEST['uuid_user'];
			$data[]=1;
			$data[]=$usuario[0];
			$data[]=$usuario[4];
			addDispositivo($data);
			?>
			<script>
				$.mobile.loading( 'hide');
				
				mensaje("Solicitud enviada.",'Mensaje','myPopup_ses');	
				</script>
			<?php
		}else
		{
			?>
			<script>
				
				$.mobile.loading( 'hide');
				mensaje("Usuario no valido.",'Error','myPopup_ses');	
				</script>
			<?php
			
		}
	}elseif($_REQUEST['tipo']==9) // marcaciones via mail
{
	
	
		$tipo=$_REQUEST['opc'];
		if($tipo==1)//diario
		{
			$titulo="Del d&iacute;a";
				$fecha=date("Y-m-d");
				$marcaciones=getMarcaciones(" and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' and id_usuario_obvii=".$_SESSION["id_usuario_obvii"]." order by fecha_registro");
			
		}elseif($tipo==2) // mes
		{
			$titulo="Ultimo mes";
				$fecha=getFechaLibre(744); // 31 dias			
				$marcaciones=getMarcaciones(" and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' and id_usuario_obvii=".$_SESSION["id_usuario_obvii"]." order by fecha_registro");
		}elseif($tipo==3) // ultimos 3 meses
		{
			$titulo="Ultimos 3 meses";
				$fecha=getFechaLibre(2232); // 31 dias			
				$marcaciones=getMarcaciones(" and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' and id_usuario_obvii=".$_SESSION["id_usuario_obvii"]." order by fecha_registro");
		}elseif($tipo==4) // todas
		{
				$titulo="Historial Completo";
				$marcaciones=getMarcaciones(" and id_usuario ilike '%".$_SESSION["id_usuario"]."%' and id_usuario_obvii=".$_SESSION["id_usuario_obvii"]." order by fecha_registro");
		}
	
		if(count($marcaciones)>0)
		{
			$html="Marcaciones solicitadas: ".$titulo."<br><br>";
			$html .="<table>";
			$html .="<tr>";
			$html .="<td width=5%>ID</td>";
			$html .="<td width=40%>NOMBRE</td>";
			$html .="<td width=25%>FECHA</td>";
			$html .="<td width=15%>TIPO</td>";
			$html .="</tr>";
			foreach($marcaciones as $i => $marca)
			{
				$tip="Entrada";
				if($marca[10]==1)
				  $tip="Salida";
				$html .="<tr>";
				$html .="<td>".$marca[0]."</td>";
				$html .="<td>".ucwords($marca[11])."</td>";
				$html .="<td>".$marca[3]."</td>";
				$html .="<td>".$tip."</td>";
				$html .="</tr>";	
			}
			$html .="</table>";
			sendMail(trim($_SESSION["id_usuario"]),$html,"Marcaciones obvii");
			?>
			<script>
				$.mobile.loading( 'hide');
				mensaje("Marcaciones enviadas.",'MENSAJE','myPopup');
				</Script>
			<?php
		}else
		{
			?>
			<script>
				
				$.mobile.loading( 'hide');
				mensaje("No hay marcaciones disponibles para enviar.",'MENSAJE','myPopup');
				</Script>
			<?php
		}
		
		
		
	
}elseif($_REQUEST['tipo']==10)
{
	$envio=true;
	$mail=strtolower(trim($_REQUEST['mail']));
	$msg="";
	$usuario=getUsuario(" and mail ilike '".$mail."' and estado=0");
	$dispositivo=getUsuario(" and id_device ilike '".$_REQUEST['device']."'");
	if(count($usuario)>0 or count($dispositivo)>0)
	{	
		$envio=false;
		$msg="Mail ya se encuentra registrado<br>";
		if(count($dispositivo)>0)
		{
			$msg="Este dispositivo ya esta asociado a un usuario.<br>";
		}
	}else
	{
	
		try
		{
	  	$usuarios=new SoapClient("".PATH_WS_OBVII."".WS_REGISTROUSUARIO."");
    	$res= $usuarios->registrarUsuario($mail, $_REQUEST['nombre'], $_REQUEST['clave'],  '1', '0', '0', '1', '0', '0');
    	
    	if ($res==1) 
    	{
    		
    		$eventos=new SoapClient("".PATH_WS_OBVII."".WS_LOGIN."");
				$res= $eventos->validarUsuario($mail,trim($_REQUEST['clave']));
		  	//if ($res==$_REQUEST['clave']) 
    		if ($res >0) 
    		{
    			
					$data=array();							
					$data[]=$mail;
					$data[]=CLI_DEMO;
					$data[]=0;
					$data[]=$_REQUEST['clave'];
					$data[]=strtolower($_REQUEST['nombre']);
					$data[]=0;
					$data[]=$_REQUEST['device'];
					$data[]="false";
					$data[]=$mail;
					$data[]=$_REQUEST['empresa'];
					$data[]=$_REQUEST['mail_emp'];
					addUsuario($data);
					$html=MSG_BIENVENIDA_OBVII;
					$html=str_replace("_MAIL_",$mail,$html);
					$html=str_replace("_CLAVE_",$_REQUEST['clave'],$html);
					sendMail($mail,$html,MSG_TITULO_OBVII);
					$usuario_new=getUsuario(" and mail ilike '".$mail."' and estado=0");
					
					$data=array();
					$data[]=$mail;
					$data[]=$res;
					$data[]=19;
					addFavorito($data);
					$msg="Usuario Registrado exitosamente";
					
				}else
				{
					$envio=false;
					$msg="Se produjo un error. Por favor intentelo nuevamente<br>";
				}
			}else
			{
				$envio=false;
				$msg="Ya se encuentra un usuario registrado con la cuenta mail ".$mail."<br>";
			}
		
	}catch (Exception $e) 
			{
				$envio=false;
				$msg="Se produjo un error. Por favor intentelo nuevamente<br>";
			}
	}
	if(!$envio)
	{
			?>
			<script>
				//mensaje('<?=$msg?>','Alerta','myPopup_reg');
				$("#msg_error_reg").html('<?=$msg?>');
			</script>
			<?php
	}else
	{
		?>
			<script>
				//volver();
				$("#mod_registro").dialog( "close" );
				document.getElementById("mail_ses").value="<?=$mail?>";
				setTimeout("$('#clave_ses').focus();",500);

			</script>
			<?php
		
	}
}elseif($_REQUEST['tipo']==11) //watch position
{
	$lon=$_REQUEST['lon'];
	$lat=$_REQUEST['lat'];
	$precision=$_REQUEST['prec'];
	$speed=$_REQUEST['speed'];
	$heading=$_REQUEST['heading'];
	if(!is_numeric($speed))
	{
		$speed=0;
	}
	if(!is_numeric($heading))
	{
		$heading=0;
	}
	$data=array();
	$data[]=$_SESSION["id_usuario_obvii"];
	$data[]=$_SESSION["id_usuario"];
	$data[]=$lat;
	$data[]=$lon;
	$data[]=0;
	$data[]=$speed;
	$data[]=$precision;
	$data[]=$heading;
	$data[]=$_SESSION["id_cliente"];
	$data[]=$_SESSION["nickname"];
	addRuta($data);
}elseif($_REQUEST['tipo']==12) //gps
{
	$_SESSION['gps']=$_REQUEST['gps'];
	$usuario=getUsuario(" and nickname ilike '".$_SESSION["nickname"]."' and estado=0");
	updateUsuario("gps='".$_REQUEST['gps']."'",$usuario[0]);
	
}elseif($_REQUEST['tipo']==13) //lugares cercanos al un punto
{
	$lon=$_REQUEST['lon'];
	$lat=$_REQUEST['lat'];
	$favorito=getFavoritos(" and id_usuario ilike '".$_SESSION["id_usuario"]."' and estado=0"); 
	$favo=array();
	foreach($favorito as $fav)
	{
		$favo[]=$fav[3];
	}
	$empresas=getLugares(" and id_lugar in(".implode(',',$favo).")");
	//$empresas=getEmpresaRadio($lat,$lon,RADIO);
	foreach($empresas as $emp)
	{
		$texto="<div class=titulo>".ucwords($emp[1])."</div>";
		$texto .="<div class=titulo_pop>".ucwords($emp[6])." #".$emp[7]."</div>";
		$texto .="<div class=titulo_pop>".ucwords($emp[8])."</div>";
		//$texto .="<div class=titulo_pop2>Distancia: ".ucwords($emp[2])."Mts</div>";
		
		//$lug=getLugares(" and id_lugar=".$emp[0]."");
		$comenta=0; //true
		$marca=0;
		if($emp[12]=='f')
		   $comenta=1;
		if($emp[13]=='f')
		   $marca=1;
		 /* marcar(<?=$lug[0][0]?>,<?=$comenta?>,<?=$marca?>); */
		$texto .='<br><div align=center><input class=boton_pop type=button value=Marcar onclick=marcar('.$emp[0].','.$comenta.','.$marca.');><br><input class=boton_pop type=button value=Zoom onclick=moverCentro('.$emp[4].','.$emp[5].',16);></div><br>';
		
		
		
		?>
		<script>
			addMarcadores("<?=$emp[5]?>","<?=$emp[4]?>","<?=$texto?>","images/marker_ini.png",40,40);
			</script>
		<?php
	}
	
}elseif($_REQUEST['tipo']==14) //hora servidor
{
	$fech=getFechaLibre(DIF_HORA);
	?>
	<script>
		$("#mypanel").panel( "close" );
		mensaje("Fecha y hora actual del sistema: <?=$fech?>",'Mensaje','myPopup');
	</script>
		
	<?php
}elseif($_REQUEST['tipo']==15) //ubicacion actual
{
	if(isset($_REQUEST['mail']))
	{
		sendMail($_REQUEST['mail'],$_SESSION['mail_pop'],"Ubicacion Obvii");
		
	}else
	{
		$direc=getDireccionGoogleLATLON($_REQUEST['lat'],$_REQUEST['lon']);
		$texto_mail ="El usuario ".$_SESSION['nickname']." le ha enviado su ubicacion actual <br><br>";
		$texto_mail .="Cerca de: ".trim($direc[0][3])." #".trim($direc[0][2]).", ".trim($direc[0][4])."<br>";
		$texto_mail .="Coordenadas: ".$_REQUEST['lat'].",".$_REQUEST['lon']."<br>";
		$link=str_replace("_LON_",$_REQUEST['lon'],PATH_CHILEMAP);
		$link=str_replace("_LAT_",$_REQUEST['lat'],$link);
		$texto_mail .="<a href='".trim($link)."'>Ver ubicacion</a>";
		unset($_SESSION['mail_pop']);
		$_SESSION['mail_pop']=$texto_mail;
		
		
		$texto="<div class=titulo>Ubicaci&oacute;n Actual</div>";
		$texto .="<div class=titulo_pop>".$direc[0][3]." #".$direc[0][2]."</div>";
		$texto .="<div class=titulo_pop>".$direc[0][4]."</div>";
		$texto .="<div class=titulo_pop2>".$_REQUEST['lat'].",".$_REQUEST['lon']."</div>";
		$texto .="<div class=titulo>Enviar por correo</div>";
		$texto .="<div class=titulo_pop><input placeholder='e-mail' type=text class=boton_pop2 id=mail_pop name=mail_pop></div>";
		$texto .="<div class=titulo_pop><input type=button class=boton_pop value='Enviar' onclick=enviarMailPop();></div>";
		
		?>
		<script>
			addMarcadores(<?=$_REQUEST['lon']?>,<?=$_REQUEST['lat']?>,"<?=$texto?>","images/point.png",40,40);
			</script>
		<?php
	}
}

?>