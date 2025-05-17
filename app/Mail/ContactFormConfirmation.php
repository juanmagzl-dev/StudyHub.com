<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Clase para enviar correos de confirmación al usuario cuando 
 * envía un mensaje desde el formulario de contacto
 */
class ContactFormConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     * Constructor que inicializa la clase con los datos del formulario
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     * Define el sobre del mensaje (asunto, remitente, destinatarios)
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de contacto - StudyHub',
        );
    }

    /**
     * Get the message content definition.
     * Define qué vista se usará para generar el contenido HTML del correo
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     * Define los archivos adjuntos del correo (si los hay)
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 