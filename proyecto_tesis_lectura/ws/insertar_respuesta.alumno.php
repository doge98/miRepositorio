<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Ejercicio_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$respuestaalumno=$_POST["respuestaalumno"];
$dnialumno=$_POST["dnialumno"];
$descripccionalternativa=$_POST["descripccionalternativa"];
$codigopregunta=$_POST["codigopregunta"];
$codigoejercicio=$_POST["codigoejercicio"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Ejercicio_Lectura();
                $objAgregar->setRespuesta_alumno($respuestaalumno);
                $objAgregar->setDni_alumno($dnialumno);
                $objAgregar->setDescripccionalternativa($descripccionalternativa);
                $objAgregar->setCodigo_pregunta($codigopregunta);
                $objAgregar->setCodigo_ejercicio($codigoejercicio);
                $resultado=$objAgregar->insertarRespuestaAlternativa();
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }

