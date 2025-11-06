<?php

class UsuarioRol {
    // ===== Atributos =====
    private $idUsuario;
    private $idRol;

    // ===== Constructor =====
    public function __construct($idUsuario = null, $idRol = null) {
        // Si el primer parámetro es un array, usamos cargarDatos
        if (is_array($idUsuario)) {
            $this->cargarDatos($idUsuario);
        } else {
            // Si no es array, asignamos directamente
          $this->idUsuario = $idUsuario;
          $this->idRol = $idRol;
        }
    }
        public function cargarDatos($datos) {
        if (isset($datos['idUsuario'])) $this->idUsuario = $datos['idUsuario'];
        if (isset($datos['usNombre'])) $this->idRol = $datos['idRol'];
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

    // BUSCAR
    public function buscar($param){
    $where = "";
    if ($param != null) {
        if (isset($param['idusuario'])) {
            $where .= "idusuario = " . intval($param['idusuario']);
        }
        if (isset($param['idrol'])) {
            // si también querés filtrar por idrol
            if ($where != "") {
                $where .= " AND ";
            }
            $where .= "idrol = " . intval($param['idrol']);
        }
    }
    // Llama al método listar() de esta misma clase
    $arreglo = $this->listar($where);
    return $arreglo;
}

    // INSERTAR
    public function insertar($datos) {
        $bd = new BaseDatos();
        $sql = "INSERT INTO usuariorol (idusuario, idrol) VALUES (:idusuario, :idrol)";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':idusuario', $datos['idusuario']);
        $stmt->bindParam(':idrol', $datos['idrol']);
        return $stmt->execute();
    }

    // LISTAR
    public function listar($filtro = "") {
        $bd = new BaseDatos();
        $sql = "SELECT * FROM usuariorol";
        if ($filtro) {
            $sql .= " WHERE " . $filtro;
        }
        $stmt = $bd->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // MODIFICAR (por ejemplo, cambiar el rol de un usuario)
    public function modificar($datos) {
        $bd = new BaseDatos();
        $sql = "UPDATE usuariorol 
                SET idrol = :nuevoRol 
                WHERE idusuario = :idusuario AND idrol = :idrol";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':nuevoRol', $datos['nuevoRol']);
        $stmt->bindParam(':idusuario', $datos['idusuario']);
        $stmt->bindParam(':idrol', $datos['idrol']);
        return $stmt->execute();
    }

    // ELIMINAR (elimina la relación entre un usuario y un rol)
    public function eliminar($datos) {
        $bd = new BaseDatos();
        $sql = "DELETE FROM usuariorol 
                WHERE idusuario = :idusuario AND idrol = :idrol";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':idusuario', $datos['idusuario']);
        $stmt->bindParam(':idrol', $datos['idrol']);
        return $stmt->execute();
    }

}