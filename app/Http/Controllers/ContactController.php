<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormAdmin;
use App\Mail\ContactFormConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMessage(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);
        
        // Send confirmation email to the user
        Mail::to($request->email)->send(new ContactFormConfirmation($validated));
        
        // Send notification to admin
        Mail::to(config('mail.admin_address', 'admin@studyhub.com'))->send(new ContactFormAdmin($validated));
        
        return response()->json(['success' => true, 'message' => 'Mensaje enviado con éxito. Revisa tu correo para confirmación.']);
    }
} 