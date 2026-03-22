<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - {{ $appName }}</title>
    
    {{-- Assets de Laravel + Bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- IMPORTANTE: Agregamos Font Awesome para los iconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .bg-login-florentica { 
            background: linear-gradient(135deg, #fdf2f8 0%, #ffffff 100%);
            min-height: 100vh;
        }
        .card-login {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(244, 114, 182, 0.1);
        }
        .btn-login {
            background-color: #f472b6; /* flower-pink */
            border: none;
            border-radius: 50px;
            padding: 0.8rem;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background-color: #db2777;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(244, 114, 182, 0.3);
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
        }
        /* Ajuste para que el botón del ojo combine con el estilo rosa */
        .btn-outline-secondary {
            border-color: #dee2e6;
            color: #f472b6;
            border-radius: 0 0.75rem 0.75rem 0;
        }
        .btn-outline-secondary:hover {
            background-color: #fdf2f8;
            border-color: #f472b6;
            color: #db2777;
        }
        .form-control:focus {
            border-color: #f472b6;
            box-shadow: 0 0 0 0.25rem rgba(244, 114, 182, 0.15);
        }
        .text-flower-pink { color: #f472b6 !important; }
    </style>
</head>

<body class="bg-login-florentica d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                {{-- Branding --}}
                <div class="text-center mb-4">
                    
                    <h1 class="fw-bold text-flower-pink">🌸 Florentica</h1>
                </div>

                <div class="card card-login overflow-hidden">
                    <div class="text-center py-4 bg-white border-bottom">
                        <h4 class="fw-bold mb-0">Iniciar Sesión</h4>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 small rounded-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-secondary">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" 
                                       value="{{ old('email') }}" placeholder="correo@ejemplo.com" required autofocus>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-secondary">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control" 
                                           placeholder="••••••••" required style="border-radius: 0.75rem 0 0 0.75rem;">
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                               {{-- En tu archivo de Login --}}
<a href="{{ route('password.request') }}" class="small text-decoration-none text-flower-pink">
    ¿Olvidaste tu contraseña?
</a>
                            </div>

                            <button type="submit" class="btn btn-login w-100 text-white shadow-sm">
                                ENTRAR A MI CUENTA
                            </button>
                        </form>

                        <div class="text-center mt-4 pt-2 border-top">
                            <p class="small text-muted mb-0">¿Aún no eres cliente?</p>
                            <a href="{{ route('register') }}" class="fw-bold text-flower-pink text-decoration-none">Regístrate en Florentica</a>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <a href="/" class="text-muted small text-decoration-none opacity-75">← Volver al catálogo</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Lógica JavaScript para el botón del ojo --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const eyeIcon = document.querySelector('#eyeIcon');

            togglePassword.addEventListener('click', function () {
                // Cambiar tipo de input
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                
                // Cambiar el icono
                this.querySelector('i').classList.toggle('fa-eye');
                this.querySelector('i').classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>