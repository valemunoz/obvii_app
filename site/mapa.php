<?php
include("../includes/funciones.php");

$estado_web=estado_sesion_web();
if($estado_web!=0)
{
	?>
	<script>
		window.location="login.php";
	</script>
	<?php 
	
}

?>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="css/rounded.css" />
		<link rel="shortcut icon" href="img/pin.png">
		<!--<link type="text/css" rel="stylesheet" href="/ws/sites/css/blitzer/jquery-ui-1.10.3.custom.min.css" />-->
		<link href="http://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet" type="text/css" />
		
		<title>Lugares ::: Locate By Chilemap</title>
		<!--<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script> -->
<script src="funciones.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
 		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	 	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	 	
	<script src="http://www.chilemap.cl/OpenLayers/OpenLayers.js"></script>
	 	<script src="http://www.chilemap.cl/js/funciones_api_v2.js"></script>	<script>

		 $(function() {
    		$( "#desde" ).datepicker({dateFormat:"yy-mm-dd"});
  			});	

		 $(function() {
    		$( "#hasta" ).datepicker({dateFormat:"yy-mm-dd"});
  			});	
  			

		</script>
		
		<style>
			#mapa , #map
				{
					width:70% !important;
					height:400px !important;
					border:1px solid #C0C0C0;
				
				}
				#resultado
				{
					height:60% !important;
					overflow:auto;
					width:112%;
				}
.ui-dialog
{
	background-color:#F3F3F3;
	border-bottom: 1px solid #7EB6E2;
	color: #1F5988;
  font-size: 15px;
  height:500px !important;
  width:530px !important;
  
  text-align:center !important
}
#popup_CM3
{
	z-index:6000 !important;
}
			</style>

		</head>
	<body>
		<div class="img_left"><a target=BLANK_ href="http://www.architeq.cl"><img src="img/obvii-logo-blue.png"></a></div>
			
			
		<div id="contenido">
			
<div id="buscador">
<?php
include("header.php");
?>
</div>
<br>
		<div id="buscador">
	<fieldset>
	<legend>Filtro Mapa</legend>
	
	<table id=table_filtro>
	
	            <tr>
	            	<td>
	            		
	            	</td>
	                
		<td>
	                    Vista
	                </td>
	 
	                <td>
	                    Usuario
	                </td>
	                <td>Desde</td>
	                <td>Hasta</td>
	               
	            </tr>
			<tr>
				<td>
	            		<img src="img/add.png" class=mano onclick="nuevaEmpresa();" title="Nueva Empresa">
	            	</td>

			<td>
				<select id="em_estado" name="em_estado">				
						
						<option value=0 checked>Linea</option>
						<option value=1>Punto</option>
					
				</select>
				</td>
			
			<td><input type="text" id='nom_em' name='nom_em'></td>
			<td><input type="text" class="input_filtro" autocomplete=off id="desde" name="desde" maxlength="50" class="txtFecha"/></td>
			<td><input type="text" class="input_filtro" autocomplete=off id="hasta" name="hasta" maxlength="50" class="txtFecha"/></td>
			
		
			<td><input type="button" onclick="loadMapaData();" value="Generar"></td>
		</tr>	
	</table>
	
	
	</fieldset>
	</div>
<div id=map></div>
<script>
	var CM_farma_turno=false;	
	init("map");
  //loadMapaData();
	</script>
	
	<div id="output"></div>
	
	</body>
</html>
