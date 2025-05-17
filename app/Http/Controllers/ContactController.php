<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormAdmin;
use App\Mail\ContactFormConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

/**
 * Controlador que maneja las funcionalidades relacionadas con el formulario de contacto
 */
class ContactController extends Controller
{
    /**
     * Procesa el envío de mensajes desde el formulario de contacto
     * 
     * @param Request $request La solicitud HTTP que contiene los datos del formulario
     * @return \Illuminate\Http\JsonResponse Respuesta JSON con el resultado de la operación
     */
    public function sendMessage(Request $request)
    {
        // Valida los datos recibidos del formulario según las reglas establecidas
        $validated = $request->validate([
            'name' => 'required|string|max:255', // El nombre es obligatorio, debe ser texto y no exceder 255 caracteres
            'email' => 'required|email|max:255', // El email es obligatorio, debe tener formato de email válido y no exceder 255 caracteres
            'message' => 'required|string', // El mensaje es obligatorio y debe ser texto
        ]);
        
        // Envía un correo de confirmación al usuario que completó el formulario
        Mail::to($request->email)->send(new ContactFormConfirmation($validated));
        
        // Envía un correo de notificación al administrador del sitio
        // Utiliza la dirección configurada en el archivo de configuración o usa un valor predeterminado
        Mail::to(config('mail.admin_address', 'admin@studyhub.com'))->send(new ContactFormAdmin($validated));
        
        // Devuelve una respuesta JSON indicando que el mensaje se envió exitosamente
        return response()->json(['success' => true, 'message' => 'Mensaje enviado con éxito. Revisa tu correo para confirmación.']);
    }
} 