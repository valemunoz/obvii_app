<?php
include("../includes/funciones.php");
$data_server= explode("?",$_SERVER['HTTP_REFERER']);
$estado_sesion=estado_sesion_web();
if(substr(strtolower($data_server[0]),0,strlen(PATH_SITE_WEB))==PATH_SITE_WEB)
{
	if($_REQUEST['tipo']==1 and $estado_sesion==0) //lista dispositivos
	{
		$cliente=$_SESSION['id_cliente_web'];
		
		$estado=$_REQUEST['estado'];
		
		if($estado!=10)
		{
			$query =" and estado=".$estado."";
		}
		$query .=" and id_cliente=".$cliente." order by fecha_registro";
		$dispo=getDispositivos($query);
	  //print_r($dispo); //AQUI pendiente
		?>
		<table border=1 id="table_resul" class="bordered">
			<!--	<tr class="titulo">-->
				<tr>
								
					<th style="width:5%;">ID</th>						
					<th style="width:20%;">USUARIO</th>
					<th style="width:20%;">DISPOSITIVO</th>		
					
					<th style="width:20%;">FECHA</th>
					<th style="width:15%;">ESTADO</th>						
					<TH style="width:10%;">PANEL</TH>
				</tr>
			<?php
			foreach($dispo as $i=> $us)
			{
			  $entSal="Pendiente";
			  
			  if($us[3]==0)
			  {
			  	$entSal="Activado";
			  
			  }
			  $usuario=getUsuario(" and id_usuario=".$us[4]."");
				?>
				<tr>
					
					<td ><?=ucwords($us[0])?></td>				
					<td><?=$usuario[1]?></td>	
					<td><?=ucwords($us[1])?></td>	
					<td><?=ucwords($us[2])?></td>	
					<td><?=ucwords($entSal)?></td>	
						
					<Td>		
						<?php
						 if($us[3]==1)
			  		{
						?>						
						<a href='javascript:activarDispo(<?=$us[0]?>,0);'><img title ='Activar dispositivo' src='img/up.png'></a> <a href="javascript:detDispo('<?=$us[1]?>');">Detalle</a>
						<?PHP
						}else
						{
							?>
							<a href='javascript:activarDispo(<?=$us[0]?>,1);'><img title ='Inactivar dispositivo' src='img/down.png'></a>
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
	}elseif($_REQUEST['tipo']==2 and $estado_sesion==0)//Detalle dispositivo
	{		
		
		//$_REQUEST['dispo']
		$dispo=getUsuario(" and id_device ilike '".$_REQUEST["dispo"]."'");
		if(count($dispo) > 0)
		{
			echo "Dispositivo ".$_REQUEST['dispo']." ya se encuentra asociado al usuario ".$dispo[1]."<br> si activa este dispositivo, todos los usuarios asociados seran desactivados.";
		}else
		{
			echo "Dispositivo ".$_REQUEST['dispo']." esta libre para ser asignado.";
		}

	}elseif($_REQUEST['tipo']==3 and $estado_sesion==0)
	{
			//id_dispo
			$dispo=getDispositivos(" and id_dispositivo=".$_REQUEST['id_dispo']."");
			$id_device=$dispo[0][1];
			$usuarios=getUsuarios(" and id_device ilike '".$id_device."'");
			if($_REQUEST['estado']==0)
			{
				foreach($usuarios as $us)
				{
					updateUsuario("id_device=''",$us[0]);
				}
				
				updateUsuario("id_device='".$id_device."'",$dispo[0][4]);
			}else
			{
							
					updateUsuario("id_device=''",$dispo[0][4]);
			
				
			}
			updateDispositivo("estado=".$_REQUEST['estado']."",$_REQUEST['id_dispo']);
	}
}

?>