<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Ejercicio_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$codigocategoria=$_POST["codigocategoria"];
$codigoaulato=$_POST["codigoaula"];
$dnialumno=$_POST["dnialumno"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Ejercicio_Lectura();
                $objAgregar->setCodigo_categoria($codigocategoria);
                $objAgregar->setCodigo_aula($codigoaulato);
                $objAgregar->setDni_alumno($dnialumno);
                $resultado=$objAgregar->listarEjercicioLectura();
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
