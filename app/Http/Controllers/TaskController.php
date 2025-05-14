<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Mostrar una lista de todas las tareas del usuario.
     */
    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Mostrar el formulario para crear una nueva tarea.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Almacenar una nueva tarea en la base de datos.
     */
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

    /**
     * Mostrar los detalles de una tarea específica.
     */
    public function show(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para ver esta tarea');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Mostrar el formulario para editar una tarea existente.
     */
    public function edit(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para editar esta tarea');
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Actualizar una tarea específica en la base de datos.
     */
    public function update(Request $request, Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual
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

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'status' => $request->status,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tarea actualizada correctamente');
    }

    /**
     * Eliminar una tarea específica de la base de datos.
     */
    public function destroy(Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual
        if ($task->user_id !== Auth::id()) {
            abort(403, 'No tienes permiso para eliminar esta tarea');
        }

        $task->delete();

        return redirect()->route('dashboard')->with('success', 'Tarea eliminada correctamente');
    }

    /**
     * Cambiar rápidamente el estado de una tarea.
     */
    public function updateStatus(Request $request, Task $task)
    {
        // Verificar que la tarea pertenezca al usuario actual
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
