<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Iniciar Sesión - StudyHub 2.0</title>

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

            /* Fondo animado - mantenido del diseño original */
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

            /* Nuevo diseño para la página de login */
            .login-wrapper {
                display: flex;
                height: 100vh;
                width: 100%;
            }

            .login-side {
                width: 60%;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0 2rem;
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

            .login-box {
                width: 100%;
                max-width: 450px;
                padding: 3rem;
                padding-top: 4.5rem;
                margin-top: 3rem;
                background: rgba(255, 255, 255, 0.03);
                backdrop-filter: blur(10px);
                border-radius: 16px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
                position: relative;
            }

            .login-logo {
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

            .login-heading {
                font-size: 2rem;
                font-weight: 700;
                color: #fff;
                margin-bottom: 2rem;
                text-align: center;
            }

            .form-group {
                margin-bottom: 1.5rem;
            }

            .form-label {
                display: block;
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 0.5rem;
                font-weight: 500;
                font-size: 0.95rem;
            }

            .form-control {
                width: 100%;
                padding: 0.75rem 1rem;
                background: rgba(255, 255, 255, 0.07);
                border: 1px solid rgba(72, 118, 255, 0.2);
                border-radius: 8px;
                color: #fff;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                outline: none;
                border-color: #4876FF;
                box-shadow: 0 0 0 3px rgba(72, 118, 255, 0.3);
                background: rgba(255, 255, 255, 0.1);
                color: #fff;
            }

            .form-control::placeholder {
                color: rgba(255, 255, 255, 0.4);
            }

            .input-group {
                position: relative;
            }

            .input-icon {
                position: absolute;
                left: 1rem;
                top: 50%;
                transform: translateY(-50%);
                color: rgba(72, 118, 255, 0.8);
            }

            .input-icon i {
                width: 20px;
                height: 20px;
            }

            .input-with-icon {
                padding-left: 3rem;
            }

            .extra-options {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.5rem;
            }

            .remember-check {
                display: flex;
                align-items: center;
            }

            .remember-check input {
                margin-right: 0.5rem;
            }

            .remember-check label {
                color: rgba(255, 255, 255, 0.8);
                font-size: 0.9rem;
            }

            .forgot-link {
                color: rgba(72, 118, 255, 0.9);
                font-size: 0.9rem;
                text-decoration: none;
                transition: color 0.2s ease;
            }

            .forgot-link:hover {
                color: #fff;
                text-decoration: underline;
            }

            .login-btn {
                display: block;
                width: 100%;
                padding: 0.85rem;
                background: linear-gradient(to right, #4876FF, #6a93ff);
                color: #fff;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                text-transform: uppercase;
                letter-spacing: 0.5px;
                margin-bottom: 1.5rem;
                text-decoration: none;
            }

            .login-btn:hover {
                background: linear-gradient(to right, #3a67ff, #5a83ff);
                transform: translateY(-2px);
                box-shadow: 0 10px 20px rgba(72, 118, 255, 0.3);
            }

            .divider {
                display: flex;
                align-items: center;
                margin: 1.5rem 0;
                color: rgba(255, 255, 255, 0.5);
                font-size: 0.9rem;
            }

            .divider::before,
            .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: rgba(255, 255, 255, 0.2);
            }

            .divider::before {
                margin-right: 0.5rem;
            }

            .divider::after {
                margin-left: 0.5rem;
            }

            .social-login {
                display: flex;
                justify-content: center;
                gap: 1rem;
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
            }

            .social-btn:hover {
                background: #4876FF;
                transform: translateY(-3px);
            }

            .social-btn i {
                font-size: 1.2rem;
            }

            .signup-link {
                text-align: center;
                color: rgba(255, 255, 255, 0.7);
                font-size: 0.95rem;
            }

            .signup-link a {
                color: #4876FF;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.2s ease;
            }

            .signup-link a:hover {
                color: #fff;
                text-decoration: underline;
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

            /* Media queries */
            @media (max-width: 992px) {
                .login-wrapper {
                    flex-direction: column-reverse;
                    height: auto;
                }

                .login-side, .brand-side {
                    width: 100%;
                    padding: 2rem 1rem;
                }

                .brand-side {
                    display: none;
                }

                .login-box {
                    padding: 2rem;
                    padding-top: 4rem;
                    margin: 4rem 0 2rem;
                }
                
                .login-logo {
                    width: 80px;
                    height: 80px;
                    top: -40px;
                }
            }

            @media (max-width: 768px) {
                .login-box {
                    padding: 1.5rem;
                    padding-top: 3.5rem;
                }

                .login-heading {
                    font-size: 1.5rem;
                    margin-bottom: 1.5rem;
                }
                
                .login-logo {
                    width: 70px;
                    height: 70px;
                    top: -35px;
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

        <div class="login-wrapper">
            <div class="login-side">
                <div class="login-box">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo" class="login-logo">
                    <h1 class="login-heading">Bienvenido a StudyHub</h1>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i data-feather="mail"></i>
                                </span>
                                <input id="email" type="email" class="form-control input-with-icon @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="tu@email.com">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-icon">
                                    <i data-feather="lock"></i>
                                </span>
                                <input id="password" type="password" class="form-control input-with-icon @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="••••••••">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="extra-options">
                            <div class="remember-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div>
                            
                            @if (Route::has('password.request'))
                                <a class="forgot-link" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        
                        <button type="submit" class="login-btn">
                            Iniciar Sesión
                        </button>
                        
                        <div class="divider">O continua con</div>
                        
                        <div class="social-login">
                            <a href="#" class="social-btn">
                                <i class="bi bi-google"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="#" class="social-btn">
                                <i class="bi bi-github"></i>
                            </a>
                        </div>
                        
                        <div class="signup-link">
                            ¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate ahora</a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="brand-side">
                <div class="brand-content">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo" class="brand-logo">
                    <h2 class="brand-title">StudyHub 2.0</h2>
                    <p class="brand-subtitle">La plataforma de aprendizaje colaborativo que maximiza tu potencial de estudio con herramientas inteligentes.</p>
                    
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Colaboración en tiempo real
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Inteligencia artificial integrada
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Recursos de aprendizaje personalizados
                    </div>
                    <div class="brand-feature">
                        <i class="bi bi-check-circle-fill"></i> Estadísticas de progreso detalladas
                    </div>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Feather Icons -->
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            feather.replace();
        </script>
    </body>
</html>
