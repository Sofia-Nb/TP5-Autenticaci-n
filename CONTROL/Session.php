<?php

class Session {

    public function __construct() {
        // Inicia la sesión si no está iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function getUsuario() {
        if (isset($_SESSION['nombreUsuario'])) {
            return $_SESSION['nombreUsuario'];
        }
        return null; // Si no está definido, devuelve null
    }

    public function getEmail() {
        if (isset($_SESSION['email'])) {
            return $_SESSION['email'];
        }
        return null; // Si no está definido, devuelve null
    }

    public function getRol() {
        if (isset($_SESSION['rol'])) {
            return $_SESSION['rol'];
        }
        return null;
    }

    public function setRol($rol) {
        $_SESSION['rol'] = $rol;
    }

    public function setUsuario($nombreUsuario) {
        $_SESSION['nombreUsuario'] = $nombreUsuario;
    }

    public function setEmail($email) {
        $_SESSION['email'] = $email;
    }

    public function getIdUsuario() {
        if (isset($_SESSION['id'])) {
            return $_SESSION['id'];
        }
        return null;
    }

    public function setIdUsuario($idusuario) {
        $_SESSION['id'] = $idusuario;
    }

    public function getRoles(){
        //Devuelve un arreglo con los objetos rol del user
        $roles = [];
        $user = $this->getUsuario();
        if ($user != null) {
            //Primero busco la instancia de UsuarioRol
            $objUsuarioRol = new UsuarioRol();
            //Creo el parametro con el id del usuario
            $parametroUser = array('idusuario' => $user->getID());
            $listaUsuarioRol = $objUsuarioRol->buscar($parametroUser);
            foreach ($listaUsuarioRol as $tupla) {
                array_push($roles, $tupla->getObjRol());
            }
        }
        return $roles;
    }

    public function iniciar($usEmail, $psw) {
    $resp = false;
    $obj = new Usuario();
    $param['usEmail'] = $usEmail;
    $param['usPass'] = $psw;
    $param['usdeshabilitado'] = null;

    $resultado = $obj->buscar($param);
    if (count($resultado) > 0) {
        $usuario = $resultado[0];
        $_SESSION['id'] = $usuario->getIdUsuario();
        $_SESSION['nombreUsuario'] = $usuario->getUsNombre();
        $_SESSION['email'] = $usuario->getUsEmail();

        // Si tenés una relación UsuarioRol:
        $objUsuarioRol = new UsuarioRol();
        $roles = $objUsuarioRol->buscar(['idusuario' => $usuario->getIdUsuario()]);
        if (count($roles) > 0) {
            $_SESSION['rol'] = $roles[0]->getObjRol()->getRolDescripcion();
        }

        $resp = true;
    } else {
        $this->cerrar();
    }
    return $resp;
}

    public function validar() {
        // se revisa si 'id' y 'usuario' existen y no están vacíos
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && isset($_SESSION['nombreUsuario']) && !empty($_SESSION['nombreUsuario']);
    }
    
    public function activa() {
        // Verifica que la sesión esté activa y que exista un usuario logueado
        return session_status() == PHP_SESSION_ACTIVE && isset($_SESSION['id']);
    }

    public function cerrar() {
        // Limpiar todas las variables de sesión
        $_SESSION = array();
        // Destruir la sesión
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

}