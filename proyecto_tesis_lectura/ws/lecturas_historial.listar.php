<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Ejercicio_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$dnialumno=$_POST["dnialumno"];
$codigo_categoria=$_POST["codigo_categoria"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Ejercicio_Lectura();
                $objAgregar->setDni_alumno($dnialumno);
                $objAgregar->setCodigo_categoria($codigo_categoria);
                $resultado=$objAgregar->listarLecturasHistorial();
               
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
