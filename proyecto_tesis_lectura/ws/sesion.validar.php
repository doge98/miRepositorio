<?php
require_once("../logica/Sesion.clase.php");
require_once('../util/funciones/Funciones.clase.php');


//validar si los parametros email y clave estan cargados/seteados dentro
//de la variable $_POST
if(!isset($_POST["usuario"]) || !isset($_POST["clave"])){
	Funciones::imprimeJSON(500,"Faltan datos requeridos","");
	exit();//Detiene el avance del programa
}

//Recoger los datos ingresados en los parametros email y clave
$usuario=$_POST["usuario"];
$clave=$_POST["clave"];


//exit;

//Instanciar a la clase Sesion y llamar a los metodos
try{
	//Instanciar un objeto de clase Sesion
	$objSesion=new Sesion();
	
	//Enviar los datos a los atributos haciendo uso de los metodos set
	$objSesion->setUsuario($usuario);
	$objSesion->setClave($clave);
	
	//Llamar al metodo validarSesion()
	$resultado=$objSesion->validarSesion();
	
	//Preguntar por el estado
	if($resultado["estado"]==200){//devuelve 200 cuendo el usuario y clave son correctos
		//generar token
		require_once 'token.generar.php';
		$token= generarToken(null,900000);
		$resultado["token"]=$token;
		
		//Imprimir variable resultado mostrando el mensaje de bienvenida
		Funciones::imprimeJSON(200,"Bienvenido a la aplicacion",$resultado);
	}else{
	Funciones::imprimeJSON(500,$resultado["nombre_alumno"],"");	
	}
	
	//imprimir la variable resultado
	//Funciones::imprimeJSON(200,"",$resultado);
	
}catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
}


