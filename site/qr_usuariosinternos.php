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
		$lugar=$_REQUEST['lugar'];
		

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
		if(trim($lugar)>0)
		{
			$query .=" and id_lugar = ".$lugar.""	;
		}	
		$query .=" order by nombre";
		
		$usuarios=getUsuariosInterno($query);
		//print_r($usuarios);
		?>
		<table border=1 id="table_resul" class="bordered">
			<!--	<tr class="titulo">-->
				<tr>
					<th style="width:5%;">ID</th>				
					<th style="width:50%;">NOMBRE</th>						
					<th style="width:20%;">LUGAR</th>		
					
					<TH style="width:25%;">PANEL</TH>
				</tr>
			<?php
			foreach($usuarios as $i=> $us)
			{
				$detalle_lugar=getLugares(" and id_lugar=".$us[3]."");
			  
				?>
				<tr>
					
					<td style="width:5%;"><?=$us[0]?></td>				
					<td style="width:50%;"><?=ucwords($us[1])?></td>	
					<td style="width:20%;"><?=ucwords($detalle_lugar[0][1])?></td>		
					<Td style="width:25%;">
						
						<a href="javascript:loadUsuarioInt('<?=encrypt($us[0],ENCRIPTACION)?>');">Editar</a>	
						
						<?php
						if($us[2]==0)
						{
							?>
							| <a href="javascript:upUsuarioEstInt(1,'<?=encrypt($us[0],ENCRIPTACION)?>');">Bajar</a>	
							<?php
						}else
						{
							?>
							| <a href="javascript:upUsuarioEstInt(0,'<?=encrypt($us[0],ENCRIPTACION)?>');">Subir</a>	
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
		$usuario=getUsuariosInterno(" and id_usuario_interno=".$id."");
		
		$check1="selected";
		$check12="";
		if($usuario[0][2]==1)
		{
			$check1="";
			$check2="selected";
		}
		$lugares=getLugares(" and id_cliente=".$_SESSION['id_cliente_web']." order by nombre");
		$check="checked";
		$check2="";
		if($usuario[0][5]==2)
		{
			$check2="checked";
			$check="";
			
			
		}
		?>
		<table border=1 id="table_resul" class="bordered">
		 <tr><td>Nombre</td><td><input id="nom_us" name="nom_us" type="text" value="<?=$usuario[0][1]?>"></td></tr>		
			<tr><td>Estado</td>
				<td>
						<select id=est_us name=est_us>
							
								<option value=0 <?=$check1?>>Activo</option>
								<option value=1 <?=$check2?>>Inactivo</option>
							
						</select>		
				</td></tr>
				<tr><td>Tipo Lista</td><td><input type="radio" id="lug" name="group2" value="1"  <?=$check?>> Personas <input type="radio" id="lug2" name="group2" value="2"  <?=$check2?>> Otro</td></tr>		
				<tr><td>Lugar</td>
				<td>
					<select id=tipo_us name=tipo_us>
							<?php
							foreach($lugares as $lug)
							{
								$select="";
								if($lug[0]==$usuario[0][3])
								{
									$select="selected";
								}
								?>
								<option value=<?=$lug[0]?> <?=$select?>><?=ucwords($lug[1])?></option>
								<?php
							}
							?>
						</select>		
				</td></tr>
				<tr id="opc_list"><td>Descripci&oacute;n</td><td><textarea name="descript" id="descript" rows="4" cols="50"><?=$usuario[0][6]?></textarea></td></tr>
			
			<tr><td></td><td><input type="button" onclick="updateUsuarioInt('<?=encrypt($id,ENCRIPTACION)?>');" value="Guardar"></td></tr>
		</table>
		<div id="msg_error_add" class="msg_error"></div>
			<?php
	}elseif($_REQUEST['tipo']==3 and $estado_sesion==0)//update usuario
	{
		
		updateUsuarioInt("descripcion='".$_REQUEST["desc"]."',tipo='".$_REQUEST["tipo_lista"]."',estado='".$_REQUEST['estado']."', id_lugar=".$_REQUEST['lugar'].", nombre='".$_REQUEST['nom']."'",decrypt($_REQUEST['id'],ENCRIPTACION));
	}elseif($_REQUEST['tipo']==4 and $estado_sesion==0)//nuevo usuario
	{
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
			<form enctype="multipart/form-data" class="formulario">
			<table border=1 id="table_resul" class="bordered">
				<tr><td>Nombre</td><td><input id="nom_us" name="nom_us" type="text" value=""></td></tr>		
			<tr><td>Estado</td>
				<td>
						<select id=est_us name=est_us>
							
								<option value=0>Activo</option>
								<option value=1>Inactivo</option>
							
						</select>		
				</td></tr>
				<tr><td>Tipo Lista</td><td><input type="radio" id="lug" name="group2" value="1" <?=$checA?>> Personas <input type="radio" id="lug2" name="group2" value="2" <?=$checB?>> Otro</td></tr>		
				<tr><td>Lugar</td>
				<td>
						<select id=tipo_us name=tipo_us>
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
				</td></tr>
				<tr id="opc_list"><td>Imagen</td><td><input type="file" name="i_file" id="i_file" value=""></td></tr>
				<tr id="opc_list"><td>Descripci&oacute;n</td><td><textarea name="descript" id="descript" rows="4" cols="50"></textarea></td></tr>
				<tr><td></td><td><input type="button" onclick="saveUsuarioInt();" value="Registrar"></td></tr>
			</table>
		</form>
			<div id="msg_error_add" class="msg_error"></div>
				<?php
	}elseif($_REQUEST['tipo']==5 and $estado_sesion==0)//Nuevo usuario
	{
		$data=array();
		$data[]=$_REQUEST['nombre'];
		$data[]=$_REQUEST['estado'];		
		$data[]=$_REQUEST['lugar'];		
		$data[]=$_REQUEST["tipo_lista"];
		$data[]=$_REQUEST["desc"];
		$_SESSION['web_lugar']=$_REQUEST['lugar'];
		$_SESSION['web_opcion']=$_REQUEST["tipo_lista"];
		
		addUsuarioInt($data);
		
		$us=getUsuariosInterno(" and nombre='".$_REQUEST['nombre']."' order by id_usuario_interno desc limit 1");
		
			//comprobamos que sea una petici�n ajax
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
	 
	    //obtenemos el archivo a subir
	    $file = $_FILES['i_file']['name'];
	    

	    //comprobamos si existe un directorio para subir el archivo
	    //si no es as�, lo creamos
	    if(!is_dir("img_cli/")) 
	        mkdir("img_cli/", 0777);
	     
	    //comprobamos si el archivo ha subido
	    $name_file=explode(".",$file);
	    $nom_archivo=$us[0][0]."_ejemplo".$name_file[1];
	    if ($file && move_uploaded_file($_FILES['i_file']['tmp_name'],"img_cli/".$nom_archivo.".".$name_file[1]))
	    {
	    	sleep(2);
	    	// El archivo
				$nombre_archivo = "img_cli/".$nom_archivo.".".$name_file[1];
				$porcentaje = 0.2;
				
				// Tipo de contenido
				header('Content-Type: image/jpeg');
				
				// Obtener nuevas dimensiones
				list($ancho, $alto) = getimagesize($nombre_archivo);
				$nuevo_ancho = $ancho * $porcentaje;
				$nuevo_alto = $alto * $porcentaje;
				
				// Redimensionar
				$imagen_p = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
				$imagen = imagecreatefromjpeg($nombre_archivo);
				imagecopyresampled($imagen_p, $imagen, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);
				imagejpeg($imagen_p, "img_cli/".$nom_archivo.".".$name_file[1], 50);
	    }
	    $name_file=explode(".",$file2);
	
	    
	}else{
	    throw new Exception("Error Processing Request", 1);    
	}
		
	}elseif($_REQUEST['tipo']==6 and $estado_sesion==0)//update estado usuario
	{
		updateUsuarioInt("estado=".$_REQUEST['estado']."",decrypt($_REQUEST['id'],ENCRIPTACION));
	}
}

?>