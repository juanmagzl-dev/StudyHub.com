<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Confirmación de contacto - StudyHub</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        .container {
            background-color: #f9f9f9;
            border-radius: 5px;
            padding: 20px;
            border: 1px solid #eee;
        }
        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        h1 {
            color: #4a6ee0;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="StudyHub Logo">
    </div>
    
    <div class="container">
        <h1>¡Gracias por contactarnos!</h1>
        
        <p>Hola <strong>{{ $data['name'] }}</strong>,</p>
        
        <p>Hemos recibido tu mensaje y te responderemos lo antes posible. A continuación tienes un resumen de la información que nos has enviado:</p>
        
        <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        <p><strong>Mensaje:</strong> {{ $data['message'] }}</p>
        
        <p>Si tienes alguna otra pregunta, no dudes en contactarnos nuevamente.</p>
        
        <p>Saludos cordiales,<br>
        El equipo de StudyHub</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} StudyHub. Todos los derechos reservados.</p>
    </div>
</body>
</html> 