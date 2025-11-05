<?php

class Usuario {
    // ===== Atributos =====
    private $idUsuario;
    private $usNombre;
    private $usPass;
    private $usEmail;
    private $usDeshabilitado; // puede ser bool o string según tu DB

    // ===== Constructor =====
    public function __construct($idUsuario, $usNombre, $usPass, $usEmail, $usDeshabilitado){
        $this->idUsuario = $idUsuario;
        $this->usNombre = $usNombre;
        $this->usPass = $usPass;
        $this->usEmail = $usEmail;
        $this->usDeshabilitado = $usDeshabilitado;
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

    public function getUsEmail(){
        return $this->usEmail;
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

    public function setUsEmail($usEmail){
        $this->usEmail = $usEmail;
    }

    public function setUsDeshabilitado($usDeshabilitado){
        $this->usDeshabilitado = $usDeshabilitado;
    }

}