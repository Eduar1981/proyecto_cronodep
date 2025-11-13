-- 🔐 Base de datos inicial para CronoDep (SaaS)
CREATE DATABASE IF NOT EXISTS cronodep;
USE cronodep;

-- Tabla de clubes (cada uno es una entidad SaaS)
CREATE TABLE clubs (
    id_club INT AUTO_INCREMENT PRIMARY KEY,
    nombre_club VARCHAR(100) NOT NULL,
    correo_contacto VARCHAR(100),
    telefono_contacto VARCHAR(20),
    direccion VARCHAR(150),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de usuarios (todos los roles)
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    id_club INT,
    nombres VARCHAR(100) NOT NULL,
    apellidos VARCHAR(100) NOT NULL,
    tipo_documento VARCHAR(20),
    documento VARCHAR(20) UNIQUE NOT NULL,
    correo VARCHAR(100) UNIQUE NOT NULL,
    clave VARCHAR(255) NOT NULL,
    rol ENUM('superadmin', 'admin', 'instructor', 'deportista', 'acudiente', 'tesorero') NOT NULL,
    fecha_nacimiento DATE,
    tipo_sangre VARCHAR(10),
    celular VARCHAR(20),
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    fec_ult_sesion DATETIME,
    FOREIGN KEY (id_club) REFERENCES clubs(id_club) ON DELETE CASCADE
);

-- Tabla para relacionar acudientes con deportistas
CREATE TABLE relacion_padres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_acudiente INT,
    id_deportista INT,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_acudiente) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_deportista) REFERENCES usuarios(id_usuario)
);

-- Tipos de entrenamiento (opcional si quieres manejarlos desde un listado fijo)
CREATE TABLE tipos_entrenamiento (
    id_tipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo VARCHAR(50) NOT NULL
);

-- Entrenamientos generales
CREATE TABLE entrenamientos (
    id_entrenamiento INT AUTO_INCREMENT PRIMARY KEY,
    id_deportista INT,
    id_instructor INT,
    id_tipo INT,
    lugar VARCHAR(100),
    fecha DATE,
    total_vueltas INT DEFAULT 0,
    distancia_total FLOAT DEFAULT 0,
    tiempo_total TIME,
    observaciones TEXT,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_deportista) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_instructor) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_tipo) REFERENCES tipos_entrenamiento(id_tipo)
);

-- Vueltas por entrenamiento (solo si aplica: patinaje, ciclismo...)
CREATE TABLE vueltas_entrenamiento (
    id_vuelta INT AUTO_INCREMENT PRIMARY KEY,
    id_entrenamiento INT,
    numero_vuelta INT,
    tiempo TIME,
    distancia FLOAT,
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_entrenamiento) REFERENCES entrenamientos(id_entrenamiento)
);

-- Control de pagos (mensualidades, matrículas, etc.)
CREATE TABLE pagos (
    id_pago INT AUTO_INCREMENT PRIMARY KEY,
    id_deportista INT,
    concepto ENUM('mensualidad', 'matricula', 'otro'),
    descripcion VARCHAR(150),
    valor DECIMAL(10,2),
    fecha_pago DATE,
    metodo_pago VARCHAR(50),
    estado_pago ENUM('pagado', 'pendiente', 'mora') DEFAULT 'pendiente',
    estado ENUM('activo', 'inactivo') DEFAULT 'activo',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP,
    documento_operador VARCHAR(20),
    fec_ult_actualizacion DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (id_deportista) REFERENCES usuarios(id_usuario)
);
