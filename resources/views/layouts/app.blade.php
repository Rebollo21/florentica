<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Título genérico para que no falle en ninguna página --}}
    <title>Florentica - Sistema de Gestión</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .btn-pink { background-color: #ff69b4; color: white; }
        .btn-pink:hover { background-color: #ff1493; color: white; }
        .text-pink { color: #ff69b4; }
        body { background-color: #f8f9fa; }
    </style>
</head>
<body>

    {{-- Aquí puedes incluir tu Navbar si ya la tienes --}}
    {{-- @include('layouts.navigation') --}}

    <main>
        {{-- 🚩 Aquí es donde aparecerá el contenido de Insumos, Lotes y Ramos --}}
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>