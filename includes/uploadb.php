<?php
print_r($_FILES);
$new_image_name = $_REQUEST['names'];

if(move_uploaded_file($_FILES["i_file"]["tmp_name"], "files/".$new_image_name))
{
	
	sleep(2);
	    	// El archivo
				$nombre_archivo = "files/".$new_image_name."";
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
				imagejpeg($imagen_p, "files/".$new_image_name."", 50);
}
?>
