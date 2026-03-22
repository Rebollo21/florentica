<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda - Florentica</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>




<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-flower-pink" href="/shop">🌸 Florentica</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navFlorentica">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navFlorentica">
            <div class="ms-auto pt-3 pt-lg-0">
                <div class="d-grid d-lg-flex gap-3 align-items-center">
                     <div class="d-flex align-items-center">
                <span class="btn-florentica bg-flower-purple px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">Hola, {{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class=" text-white btn-florentica bg-flower-red px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">Cerrar Sesión</button>
                </form>
            </div>


                </div>
            </div>
        </div>
    </div>
</nav>

 
<div class="container mt-5 py-5 mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold text-flower-dark m-0">🌸 Mi Perfil Florentica</h5>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0 align-middle">
                        <tbody class="border-top-0">
                            <tr>
                                <td class="ps-4 py-3 fw-bold text-muted" style="width: 30%;">Nombre Completo</td>
                                <td class="py-3 text-flower-dark">{{ auth()->user()->name }}</td>
                            </tr>
                            <tr>
                                <td class="ps-4 py-3 fw-bold text-muted">Correo Electrónico</td>
                                <td class="py-3">{{ auth()->user()->email }}</td>
                            </tr>
                           <tr>
    <td class="ps-4 py-3 fw-bold text-muted">Contraseña</td>
    <td class="py-3 text-flower-dark">
        <span class="me-2">••••••••</span>
        <a href="#" class="text-flower-pink small fw-bold text-decoration-none">Cambiar</a>
    </td>
</tr>
                            <tr>
                                <td class="ps-4 py-3 fw-bold text-muted">Miembro desde</td>
                                <td class="py-3">{{ auth()->user()->created_at->format('d \d\e F, Y') }}</td>
                            </tr>
                           
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-light py-3 text-end">
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-pill px-4">Editar Datos</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>