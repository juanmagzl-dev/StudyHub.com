# StudyHub 2.0

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca del Proyecto

StudyHub 2.0 es una aplicación web diseñada para ayudar a los estudiantes a organizar y gestionar sus tareas académicas de manera eficiente. La plataforma permite a los usuarios crear, editar y hacer seguimiento de sus tareas, priorizarlas según su importancia y establecer fechas límite para mejorar su productividad.

## Características Principales

- **Gestión de Tareas**: Crea, edita, elimina y visualiza tareas académicas
- **Sistema de Prioridades**: Clasifica tus tareas como baja, media o alta prioridad
- **Estados de Progreso**: Seguimiento del estado de las tareas (pendiente, en progreso, completada)
- **Fechas Límite**: Establece fechas de vencimiento para tus tareas
- **Panel de Control**: Visualiza todas tus tareas en un dashboard intuitivo
- **Autenticación de Usuarios**: Registro, inicio de sesión y gestión de sesiones
- **Experiencia Personalizada**: Cada usuario gestiona únicamente sus propias tareas

## Tecnologías Utilizadas

- **Backend**: PHP 8.2 con Laravel 10
- **Frontend**: Blade, HTML5, CSS3, JavaScript
- **Base de Datos**: MySQL
- **Autenticación**: Sistema nativo de Laravel

## Requisitos del Sistema

- PHP >= 8.1
- Composer
- MySQL
- Servidor web (Apache/Nginx)
- Node.js y NPM (para compilar assets)

## Instalación y Configuración

### 1. Clonar el Repositorio

```bash
git clone https://github.com/tu-usuario/studyhub2.0.git
cd studyhub2.0
```

### 2. Instalar Dependencias

```bash
composer install
npm install
```

### 3. Configuración del Entorno

Copia el archivo `.env.example` a `.env` y configura las variables de entorno:

```bash
cp .env.example .env
```

Edita el archivo `.env` con la configuración de tu base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studyhub
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 5. Crear la Base de Datos

Crea una base de datos llamada `studyhub` en tu servidor MySQL (puede ser a través de phpMyAdmin u otra herramienta).

### 6. Ejecutar Migraciones

```bash
php artisan migrate
```

### 7. Compilar Assets (opcional)

```bash
npm run dev
```

### 8. Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

La aplicación estará disponible en `http://localhost:8000`.

## Estructura de la Aplicación

- **Modelos**: 
  - `User`: Gestiona la información de los usuarios registrados
  - `Task`: Almacena las tareas con título, descripción, fecha límite, prioridad y estado

- **Controladores**:
  - `AuthController`: Maneja el registro, inicio y cierre de sesión
  - `TaskController`: Administra las operaciones CRUD para las tareas
  - `ContactController`: Procesa los mensajes del formulario de contacto

- **Rutas**:
  - Públicas: Landing page, login, registro
  - Protegidas: Dashboard, gestión de tareas (requieren autenticación)

## Uso de la Aplicación

1. **Registro/Inicio de Sesión**: Crea una cuenta o inicia sesión con credenciales existentes
2. **Dashboard**: Visualiza todas tus tareas organizadas por estado
3. **Crear Tarea**: Utiliza el formulario para añadir una nueva tarea con título, descripción, fecha límite y prioridad
4. **Gestionar Tareas**: Edita, elimina o cambia el estado de tus tareas según avances en su realización
5. **Filtrar Tareas**: Organiza tus tareas según prioridad, estado o fecha límite

## Seguridad

- Todas las contraseñas se almacenan hasheadas en la base de datos
- Las rutas protegidas utilizan middleware de autenticación
- Validación de formularios para prevenir inyección de datos maliciosos
- Protección CSRF en todos los formularios

## Contacto y Soporte

Si tienes preguntas o necesitas ayuda con la aplicación, puedes utilizar el formulario de contacto dentro de la plataforma o enviar un correo a [correo@ejemplo.com].

## Licencia

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Configuración de la Autenticación

Este proyecto utiliza MySQL con phpMyAdmin para la base de datos. Sigue estos pasos para configurar la autenticación:

1. Configura tu archivo `.env` con los siguientes parámetros para la base de datos:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=studyhub
DB_USERNAME=root
DB_PASSWORD=
```

2. Crea una base de datos llamada `studyhub` en phpMyAdmin.

3. Ejecuta las migraciones para crear las tablas necesarias:

```bash
php artisan migrate
```

4. Genera una clave de aplicación:

```bash
php artisan key:generate
```

5. Inicia el servidor de desarrollo:

```bash
php artisan serve
```

6. Visita `http://localhost:8000` en tu navegador.

## Funcionalidades de Autenticación

- Registro de usuarios nuevos
- Inicio de sesión con correo electrónico y contraseña
- Cerrar sesión
- Acceso al dashboard protegido (solo usuarios autenticados)
