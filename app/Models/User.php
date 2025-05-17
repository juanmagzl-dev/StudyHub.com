<?php

namespace App\Models; // Define el espacio de nombres para este modelo

// Importación de las clases necesarias
// use Illuminate\Contracts\Auth\MustVerifyEmail; // Interfaz para verificación de email (comentada, no se usa actualmente)
use Illuminate\Database\Eloquent\Factories\HasFactory; // Trait para crear instancias del modelo en pruebas
use Illuminate\Foundation\Auth\User as Authenticatable; // Clase base para usuarios con autenticación
use Illuminate\Notifications\Notifiable; // Trait para enviar notificaciones al usuario

/**
 * Modelo User (Usuario) que representa un usuario del sistema
 * 
 * Esta clase define la estructura y relaciones de los usuarios en la base de datos.
 * Extiende de Authenticatable para proporcionar toda la funcionalidad de autenticación
 * integrada en Laravel.
 */
class User extends Authenticatable
{
    /** 
     * @use HasFactory<\Database\Factories\UserFactory> 
     * Utiliza el trait HasFactory para facilitar la creación de instancias en pruebas
     */
    use HasFactory, Notifiable; // Notifiable permite enviar notificaciones al usuario

    /**
     * The attributes that are mass assignable.
     * Define qué campos pueden ser llenados a través de asignación masiva (create, fill, update)
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',     // Nombre del usuario
        'email',    // Correo electrónico (único para cada usuario)
        'password', // Contraseña (se almacena hasheada)
    ];

    /**
     * The attributes that should be hidden for serialization.
     * Define qué campos no deben incluirse cuando el modelo es convertido a array o JSON
     * por seguridad
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',      // Oculta la contraseña en las respuestas JSON/arrays
        'remember_token', // Oculta el token "recordarme" en las respuestas JSON/arrays
    ];

    /**
     * Get the attributes that should be cast.
     * Define qué campos deben ser convertidos a tipos específicos al recuperarse de la base de datos
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Convierte la fecha de verificación de email a objeto Carbon
            'password' => 'hashed',            // Indica que la contraseña está hasheada
        ];
    }

    /**
     * Obtener las tareas del usuario.
     * Define la relación con el modelo Task
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class); // Un usuario puede tener muchas tareas
    }
}
