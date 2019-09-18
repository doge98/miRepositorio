<?php

require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Logros_Usuario.clase.php');

if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$dni_alumno=$_POST["dni_alumno"];

try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Logros_Usuario();
                $objAgregar->setDni_alumno($dni_alumno);
                $resultado=$objAgregar->listarPuntajes();
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
