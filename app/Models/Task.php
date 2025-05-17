<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Task (Tarea) que representa una tarea en el sistema
 * 
 * Esta clase define la estructura y relaciones de las tareas en la base de datos,
 * cada tarea pertenece a un usuario y tiene varios atributos como título, descripción,
 * fecha de vencimiento, prioridad y estado.
 */
class Task extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables masivamente.
     * Define qué campos pueden ser llenados a través de asignación masiva (create, fill, update)
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',     // ID del usuario al que pertenece la tarea
        'title',       // Título de la tarea
        'description', // Descripción detallada de la tarea (opcional)
        'due_date',    // Fecha de vencimiento de la tarea (opcional)
        'priority',    // Prioridad de la tarea (baja, media, alta)
        'status',      // Estado de la tarea (pendiente, en_progreso, completada)
    ];

    /**
     * Los atributos que deben convertirse a tipos específicos.
     * Define qué campos deben ser convertidos a tipos específicos al recuperarse de la base de datos
     *
     * @var array<string, string>
     */
    protected $casts = [
        'due_date' => 'date', // Convierte el campo due_date a un objeto Carbon para manipulación de fechas
    ];

    /**
     * Obtener el usuario al que pertenece la tarea.
     * Define la relación inversa con el modelo User
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class); // Una tarea pertenece a un único usuario
    }
}
