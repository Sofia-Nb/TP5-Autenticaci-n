<?php

class Rol {
    // ===== Atributos =====
    private $idRol;
    private $rolDescripcion = "";

    // ===== Constructor =====
    public function __construct($idRol = null, $rolDescripcion = null) {
        // Si el primer parámetro es un array, usamos cargarDatos
        if (is_array($idRol)) {
            $this->cargarDatos($idRol);
        } else {
            // Si no es array, asignamos directamente
          $this->idRol = $idRol;
          $this->rolDescripcion = $rolDescripcion;
        }
    }
        public function cargarDatos($datos) {
        if (isset($datos['idRol'])) $this->idRol = $datos['idRol'];
        if (isset($datos['rolDescripcion'])) $this->rolDescripcion = $datos['rolDescripcion'];
    }

    // ===== Getters =====
    public function getIdRol(){
        return $this->idRol;
    }

    public function getRolDescripcion(){
        return $this->rolDescripcion;
    }

    // ===== Setters =====
    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }

    public function setRolDescripcion($rolDescripcion){
        $this->rolDescripcion = $rolDescripcion;
    }

    // INSERTAR
    public function insertar($datos) {
        $bd = new BaseDatos();
        $sql = "INSERT INTO rol (roldescripcion) VALUES (:descripcion)";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':descripcion', $datos['roldescripcion']);
        return $stmt->execute();
    }

    // LISTAR
    public function listar($filtro = "") {
        $bd = new BaseDatos();
        $sql = "SELECT * FROM rol";
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
        $sql = "UPDATE rol 
                SET roldescripcion = :descripcion 
                WHERE idrol = :id";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':descripcion', $datos['roldescripcion']);
        $stmt->bindParam(':id', $datos['idrol']);
        return $stmt->execute();
    }

    // ELIMINAR
    public function eliminar($datos) {
        $bd = new BaseDatos();
        $sql = "DELETE FROM rol WHERE idrol = :id";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':id', $datos['idrol']);
        return $stmt->execute();
    }

}