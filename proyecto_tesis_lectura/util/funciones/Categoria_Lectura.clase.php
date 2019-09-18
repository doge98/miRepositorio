<?php
require_once '../datos/Conexion.clase.php';
class Categoria_Lectura extends Conexion{
    private $codigo_categoria;
    private $nombre_categoria;
    private $descripcion_categoria;
    private $estado_categoria;
    private $foto_categoria;
    private $usuario_colegio;
    private $dni_profesor;
    private $codigo_aula;
    private $dni_alumno;
    
    function getCodigo_categoria() {
        return $this->codigo_categoria;
    }

    function getNombre_categoria() {
        return $this->nombre_categoria;
    }

    function getDescripcion_categoria() {
        return $this->descripcion_categoria;
    }

    function getEstado_categoria() {
        return $this->estado_categoria;
    }

    function getFoto_categoria() {
        return $this->foto_categoria;
    }

    function getUsuario_colegio() {
        return $this->usuario_colegio;
    }

    function getDni_profesor() {
        return $this->dni_profesor;
    }

    function getCodigo_aula() {
        return $this->codigo_aula;
    }

    function setCodigo_categoria($codigo_categoria) {
        $this->codigo_categoria = $codigo_categoria;
    }

    function setNombre_categoria($nombre_categoria) {
        $this->nombre_categoria = $nombre_categoria;
    }

    function setDescripcion_categoria($descripcion_categoria) {
        $this->descripcion_categoria = $descripcion_categoria;
    }

    function setEstado_categoria($estado_categoria) {
        $this->estado_categoria = $estado_categoria;
    }

    function setFoto_categoria($foto_categoria) {
        $this->foto_categoria = $foto_categoria;
    }

    function setUsuario_colegio($usuario_colegio) {
        $this->usuario_colegio = $usuario_colegio;
    }

    function setDni_profesor($dni_profesor) {
        $this->dni_profesor = $dni_profesor;
    }

    function setCodigo_aula($codigo_aula) {
        $this->codigo_aula = $codigo_aula;
    }
    
    function getDni_alumno() {
        return $this->dni_alumno;
    }

    function setDni_alumno($dni_alumno) {
        $this->dni_alumno = $dni_alumno;
    }

        
    public function listarCategoriaLectura(){
	try{
            $sql="select CES.*,
(select count(*) from CATEGORIA_EJERCICIO CE 
inner join EJERCICIO_LECTORA EL on CE.codigo_categoria=EL.codigo_categoria
where CE.usuario_colegio=:usuariocolegio and CE.codigo_aula=:codigoaula and CE.codigo_categoria=CES.codigo_categoria
and EL.codigo_ejercicio not in (
select codigo_ejercicio from PUNTAJE_ALUMNO_PREGUNTAS where dni_alumno=:dnialumno
)) as faltante,
(select count(*) from CATEGORIA_EJERCICIO CE 
inner join EJERCICIO_LECTORA EL on CE.codigo_categoria=EL.codigo_categoria
where CE.usuario_colegio=:usuariocolegio and CE.codigo_aula=:codigoaula and CE.codigo_categoria=CES.codigo_categoria
) as total
from CATEGORIA_EJERCICIO CES 
where usuario_colegio=:usuariocolegio and codigo_aula=:codigoaula";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":usuariocolegio",$this->getUsuario_colegio());
                $sentencia->bindParam(":codigoaula",$this->getCodigo_aula());
                $sentencia->bindParam(":dnialumno",$this->getDni_alumno());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    

}
