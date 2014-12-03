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
		    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th width=2%>ID</th>
        <th>Usuario</th>
        <th>Dispositivo</th>
        <th>Fecha</th>
        <th>Estado</th>        
        <th>Panel</th>
    </tr>
    </thead>
    <tbody>
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
    	<td><?=ucwords($us[0])?></td>
        <td><?=$usuario[1]?></td>
        <td class="center"><?=ucwords($us[1])?></td>
        <td class="center"><?=ucwords($us[2])?></td>
        <td class="center">
        	<?PHP
        	if($us[3]==0)
        	{
        	?>
            <span class="label-success label label-default"><?=ucwords($entSal)?></span>
            <?php
          }elseif($us[3]==1)
          {
          	?>
          	<span class="label-warning label label-default"><?=ucwords($entSal)?></span>
          	<?php
          }else
          {
          	?>
          	<span class="label-warning label label-default">Omitido</span>
          	<?php
          }
            ?>
            
        </td>
        
       
        <td class="center">
                  							<?php
        							
						 if($us[3]==1)
			  		{
						?>						
						 
						<a class="btn btn-success" href='javascript:activarDispo(<?=$us[0]?>,0);'>
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Activar
            </a>
            <a class="btn btn-danger" href='javascript:activarDispo(<?=$us[0]?>,2);'>
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Omitir
            </a>
                   <a class="btn btn-info" href="javascript:detDispo('<?=$us[1]?>');">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Detalle
            </a>
						<?PHP
						}elseif($us[3]==0)
						{
							?>
							
								<a class="btn btn-danger" href='javascript:activarDispo(<?=$us[0]?>,1);'>
                <i class="glyphicon glyphicon-zoom-in icon-white"></i>
                Inactivar
            </a>
							<?php
						}
					?>
           
            
        </td>
    </tr>
    <?php
  	}
    ?>
  

  
 
      
   
       </tbody>
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
			}elseif($_REQUEST['estado']==1)
			{
							
					updateUsuario("id_device=''",$dispo[0][4]);
			
				
			}
			updateDispositivo("estado=".$_REQUEST['estado']."",$_REQUEST['id_dispo']);
	}
}

?>