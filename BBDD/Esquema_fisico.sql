-- Tabla PASAPORTE
CREATE TABLE pasaporte (
    numero VARCHAR(15),
    pais_expedicion VARCHAR(50) NOT NULL,
    CONSTRAINT pk_pasaporte PRIMARY KEY (numero)
);

-- Tabla USUARIOS
CREATE TABLE usuarios (
    id_usuario INT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    edad INT,
    email VARCHAR(100) NOT NULL,
    num_pasaporte VARCHAR(15) UNIQUE,
    CONSTRAINT pk_usuarios PRIMARY KEY (id_usuario),
    CONSTRAINT uq_usuarios_email UNIQUE (email),
    CONSTRAINT ck_usuarios_edad CHECK (edad >= 18),
    CONSTRAINT fk_usuarios_pasaporte FOREIGN KEY (num_pasaporte)
        REFERENCES pasaporte(numero)
);

-- Tabla DESTINO
CREATE TABLE destino (
    id_destino INT,
    ciudad VARCHAR(50) NOT NULL,
    pais VARCHAR(50) NOT NULL,
    requiere_pasaporte BOOLEAN NOT NULL,
    CONSTRAINT pk_destino PRIMARY KEY (id_destino)
);

-- Tabla GUIAS
CREATE TABLE guias (
    id_guia INT,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    especialidad VARCHAR(20) NOT NULL,
    id_destino INT NOT NULL,
    CONSTRAINT pk_guias PRIMARY KEY (id_guia),
    CONSTRAINT ck_guias_especialidad CHECK (
        especialidad IN ('Geografía', 'Historia', 'Arquitectura', 'Comida')
    ),
    CONSTRAINT fk_guias_destino FOREIGN KEY (id_destino)
        REFERENCES destino(id_destino)
);

-- Tabla de relacion elegir entre USUARIOS y DESTINOS
CREATE TABLE usuario_elige_destino (
    id_usuario INT,
    id_destino INT,
    CONSTRAINT pk_usuario_elige_destino PRIMARY KEY (id_usuario, id_destino),
    CONSTRAINT fk_ued_usuario FOREIGN KEY (id_usuario)
        REFERENCES usuarios(id_usuario),
    CONSTRAINT fk_ued_destino FOREIGN KEY (id_destino)
        REFERENCES destino(id_destino)
);