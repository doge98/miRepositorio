<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Ejercicio_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$numero_preguntas=$_POST["numero_preguntas"];
$preguntas_buenas=$_POST["preguntas_buenas"];
$preguntas_malas=$_POST["preguntas_malas"];
$estrellas_obtenidas=$_POST["estrellas_obtenidas"];
$nivelejercicio=$_POST["nivelejercicio"];
$porcentaje_obtenido=$_POST["porcentaje_obtenido"];
$dni_alumno=$_POST["dni_alumno"];
$codigoejercicio=$_POST["codigoejercicio"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Ejercicio_Lectura();
                $objAgregar->setNumero_preguntas($numero_preguntas);
                $objAgregar->setPreguntas_buenas($preguntas_buenas);
                $objAgregar->setPreguntas_malas($preguntas_malas);
                $objAgregar->setEstrellas_obtenidas($estrellas_obtenidas);
                $objAgregar->setNivel_ejercicio($nivelejercicio);
                $objAgregar->setPorcentaje_obtenido($porcentaje_obtenido);
                $objAgregar->setDni_alumno($dni_alumno);
                $objAgregar->setCodigo_ejercicio($codigoejercicio);
                $resultado=$objAgregar->insertarPuntaje();
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
