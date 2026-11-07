-- Autor: Alfonso Hernández Xochipa

CREATE DATABASE IF NOT EXISTS techstore
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE techstore;

CREATE TABLE categorias (
    id        INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre    VARCHAR(60) NOT NULL,
    slug      VARCHAR(60) NOT NULL,
    activa    TINYINT(1)  NOT NULL DEFAULT 1,
    creado_en TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_categorias_slug UNIQUE (slug)
) ENGINE=InnoDB;

CREATE TABLE productos (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    categoria_id   INT UNSIGNED  NOT NULL,
    sku            VARCHAR(20)   NOT NULL,
    nombre         VARCHAR(120)  NOT NULL,
    descripcion    TEXT          NULL,
    precio         DECIMAL(10,2) NOT NULL,
    existencias    INT           NOT NULL DEFAULT 0,
    imagen         VARCHAR(255)  NULL,
    activo         TINYINT(1)    NOT NULL DEFAULT 1,
    creado_en      TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
                                 ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT uq_productos_sku UNIQUE (sku),
    CONSTRAINT fk_productos_categoria
        FOREIGN KEY (categoria_id) REFERENCES categorias(id),
    CONSTRAINT ck_productos_precio      CHECK (precio >= 0),
    CONSTRAINT ck_productos_existencias CHECK (existencias >= 0)
) ENGINE=InnoDB;

CREATE INDEX idx_productos_categoria ON productos(categoria_id);
CREATE INDEX idx_productos_nombre    ON productos(nombre);

CREATE TABLE usuarios (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre        VARCHAR(100) NOT NULL,
    email         VARCHAR(150) NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    rol           ENUM('admin','editor') NOT NULL DEFAULT 'editor',
    activo        TINYINT(1)   NOT NULL DEFAULT 1,
    creado_en     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT uq_usuarios_email UNIQUE (email)
) ENGINE=InnoDB;

CREATE TABLE movimientos (
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    producto_id  INT UNSIGNED NOT NULL,
    cantidad     INT          NOT NULL,
    motivo       VARCHAR(80)  NULL,
    registrado_en TIMESTAMP   NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_movimientos_producto
        FOREIGN KEY (producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;
