var OBVII_LON=0;
var OBVII_LAT=0;
var OBVII_ACCU=0;
var PAIS_LON=-70.656235;
var PAIS_LAT=-33.458943;
var PAIS_ZOOM=10;
var OBVII_PAIS="chile";
var up_img=false;
var path_query="http://locate.chilemap.cl/obvii/app/query.php";
var path_query2="http://locate.chilemap.cl/obvii/app/query_app.php";
var path_info="http://locate.chilemap.cl/obvii/app/info.php";
var path_upload="http://locate.chilemap.cl/obvii/includes/uploadb.php";

/*MENSAJES*/
var MSG_CAMPOS="Todos los campos son obligatorios.<br>";
var MSG_NOCONEC="No tiene conexion a internet.<br>Por favor conectese a una red para poder iniciar sesi&oacute;n<br>";
var MSG_OFFLINE="No tiene conecci&oacute;n a internet activada.<br>El sistema trabajara de manera Local/Offline<br>Algunas opciones seran limitadas<br>";
var MSG_ERR_DISPO="No tiene conecci&oacute;n a internet activada o no se pudo obtener el ID del dispositivo.<br>Para solicitar dispositivo debe estar conectado a internet.<br>";
var MSG_ERR_DEVICE="Error al obtener el ID del dispositivo. por favor intentelo nuevamente o revisa la configuracion de su equipo.<br>";
var MSG_USER_DISPO_NO="Su usuario no esta activado para iniciar sesion en este dispositivo<br>";
var MSG_NO_SESION="No tiene conexion a internet y no tiene una sesion activa.<br>Por favor conectese a una red para continuar<br>";
var MSG_NO_GPS="Se produjo un error en la lectura de su posici&oacute;n.<br>Esto se puede suceder al no darle permisos al sistema para obtener su ubicacion actual o bien no tiene disponible GPS en el equipo.<br>Por favor revise su configuracion e intentelo nuevamente<br>";
var MSG_NO_INTERNET="El sistema no se puede conectar a internet,<br>por favor revise su conecci&oacute;n e int&eacute;ntelo nuevamente.<br>";
var MSG_NO_SYNC="No hay marcaciones disponibles para sincronizar<br>";
var MSG_USER_DEMO="Este servicio no esta disponible para su tipo de usuario.<br>";
var MSG_NO_MAIL="Correo electronico no valido<br>";
var MSG_TERMINOS="Debe aceptar los t&eacute;rminos y condiciones para poder registrarse.<br>";
var MSG_MARCA_OFFLINE="Marcacion realizada localmente<br>";
var MSG_CLAVE="La contrase&ntilde;as debe contener al menos 6 caracteres.<br>";
var MSG_RE_CLAVE="Las contrase&ntilde;as ingresadas no coinciden.<br>";
var MSG_ERR_USER="Usuario o Clave incorrectas<br>";
var MSG_NOM_MARCA="Nombre de la marcacion es obligatoria<br>";
var MSG_ERR_NUM="N&uacute;mero municipal debe ser num&eacute;rico <br>";
var MSG_DEMO='Su usuario es de tipo Demo, el uso del sistema sera limitado. Si desea un upgrade de su cuenta env&iacute;e un mail a contacto@architeq.cl';
var MSG_ERR_CONEC="Problemas de conexi&oacute;n, por favor int&eacute;ntelo nuevamente.<br>";
var MSG_NO_USUARIO="Debe Ingresar un nombre de usuario.";
/*FIN MENSAJE*/