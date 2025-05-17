<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador que gestiona todas las operaciones CRUD relacionadas con las tareas del usuario
 */
class TaskController extends Controller
{
    /**
     * Mostrar una lista de todas las tareas del usuario.
     * 
     * @return \Illuminate\View\View Vista con el listado de tareas
     */
    public function index()
    {
        // Obtiene todas las tareas del usuario autenticado, ordenadas por fecha de creación descendente
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        
        // Retorna la vista con las tareas obtenidas
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Mostrar el formulario para crear una nueva tarea.
     * 
     * @return \Illuminate\View\View Vista con el formulario de creación
     */
    public function create()
    {
        // Retorna la vista del formulario para crear una nueva tarea
        return view('tasks.create');
    }

    /**
     * Almacenar una nueva tarea en la base de datos.
     * 
     * @param Request $request Contiene los datos del formulario
     * @return \Illuminate\Http\RedirectResponse Redirección al dashboard con mensaje de éxito
     */
    public function store(Request $request)
    {
        // Valida los datos recibidos según las reglas establecidas
        $request->validate([
            'title' => 'required|string|max:255', // El título es obligatorio y no puede exceder 255 caracteres
            'description' => 'nullable|string', // La descripción es opcional
            'due_date' => 'nullable|date', // La fecha de vencimiento es opcional y debe ser una fecha válida
            'priority' => 'required|in:baja,media,alta', // La prioridad es obligatoria y solo puede ser uno de los valores especificados
        ]);

        // Crea una nueva tarea asociada al usuario autenticado
        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => 'pendiente', // Estado inicial para todas las tareas nuevas
        ]);

        // Redirecciona al dashboard con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Tarea creada correctamente');
    }

    /**
     * Mostrar los detalles de una tarea específica.
     * 
     * @param Task $task La tarea a mostrar (inyección de modelo de ruta)
     * @return \Illuminate\View\View Vista con los detalles de la tarea
     */
    public function show(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual por seguridad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta tarea'); // Lanza un error 403 Forbidden si no es propietario
        }

        // Retorna la vista con los detalles de la tarea
        return view('tasks.show', compact('task'));
    }

    /**
     * Mostrar el formulario para editar una tarea existente.
     * 
     * @param Task $task La tarea a editar (inyección de modelo de ruta)
     * @return \Illuminate\View\View Vista con el formulario de edición
     */
    public function edit(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual por seguridad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta tarea'); // Lanza un error 403 Forbidden si no es propietario
        }

        // Retorna la vista del formulario de edición con los datos de la tarea
        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualizar una tarea específica en la base de datos.
     * 
     * @param Request $request Contiene los datos actualizados
     * @param Task $task La tarea a actualizar (inyección de modelo de ruta)
     * @return \Illuminate\Http\RedirectResponse Redirección al dashboard con mensaje de éxito
     */
    public function update(Request $request, Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual por seguridad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea'); // Lanza un error 403 Forbidden si no es propietario
        }

        // Valida los datos recibidos según las reglas establecidas
        $request->validate([
            'title' => 'required|string|max:255', // El título es obligatorio y no puede exceder 255 caracteres
            'description' => 'nullable|string', // La descripción es opcional
            'due_date' => 'nullable|date', // La fecha de vencimiento es opcional y debe ser una fecha válida
            'priority' => 'required|in:baja,media,alta', // La prioridad solo puede ser uno de los valores especificados
            'status' => 'required|in:pendiente,en_progreso,completada', // El estado solo puede ser uno de los valores especificados
        ]);

        // Actualiza los campos de la tarea con los nuevos valores
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        // Redirecciona al dashboard con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Eliminar una tarea específica de la base de datos.
     * 
     * @param Task $task La tarea a eliminar (inyección de modelo de ruta)
     * @return \Illuminate\Http\RedirectResponse Redirección al dashboard con mensaje de éxito
     */
    public function destroy(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual por seguridad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea'); // Lanza un error 403 Forbidden si no es propietario
        }

        // Elimina la tarea de la base de datos
        $task->delete();

        // Redirecciona al dashboard con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Tarea eliminada correctamente');
    }

    /**
     * Cambiar rápidamente el estado de una tarea.
     * 
     * @param Request $request Contiene el nuevo estado
     * @param Task $task La tarea a actualizar (inyección de modelo de ruta)
     * @return \Illuminate\Http\RedirectResponse Redirección al dashboard con mensaje de éxito
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual por seguridad
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para actualizar esta tarea'); // Lanza un error 403 Forbidden si no es propietario
        }

        // Valida que el estado proporcionado sea válido
        $request->validate([
            'status' => 'required|in:pendiente,en_progreso,completada', // El estado solo puede ser uno de los valores especificados
        ]);

        // Actualiza solo el campo de estado de la tarea
        $task->update([
            'status' => $request->status,
        ]);

        // Redirecciona al dashboard con mensaje de éxito
        return redirect()->route('dashboard')->with('success', 'Estado de la tarea actualizado');
    }
}
