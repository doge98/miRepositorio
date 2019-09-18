<?php
require_once('../util/funciones/Funciones.clase.php');
require_once('../util/funciones/Categoria_Lectura.clase.php');

    if(!isset($_POST["token"])){
        Funciones::imprimeJSON(500,"Falta el token","");	
	exit();
    }
    
$token=$_POST["token"];
$usuariocolegio=$_POST["usuariocolegio"];
$codigoaula=$_POST["codigoaula"];
$dnialumno=$_POST["dnialumno"];

    try{
        require_once 'token.validar.php';
            if(validarToken($token)){
                $objAgregar=new Categoria_Lectura();
                $objAgregar->setUsuario_colegio($usuariocolegio);
                $objAgregar->setCodigo_aula($codigoaula);
                $objAgregar->setDni_alumno($dnialumno);
                $resultado=$objAgregar->listarCategoriaLectura();
               
                Funciones::imprimeJSON(200,"",$resultado);
            }
    }catch(Exception $exc){
	Funciones::imprimeJSON(500,$exc->getMessage(),"");
    }
