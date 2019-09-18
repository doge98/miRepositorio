<?php
require_once '../datos/Conexion.clase.php';
class Ejercicio_Lectura extends Conexion{
    private $codigo_ejercicio;
    private $dni_alumno;
    private $titulo_ejercicio;
    private $tipo_texto;
    private $texto_ejercicio;
    private $estado_ejercicio;
    private $nivel_ejercicio;
    private $puntaje_ejercicio;
    private $fecha_publicacion_ejercicio;
    private $codigo_categoria;
    private $codigo_aula;
    private $codigo_pregunta;
    
    private $descripccionalternativa;
    private $respuesta_alumno;
    
    private $numero_preguntas;
    private $preguntas_buenas;
    private $preguntas_malas;
    private $estrellas_obtenidas;
    private $porcentaje_obtenido;
    
    function getCodigo_ejercicio() {
        return $this->codigo_ejercicio;
    }

    function getDescripccionalternativa() {
        return $this->descripccionalternativa;
    }

    function setDescripccionalternativa($descripccionalternativa) {
        $this->descripccionalternativa = $descripccionalternativa;
    }

    function getTitulo_ejercicio() {
        return $this->titulo_ejercicio;
    }

    function getTipo_texto() {
        return $this->tipo_texto;
    }

    function getTexto_ejercicio() {
        return $this->texto_ejercicio;
    }

    function getEstado_ejercicio() {
        return $this->estado_ejercicio;
    }

    function getNivel_ejercicio() {
        return $this->nivel_ejercicio;
    }

    function getPuntaje_ejercicio() {
        return $this->puntaje_ejercicio;
    }

    function getFecha_publicacion_ejercicio() {
        return $this->fecha_publicacion_ejercicio;
    }

    function getCodigo_categoria() {
        return $this->codigo_categoria;
    }

    function getCodigo_aula() {
        return $this->codigo_aula;
    }

    function setCodigo_ejercicio($codigo_ejercicio) {
        $this->codigo_ejercicio = $codigo_ejercicio;
    }

    function setTitulo_ejercicio($titulo_ejercicio) {
        $this->titulo_ejercicio = $titulo_ejercicio;
    }

    function setTipo_texto($tipo_texto) {
        $this->tipo_texto = $tipo_texto;
    }

    function setTexto_ejercicio($texto_ejercicio) {
        $this->texto_ejercicio = $texto_ejercicio;
    }

    function setEstado_ejercicio($estado_ejercicio) {
        $this->estado_ejercicio = $estado_ejercicio;
    }

    function setNivel_ejercicio($nivel_ejercicio) {
        $this->nivel_ejercicio = $nivel_ejercicio;
    }

    function setPuntaje_ejercicio($puntaje_ejercicio) {
        $this->puntaje_ejercicio = $puntaje_ejercicio;
    }

    function setFecha_publicacion_ejercicio($fecha_publicacion_ejercicio) {
        $this->fecha_publicacion_ejercicio = $fecha_publicacion_ejercicio;
    }

    function setCodigo_categoria($codigo_categoria) {
        $this->codigo_categoria = $codigo_categoria;
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
    
    function getCodigo_pregunta() {
        return $this->codigo_pregunta;
    }

    function setCodigo_pregunta($codigo_pregunta) {
        $this->codigo_pregunta = $codigo_pregunta;
    }
    
    function getRespuesta_alumno() {
        return $this->respuesta_alumno;
    }

    function setRespuesta_alumno($respuesta_alumno) {
        $this->respuesta_alumno = $respuesta_alumno;
    }
    function getNumero_preguntas() {
        return $this->numero_preguntas;
    }

    function getPreguntas_buenas() {
        return $this->preguntas_buenas;
    }

    function getPreguntas_malas() {
        return $this->preguntas_malas;
    }

    function getEstrellas_obtenidas() {
        return $this->estrellas_obtenidas;
    }

    function getPorcentaje_obtenido() {
        return $this->porcentaje_obtenido;
    }

    function setNumero_preguntas($numero_preguntas) {
        $this->numero_preguntas = $numero_preguntas;
    }

    function setPreguntas_buenas($preguntas_buenas) {
        $this->preguntas_buenas = $preguntas_buenas;
    }

    function setPreguntas_malas($preguntas_malas) {
        $this->preguntas_malas = $preguntas_malas;
    }

    function setEstrellas_obtenidas($estrellas_obtenidas) {
        $this->estrellas_obtenidas = $estrellas_obtenidas;
    }

    function setPorcentaje_obtenido($porcentaje_obtenido) {
        $this->porcentaje_obtenido = $porcentaje_obtenido;
    }

            
            
    public function listarEjercicioLectura(){
	try{
            $sql="select EL.*,
(select count(*) from PREGUNTA_EJERCICIO PE where PE.codigo_ejercicio=EL.codigo_ejercicio) as numPreguntas,
(select count(*) from PUNTAJE_ALUMNO_PREGUNTAS PAP
where PAP.codigo_ejercicio=EL.codigo_ejercicio and PAP.dni_alumno=:dnialumno) as respuesta
from EJERCICIO_LECTORA EL
inner join ALUMNO_AULA AA on AA.codigo_aula=EL.codigo_aula
where EL.codigo_categoria=:codigocategoria and EL.codigo_aula=:codigoaula and AA.dni_alumno=:dnialumno
order by respuesta,fecha_publicacion_ejercicio desc";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":codigocategoria",$this->getCodigo_categoria());
                $sentencia->bindParam(":codigoaula",$this->getCodigo_aula());
                $sentencia->bindParam(":dnialumno",$this->getDni_alumno());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function listarPreguntasEjercicio(){
	try{
            $sql="select * from PREGUNTA_EJERCICIO where codigo_ejercicio=:codigoejercicio;";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":codigoejercicio",$this->getCodigo_ejercicio());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function listarAlternativasPregunta(){
	try{
            $sql="select * from ALTERNATIVAS_EJERCICIO where codigo_ejercicio=:codigoejercicio;";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":codigoejercicio",$this->getCodigo_ejercicio());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function insertarRespuestaAlternativa(){
	try{
            $sql="insert into RESPUESTA_ALTERNATIVA_ALUMNO values(:respuestaalumno,:dnialumno,:descripccionalternativa,:codigopregunta,:codigoejercicio);";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":respuestaalumno",$this->getRespuesta_alumno());
                $sentencia->bindParam(":dnialumno",$this->getDni_alumno());
                $sentencia->bindParam(":descripccionalternativa",$this->getDescripccionalternativa());
                $sentencia->bindParam(":codigopregunta",$this->getCodigo_pregunta());
                $sentencia->bindParam(":codigoejercicio",$this->getCodigo_ejercicio());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function insertarPuntaje(){
	try{
            $sql="insert into PUNTAJE_ALUMNO_PREGUNTAS values (:numero_preguntas,:preguntas_buenas,:preguntas_malas,:estrellas_obtenidas,:nivelejercicio,:porcentaje_obtenido,:dni_alumno,:codigoejercicio,current_date);";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":numero_preguntas",$this->getNumero_preguntas());
                $sentencia->bindParam(":preguntas_buenas",$this->getPreguntas_buenas());
                $sentencia->bindParam(":preguntas_malas",$this->getPreguntas_malas());
                $sentencia->bindParam(":estrellas_obtenidas",$this->getEstrellas_obtenidas());
                $sentencia->bindParam(":nivelejercicio",$this->getNivel_ejercicio());
                $sentencia->bindParam(":porcentaje_obtenido",$this->getPorcentaje_obtenido());
                $sentencia->bindParam(":dni_alumno",$this->getDni_alumno());
                $sentencia->bindParam(":codigoejercicio",$this->getCodigo_ejercicio());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function listarLecturasHistorial(){
	try{
            $sql="select EL.titulo_ejercicio,PAP.* from PUNTAJE_ALUMNO_PREGUNTAS PAP
                inner join EJERCICIO_LECTORA EL on PAP.codigo_ejercicio=EL.codigo_ejercicio
                where PAP.dni_alumno=:dnialumno and EL.codigo_categoria=:codigo_categoria order by PAP.fecha_respuesta";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":dnialumno",$this->getDni_alumno());
                $sentencia->bindParam(":codigo_categoria",$this->getCodigo_categoria());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
    
    public function listarRespuestasHistorial(){
	try{
            $sql="select * from RESPUESTA_ALTERNATIVA_ALUMNO 
                where dni_alumno=:dnialumno and codigo_ejercicio=:codigo_ejercicio";
		$sentencia=$this->dblink->prepare($sql);
		$sentencia->bindParam(":dnialumno",$this->getDni_alumno());
                $sentencia->bindParam(":codigo_ejercicio",$this->getCodigo_ejercicio());
		$sentencia->execute();
		$resultado=$sentencia->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(Exception $exc){
		throw $exc;
	}
    }
}
