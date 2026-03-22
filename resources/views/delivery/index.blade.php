<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reparto - Florentica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-info text-dark"> <div class="container mt-5 text-center">
        <h1>Panel de Logística</h1>
        <p>Bienvenido, aquí verás las flores por entregar.</p>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-dark">Cerrar Sesión</button>
        </form>
    </div>

    
</body>
</html>