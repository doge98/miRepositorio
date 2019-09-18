<?php
require_once '../datos/Conexion.clase.php';
class Logros_Usuario extends Conexion{
    private $dni_alumno;
    
    function getDni_alumno() {
        return $this->dni_alumno;
    }

    function setDni_alumno($dni_alumno) {
        $this->dni_alumno = $dni_alumno;
    }
    
    public function listarPuntajes(){
	try{
            $sql="select count(*) as primero,
(select sum(estrellas_obtenidas) from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno) as segundo,
(select count(*) from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno and preguntas_malas=0) as tercero,
(select count(*) from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno and porcentaje_obtenido>=50 and nivel_dado='Normal') as cuarto,
(select count(*) from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno and porcentaje_obtenido>=60 and nivel_dado='Difícil') as quinto,
(select count(*) from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno and porcentaje_obtenido>=70 and nivel_dado='Muy difícil') as sexto
from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dni_alumno";
		$sentencia1=$this->dblink->prepare($sql);
		$sentencia1->bindParam(":dni_alumno",$this->getDni_alumno());
		$sentencia1->execute();
		$resultado=$sentencia1->fetchAll(PDO::FETCH_ASSOC);
                
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
}
