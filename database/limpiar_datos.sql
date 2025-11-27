-- ============================================
-- Script para eliminar todos los datos y 
-- resetear los IDs (AUTO_INCREMENT) a 1
-- ============================================
-- Fecha: 2025-11-27
-- Base de datos: inventariodb
-- ============================================

-- Desactivar verificación de claves foráneas
SET FOREIGN_KEY_CHECKS = 0;

-- ============================================
-- ELIMINAR DATOS DE TODAS LAS TABLAS
-- ============================================

-- Eliminar datos (en orden por dependencias)
DELETE FROM detallefactura;
DELETE FROM detalle_ventas;
DELETE FROM facturas;
DELETE FROM ventas;
DELETE FROM producto;
DELETE FROM clientes;
DELETE FROM proveedores;
DELETE FROM sessions;
DELETE FROM cache;
DELETE FROM cache_locks;
DELETE FROM reportes;

-- ============================================
-- RESETEAR AUTO_INCREMENT A 1
-- ============================================

ALTER TABLE detallefactura AUTO_INCREMENT = 1;
ALTER TABLE facturas AUTO_INCREMENT = 1;
ALTER TABLE ventas AUTO_INCREMENT = 1;
ALTER TABLE producto AUTO_INCREMENT = 1;
ALTER TABLE clientes AUTO_INCREMENT = 1;
ALTER TABLE proveedores AUTO_INCREMENT = 1;
ALTER TABLE reportes AUTO_INCREMENT = 1;

-- Reactivar verificación de claves foráneas
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- VERIFICAR QUE TODO ESTÁ VACÍO
-- ============================================
SELECT 'producto' AS tabla, COUNT(*) AS registros FROM producto
UNION ALL
SELECT 'clientes', COUNT(*) FROM clientes
UNION ALL
SELECT 'proveedores', COUNT(*) FROM proveedores
UNION ALL
SELECT 'ventas', COUNT(*) FROM ventas
UNION ALL
SELECT 'facturas', COUNT(*) FROM facturas
UNION ALL
SELECT 'detallefactura', COUNT(*) FROM detallefactura;

-- ============================================
-- LISTO! Todos los IDs empiezan en 1
-- ============================================
