<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nuevo mensaje de contacto - StudyHub</title>
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
        .message-box {
            background-color: #fff;
            border-left: 4px solid #4a6ee0;
            padding: 15px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="{{ asset('logo.png') }}" alt="StudyHub Logo">
    </div>
    
    <div class="container">
        <h1>Nuevo mensaje de contacto</h1>
        
        <p>Se ha recibido un nuevo mensaje de contacto a través del formulario de la página web.</p>
        
        <p><strong>Detalles del contacto:</strong></p>
        
        <p><strong>Nombre:</strong> {{ $data['name'] }}</p>
        <p><strong>Email:</strong> {{ $data['email'] }}</p>
        
        <div class="message-box">
            <p><strong>Mensaje:</strong></p>
            <p>{{ $data['message'] }}</p>
        </div>
        
        <p>Por favor, responde a este cliente lo antes posible.</p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} StudyHub. Todos los derechos reservados.</p>
    </div>
</body>
</html> 