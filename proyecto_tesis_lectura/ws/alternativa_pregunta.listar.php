<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Ejercicio_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$codigoejercicio=$_POST["codigoejercicio"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Ejercicio_Lectura();
                $objAgregar->setCodigo_ejercicio($codigoejercicio);
                $resultado=$objAgregar->listarAlternativasPregunta();
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
