<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registrarse - StudyHub 2.0</title>

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
                background-color: #f9f9f9;
                color: #333;
                overflow-x: hidden;
                height: 100vh;
            }

            /* Fondo animado */
            .background {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                background-color: #0a1128;
                overflow: hidden;
            }

            .grid {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: 
                    linear-gradient(rgba(18, 52, 143, 0.1) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(18, 52, 143, 0.1) 1px, transparent 1px);
                background-size: 40px 40px;
            }

            .lines {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }

            .line {
                position: absolute;
                height: 2px;
                width: 100%;
                background: linear-gradient(90deg, transparent, rgba(72, 118, 255, 0.8), transparent);
                animation: flow 8s linear infinite;
                opacity: 0.3;
            }

            .line:nth-child(1) {
                top: 15%;
                animation-delay: 0s;
            }

            .line:nth-child(2) {
                top: 35%;
                animation-delay: 2s;
            }

            .line:nth-child(3) {
                top: 55%;
                animation-delay: 4s;
            }

            .line:nth-child(4) {
                top: 75%;
                animation-delay: 6s;
            }

            @keyframes flow {
                0% {
                    transform: translateX(-100%);
                }
                100% {
                    transform: translateX(100%);
                }
            }

            /* Diseño de la página de registro */
            .register-wrapper {
                min-height: 100vh;
                display: flex;
                height: auto;
                width: 100%;
                overflow: hidden;
            }

            .register-side {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 1rem;
                width: 60%;
                min-height: 100vh;
            }

            .brand-side {
                width: 40%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                background: rgba(72, 118, 255, 0.05);
                backdrop-filter: blur(5px);
                border-left: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: -5px 0 30px rgba(0, 0, 0, 0.2);
            }

            .register-box {
                width: 100%;
                max-width: 600px;
                padding: 2.5rem;
                padding-top: 4rem;
                margin-top: 3rem;
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(10px);
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                position: relative;
            }

            .register-logo {
                display: block;
                width: 90px;
                height: 90px;
                position: absolute;
                top: -45px;
                left: 50%;
                transform: translateX(-50%);
                margin: 0;
                z-index: 2;
                background: rgba(10, 17, 40, 0.6);
                padding: 8px;
                border-radius: 50%;
                border: 1px solid rgba(72, 118, 255, 0.3);
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            }

            .register-heading {
                font-size: 1.7rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 1.5rem;
                text-align: center;
            }

            .row {
                margin-left: -0.5rem;
                margin-right: -0.5rem;
            }

            .row .col-md-6 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .form-group {
                margin-bottom: 1.2rem;
            }

            .form-label {
                display: block;
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 0.3rem;
                font-weight: 500;
                font-size: 0.9rem;
            }

            .input-group {
                position: relative;
                display: flex;
                flex-wrap: wrap;
                align-items: stretch;
                width: 100%;
            }

            .input-icon {
                position: absolute;
                top: 0.75rem;
                left: 1rem;
                z-index: 10;
                color: rgba(72, 118, 255, 0.8);
                pointer-events: none;
            }

            .form-control {
                width: 100%;
                padding: 0.7rem 1rem 0.7rem 2.8rem;
                background: rgba(255, 255, 255, 0.07);
                border: 1px solid rgba(72, 118, 255, 0.2);
                border-radius: 8px;
                color: #fff;
                font-size: 0.95rem;
                line-height: 1.5;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #4876FF;
                box-shadow: 0 0 0 3px rgba(72, 118, 255, 0.3);
                background: rgba(255, 255, 255, 0.1);
            }

            .form-control.is-invalid {
                border-color: #ff4a6b;
                background-image: none;
            }

            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.4);
            }

            .toggle-password {
                position: absolute;
                right: 1rem;
                top: 0.75rem;
                color: rgba(255, 255, 255, 0.5);
                cursor: pointer;
                z-index: 10;
                transition: all 0.3s ease;
            }

            .toggle-password:hover {
                color: #fff;
            }

            .form-check {
                display: flex;
                align-items: flex-start;
                margin-top: 0.5rem;
                margin-bottom: 1.2rem;
                padding-left: 1.5rem;
            }

            .form-check-input {
                margin-right: 0.5rem;
                margin-top: 0.2rem;
                width: 1rem;
                height: 1rem;
                background-color: rgba(255, 255, 255, 0.1);
                border: 1px solid rgba(72, 118, 255, 0.3);
                border-radius: 0.2rem;
            }

            .form-check-input:checked {
                background-color: #4876FF;
                border-color: #4876FF;
            }

            .form-check-label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.85rem;
                line-height: 1.4;
            }

            .form-check-label a {
                color: #4876FF;
                text-decoration: none;
                font-weight: 500;
                transition: color 0.2s ease;
            }

            .form-check-label a:hover {
                color: #fff;
                text-decoration: underline;
            }

            .register-btn {
                display: block;
                width: 100%;
                margin-top: 0.75rem;
                margin-bottom: 1.2rem;
                padding: 0.8rem;
                background: linear-gradient(to right, #4876FF, #6a93ff);
                color: #fff;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 0.95rem;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .register-btn:hover {
                background: linear-gradient(to right, #3a67ff, #5a83ff);
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(72, 118, 255, 0.3);
            }

            .divider {
                display: flex;
                align-items: center;
                margin: 1.5rem 0;
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.85rem;
            }

            .divider::before,
            .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(255, 255, 255, 0.2);
            }

            .divider::before {
                margin-right: 0.8rem;
            }

            .divider::after {
                margin-left: 0.8rem;
            }

            .social-login {
                display: flex;
                justify-content: center;
                gap: 1.2rem;
                margin-bottom: 1.5rem;
            }

            .social-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 40px;
                height: 40px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
                transition: all 0.3s ease;
                text-decoration: none;
            }

            .social-btn:hover {
                background: #4876FF;
                transform: translateY(-3px);
                box-shadow: 0 6px 15px rgba(72, 118, 255, 0.25);
            }

            .login-link {
                text-align: center;
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.9rem;
                margin-top: 0.5rem;
            }

            .login-link a {
                color: #4876FF;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .login-link a:hover {
                color: #fff;
                text-decoration: underline;
            }

            .home-link {
                text-align: center;
                margin-top: 0.5rem;
            }

            .home-link a {
                color: rgba(255, 255, 255, 0.6);
                text-decoration: none;
                font-size: 0.85rem;
                transition: color 0.2s ease;
                display: inline-flex;
                align-items: center;
            }

            .home-link a i {
                margin-right: 0.3rem;
            }

            .home-link a:hover {
                color: #4876FF;
            }

            .brand-content {
                text-align: center;
                padding: 2rem;
            }

            .brand-logo {
                width: 150px;
                height: auto;
                margin-bottom: 2rem;
            }

            .brand-title {
                font-size: 2.2rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 1rem;
            }

            .brand-subtitle {
                font-size: 1.1rem;
                color: rgba(255, 255, 255, 0.7);
                margin-bottom: 2rem;
                line-height: 1.6;
            }

            .brand-feature {
                display: flex;
                align-items: center;
                margin-bottom: 1rem;
                color: rgba(255, 255, 255, 0.8);
                font-weight: 500;
            }

            .brand-feature i {
                color: #4876FF;
                margin-right: 0.75rem;
            }

            .invalid-feedback {
                display: block;
                width: 100%;
                color: #ff4a6b;
                font-size: 0.8rem;
                margin-top: 0.25rem;
            }

            /* Media queries */
            @media (max-width: 992px) {
                .register-wrapper {
                    flex-direction: column-reverse;
                    height: auto;
                    padding: 0;
                }

                .register-side, .brand-side {
                    width: 100%;
                    padding: 1.5rem 1rem;
                }

                .brand-side {
                    display: none;
                }

                .register-box {
                    padding: 2rem 1.5rem;
                    padding-top: 3.5rem;
                    margin: 3.5rem 0 1.5rem;
                }
                
                .register-logo {
                    width: 80px;
                    height: 80px;
                    top: -40px;
                }
            }

            @media (max-width: 768px) {
                .register-box {
                    padding: 1.5rem 1.25rem;
                    padding-top: 3rem;
                    margin-top: 3rem;
                }

                .register-heading {
                    font-size: 1.5rem;
                    margin-bottom: 1.25rem;
                }
                
                .register-logo {
                    width: 70px;
                    height: 70px;
                    top: -35px;
                }

                .register-btn {
                    padding: 0.7rem;
                    font-size: 0.9rem;
                }
            }

            @media (max-width: 576px) {
                .register-box {
                    padding: 1.25rem 1rem;
                    padding-top: 2.75rem;
                }
                
                .register-logo {
                    width: 60px;
                    height: 60px;
                    top: -30px;
                    padding: 5px;
                }
                
                .form-group {
                    margin-bottom: 0.9rem;
                }
            }
        </style>
    </head>
    <body>
        <div class="background">
            <div class="grid"></div>
            <div class="lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>

        <div class="register-wrapper">
            <div class="register-side">
                <div class="register-box">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo" class="register-logo">
                    <h1 class="register-heading">Crear Cuenta</h1>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="form-label">Nombre Completo</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password" class="form-label">Contraseña</label>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="primary-btn register-btn">
                                Registrarse
                            </button>
                        </div>

                        <div class="login-link">
                            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="brand-side">
                <div class="brand-content">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo" class="brand-logo">
                    <h2 class="brand-title">StudyHub 2.0</h2>
                    <p class="brand-subtitle">Únete a nuestra comunidad de estudiantes y descubre una nueva forma de aprender de manera colaborativa.</p>
                    
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Acceso a todos los recursos de estudio
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Grupos de estudio personalizados
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Asistente de IA para resolver dudas
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Seguimiento de tu progreso académico
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function togglePasswordVisibility(inputId) {
                const passwordInput = document.getElementById(inputId);
                const icon = event.currentTarget.querySelector('i');
                
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            }
        </script>
    </body>
</html>
