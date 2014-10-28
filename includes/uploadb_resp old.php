<?php
include("funciones.php");
$est_sesion=estado_sesion();
if($est_sesion==0)
{
	//comprobamos que sea una petici�n ajax
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
	 
	    //obtenemos el archivo a subir
	    $file = $_FILES['i_file']['name'];
	    

	    //comprobamos si existe un directorio para subir el archivo
	    //si no es as�, lo creamos
	    if(!is_dir("files/")) 
	        mkdir("files/", 0777);
	     
	    //comprobamos si el archivo ha subido
	    $name_file=explode(".",$file);
	    if ($file && move_uploaded_file($_FILES['i_file']['tmp_name'],"files/".$_REQUEST['names'].""))
	    {
	    	
	    	sleep(2);
	    	// El archivo
				$nombre_archivo = "files/".$_REQUEST['names']."";
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
				imagejpeg($imagen_p, "files/".$_REQUEST['names']."", 50);
	    }
	  
	    
	}else{
		
	    throw new Exception("Error Processing Request", 1);    
	}
}