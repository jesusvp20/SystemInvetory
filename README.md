# Sistema de Gestión de Inventario (SystemInventory)

Este es un sistema web robusto desarrollado con **Laravel** para la gestión de inventarios, ventas, clientes y proveedores. El sistema permite llevar un control detallado de las operaciones comerciales, generar reportes en PDF y gestionar de manera eficiente el flujo de productos.

## 🚀 Tecnologías Utilizadas

- **Backend:** Laravel 10 (PHP 8.x)
- **Frontend:** Bootstrap 5, Blade Templates, JavaScript (AJAX/Fetch API)
- **Base de Datos:** MySQL
- **Herramientas:** Vite, Composer, NPM
- **Reportes:** DomPDF

## ✨ Características Principales

- **Dashboard:** Métricas generales del estado del inventario y ventas.
- **Gestión de Productos:** Registro, edición y control de stock de productos.
- **Módulo de Ventas:** Registro de ventas en tiempo real utilizando AJAX para una experiencia fluida.
- **Clientes y Proveedores:** Directorio completo con historial de transacciones.
- **Reportes PDF:** Generación de facturas y reportes de inventario descargables.
- **Interfaz Optimizada:** Implementación de efectos de carga (Spinners) y Shimmer para mejorar la percepción de velocidad del sistema.

## 🛠️ Instalación y Configuración

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Clonar el repositorio:**
   ```bash
   git clone <url-del-repositorio>
   cd SystemInvetory
   ```

2. **Instalar dependencias de PHP:**
   ```bash
   composer install
   ```

3. **Instalar dependencias de frontend:**
   ```bash
   npm install
   ```

4. **Configurar el entorno:**
   Copia el archivo `.env.example` a `.env`:
   ```bash
   cp .env.example .env
   ```
   Luego genera la clave de aplicación:
   ```bash
   php artisan key:generate
   ```

5. **Configurar la base de datos:**
   Abre el archivo `.env` y configura el acceso a tu base de datos MySQL:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventariodb
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

6. **Ejecutar migraciones:**
   ```bash
   php artisan migrate
   ```

## 🏃‍♂️ Ejecución del Proyecto

Para iniciar el sistema, debes ejecutar tanto el servidor de PHP como el de Vite para los recursos del frontend:

1. **Servidor Laravel:**
   ```bash
   php artisan serve
   ```

2. **Compilador de Assets (Vite):**
   - Para desarrollo (con recarga rápida):
     ```bash
     npm run dev
     ```
   - Para producción (compilar archivos finales):
     ```bash
     npm run build
     ```

Una vez iniciados, puedes acceder al sistema en `http://localhost:8000`.

---
*Desarrollado como solución integral para la gestión empresarial.*
