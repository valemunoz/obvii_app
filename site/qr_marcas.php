<?php
include("../includes/funciones.php");
$data_server= explode("?",$_SERVER['HTTP_REFERER']);
$estado_sesion=estado_sesion_web();
if(substr(strtolower($data_server[0]),0,strlen(PATH_SITE_WEB))==PATH_SITE_WEB)
{
	if($_REQUEST['tipo']==1 and $estado_sesion==0) //lista de usuarios
	{
		$cliente=$_SESSION['id_cliente_web'];
		
		$mail=$_REQUEST['mail'];
		
		$lugar=$_REQUEST['lugar'];
		
		$fecha_inicio=$_REQUEST['fec_ini'];
		$fecha_termino=$_REQUEST['fec_ter'];

    $query = " and id_cliente=".$cliente."";
    if(trim($fecha_inicio) !="")
    {
    	$query .=" and fecha_registro >= '".$fecha_inicio."'"	;
    }
    if(trim($fecha_termino) !="")
    {
    	$query .=" and fecha_registro <= '".$fecha_termino." 23:59:59'"	;
    }
		if(trim($mail)!="")
		{
			$query .=" and id_usuario ilike '%".$mail."%'"	;
		}	
		
		if(trim($lugar)>0)
		{
			$query .=" and id_lugar = ".$lugar.""	;
		}	
		$query .=" order by fecha_registro desc";
		
		$usuarios=getMarcaciones($query);
		//print_r($usuarios);
		?>
		    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Usuario</th>
        <th>Lugar</th>
        <th>Entrada/Salida</th>
        <th>Fecha</th>
        <th>Panel</th>
    </tr>
    </thead>
    <tbody>
    	<?php
			foreach($usuarios as $i=> $us)
			{
				$detalle_lugar=getLugares(" and id_lugar=".$us[5]."");
			  $user=getUsuario(" and mail ilike '".$us[1]."'");
			  $entSal="entrada";
			  if($us[10]==1)
			  {
			  	$entSal="Salida";
			  }
			  $color="";
			  
			  $tiempo= segundos($us[3],$us[14]);
			  $tiempo2= segundos($us[3],$us[13]);
			  if($us[15]=='t')
			  {
			  	$color="alert_sync";
			  }
			  if($us[4]=='1')
			  {
			  	$color="alert_libre";
			  }
			  if(($us[3] < $us[14] or $us[3] < $us[13]) and ($tiempo > 600 or $tiempo2 > 600))
			  {
			  	$color="alert_hora";
			  	
			  }
				?>
    <tr class=<?=$color?>>
    	
        <td><?=ucwords($user[7])?></td>
        <td class="center"><?=ucwords($us[11])?></td>
        
        <td class="center">
        	<?php
        	if($us[10]==1)
			  	{
			  		?>
			  		<span class="label-warning label label-default"><?=$entSal?></span>
			  		<?php
			  		
			  	}else
			  	{
			  		?>
			  		<span class="label-success label label-default"><?=$entSal?></span>
			  		<?php
			  	}
        	?>
            
        </td>
        <td class="center"><?=ucwords($us[3])?></td>
        <td class="center">
    
            <a class="btn btn-info" href="javascript:loadDetMarca('<?=encrypt($us[0],ENCRIPTACION)?>');">
                <i class="glyphicon glyphicon-edit icon-white"></i>
                Detalle
            </a>
           
        </td>
    </tr>
  <?php
	}
  ?>

  
 
    
   
       </tbody>
    </table>

		<?php
	}elseif($_REQUEST['tipo']==2 and $estado_sesion==0)//Detalle marcacion
	{		
		$id=decrypt($_REQUEST['marca'],ENCRIPTACION);
		$marca=getMarcaciones(" and id_marcacion=".$id."");
		$user=getUsuario(" and mail ilike '".$marca[0][1]."'");
		//print_R($marca);
		$tipo="entrada";
		if($marca[0][10]==1)
			$tipo="salida";
		$tip_mar="Normal";
		if($marca[0][4]==1)	
		{
			$tip_mar="Libre";	
		}
		$direc_aprox=getDireccionGoogleLATLON($marca[0][6],$marca[0][7]);
		$lugar=getLugares(" and id_lugar=".$marca[0][5]."");
		$imagenes=getImagen(" and id_marcacion =".$id." and estado=0 order by fecha_registro");
		
		
		$distancia_aprox=getDistancia($marca[0][6],$marca[0][7], $lugar[0][4],$lugar[0][5]);
		?>
		<table border=1 id="table_resul" class="bordered">
		 <tr><td>Lugar</td><td><?=ucwords($marca[0][11])?></td></tr>	
		 	<tr><td>Tipo</td><td><?=$tip_mar?></td></tr>	
		 	<?php
		 	if($marca[0][4]==1)	
		 	{
		 		?>
		 		<tr><td>Direcci&oacute;n</td><td><?=$marca[0][12]?></td></tr>	
		 		<?php
		 	}
		 	?>
		 <tr><td>Usuario</td><td><?=ucwords($user[7])?></td></tr>
		 <tr><td>Mail Usuario</td><td><?=ucwords($marca[0][1])?></td></tr>		
		 <tr><td>Lugar Cercano de Marcaci&oacute;n</td><td><?=$direc_aprox[0][1]?></td></tr>	
		 <tr><td>Distancia Aproximada</td><td><?=round($distancia_aprox/1000,2)?> KMs</td></tr>	
			<tr><td>Fecha Marcaci&oacute;n</td><td><?=ucwords($marca[0][3])?></td></tr>		
			<?php
			if($marca[0][15]=='t')
			{				
				$color="";
				if($marca[0][3] < $marca[0][14] or $marca[0][3]<$marca[0][13])
				{
					$color="alert_hora";
				}
				?>
				<tr><td>Fecha Nube</td><td><?=ucwords($marca[0][13])?></td></tr>		
				<tr class=<?=$color?>><td>Fecha Local</td><td><?=ucwords($marca[0][14])?></td></tr>		
				<?php
			}
			?>
			<tr><td>Comentario</td><td><?=ucwords($marca[0][9])?></td></tr>		
			<tr><td>Tipo Marcaci&oacute;n</td><td><?=ucwords($tipo)?></td></tr>	
			
			</table>
			<?php
			
			if(count($imagenes) >0)
			{
			?>
			<br>
			<h3>Documentos Adjuntos</h3>
			<?php
			foreach($imagenes as $img)
			{
				?>
				<img class=img_doc src="<?=PATH_SITE?>/<?=PATH_IMG?>/<?=$img[1]?>">
				<?php
			}
			}
			if($_SESSION['tip_cli_web']==1)
			{
				$asistentes=getMarcaInt(" and estado=0 and id_marca_base=".$id."");
			?>
				<br>	
				<spam class=tit_pop>Asistencia </spam>
				<?php
				if(count($asistentes)>0)
				{
					?>
					<img src="img/email_open.png" onclick="mailLista(<?=$id?>);" class=mano title="Enviar por mail">
					<br><br>
					<div class=table_lista>
					<table border=1 id="table_resul" class="bordered">
					
					<tr><td><strong>Usuario</strong></td><td><strong>Asiste</strong></td></tr>	
					<?php
					
					foreach($asistentes as $i => $asis)
					{
						$usuario_int=getUsuariosInterno(" and id_usuario_interno=".$asis[1]."");
						$as="SI";
						if($asis[4]=='f')
						{
							$as="NO";
						}
						$color="";
						if($i % 10==0)
						{
							$color="tabla_fila";
						}
						?>
						<tr class="<?=$color?>"><td><?=ucwords($usuario_int[0][1])?></td><td><?=$as?></td></tr>	
						
						<?php
					}
					?>	
				</table>
				<?php
			}else
			{
				echo "No Disponible";
			}
		}
		?>
	</div>
		<div id="msg_error_add" class="msg_error"></div>
			<?php
	}elseif($_REQUEST['tipo']==3 and $estado_sesion==0)
	{
		$asistentes=getMarcaInt(" and estado=0 and id_marca_base=".$_REQUEST['marca']."");
		$html ="<br>Listado de asistencia<br><br>";
		$html .='<table border=1 id="table_resul" class="bordered">';
			
			$html .='<tr><td><strong>Usuario</strong></td><td><strong>Asiste</strong></td></tr>	';
			
			
			foreach($asistentes as $asis)
			{
				$usuario_int=getUsuariosInterno(" and id_usuario_interno=".$asis[1]."");
				$as="SI";
				if($asis[4]==1)
				{
					$as="NO";
				}
				
				$html .='<tr><td><?=ucwords($usuario_int[0][1])?></td><td><?=$as?></td></tr>	';
				
				
			}
				
		$html .='</table>';
		sendMail($_SESSION["usuario_web"],$html,"Lista asistencia");
	}elseif($_REQUEST['tipo']==4 and $estado_sesion==0) //csv
	{
		$cliente=$_SESSION['id_cliente_web'];
		
		$mail=$_REQUEST['mail'];
		
		$lugar=$_REQUEST['lugar'];
		
		$fecha_inicio=$_REQUEST['fec_ini'];
		$fecha_termino=$_REQUEST['fec_ter'];

    $query = " and id_cliente=".$cliente."";
    if(trim($fecha_inicio) !="")
    {
    	$query .=" and fecha_registro >= '".$fecha_inicio."'"	;
    }
    if(trim($fecha_termino) !="")
    {
    	$query .=" and fecha_registro <= '".$fecha_termino." 23:59:59'"	;
    }
		if(trim($mail)!="")
		{
			$query .=" and id_usuario ilike '%".$mail."%'"	;
		}	
		
		if(trim($lugar)>0)
		{
			$query .=" and id_lugar = ".$lugar.""	;
		}	
		$query .=" order by fecha_registro desc";
		
		$usuarios=getMarcaciones($query);
		//print_r($usuarios);
		
		$data_csv_arr=array();
			foreach($usuarios as $i=> $us)
			{
				$detalle_lugar=getLugares(" and id_lugar=".$us[5]."");
			  $user=getUsuario(" and mail ilike '".$us[1]."'");
			  $entSal="entrada";
			  if($us[10]==1)
			  {
			  	$entSal="Salida";
			  }
			  //$direc_aprox=getDireccionGoogleLATLON($usuarios[0][6],$usuarios[0][7]);
				
				$distancia_aprox=getDistancia($usuarios[0][6],$usuarios[0][7], $detalle_lugar[0][4],$detalle_lugar[0][5]);
			  $data_csv=array();
			  $data_csv[]=$user[7];
			  $data_csv[]=$us[11];
			  $data_csv[]=$entSal;
			  $data_csv[]=$us[3];
			  //$data_csv[]=$direc_aprox[0][1];
			  $data_csv[]=round($distancia_aprox/1000,2)."Kms";
			  $data_csv_arr[]=$data_csv;
			  
				
			}
			$campos=array('Usuario','Lugar','Entrada/Salida', 'Fecha', 'Distancia del lugar');
			createCsv($data_csv_arr,$_REQUEST['nomfile'],$campos);
			
			
	}elseif($_REQUEST['tipo']==5)//graficos pizza
{
	include_once "libchart/classes/libchart.php";
	$cliente=$_SESSION['id_cliente_web'];
		
		$mail=$_REQUEST['mail'];
		
		$lugar=$_REQUEST['lugar'];
		
		$fecha_inicio=$_REQUEST['fec_ini'];
		$fecha_termino=$_REQUEST['fec_ter'];

    $query = " and id_cliente=".$cliente."";
    if(trim($fecha_inicio) !="")
    {
    	$query .=" and fecha_registro >= '".$fecha_inicio."'"	;
    }
    if(trim($fecha_termino) !="")
    {
    	$query .=" and fecha_registro <= '".$fecha_termino." 23:59:59'"	;
    }
		if(trim($mail)!="")
		{
			$query .=" and id_usuario ilike '%".$mail."%'"	;
		}	
		
		if(trim($lugar)>0)
		{
			$query .=" and id_lugar = ".$lugar.""	;
		}	
		$query .=" group by nombre_lugar order by nombre_lugar desc";
		
		$marcas=getMarcacionesGrupo($query,"nombre_lugar, count(*)");
		//print_R($marcas);
	$chart = new PieChart();
	$date=date("YmdHms");
	$dataSet = new XYDataSet();	
	
	
	
	$chart2 = new VerticalBarChart(); //400, 500
	$chart->getPlot()->getPalette()->setPieColor(array(
		new Color(0, 0, 255),
		new Color(0, 255,64),
		new Color(255, 255,0),
		new Color(255, 128, 255),
		new Color(128, 255, 255),
		new Color(255, 36, 146),
		new Color(213, 255, 213),
		new Color(128, 64, 64),
		new Color(224, 193, 255),
		new Color(0, 202, 101),
		new Color(0, 128, 64),
		new Color(255, 128, 0)
	));
  $valor=130;
  if(count($marcas)>0)
  {
	foreach($marcas as $char)
	{
			$dataSet->addPoint(new Point(ucwords(substr($char[0],0,10)), $char[1]));
		
	}
			$chart->setDataSet($dataSet);
			$chart->setTitle("Grafico de Marcaciones");
			$num=rand(0,9);
			$chart->render("graficos/pie_chart_color_".$num.".png");
			
			?>
		<img alt="Grafico estadisticas"  src="graficos/pie_chart_color_<?=$num?>.png" style="border: 1px solid gray;"/></br></br>
		<?php
		$chart2->setDataSet($dataSet);
		$chart2->setTitle("Grafico de Marcaciones");
		$chart2->render("graficos/pie_chart_color_v_".$num.".png");
			?>
			<img alt="Grafico estadisticas"  src="graficos/pie_chart_color_v_<?=$num?>.png" style="border: 1px solid gray;"/>
		<?php
	}
	
}
}

?>