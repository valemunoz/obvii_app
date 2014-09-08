<?php
include("funciones.php");
$estado_sesion=estado_sesion();
$data_server= explode("?",$_SERVER['HTTP_REFERER']);
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
if(substr(strtolower($data_server[0]),0,strlen(PATH_SITE))==PATH_SITE)
{
if($_REQUEST['tipo']==1) //check estado sesion
{
	
	$estado_sesion=estado_sesion();
	if($estado_sesion==1)
	{
		?>
		<script>
		cambiar("mod_sesion");
		</script>
		<?php
	}else
	{
		
		?>
		<script>
		$("#bienvenido_div").html("Bienvenido : <?=$_SESSION['id_usuario']?>");
		
		loadFav();
		</script>
		<?php
		
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
				bar +='<li ><a  href="javascript:loadHome();"><img src="images/icon-servicios.png"></a></li>';
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
				bar +='<li ><a  href="javascript:loadHome();"><img src="images/icon-servicios.png"></a></li>';
				
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
	$fecha=getFechaLibre(744); // 31 dias
	$marcaciones=getMarcaciones(" and fecha_registro >= '".$fecha."' and id_usuario ilike '%".$_SESSION["id_usuario"]."%' and id_usuario_obvii=".$_SESSION["id_usuario_obvii"]." order by fecha_registro desc");
	//print_R($marcaciones);
	?>
	
	<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					Historial de Asistencia
					</div>
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
		 $largo=20;
		 if($_SESSION['tipo_usuario']=="computer")
		 {
		 	$largo=100;
		 }elseif($_SESSION['tipo_usuario']=="tablet")
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
							
					</p>          
					<p id="form_login">
						<input type="button" onclick="validaMarcacion();" value="Marcar">
					</p>

	<?php
}elseif($_REQUEST['tipo']==5)
{
	$estado_sesion=estado_sesion();
$lugares=getLugares(" and id_lugar=".$_REQUEST['id']."");
if($lugares[0][12]=='t')
{
	$check2="selected";
	$check1="";
}else
{
	$check2="";
	$check1="selected";
}
if($lugares[0][13]=='t')
{
	$check_s2="selected";
	$check_s1="";
}else
{
	$check_s2="";
	$check_s1="selected";
}

?>
					<div class="ui-bar ui-bar-a" id=barra_sup style="text-align:center;">
					 Descripci&oacute;n Lugar
					</div>
    	    <p id="form_interior">
						
						<label for="text-basic">Nombre del Lugar</label>
						<span class=titulo_basico><?=ucwords($lugares[0][1])?></span>
						<label for="text-basic">Direcci&oacute;n</label>
						<span class=titulo_basico><?=ucwords($lugares[0][6])?> #<?=$lugares[0][7]?>,<?=ucwords($lugares[0][8])?></span>
						<label for="text-basic">Correo Electronico</label>
						<span class=titulo_basico><?=$lugares[0][10]?></span>
						<label for="text-basic">Comentario?</label>
						<select name="slider2" id="slider2" data-role="slider" data-theme="b">
    					<option value="off" <?=$check1?>>No</option>
    					<option value="on" <?=$check2?>>Si</option>
						</select> <span class=texto_interior>Esta opci&oacute;n activa una casilla de comentario cada vez que se ejecute una acci&oacute;n con el lugar registrado.</span>
							<br><br>
							<label for="text-basic">Entrada y Salida??</label>
						<select name="slider1" id="slider1" data-role="slider" data-theme="b">
    					<option value="off" <?=$check_s1?>>No</option>
    					<option value="on" <?=$check_s2?>>Si</option>
						</select> <span class=texto_interior>Esta opci&oacute;n activa la opci&oacute;n de marcar una salida para este lugar.</span>
					</p>          
					<p id="form_login">
						<?php
						$favorito=getFavoritos(" and id_usuario ilike '".$_SESSION["id_usuario"]."' and estado=0 and id_lugar=".$_REQUEST['id']."");
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
						?>
					</p>
<?php
}
}else
{
	
}
?>