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

### Estructura de Directorios

La aplicación sigue la estructura estándar de Laravel con los siguientes directorios principales:

- `app/`: Contiene la lógica principal de la aplicación
- `config/`: Archivos de configuración
- `database/`: Migraciones y seeders
- `public/`: Punto de entrada y assets públicos
- `resources/`: Vistas, assets sin compilar y traducciones
- `routes/`: Definiciones de rutas
- `storage/`: Archivos generados por la aplicación
- `tests/`: Tests automatizados

### Modelos

#### User.php

El modelo `User` gestiona la información de los usuarios registrados y sus relaciones:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación: un usuario tiene muchas tareas
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
```

Este modelo:
- Define los campos que se pueden asignar masivamente con `$fillable`
- Oculta campos sensibles como la contraseña con `$hidden`
- Establece el casting de tipos de datos con `casts()`
- Define una relación de uno-a-muchos con las tareas

#### Task.php

El modelo `Task` gestiona las tareas de los usuarios:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relación: una tarea pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

Este modelo:
- Define los campos que pueden asignarse masivamente
- Convierte automáticamente el campo `due_date` a un objeto de tipo fecha
- Establece una relación inversa con el modelo User

### Controladores

#### AuthController.php

Gestiona todos los procesos de autenticación:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar registro
    public function register(Request $request)
    {
        // Validación de datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    // Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->withInput();
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
```

Este controlador:
- Muestra y procesa formularios de registro e inicio de sesión
- Valida los datos de entrada 
- Crea nuevos usuarios con contraseñas hasheadas
- Gestiona la autenticación mediante las facilidades de Laravel
- Maneja el cierre de sesión de forma segura

#### TaskController.php

Gestiona todas las operaciones CRUD para las tareas:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Lista todas las tareas del usuario
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    // Muestra el formulario para crear una tarea
    public function create()
    {
        return view('tasks.create');
    }

    // Almacena una nueva tarea
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:baja,media,alta',
        ]);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => 'pendiente',
        ]);

        return redirect()->route('dashboard')->with('success', 'Tarea creada correctamente');
    }

    // Muestra detalles de una tarea
    public function show(Task $task)
    {
        // Verificar propiedad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta tarea');
        }

        return view('tasks.show', compact('task'));
    }

    // Formulario para editar una tarea
    public function edit(Task $task)
    {
        // Verificar propiedad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta tarea');
        }

        return view('tasks.edit', compact('task'));
    }

    // Actualizar una tarea
    public function update(Request $request, Task $task)
    {
        // Verificar propiedad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:baja,media,alta',
            'status' => 'required|in:pendiente,en_progreso,completada',
        ]);

        $task->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada correctamente');
    }

    // Eliminar una tarea
    public function destroy(Task $task)
    {
        // Verificar propiedad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea');
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tarea eliminada correctamente');
    }

    // Actualizar solo el estado de una tarea
    public function updateStatus(Request $request, Task $task)
    {
        // Verificar propiedad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea');
        }

        $request->validate([
            'status' => 'required|in:pendiente,en_progreso,completada',
        ]);

        $task->update([
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Estado de la tarea actualizado');
    }
}
```

Este controlador:
- Implementa el patrón CRUD completo para tareas
- Verifica que un usuario solo pueda acceder y modificar sus propias tareas
- Valida todos los datos de entrada
- Utiliza inyección de dependencias de Laravel

#### ContactController.php

Gestiona el envío de mensajes de contacto:

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    // Procesa y envía el mensaje de contacto
    public function sendMessage(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Enviar correo electrónico
        Mail::to('admin@studyhub.com')->send(new ContactMessage($request->all()));

        return back()->with('success', 'Tu mensaje ha sido enviado correctamente.');
    }
}
```

Este controlador:
- Valida los datos del formulario de contacto
- Envía un correo electrónico con los detalles del mensaje

### Migraciones

#### 0001_01_01_000000_create_users_table.php

Define la estructura de la tabla de usuarios:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
```

#### 0001_01_01_000003_create_tasks_table.php

Define la estructura de la tabla de tareas:

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('priority', ['baja', 'media', 'alta'])->default('media');
            $table->enum('status', ['pendiente', 'en_progreso', 'completada'])->default('pendiente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
```

### Rutas

#### web.php

Define todas las rutas de la aplicación:

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;

// Ruta de bienvenida
Route::get('/', function () {
    return view('landing');
});

// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (autenticadas)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Rutas para las tareas
    Route::resource('tasks', TaskController::class);
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.update.status');
});

// Ruta para el formulario de contacto
Route::post('/contact', [ContactController::class, 'sendMessage'])->name('contact.send');
```

En este archivo:
- Se definen rutas públicas accesibles a todos los usuarios
- Se agrupan rutas protegidas dentro del middleware 'auth'
- Se utilizan controladores resource para las tareas (genera automáticamente las 7 rutas CRUD)
- Se definen rutas personalizadas para operaciones específicas

### Vistas

#### dashboard.blade.php

Esta es la vista principal donde los usuarios administran sus tareas:

```html
<!-- Fragmento simplificado para mostrar la estructura -->
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - StudyHub</title>
    <!-- Enlaces a CSS, meta tags, etc. -->
</head>
<body>
    <header>
        <!-- Barra de navegación -->
        <nav>
            <div class="logo">StudyHub</div>
            <div class="user-menu">
                <span>{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </nav>
    </header>

    <main>
        <section class="summary">
            <!-- Resumen de tareas -->
            <div class="task-count">
                <div>Pendientes: {{ $pendingTasks }}</div>
                <div>En progreso: {{ $inProgressTasks }}</div>
                <div>Completadas: {{ $completedTasks }}</div>
            </div>
        </section>

        <section class="task-management">
            <!-- Botón para crear nueva tarea -->
            <a href="{{ route('tasks.create') }}" class="btn-create">Nueva tarea</a>
            
            <!-- Lista de tareas -->
            <div class="task-lists">
                <!-- Tareas pendientes -->
                <div class="task-column">
                    <h2>Pendientes</h2>
                    @foreach ($pendingTasksList as $task)
                        <div class="task-card">
                            <h3>{{ $task->title }}</h3>
                            <p>{{ Str::limit($task->description, 50) }}</p>
                            <div class="task-meta">
                                <span class="priority {{ $task->priority }}">{{ $task->priority }}</span>
                                @if ($task->due_date)
                                    <span class="due-date">{{ $task->due_date->format('d/m/Y') }}</span>
                                @endif
                            </div>
                            <div class="task-actions">
                                <a href="{{ route('tasks.edit', $task) }}">Editar</a>
                                <!-- Botones para cambiar estados -->
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Tareas en progreso y completadas (estructura similar) -->
            </div>
        </section>
    </main>

    <footer>
        <!-- Pie de página -->
    </footer>

    <!-- Scripts JS -->
</body>
</html>
```

#### auth/login.blade.php y auth/register.blade.php

Formularios para inicio de sesión y registro:

```html
<!-- login.blade.php (simplificado) -->
<form method="POST" action="{{ route('login') }}">
    @csrf
    
    <div>
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>

    <div>
        <label for="password">Contraseña</label>
        <input id="password" type="password" name="password" required>
    </div>

    <div>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Recordarme</label>
    </div>

    <button type="submit">Iniciar sesión</button>
</form>
```

### Flujo de la Aplicación

1. **Inicio**: El usuario accede a la página principal (`landing.blade.php`)
2. **Autenticación**: 
   - Si es nuevo, se registra (`register.blade.php`)
   - Si ya tiene cuenta, inicia sesión (`login.blade.php`)
3. **Dashboard**: Después de autenticarse, accede al panel principal (`dashboard.blade.php`)
4. **Gestión de Tareas**:
   - Crea nuevas tareas (`tasks.create.blade.php`)
   - Edita tareas existentes (`tasks.edit.blade.php`)
   - Actualiza el estado de las tareas
   - Elimina tareas
5. **Cierre de Sesión**: El usuario cierra sesión y vuelve a la página principal

### Interacción con la Base de Datos

- Las operaciones CRUD se manejan a través de Eloquent ORM
- Las migraciones definen la estructura de las tablas
- Las relaciones entre tablas se manejan con métodos en los modelos
- La validación de datos se realiza en los controladores

### Seguridad

- Autenticación mediante el sistema nativo de Laravel
- Middleware 'auth' para proteger rutas
- Verificación de propiedad de tareas
- Validación de todas las entradas de usuario
- Protección CSRF en formularios
- Contraseñas hasheadas

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