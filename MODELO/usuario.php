<?php

class Usuario {
    // ===== Atributos =====
    private $idUsuario;
    private $usNombre;
    private $usPass;
    private $usmail;
    private $usDeshabilitado; // puede ser bool o string según tu DB

   public function __construct($idUsuario = null, $usNombre = null, $usPass = null, $usmail = null, $usDeshabilitado = null) {
        // Si el primer parámetro es un array, usamos cargarDatos
        if (is_array($idUsuario)) {
            $this->cargarDatos($idUsuario);
        } else {
            // Si no es array, asignamos directamente
            $this->idUsuario = $idUsuario;
            $this->usNombre = $usNombre;
            $this->usPass = $usPass;
            $this->usmail = $usmail;
            $this->usDeshabilitado = $usDeshabilitado;
        }
    }

        public function cargarDatos($datos) {
        if (isset($datos['idUsuario'])) $this->idUsuario = $datos['idUsuario'];
        if (isset($datos['usNombre'])) $this->usNombre = $datos['usNombre'];
        if (isset($datos['usPass'])) $this->usPass = $datos['usPass'];
        if (isset($datos['usEmail'])) $this->usmail = $datos['usEmail'];
        if (isset($datos['usDeshabilitado'])) $this->usDeshabilitado = $datos['usDeshabilitado'];
    }

    // ===== Getters =====
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getUsNombre(){
        return $this->usNombre;
    }

    public function getUsPass(){
        return $this->usPass;
    }

    public function getUsmail(){
        return $this->usmail;
    }

    public function getUsDeshabilitado(){
        return $this->usDeshabilitado;
    }

    // ===== Setters =====
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setUsNombre($usNombre){
        $this->usNombre = $usNombre;
    }

    public function setUsPass($usPass){
        $this->usPass = $usPass;
    }

    public function setUsEmail($usmail){
        $this->usmail = $usmail;
    }

    public function setUsDeshabilitado($usDeshabilitado){
        $this->usDeshabilitado = $usDeshabilitado;
    }

// CORREGIR //
    public function buscar($datos) {
        $baseDatos = new BaseDatos();
        $res = false;
        $usEmail = $datos["usEmail"];
        $usPass = $datos["usPass"];
        $sql = "SELECT idUsuario FROM usuario WHERE usEmail = :usEmail AND usPass = :usPass";
        $stmt = $baseDatos->prepare($sql);
        $stmt->execute([':usEmail' => $usEmail]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            $res = $usuario['idUsuario'];
        }
        return $res;
    }

    // INSERTAR
    public function insertar($datos) {
        $bd = new BaseDatos();
        $sql = "INSERT INTO usuario (usnombre, uspass, usmail, usdeshabilitado)
                VALUES (:nombre, :pass, :mail, :deshabilitado)";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':nombre', $datos['usnombre']);
        $stmt->bindParam(':pass', $datos['uspass']);
        $stmt->bindParam(':mail', $datos['usmail']);
        $stmt->bindParam(':deshabilitado', $datos['usdeshabilitado']);
        return $stmt->execute();
    }

    // LISTAR
    public static function listar($filtro = "") {
        $bd = new BaseDatos();
        $sql = "SELECT * FROM usuario";
        if ($filtro) {
            $sql .= " WHERE " . $filtro;
        }
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // MODIFICAR
    public function modificar($datos) {
        $bd = new BaseDatos();
        $sql = "UPDATE usuario 
                SET usnombre = :nombre, uspass = :pass, usmail = :mail, usdeshabilitado = :deshabilitado
                WHERE idusuario = :id";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':nombre', $datos['usnombre']);
        $stmt->bindParam(':pass', $datos['uspass']);
        $stmt->bindParam(':mail', $datos['usmail']);
        $stmt->bindParam(':deshabilitado', $datos['usdeshabilitado']);
        $stmt->bindParam(':id', $datos['idusuario']);
        return $stmt->execute();
    }

    // ELIMINAR
    public function eliminar($datos) {
        $bd = new BaseDatos();
        $sql = "DELETE FROM usuario WHERE idusuario = :id";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id', $datos['idusuario']);
        return $stmt->execute();
    }

}