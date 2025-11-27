-- ============================================
-- Script PostgreSQL para inventariodb
-- Convertido desde MySQL
-- ============================================

-- Eliminar tablas si existen (en orden por dependencias)
DROP TABLE IF EXISTS detallefactura CASCADE;
DROP TABLE IF EXISTS detalle_ventas CASCADE;
DROP TABLE IF EXISTS facturas CASCADE;
DROP TABLE IF EXISTS ventas CASCADE;
DROP TABLE IF EXISTS producto CASCADE;
DROP TABLE IF EXISTS clientes CASCADE;
DROP TABLE IF EXISTS proveedores CASCADE;
DROP TABLE IF EXISTS reportes CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS password_reset_tokens CASCADE;
DROP TABLE IF EXISTS sessions CASCADE;
DROP TABLE IF EXISTS cache CASCADE;
DROP TABLE IF EXISTS cache_locks CASCADE;
DROP TABLE IF EXISTS failed_jobs CASCADE;
DROP TABLE IF EXISTS jobs CASCADE;
DROP TABLE IF EXISTS job_batches CASCADE;
DROP TABLE IF EXISTS migrations CASCADE;

-- ============================================
-- TABLA: users (usuarios de Laravel)
-- ============================================
CREATE TABLE users (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP NULL,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- ============================================
-- TABLA: password_reset_tokens
-- ============================================
CREATE TABLE password_reset_tokens (
    email VARCHAR(255) PRIMARY KEY,
    token VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL
);

-- ============================================
-- TABLA: sessions
-- ============================================
CREATE TABLE sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

CREATE INDEX sessions_user_id_index ON sessions(user_id);
CREATE INDEX sessions_last_activity_index ON sessions(last_activity);

-- ============================================
-- TABLA: cache
-- ============================================
CREATE TABLE cache (
    key VARCHAR(255) PRIMARY KEY,
    value TEXT NOT NULL,
    expiration INTEGER NOT NULL
);

-- ============================================
-- TABLA: cache_locks
-- ============================================
CREATE TABLE cache_locks (
    key VARCHAR(255) PRIMARY KEY,
    owner VARCHAR(255) NOT NULL,
    expiration INTEGER NOT NULL
);

-- ============================================
-- TABLA: proveedores
-- ============================================
CREATE TABLE proveedores (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(250) NOT NULL,
    direccion VARCHAR(250) NOT NULL,
    telefono VARCHAR(250) NOT NULL,
    estado SMALLINT DEFAULT 0,
    user_id BIGINT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLA: clientes
-- ============================================
CREATE TABLE clientes (
    id SERIAL PRIMARY KEY,
    nombre VARCHAR(250) NOT NULL,
    identificacion INTEGER NULL UNIQUE,
    email VARCHAR(250) NULL,
    estado SMALLINT DEFAULT 0,
    telefono BIGINT NOT NULL,
    user_id BIGINT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLA: producto
-- ============================================
CREATE TABLE producto (
    "IdProducto" SERIAL PRIMARY KEY,
    nombre VARCHAR(250) NOT NULL,
    descripcion TEXT NULL,
    precio DECIMAL(10,2) NOT NULL,
    cantidad_disponible INTEGER NOT NULL DEFAULT 0,
    categoria VARCHAR(50) NULL,
    proveedor VARCHAR(100) NULL,
    "codigoProducto" VARCHAR(50) NULL UNIQUE,
    fecha_creacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    estado SMALLINT DEFAULT 1,
    user_id BIGINT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLA: ventas
-- ============================================
CREATE TABLE ventas (
    id_venta SERIAL PRIMARY KEY,
    fecha_venta TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NULL,
    id_cliente INTEGER NULL REFERENCES clientes(id),
    user_id BIGINT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLA: detalle_ventas
-- ============================================
CREATE TABLE detalle_ventas (
    id SERIAL PRIMARY KEY,
    id_venta INTEGER NULL REFERENCES ventas(id_venta),
    id_producto INTEGER NULL,
    cantidad INTEGER NOT NULL,
    precio DECIMAL(10,2) NOT NULL
);

-- ============================================
-- TABLA: facturas
-- ============================================
CREATE TABLE facturas (
    id SERIAL PRIMARY KEY,
    numero_factura VARCHAR(50) NOT NULL UNIQUE,
    fecha DATE NOT NULL,
    cliente_id INTEGER NULL REFERENCES clientes(id),
    total DECIMAL(10,2) NOT NULL,
    estado VARCHAR(20) DEFAULT 'pendiente',
    user_id BIGINT NULL REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================
-- TABLA: detallefactura
-- ============================================
CREATE TABLE detallefactura (
    id SERIAL PRIMARY KEY,
    factura_id INTEGER NULL REFERENCES facturas(id),
    producto_id INTEGER NULL,
    cantidad INTEGER NOT NULL,
    precio_unitario DECIMAL(10,2) NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL
);

-- ============================================
-- TABLA: reportes
-- ============================================
CREATE TABLE reportes (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);

-- ============================================
-- TABLA: failed_jobs
-- ============================================
CREATE TABLE failed_jobs (
    id BIGSERIAL PRIMARY KEY,
    uuid VARCHAR(255) NOT NULL UNIQUE,
    connection TEXT NOT NULL,
    queue TEXT NOT NULL,
    payload TEXT NOT NULL,
    exception TEXT NOT NULL,
    failed_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- ============================================
-- TABLA: jobs
-- ============================================
CREATE TABLE jobs (
    id BIGSERIAL PRIMARY KEY,
    queue VARCHAR(255) NOT NULL,
    payload TEXT NOT NULL,
    attempts SMALLINT NOT NULL,
    reserved_at INTEGER NULL,
    available_at INTEGER NOT NULL,
    created_at INTEGER NOT NULL
);

CREATE INDEX jobs_queue_index ON jobs(queue);

-- ============================================
-- TABLA: job_batches
-- ============================================
CREATE TABLE job_batches (
    id VARCHAR(255) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    total_jobs INTEGER NOT NULL,
    pending_jobs INTEGER NOT NULL,
    failed_jobs INTEGER NOT NULL,
    failed_job_ids TEXT NOT NULL,
    options TEXT NULL,
    cancelled_at INTEGER NULL,
    created_at INTEGER NOT NULL,
    finished_at INTEGER NULL
);

-- ============================================
-- TABLA: migrations
-- ============================================
CREATE TABLE migrations (
    id SERIAL PRIMARY KEY,
    migration VARCHAR(255) NOT NULL,
    batch INTEGER NOT NULL
);

-- ============================================
-- LISTO! Base de datos PostgreSQL creada
-- ============================================

