-- Tabla usuario
CREATE TABLE usuario (
    idusuario BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    usnombre VARCHAR(50) NOT NULL,
    uspass INT(11) NOT NULL,
    usmail VARCHAR(50) NOT NULL,
    usdeshabilitado TIMESTAMP NULL DEFAULT NULL
);

-- Tabla rol
CREATE TABLE rol (
    idrol BIGINT(20) AUTO_INCREMENT PRIMARY KEY,
    roldescripcion VARCHAR(50) NOT NULL
);

-- Tabla intermedia usuario_rol
CREATE TABLE usuariorol (
    idusuario BIGINT(20) NOT NULL,
    idrol BIGINT(20) NOT NULL,
    PRIMARY KEY (idusuario, idrol),
    FOREIGN KEY (idusuario) REFERENCES usuario(idusuario) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idrol) REFERENCES rol(idrol) ON DELETE CASCADE ON UPDATE CASCADE
);