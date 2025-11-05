<?php

class Rol {
    // ===== Atributos =====
    private $idRol;
    private $rolDescripcion = "";

    // ===== Constructor =====
    public function __construct($idRol, $rolDescripcion) {
        $this->idRol = $idRol;
        $this->rolDescripcion = $rolDescripcion;
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

}