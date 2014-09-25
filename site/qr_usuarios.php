<?php
include("../includes/funciones.php");
$data_server= explode("?",$_SERVER['HTTP_REFERER']);
$estado_sesion=estado_sesion_web();
if(substr(strtolower($data_server[0]),0,strlen(PATH_SITE_WEB))==PATH_SITE_WEB)
{
	if($_REQUEST['tipo']==1 and $estado_sesion==0) //lista de usuarios
	{
		$cliente=$_SESSION['id_cliente_web'];
		$estado=$_REQUEST['estado'];
		$mail=$_REQUEST['mail'];
		$nombre=$_REQUEST['nombre'];
		
		if(trim($cliente)!="")
		{
			$query .=" and id_cliente=".$cliente.""	;
		}
		if(trim($estado)!="" and $estado!=10)
		{
			$query .=" and estado=".$estado.""	;
		}
		if(trim($mail)!="")
		{
			$query .=" and mail ilike '%".$mail."%'"	;
		}	
		if(trim($nombre)!="")
		{
			$query .=" and nombre ilike '%".$nombre."%'"	;
		}	
		$query .=" order by nombre";
		
		$usuarios=getUsuarios($query);
		//print_r($usuarios);
		?>
		<table border=1 id="table_resul" class="bordered">
			<!--	<tr class="titulo">-->
				<tr>
					<th style="width:5%;">ID</th>				
					<th style="width:30%;">NOMBRE</th>	
					<th style="width:20%;">MAIL</th>				
					<th style="width:20%;">TIPO</th>					
					<TH style="width:25%;">PANEL</TH>
				</tr>
			<?php
			foreach($usuarios as $i=> $us)
			{
			  $tipo="Usuario";
			  if($us[5]==1)
			    $tipo="Administrador";
				?>
				<tr>
					
					<td style="width:5%;"><?=$us[0]?></td>				
					<td style="width:30%;"><?=$us[7]?></td>	
					<td style="width:20%;"><?=$us[1]?></td>				
					<td style="width:20%;"><?=ucwords($tipo)?></td>
					
					<Td style="width:25%;">
						
						<a href="javascript:loadUsuario('<?=encrypt($us[0],ENCRIPTACION)?>');">Editar</a>	
						
						<?php
						if($us[3]==0)
						{
							?>
							| <a href="javascript:upUsuarioEst(1,'<?=encrypt($us[0],ENCRIPTACION)?>');">Bajar</a>	
							<?php
						}else
						{
							?>
							| <a href="javascript:upUsuarioEst(0,'<?=encrypt($us[0],ENCRIPTACION)?>');">Subir</a>	
							<?php
							
						}
						?>
						</Td>
				</tr>
				<?php
			}
			?>
			</table>
		<?php
	}elseif($_REQUEST['tipo']==2 and $estado_sesion==0)//Editar usuario
	{		
		$id=decrypt($_REQUEST['usuario'],ENCRIPTACION);
		$usuario=getUsuario(" and id_usuario=".$id."");
		
		$check1="selected";
		$check12="";
		if($usuario[5]==1)
		{
			$check1="";
			$check2="selected";
		}
		
		$check3="checked";
		$check="";
		if($usuario[9]=='t')
		{
			$check3="";
			$check="checked";
		}
		?>
		<table border=1 id="table_resul" class="bordered">
			<tr><td>Nombre</td><td><input id="nom_us" name="nom_us" type="text" value="<?=$usuario[7]?>"></td></tr>	
			<tr><td>Mail</td><td><input id="mail_us" name="mail_us" type="text" value="<?=$usuario[1]?>"></td></tr>		
			<tr><td>Clave</td><td><input id="clave" name="clave" type="text" value="<?=$usuario[6]?>"></td></tr>		
			<tr><td>Dispositivo</td><td><input id="dis_us" name="dis_us" type="text" value="<?=$usuario[8]?>"></td></tr>		
			<tr><td>Acceso Web</td><td><input type="radio"  id="web_si" name="group2" <?=$check?>>SI <input type="radio"  id="web_no" name="group2" <?=$check3?>>NO</td></tr>		
			<tr><td>Tipo Usuario</td>
				<td>
						<select id=tipo_us name=tipo_us>
							<option value=0 <?=$check1?>>Normal</option>
							<option value=1 <?=$check2?> >Administrador</option>
						</select>		
				</td></tr>
			
			<tr><td></td><td><input type="button" onclick="updateUsuario('<?=encrypt($id,ENCRIPTACION)?>');" value="Guardar"></td></tr>
		</table>
		<div id="msg_error_up" class="msg_error"></div>
			<?php
	}elseif($_REQUEST['tipo']==3 and $estado_sesion==0)//update usuario
	{
		$dispo=getUsuario(" and id_device ilike '".$_REQUEST["dis_us"]."'");		
		$id_send=decrypt($_REQUEST['id'],ENCRIPTACION);
		
		
		if(count($dispo)==0 or trim($id_send)==trim($dispo[0]) or trim($_REQUEST["dis_us"])=="")
		{
			updateUsuario("web_device='".$_REQUEST["web_us"]."',id_device='".$_REQUEST["dis_us"]."', mail='".$_REQUEST['mail']."', tipo_usuario=".$_REQUEST['tipo_us'].", nombre='".$_REQUEST['nom']."', clave='".$_REQUEST['clave']."'",decrypt($_REQUEST['id'],ENCRIPTACION));
			?>
			<script>
				CloseModalReg();
				filtrar_us();
				</script>
			<?php
		}else
		{
			?>
			<script>
				$( "#msg_error_up" ).html("Dispositivo ingresado ya se encuntra registrado.");
				</script>
			<?php
			
		}
	}elseif($_REQUEST['tipo']==4 and $estado_sesion==0)//nuevo usuario
	{
			?>
			<table border=1 id="table_resul" class="bordered">
				<tr><td>Nombre</td><td><input id="nom_usnew" name="nom_usnew" type="text" value=""></td></tr>		
				<tr><td>Mail</td><td><input id="mail_usnew" name="mail_usnew" type="text" value=""></td></tr>		
				<tr><td>Clave</td><td><input id="key_usnew" name="key_usnew" type="text" value=""></td></tr>
				<tr><td>Dispositivo</td><td><input id="dis_usnew" name="dis_usnew" type="text" value=""></td></tr>		
				<tr><td>Acceso Web</td><td><input type="radio"  id="web_sinew" name="group2" checked>SI <input type="radio"  id="web_nonew" name="group2">NO</td></tr>				
				<tr><td>Tipo Usuario</td>
				<td>
						<select id=tipo_usnew name=tipo_usnew>
							<option value=0>Normal</option>
							<option value=1>Administrador</option>
						</select>		
				</td></tr>
				<tr><td></td><td><input type="button" onclick="saveUsuario();" value="Registrar"></td></tr>
			</table>
			<div id="msg_error_add" class="msg_error"></div>
				<?php
	}elseif($_REQUEST['tipo']==5 and $estado_sesion==0)//Nuevo usuario
	{
		$data=array();
		$data[]=$_REQUEST['mail'];
		$data[]=$_SESSION['id_cliente_web'];
		$data[]=$_REQUEST['tipo_us'];
		$data[]=$_REQUEST['clave'];
		$data[]=$_REQUEST['nombre'];
		$data[]=$_REQUEST["dis_us"];
		$data[]=$_REQUEST["web_us"];
		
		$dispo=getUsuario(" and id_device ilike '".$_REQUEST["dis_us"]."'");
		if(count($dispo)==0 or trim($_REQUEST["dis_us"])=="")
		{
			
			try
			{
	  		$usuarios=new SoapClient("".PATH_WS_OBVII."".WS_REGISTROUSUARIO."");
    		$res= $usuarios->registrarUsuario($_REQUEST['mail'], $_REQUEST['nombre'], $_REQUEST['clave'],  '1', '0', '0', '1', '0', '0');
    		if ($res==1) {
    	  
				addUsuario($data);
				
				?>
				<script>
					CloseModalMapa();
				  filtrar_us();
				</script>
				<?php
    		}else
    		{
    			?>
				<script>
					alert("Usuario ya se encuentra registrado.");
				</script>
				<?php
    		}
    	}catch (Exception $e) 
			{
				?>
				<script>
					alert("Problemas de conexi&oacute;n, por favor int&eacute;ntelo nuevamente.");
				</script>
				<?php
			}
		}else
		{
			?>
			<script>
				$( "#msg_error_add" ).html("Dispositivo ingresado ya se encuntra registrado.");
				</script>
			<?php
		}
	}elseif($_REQUEST['tipo']==6 and $estado_sesion==0)//update estado usuario
	{
		updateUsuario("estado=".$_REQUEST['estado']."",decrypt($_REQUEST['id'],ENCRIPTACION));
	}
}

?>