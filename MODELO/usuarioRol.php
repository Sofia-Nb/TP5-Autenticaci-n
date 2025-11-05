<?php

class UsuarioRol {
    // ===== Atributos =====
    private $idUsuario;
    private $idRol;

    // ===== Constructor =====
    public function __construct($idUsuario, $idRol) {
        $this->idUsuario = $idUsuario;
        $this->idRol = $idRol;
    }

    // ===== Getters =====
    public function getIdUsuario(){
        return $this->idUsuario;
    }

    public function getIdRol(){
        return $this->idRol;
    }

    // ===== Setters =====
    public function setIdUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function setIdRol($idRol){
        $this->idRol = $idRol;
    }

}