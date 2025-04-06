<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>StudyHub 2.0 - Tu plataforma de estudio</title>

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('logo.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link href="{{ asset('css/landing.css') }}" rel="stylesheet">
        <style>
            .cta-button {
                text-decoration: none;
            }
            .try-ai-button {
                text-decoration: none;
            }
            .alert {
                padding: 15px;
                margin-top: 20px;
                border-radius: 4px;
            }
            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }
            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
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

    <div class="container">
        <header>
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="StudyHub Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="#inicio"><i data-feather="home"></i> Inicio</a></li>
                    <li><a href="#caracteristicas"><i data-feather="layout"></i> Características</a></li>
                    <li><a href="#ai-features"><i data-feather="info"></i> Cómo funciona</a></li>
                    <li><a href="#contacto"><i data-feather="send"></i> Contacto</a></li>
                </ul>
            </nav>
            <a href="{{ route('login') }}" class="cta-button"><i data-feather="star"></i> Comenzar gratis</a>
        </header>

        <section class="hero" id="inicio">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>Aprende <span>colaborando</span>, alcanza tus metas</h1>
                    <p>StudyHub es una plataforma innovadora que combina el aprendizaje colaborativo para crear una experiencia de estudio más efectiva y personalizada. Conecta con otros estudiantes, comparte conocimientos y maximiza tu potencial.</p>
                    <a href="{{ route('register') }}" class="cta-button"><i data-feather="user-plus"></i> Únete ahora</a>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub plataforma">
                </div>
            </div>
        </section>
    </div>

    <section class="features" id="caracteristicas">
        <div class="container">
            <h2 class="section-title">Por qué elegir StudyHub</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-feather="book-open"></i>
                    </div>
                    <h3>Aprendizaje colaborativo</h3>
                    <p>Conecta con estudiantes que comparten tus intereses y objetivos académicos. Aprende más rápido compartiendo conocimientos.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-feather="search"></i>
                    </div>
                    <h3>Estudio personalizado</h3>
                    <p>Recibe recomendaciones adaptadas a tu estilo de aprendizaje y necesidades específicas.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i data-feather="bar-chart-2"></i>
                    </div>
                    <h3>Seguimiento de progreso</h3>
                    <p>Analiza tu evolución con herramientas visuales y estadísticas detalladas que te ayudarán a mejorar constantemente.</p>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Nueva sección de características IA -->
    <section class="ai-features" id="ai-features">
        <div class="container">
            <h2 class="ai-title">Potenciado por Inteligencia Artificial</h2>
            <p class="ai-description">Aprovecha el poder de la inteligencia artificial para optimizar tu estudio y colaborar eficientemente con otros estudiantes.</p>
            
            <div class="ai-cards">
                <div class="ai-card">
                    <div class="ai-card-header">
                        <div class="ai-card-icon">
                            <i data-feather="cpu"></i>
                        </div>
                        <h3 class="ai-card-title">Resúmenes Inteligentes</h3>
                    </div>
                    <p class="ai-card-description">Nuestra avanzada IA analiza y sintetiza grandes volúmenes de información para crear resúmenes concisos y fáciles de entender.</p>
                    <ul class="ai-card-features">
                        <li><i data-feather="check"></i>Resúmenes automáticos de textos extensos</li>
                        <li><i data-feather="check"></i>Extracción de conceptos clave</li>
                        <li><i data-feather="check"></i>Adaptación al nivel de conocimiento del usuario</li>
                        <li><i data-feather="check"></i>Generación de esquemas para estudio rápido</li>
                    </ul>
                    <button class="ai-card-button"><i data-feather="more-horizontal"></i> Conocer más</button>
                </div>
                
                <div class="ai-card">
                    <div class="ai-card-header">
                        <div class="ai-card-icon">
                            <i data-feather="message-circle"></i>
                        </div>
                        <h3 class="ai-card-title">Chat Colaborativo</h3>
                    </div>
                    <p class="ai-card-description">Conecta con múltiples usuarios en tiempo real para resolver dudas, compartir ideas y crear grupos de estudio efectivos.</p>
                    <ul class="ai-card-features">
                        <li><i data-feather="check"></i>Salas temáticas moderadas por IA</li>
                        <li><i data-feather="check"></i>Traducción automática entre idiomas</li>
                        <li><i data-feather="check"></i>Herramientas de colaboración en tiempo real</li>
                        <li><i data-feather="check"></i>Búsqueda inteligente de compañeros de estudio</li>
                    </ul>
                    <button class="ai-card-button"><i data-feather="compass"></i> Explorar chats</button>
                </div>
            </div>
            
            <div class="try-ai-section">
                <h3>¿Quieres experimentar nuestro asistente IA?</h3>
                <p>Prueba una versión preliminar de nuestro asistente de estudio potenciado por IA</p>
                <a href="assets/ia.html" class="try-ai-button"><i data-feather="zap"></i> Probar demo IA</a>
            </div>
        </div>
    </section>

    <!-- Sección de contacto -->
    <section id="contacto" class="contact">
        <div class="container">
            <h2 class="section-title">Contacto</h2>
            
            <div class="simple-contact-form">
                <p class="contact-intro">¿Tienes alguna pregunta? Envíanos un mensaje y te responderemos lo antes posible.</p>
                
                <form id="contactForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" name="name" placeholder="Tu nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Tu email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Mensaje</label>
                        <textarea id="message" name="message" placeholder="¿En qué podemos ayudarte?" required></textarea>
                    </div>
                    
                    <button type="submit" class="cta-button"><i data-feather="send"></i> Enviar</button>
                </form>
                <div id="formStatus" style="margin-top: 20px; display: none;"></div>
            </div>
        </div>
    </section>

     <!-- Footer minimalista -->
     <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="{{ asset('logo.png') }}" alt="StudyHub Logo">
                    <p>StudyHub &copy; 2023</p>
                </div>
                <div class="footer-links">
                    <a href="#inicio">Inicio</a>
                    <a href="#caracteristicas">Características</a>
                    <a href="#ai-features">IA</a>
                    <a href="#contacto">Contacto</a>
                </div>
                <div class="footer-social">
                    <a href="#"><i data-feather="github"></i></a>
                    <a href="#"><i data-feather="twitter"></i></a>
                    <a href="#"><i data-feather="instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Feather Icons -->
        <script src="https://unpkg.com/feather-icons"></script>
        <script>
            feather.replace();
            
            // Script para el formulario de contacto
            document.addEventListener('DOMContentLoaded', function() {
                const contactForm = document.getElementById('contactForm');
                const formStatus = document.getElementById('formStatus');
                
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Cambiar el texto del botón mientras se envía
                    const submitButton = contactForm.querySelector('button[type="submit"]');
                    const originalButtonText = submitButton.innerHTML;
                    submitButton.innerHTML = '<i data-feather="loader"></i> Enviando...';
                    feather.replace();
                    submitButton.disabled = true;
                    
                    // Obtener los datos del formulario
                    const formData = new FormData(contactForm);
                    
                    // Enviar los datos mediante AJAX
                    fetch('{{ route('contact.send') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mostrar mensaje de éxito
                        formStatus.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
                        formStatus.style.display = 'block';
                        
                        // Restablecer el formulario
                        contactForm.reset();
                        
                        // Restaurar el botón
                        submitButton.innerHTML = originalButtonText;
                        feather.replace();
                        submitButton.disabled = false;
                    })
                    .catch(error => {
                        // Mostrar mensaje de error
                        formStatus.innerHTML = '<div class="alert alert-danger">Ha ocurrido un error al enviar el mensaje. Por favor, inténtalo de nuevo más tarde.</div>';
                        formStatus.style.display = 'block';
                        
                        // Restaurar el botón
                        submitButton.innerHTML = originalButtonText;
                        feather.replace();
                        submitButton.disabled = false;
                    });
                });
            });
        </script>
    </body>
</html> 