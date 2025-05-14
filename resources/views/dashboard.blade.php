<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard - StudyHub 2.0</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <style>
            /* Estilos generales */
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: 'Figtree', 'Segoe UI', sans-serif;
            }

            body {
                background-color: #f5f7fb;
                color: #333;
            }

            /* Sidebar */
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                bottom: 0;
                width: 250px;
                background-color: #0a1128;
                color: #fff;
                overflow-y: auto;
                transition: all 0.3s ease;
                z-index: 1000;
            }

            .sidebar-header {
                padding: 1.5rem;
                display: flex;
                align-items: center;
                justify-content: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }

            .sidebar-logo {
                display: flex;
                align-items: center;
            }

            .sidebar-logo img {
                width: 40px;
                height: 40px;
                margin-right: 10px;
            }

            .sidebar-logo h1 {
                font-size: 1.5rem;
                font-weight: 700;
                margin: 0;
                color: #fff;
            }

            .sidebar-menu {
                padding: 1.5rem 0;
            }

            .menu-item {
                padding: 0.75rem 1.5rem;
                display: flex;
                align-items: center;
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .menu-item:hover, .menu-item.active {
                background-color: rgba(72, 118, 255, 0.1);
                color: #fff;
            }

            .menu-item i {
                margin-right: 10px;
                font-size: 1.1rem;
            }

            .menu-text {
                font-size: 0.95rem;
                font-weight: 500;
            }

            /* Main content */
            .main-content {
                margin-left: 250px;
                padding: 2rem;
                min-height: 100vh;
                transition: all 0.3s ease;
            }

            /* Header top */
            .header-top {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 2rem;
                padding-bottom: 1rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            .page-title h1 {
                font-size: 1.8rem;
                font-weight: 700;
                color: #0a1128;
                margin: 0;
            }

            .user-profile {
                display: flex;
                align-items: center;
            }

            .profile-info {
                margin-right: 1rem;
                text-align: right;
            }

            .profile-name {
                font-size: 1rem;
                font-weight: 600;
                color: #0a1128;
                margin: 0;
            }

            .profile-role {
                font-size: 0.8rem;
                color: #666;
                margin: 0;
            }

            .profile-avatar {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background-color: #4876FF;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
            }

            /* Dashboard content */
            .dashboard-content {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.5rem;
            }

            .dashboard-card {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
                padding: 1.5rem;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }

            .card-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1rem;
            }

            .card-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: #0a1128;
                margin: 0;
            }

            .card-icon {
                width: 40px;
                height: 40px;
                border-radius: 8px;
                background-color: #4876FF;
                color: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.2rem;
            }

            .card-content {
                margin-bottom: 1rem;
            }

            .card-value {
                font-size: 2rem;
                font-weight: 700;
                color: #0a1128;
                margin: 0 0 0.5rem 0;
            }

            .card-description {
                font-size: 0.9rem;
                color: #666;
                margin: 0;
            }

            .card-footer {
                margin-top: 1rem;
                display: flex;
                justify-content: flex-end;
            }

            .card-btn {
                padding: 0.5rem 1rem;
                background-color: transparent;
                color: #4876FF;
                border: 1px solid #4876FF;
                border-radius: 5px;
                font-size: 0.85rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .card-btn:hover {
                background-color: #4876FF;
                color: #fff;
            }

            /* Estilos para la sección de tareas */
            .tasks-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                padding-bottom: 1rem;
            }

            .tasks-header h2 {
                font-size: 1.5rem;
                font-weight: 700;
                color: #0a1128;
                margin: 0;
            }

            .tasks-container {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
                overflow: hidden;
            }

            .nav-tabs {
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
                background-color: #f8f9fa;
                padding: 0.5rem 1rem 0;
            }

            .nav-tabs .nav-link {
                margin-bottom: -1px;
                color: #495057;
                border: none;
                border-top-left-radius: 8px;
                border-top-right-radius: 8px;
                padding: 0.75rem 1.5rem;
                font-weight: 500;
            }

            .nav-tabs .nav-link.active {
                color: #4876FF;
                background-color: #fff;
                border-color: #dee2e6 #dee2e6 #fff;
                border-top: 2px solid #4876FF;
            }

            .tab-content {
                padding: 1.5rem;
            }

            .task-item {
                display: flex;
                justify-content: space-between;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                padding: 1.25rem 0;
            }

            .task-item:first-child {
                padding-top: 0;
            }

            .task-item:last-child {
                border-bottom: none;
                padding-bottom: 0;
            }

            .task-info {
                flex: 1;
            }

            .task-title {
                font-size: 1.1rem;
                font-weight: 600;
                color: #333;
                margin: 0 0 0.5rem 0;
            }

            .task-description {
                font-size: 0.9rem;
                color: #666;
                margin-bottom: 0.75rem;
            }

            .task-meta {
                display: flex;
                align-items: center;
                gap: 1rem;
                font-size: 0.85rem;
            }

            .task-date {
                color: #777;
            }

            .task-date i {
                margin-right: 3px;
            }

            .task-completed-date {
                color: #28a745;
                font-style: italic;
            }

            .task-actions {
                display: flex;
                align-items: center;
                gap: 0.5rem;
            }

            .empty-state {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 3rem 0;
                color: #aaa;
                text-align: center;
            }

            .empty-state i {
                font-size: 3rem;
                margin-bottom: 1rem;
            }

            .empty-state p {
                font-size: 1.1rem;
                margin: 0;
            }

            /* Estilos para las prioridades */
            .badge {
                font-weight: 500;
                font-size: 0.8rem;
                padding: 0.35em 0.65em;
            }

            /* Tareas completadas */
            .task-item.completed .task-title,
            .task-item.completed .task-description {
                color: #777;
            }
        </style>
    </head>
    <body>
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo">
                    <h1>StudyHub</h1>
                </div>
            </div>
            <div class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item active">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-book-fill"></i>
                    <span class="menu-text">Cursos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-calendar-week-fill"></i>
                    <span class="menu-text">Horario</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    <span class="menu-text">Tareas</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-people-fill"></i>
                    <span class="menu-text">Grupos</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span class="menu-text">Mensajes</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="bi bi-gear-fill"></i>
                    <span class="menu-text">Configuración</span>
                </a>
                <a href="{{ route('logout') }}" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>
                    <span class="menu-text">Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header-top">
                <div class="page-title">
                    <h1>Dashboard</h1>
                </div>
                <div class="user-profile">
                    <div class="profile-info">
                        <h4 class="profile-name">{{ Auth::user()->name }}</h4>
                        <p class="profile-role">Estudiante</p>
                    </div>
                    <div class="profile-avatar">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Cursos Activos</h2>
                        <div class="card-icon">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-value">5</h3>
                        <p class="card-description">Cursos en los que estás inscrito</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-btn">Ver Cursos</a>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Tareas Pendientes</h2>
                        <div class="card-icon">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-value">{{ Auth::user()->tasks()->where('status', 'pendiente')->count() }}</h3>
                        <p class="card-description">Tareas por completar</p>
                    </div>
                    <div class="card-footer">
                        <button type="button" class="card-btn" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                            Agregar Tarea
                        </button>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Próximas Clases</h2>
                        <div class="card-icon">
                            <i class="bi bi-calendar-event"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-value">3</h3>
                        <p class="card-description">Clases programadas para hoy</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-btn">Ver Horario</a>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-header">
                        <h2 class="card-title">Mensajes Nuevos</h2>
                        <div class="card-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <h3 class="card-value">12</h3>
                        <p class="card-description">Mensajes sin leer</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="card-btn">Ver Mensajes</a>
                    </div>
                </div>
            </div>

            <!-- Sección de Tareas -->
            <div class="mt-5">
                <div class="tasks-header">
                    <h2>Mis Tareas</h2>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTaskModal">
                        <i class="bi bi-plus-lg"></i> Nueva Tarea
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="tasks-container">
                    <ul class="nav nav-tabs" id="tasksTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">Pendientes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="inprogress-tab" data-bs-toggle="tab" data-bs-target="#inprogress" type="button" role="tab" aria-controls="inprogress" aria-selected="false">En Progreso</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">Completadas</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="tasksTabsContent">
                        <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                            @if(Auth::user()->tasks()->where('status', 'pendiente')->count() > 0)
                                @foreach(Auth::user()->tasks()->where('status', 'pendiente')->orderBy('due_date')->get() as $task)
                                    <div class="task-item">
                                        <div class="task-info">
                                            <h3 class="task-title">{{ $task->title }}</h3>
                                            <p class="task-description">{{ $task->description }}</p>
                                            <div class="task-meta">
                                                @if($task->due_date)
                                                    <span class="task-date"><i class="bi bi-calendar"></i> {{ $task->due_date->format('d/m/Y') }}</span>
                                                @endif
                                                <span class="badge {{ $task->priority == 'alta' ? 'bg-danger' : ($task->priority == 'media' ? 'bg-warning' : 'bg-info') }}">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="task-actions">
                                            <form action="{{ route('tasks.update.status', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="en_progreso">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-play-fill"></i> Iniciar
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal para editar tarea -->
                                    <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">Editar Tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Título</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="due_date" class="form-label">Fecha de entrega</label>
                                                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="priority" class="form-label">Prioridad</label>
                                                            <select class="form-select" id="priority" name="priority" required>
                                                                <option value="baja" {{ $task->priority == 'baja' ? 'selected' : '' }}>Baja</option>
                                                                <option value="media" {{ $task->priority == 'media' ? 'selected' : '' }}>Media</option>
                                                                <option value="alta" {{ $task->priority == 'alta' ? 'selected' : '' }}>Alta</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Estado</label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="pendiente" {{ $task->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                <option value="en_progreso" {{ $task->status == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                                                                <option value="completada" {{ $task->status == 'completada' ? 'selected' : '' }}>Completada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-clipboard"></i>
                                    <p>No tienes tareas pendientes</p>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="inprogress" role="tabpanel" aria-labelledby="inprogress-tab">
                            @if(Auth::user()->tasks()->where('status', 'en_progreso')->count() > 0)
                                @foreach(Auth::user()->tasks()->where('status', 'en_progreso')->orderBy('due_date')->get() as $task)
                                    <div class="task-item">
                                        <div class="task-info">
                                            <h3 class="task-title">{{ $task->title }}</h3>
                                            <p class="task-description">{{ $task->description }}</p>
                                            <div class="task-meta">
                                                @if($task->due_date)
                                                    <span class="task-date"><i class="bi bi-calendar"></i> {{ $task->due_date->format('d/m/Y') }}</span>
                                                @endif
                                                <span class="badge {{ $task->priority == 'alta' ? 'bg-danger' : ($task->priority == 'media' ? 'bg-warning' : 'bg-info') }}">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="task-actions">
                                            <form action="{{ route('tasks.update.status', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="completada">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="bi bi-check-lg"></i> Completar
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal{{ $task->id }}">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Modal para editar tarea (igual que en la pestaña de pendientes) -->
                                    <div class="modal fade" id="editTaskModal{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel{{ $task->id }}" aria-hidden="true">
                                        <!-- El mismo contenido que el modal de edición anterior -->
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editTaskModalLabel{{ $task->id }}">Editar Tarea</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="title" class="form-label">Título</label>
                                                            <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Descripción</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="due_date" class="form-label">Fecha de entrega</label>
                                                            <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date ? $task->due_date->format('Y-m-d') : '' }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="priority" class="form-label">Prioridad</label>
                                                            <select class="form-select" id="priority" name="priority" required>
                                                                <option value="baja" {{ $task->priority == 'baja' ? 'selected' : '' }}>Baja</option>
                                                                <option value="media" {{ $task->priority == 'media' ? 'selected' : '' }}>Media</option>
                                                                <option value="alta" {{ $task->priority == 'alta' ? 'selected' : '' }}>Alta</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="status" class="form-label">Estado</label>
                                                            <select class="form-select" id="status" name="status" required>
                                                                <option value="pendiente" {{ $task->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                                <option value="en_progreso" {{ $task->status == 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                                                                <option value="completada" {{ $task->status == 'completada' ? 'selected' : '' }}>Completada</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-hourglass-split"></i>
                                    <p>No tienes tareas en progreso</p>
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                            @if(Auth::user()->tasks()->where('status', 'completada')->count() > 0)
                                @foreach(Auth::user()->tasks()->where('status', 'completada')->orderBy('updated_at', 'desc')->get() as $task)
                                    <div class="task-item completed">
                                        <div class="task-info">
                                            <h3 class="task-title">{{ $task->title }}</h3>
                                            <p class="task-description">{{ $task->description }}</p>
                                            <div class="task-meta">
                                                @if($task->due_date)
                                                    <span class="task-date"><i class="bi bi-calendar"></i> {{ $task->due_date->format('d/m/Y') }}</span>
                                                @endif
                                                <span class="badge {{ $task->priority == 'alta' ? 'bg-danger' : ($task->priority == 'media' ? 'bg-warning' : 'bg-info') }}">
                                                    {{ ucfirst($task->priority) }}
                                                </span>
                                                <span class="task-completed-date">
                                                    <i class="bi bi-check-circle"></i> Completada el {{ $task->updated_at->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="task-actions">
                                            <form action="{{ route('tasks.update.status', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="status" value="pendiente">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-arrow-repeat"></i> Reabrir
                                                </button>
                                            </form>
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta tarea?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="empty-state">
                                    <i class="bi bi-check-circle"></i>
                                    <p>No tienes tareas completadas</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para crear nueva tarea -->
            <div class="modal fade" id="newTaskModal" tabindex="-1" aria-labelledby="newTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newTaskModalLabel">Nueva Tarea</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descripción</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="due_date" class="form-label">Fecha de entrega</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date">
                                </div>
                                <div class="mb-3">
                                    <label for="priority" class="form-label">Prioridad</label>
                                    <select class="form-select" id="priority" name="priority" required>
                                        <option value="baja">Baja</option>
                                        <option value="media" selected>Media</option>
                                        <option value="alta">Alta</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html> 