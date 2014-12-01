
var LC_lat="lat_em";
var LC_lon="lon_em";
function openModal()
{
	$('#myModal').modal('show');
}
function closeModal()
{
	$('#myModal').modal('hide');
}
function openModalMapa()
{
	$('#myMapa').modal('show');
}
function closeModalMapa()
{
	$('#myMapa').modal('hide');
}
function moveDrag(feature, pixel)
{
	
	
    		lon=feature.geometry['x'];
    		lat=feature.geometry['y'];
    		lonlat=new OpenLayers.LonLat(lon,lat).transform(
        new OpenLayers.Projection("EPSG:900913"), // de WGS 1984
        new OpenLayers.Projection("EPSG:4326") // a Proyección Esférica Mercator
  			);
    		try
    		{
         document.getElementById(LC_lon).value=lonlat.lon;
         document.getElementById(LC_lat).value=lonlat.lat;
       }catch(e){}
  
}
function salir()
{
	$("#output").load("query.php", 
		{tipo:2} 
			,function(){	
			}
	);
}
function validarEmail( email ) {
	  var valido=true;
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        valido=false;
        
   return valido;     
}
function login()
{
	var clave=$.trim(document.getElementById("clv").value);
	var mail=document.getElementById("mail").value;
	
	var msg="";
	var valida=true;
	if($.trim(clave)=="" || $.trim(mail)=="")
	{		
		valida=false;
		msg="<strong>Todos los campos son obligatorios.</strong><br>";
	}
	/*if(!validarEmail(mail))
	{		
		msg=""+msg+" <strong>E-mail debe tener formato correcto.</strong><br>";
		valida=false;
	}*/
	if(!valida)
	{
		
		$( "#msg_error" ).html(msg);
	}else
	{
		
		$("#msg_error").html("<img src=img/load.gif>");
		$("#msg_error").load("query.php", 
			{tipo:1, clave:""+clave+"", mail:""+mail+""} 
				,function(){	
				}
		);
		
	}
}

/*Usuarios*/
function filtrar_us()
{
	var mail=$.trim(document.getElementById("nom_em").value);
	var estado=$.trim(document.getElementById("em_estado").value);
	var nombre=$.trim(document.getElementById("nom_fil").value);
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_usuarios.php", 
						{tipo:1, nombre:nombre,estado:estado,mail:mail} 
							,function(){
								
									
							}
	);
}
function loadUsuario(id_usuario)
{
	$("#cont_modal").load("qr_usuarios.php", 
							{tipo:2, usuario:id_usuario} 
								,function(){
									openModal();
								}
		);
}
function updateUsuario(id_usuario)
{
	var mail=$.trim(document.getElementById("mail_us").value);
	var nn_us=$.trim(document.getElementById("nn_us").value);
	var nombre=$.trim(document.getElementById("nom_us").value);	
	var clave=$.trim(document.getElementById("clave").value);	
		var dis_us=$.trim(document.getElementById("dis_us").value);
		var web_us=false;
		if(document.getElementById("web_si").checked)
		{
			web_us=true;
		}
		var tipo=$.trim(document.getElementById("tipo_us").value);
		
	var msg="";
	var valida=true;

	if($.trim(mail)=="" || !validarEmail(mail))
	{		
		valida=false;
		msg="<strong>Mail es obligatorio y debe tener formato correcto.</strong><br>";
	}
	
	if(!valida)
	{
		
		$( "#msg_error_up" ).html(msg);
	}else
	{
		$("#output").load("qr_usuarios.php", 
							{tipo:3,nn_us:nn_us, mail:mail,tipo_us:tipo,nom:nombre,id:id_usuario,clave:clave,dis_us:dis_us,web_us:web_us} 
								,function(){
									
								}
		);
	}
}
function saveUsuario()
{
	var mail=$.trim(document.getElementById("mail_usnew").value);
	var nn_us=$.trim(document.getElementById("nn_usnew").value);
	var nombre=$.trim(document.getElementById("nom_usnew").value);
		var dis_us=$.trim(document.getElementById("dis_usnew").value);
		var web_us=false;
		if(document.getElementById("web_sinew").checked)
		{
			web_us=true;
		}
		var key_us=$.trim(document.getElementById("key_usnew").value);
		var tipo=$.trim(document.getElementById("tipo_usnew").value);
		
	var msg="";
	var valida=true;

	if(!validarEmail(mail))
	{		
		valida=false;
		msg +="<strong>Mail es obligatorio y debe tener formato correcto.</strong><br>";
	}
	if($.trim(key_us)=="" || $.trim(mail)=="" || $.trim(nombre)=="")
	{		
		valida=false;
		msg +="<strong>Todos los campos son obligatorios</strong><br>";
	}
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
		$("#output").load("qr_usuarios.php", 
							{tipo:5, mail:mail,tipo_us:tipo,clave:key_us,nombre:nombre,dis_us:dis_us,web_us:web_us,nn_us:nn_us} 
								,function(){
									
								}
		);
	}
	
}
function upUsuarioEst(estado,id_usuario)
{

		$("#output").load("qr_usuarios.php", 
							{tipo:6, estado:estado,id:id_usuario} 
								,function(){
									$('#myModal').modal('hide');
										filtrar_us();
								}
		);
	
}
function limpiarNewUS()
{
document.getElementById("mail_usnew").value="";
document.getElementById("nn_usnew").value="";
document.getElementById("nom_usnew").value="";
document.getElementById("dis_usnew").value="";
document.getElementById("key_usnew").value="";
$( "#msg_error_add" ).html("");
}
/* fin usuarios*/

/*lugares*/
function filtrar_em()
{
	
	
	var nombre=$.trim(document.getElementById("nom_em").value);
	var estado=$.trim(document.getElementById("em_estado").value);
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("query.php", 
						{tipo:3, nombre:nombre,estado:estado} 
							,function(){
									
							}
	);
}	
function loadEmpresa(id_empresa)
{
	$("#cont_modal").load("query.php", 
							{tipo:4, empresa:id_empresa} 
								,function(){
						openModal();
								}
		);
}
function verMapa(lat_geo,lon_geo)
{
	openModalMapa();
	setTimeout('loadMapa('+lat_geo+','+lon_geo+');',500);
	
}
function loadMapa(lat_geo,lon_geo)
{
	var var_es=document.getElementById("mapa_int").innerHTML;
	
	if(var_es=="" || var_es=="undefined" || typeof var_es == "undefined")
	{
		init2("mapa_int");
	}
	limpiarMapa();	
	limpiarPuntosDrag();		
	addMarcadorVector(lon_geo,lat_geo,'','img/place.png',30,30);
	moverCentro2(lon_geo,lat_geo,18);
	activarDrag();	
}
function upEstadoEmpresa(estado,empresa)
{
	$("#output").load("query.php", 
							{tipo:7, empresa:empresa,estado:estado} 
								,function(){
								
										filtrar_em();
								}
		);
}

function nuevaEmpresa()
{
	$("#cont_modal").load("query.php", 
						{tipo:8} 
							,function(){
									openmodal();
							}
	);
	
}
function saveEmpresa()
{
		var nombre=$.trim(document.getElementById("nombre_em").value);
		
		var calle=$.trim(document.getElementById("calle_em").value);
		var numero=$.trim(document.getElementById("num_em").value);
			
	var comuna=$.trim(document.getElementById("com_em").value);
	var latitud=$.trim(document.getElementById("lat_em").value);
	
	var mail=$.trim(document.getElementById("mail_em").value);
	var coment=$.trim(document.getElementById("slider2").value);
	var salida=$.trim(document.getElementById("slider1").value);
	var order="";
	try
	{
		if(document.getElementById("opc_1").checked)
		{
			order=document.getElementById("opc_1").value;
		}else
		{
			order=document.getElementById("opc_2").value;
		}
	}catch(e){}
	try
		{
			var mail2=$.trim(document.getElementById("mail2_em").value);
		}catch(err) 
		{
			var mail2=""
		}
	
	var longitud=$.trim(document.getElementById("lon_em").value);
	var msg="";
	var valida=true;

	if($.trim(nombre)=="" || $.trim(latitud)=="" ||$.trim(longitud)=="")
	{		
		valida=false;
		msg="<strong>Nombre, latitud y longitud son campos obligatorios.</strong><br>";
	}
	if(mail2!='' && !validarEmail(mail2))
	{
		valida=false;
		msg +="<strong>El formato de Mail es incorrecto.</strong><br>";
	}
	if(mail!='' && !validarEmail(mail))
	{
		valida=false;
		msg +="<strong>El formato de Mail es incorrecto.</strong><br>";
	}
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
		$("#msg_error_add").load("query.php", 
							{tipo:9, order:order,nombre:nombre,calle:calle, numero:numero,comuna:comuna,latitud:latitud,longitud:longitud,mail:mail, coment:coment,salida:salida,mail2:mail2} 
								,function(){
									//closeModal();
									alert("Lugar registrado correctamente");
									limpiarNewEmpresa();
										
								}
		);
	}
}				
function BuscarGeo()
{
	var valida=true;
	var calle=$.trim(document.getElementById("calle_em").value);
		var numero=$.trim(document.getElementById("num_em").value);
			
	var comuna=$.trim(document.getElementById("com_em").value);
	if($.trim(calle)=="" || $.trim(numero)=="" ||$.trim(comuna)=="")
	{		
		valida=false;
		msg="<strong>Calle Numero y Comuna son campos obligatorios.</strong><br>";
	}
	
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
		$( "#msg_error_add" ).html("Buscando...");
	$("#msg_error_add").load("query.php", 
							{tipo:5, calle:calle, numero:numero,comuna:comuna} 
								,function(){
						
								}
		);
	}
}
function verMapa2()
{
	
	
	lat_geo=document.getElementById('lat_em').value;
	lon_geo=document.getElementById('lon_em').value;
	openModalMapa();
	setTimeout('loadMapa('+lat_geo+','+lon_geo+');',500);
	
}
function updateEmpresa(empresa)
{
		var nombre=$.trim(document.getElementById("nombre_em").value);
		
		var mail=$.trim(document.getElementById("mail_em").value);
		
		try
		{
			var mail2=$.trim(document.getElementById("mail2_em").value);
		}catch(err) 
		{
			var mail2=""
		}
		var comentario=$.trim(document.getElementById("slider2").value);
		var entsal=$.trim(document.getElementById("slider1").value);
		
		var calle=$.trim(document.getElementById("calle_em").value);
		var numero=$.trim(document.getElementById("num_em").value);
			
	var comuna=$.trim(document.getElementById("com_em").value);
	var latitud=$.trim(document.getElementById("lat_em").value);
	
	
	var longitud=$.trim(document.getElementById("lon_em").value);
	
	var msg="";
	var valida=true;
	var order="";
	try
	{
		if(document.getElementById("opc_1").checked)
		{
			order=document.getElementById("opc_1").value;
		}else
		{
			order=document.getElementById("opc_2").value;
		}
	}catch(e){}

	if($.trim(nombre)=="" || $.trim(latitud)=="" ||$.trim(longitud)=="")
	{		
		valida=false;
		msg="<strong>Nombre, latitud y longitud son campos obligatorios.</strong><br>";
	}
	if(mail2!='' && !validarEmail(mail2))
	{
		valida=false;
		msg +="<strong>El formato de Mail es incorrecto.</strong><br>";
	}
		if(mail!='' && !validarEmail(mail))
	{
		valida=false;
		msg +="<strong>El formato de Mail es incorrecto.</strong><br>";
	}
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
		$("#output").load("query.php", 
							{tipo:6, order:order,empresa:empresa,nombre:nombre,calle:calle, numero:numero,comuna:comuna,latitud:latitud,longitud:longitud,mail:mail,coment:comentario,marca:entsal,mail2:mail2} 
								,function(){
									closeModal();
										filtrar_em();
								}
		);
	}
}
function limpiarNewEmpresa()
{
	document.getElementById("mail_em").value="";
	try
	{
		document.getElementById("mail2_em").value="";
	}catch(e){}
	document.getElementById("nombre_em").value="";
	document.getElementById("calle_em").value="";
	document.getElementById("num_em").value="";
	
	document.getElementById("com_em").value="";
	document.getElementById("lat_em").value="";
	document.getElementById("lon_em").value="";
	$( "#msg_error_add" ).html("");
	
}
/*fin lugares*/


/*marcaciones*/
function filtrar_marcaciones()
{
	var mail=$.trim(document.getElementById("nom_em").value);
	
	
	var lugar=$.trim(document.getElementById("lug_us").value);
	var desde=$.trim(document.getElementById("desde").value);
	var hasta=$.trim(document.getElementById("hasta").value);
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_marcas.php", 
						{tipo:1,mail:mail,lugar:lugar,fec_ini:desde,fec_ter:hasta} 
							,function(){
								
								
									
							}
	);
	$("#contenido_data_est").load("qr_marcas.php", 
								{tipo:5,mail:mail,lugar:lugar,fec_ini:desde,fec_ter:hasta} 
									,function(){
										
										$("#datos_esta").show();
											
									}
								);
	
	
								
}
function loadDetMarca(id_marca)
{
	$("#cont_modal").load("qr_marcas.php", 
							{tipo:2, marca:id_marca} 
								,function(){
						openModal();
								}
		);
}
/**/


function mailLista(id_lista)
{
	$("#output").load("qr_marcas.php", 
							{tipo:3, marca:id_lista} 
								,function(){
										alert("Mail Enviado.");
								}
		);
}

function activaDescrip()
{
	$("#opc_list").show();
}
function desactivaDescrip()
{
	$("#opc_list").hide();
}
function filtrar_dispositivo()
{
	var estado=$.trim(document.getElementById("em_estado").value);
	
	
	
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_dispo.php", 
						{tipo:1,estado:estado} 
							,function(){
									
							}
	);
}

function activarDispo(id_dispo,estado)
{
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_dispo.php", 
						{tipo:3,id_dispo:id_dispo,estado:estado} 
							,function(){
									filtrar_dispositivo();
							}
	);
}

function detDispo(dispo)
{
	$("#cont_modal").load("qr_dispo.php", 
						{tipo:2,dispo:dispo} 
							,function(){
								openModal();
									
							}
	);
	
}
function loadMapaData()
{
	
	opc_lin=$.trim(document.getElementById("em_estado").value);
	nick=$.trim(document.getElementById("nom_em").value);
 desde=$.trim(document.getElementById("desde").value);
 hasta=$.trim(document.getElementById("hasta").value);
	if(nick!="")
	{
		limpiarMapa();
		$("#output").load("query.php", 
						{tipo:10, tipo_lin:opc_lin, usuario:nick, desde:desde, hasta:hasta} 
							,function(){
								
									
							}
		);
	}else
		{
			alert("Debe ingresar un usuario");
		}
}

/*usuarios internos*/

function filtrar_usInterno(order)
{
	var mail=$.trim(document.getElementById("nom_em").value);
	var estado=$.trim(document.getElementById("em_estado").value);
	var nombre=$.trim(document.getElementById("nom_fil").value);
	var lugar=$.trim(document.getElementById("lug_us").value);
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_usuariosinternos.php", 
						{tipo:1, nombre:nombre,estado:estado,mail:mail,lugar:lugar,order:order} 
							,function(){
									
							}
	);
}
function nuevoUsuarioInterno()
{

	$("#grilla_mapa").load("qr_usuariosinternos.php", 
						{tipo:4} 
							,function(){
									OpenModalMapa();
							}
	);
	

}
function saveUsuarioInt()
{
	var estado=$.trim(document.getElementById("est_us").value);
	var nombre=$.trim(document.getElementById("nom_us").value);		
		var lugar=$.trim(document.getElementById("tipo_us").value);
		var descripcion=$.trim(document.getElementById("descript").value);
		var tipo_lista=1;
		if(document.getElementById("lug2").checked)
		{
			tipo_lista=2;
		}
	var msg="";
	var valida=true;


	if($.trim(nombre)=="")
	{		
		valida=false;
		msg +="<strong>Todos los campos son obligatorios</strong><br>";
	}
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
	/*Imagen*/
	valida=false;
	
	try{
		 var fileExtension = "";
		 //obtenemos un array con los datos del archivo
        var file = $("#i_file")[0].files[0];
        
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = (file.size/1024);
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        //alert("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
		/**/
		valida=false;
		if(fileSize <= 2048 && (fileExtension.toLowerCase()=='jpg' || fileExtension.toLowerCase()=='jpeg'))
		{
			valida=true;
		}
	}catch(err) 
	{
		
	}
		if(valida)
		{
						var formData = new FormData($(".formulario")[0]);
						$.ajax({
        		    url: 'qr_usuariosinternos.php?tipo=5&estado='+estado+'&lugar='+lugar+'&nombre='+nombre+'&tipo_lista='+tipo_lista+'&desc='+descripcion+'',  
        		    type: 'POST',
        		    // Form data
        		    //datos del formulario
        		    data: formData,
        		    //necesario para subir archivos via ajax
        		    cache: false,
        		    contentType: false,
        		    processData: false,
        		    //mientras enviamos el archivo
        		    beforeSend: function(){
        		       //loadEspera("Subiendo..");
        		       $("#msg_error_add").html("<img src=img/load.gif>");
        		    },
        		    //una vez finalizado correctamente
        		    success: function(data){
        		       //CloseModalMapa();
										//filtrar_usInterno();
										limpiarNewUSInt();
										alert("Lista registrada exitosamente");
        		      
        		    },
        		    //si ha ocurrido un error
        		    error: function(){
        		       alert("Error al subir la imagen, por favor intentelo nuevamente");
        		       
        		    }
        		});
        		
			
			/*$("#output").load("qr_usuariosinternos.php", 
								{tipo:5, estado:estado,lugar:lugar,nombre:nombre,tipo_lista:tipo_lista,desc:descripcion} 
									,function(){
										CloseModalMapa();
										filtrar_usInterno();
									}
			);*/
		}else
			{
				img_data=$("#i_file")[0].files[0];
				if(img_data=="undefined" || typeof img_data == "undefined")
				{
					//alert("no viene imagen");
					$("#output").load("qr_usuariosinternos.php", 
								{tipo:7, estado:estado,lugar:lugar,nombre:nombre,tipo_lista:tipo_lista,desc:descripcion} 
									,function(){
										limpiarNewUSInt();
										alert("Lista registrada exitosamente");
										//CloseModalMapa();
										//filtrar_usInterno();
									}
			);
				}else
				{
					$( "#msg_error_add" ).html("La im&aacute;gen no puede superar 2 Megas<br> La im&aacute;gen debe ser de formato JPG");
				}
			}
	}
	
}
function loadUsuarioInt(id_usuario)
{
	$("#cont_modal").load("qr_usuariosinternos.php", 
							{tipo:2, usuario:id_usuario} 
								,function(){
						openModal();
								}
		);
}
function updateUsuarioInt(id_usuario)
{	
	var estado=$.trim(document.getElementById("est_us").value);
	var nombre=$.trim(document.getElementById("nom_us").value);		
		
		var lugar=$.trim(document.getElementById("tipo_us").value);
		
		var descripcion=$.trim(document.getElementById("descript").value);
		var tipo_lista=1;
		if(document.getElementById("lug2").checked)
		{
			tipo_lista=2;
		}
		
	var msg="";
	var valida=true;

	if($.trim(nombre)=="")
	{		
		valida=false;
		msg="<strong>Todos los campos son obligatorios.</strong><br>";
	}
	
	if(!valida)
	{
		
		$( "#msg_error_add" ).html(msg);
	}else
	{
		
		/*$("#output").load("qr_usuariosinternos.php", 
							{tipo:3, estado:estado,lugar:lugar,nom:nombre,id:id_usuario,tipo_lista:tipo_lista,desc:descripcion} 
								,function(){
									CloseModalReg();
										filtrar_usInterno();
								}
		);*/
		/*Imagen*/
	try{
		 var fileExtension = "";
		 //obtenemos un array con los datos del archivo
        var file = $("#i_file2")[0].files[0];
        
        //obtenemos el nombre del archivo
        var fileName = file.name;
        //obtenemos la extensión del archivo
        fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //obtenemos el tamaño del archivo
        var fileSize = (file.size/1024);
        //obtenemos el tipo de archivo image/png ejemplo
        var fileType = file.type;
        //mensaje con la información del archivo
        //alert("<span class='info'>Archivo para subir: "+fileName+", peso total: "+fileSize+" bytes.</span>");
		/**/
		valida=false;
		if(fileSize <= 2048 && (fileExtension.toLowerCase()=='jpg' || fileExtension.toLowerCase()=='jpeg'))
		{
			valida=true;
		}
	}catch(err) 
	{
		
	}
		if(valida)
		{
						var formData = new FormData($(".formulario2")[0]);
						$.ajax({
							
        		    url: 'qr_usuariosinternos.php?tipo=3&estado='+estado+'&lugar='+lugar+'&nom='+nombre+'&tipo_lista='+tipo_lista+'&desc='+descripcion+'&id='+id_usuario+'',  
        		    type: 'POST',
        		    // Form data
        		    //datos del formulario
        		    data: formData,
        		    //necesario para subir archivos via ajax
        		    cache: false,
        		    contentType: false,
        		    processData: false,
        		    //mientras enviamos el archivo
        		    beforeSend: function(){
        		       //loadEspera("Subiendo..");
        		       $("#msg_error_add").html("<img src=img/load.gif>");
        		    },
        		    //una vez finalizado correctamente
        		    success: function(data){
        		      closeModal();
										filtrar_usInterno();
        		      
        		    },
        		    //si ha ocurrido un error
        		    error: function(){
        		       alert("Error al subir la imagen, por favor intentelo nuevamente");
        		       
        		    }
        		});
        		
			
			/*$("#output").load("qr_usuariosinternos.php", 
								{tipo:5, estado:estado,lugar:lugar,nombre:nombre,tipo_lista:tipo_lista,desc:descripcion} 
									,function(){
										CloseModalMapa();
										filtrar_usInterno();
									}
			);*/
		}else
			{
				$( "#msg_error_add" ).html("La im&aacute;gen no puede superar 2 Megas<br> La im&aacute;gen debe ser de formato JPG");
			}
	}
	
}
function upUsuarioEstInt(estado,id_usuario)
{

		$("#output").load("qr_usuariosinternos.php", 
							{tipo:6, estado:estado,id:id_usuario} 
								,function(){
									//CloseModalReg();
										filtrar_usInterno();
								}
		);
	
}

function limpiarNewUSInt()
{
	document.getElementById("nom_us").value="";
document.getElementById("i_file").value="";
document.getElementById("descript").value="";
$( "#msg_error_add" ).html("");
}
/**/
function loadCsv(nom_file)
{
	var mail=$.trim(document.getElementById("nom_em").value);
	
	
	var lugar=$.trim(document.getElementById("lug_us").value);
	var desde=$.trim(document.getElementById("desde").value);
	var hasta=$.trim(document.getElementById("hasta").value);
	$("#result2").html("<img src=img/load.gif>");
	$("#result2").load("qr_marcas.php", 
						{tipo:4,mail:mail,lugar:lugar,fec_ini:desde,fec_ter:hasta,nomfile:nom_file} 
							,function(){
								filtrar_marcaciones();
								window.open('csv/'+nom_file,'','width=600,height=400,left=50,top=50,toolbar=yes');
									
							}
	);
}


