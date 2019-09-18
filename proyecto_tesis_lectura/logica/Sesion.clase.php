<?php
require_once '../datos/Conexion.clase.php';
//mio
class Sesion extends Conexion{
    private $usuario;
    private $clave;
    
    function getUsuario() {
        return $this->usuario;
    }

    function getClave() {
        return $this->clave;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    function setClave($clave) {
        $this->clave = $clave;
    }

    
    public function validarSesion(){
        try {
            //$sql="select * from f_validar_sesion(:p_correo,:p_contraseña)";
            $sql="select * from f_validar_sesion(:p_usuario,:p_clave)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_usuario",$this->getUsuario());
            $sentencia->bindParam(":p_clave",$this->getClave());
            $sentencia->execute();
            return $sentencia->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $exc) {
            throw $exc;
        }
    }
}
