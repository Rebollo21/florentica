<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Control - Florentica</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-dark text-white">

@if (session('success'))

    <div class="alert" style="background-color: #d4edda; color: #155724; padding: 15px; border-left: 5px solid #28a745; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">

        <hr style="border: 0; border-top: 1px solid #c3e6cb; margin: 10px 0;">

        {{ session('success') }}

    </div>

@endif


<div class="container mt-5 text-center">

    <h1>Bienvenido, Jefe de Florentica: {{ Auth::user()->name }}</h1>        
    
    <p class="lead">Desde aquí podrás gestionar el inventario de flores y las ventas.</p>
        
    <form action="{{ route('logout') }}" method="POST">

        @csrf

        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>

    </form>

</div>

    
<div class="container mt-5">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header bg-white py-3">

            <h5 class="fw-bold text-flower-dark m-0">🌸 Control de ramos - Florentica</h5>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">

                    <tr>

                        <th class="ps-4">Producto</th>
                        <th>Colección</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acciones</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td class="ps-4">

                            <div class="d-flex align-items-center">

                                <img src="" class="rounded-3 me-3" style="width: 45px; height: 45px; object-fit: fill;">

                                <div>

                                    <span class="fw-bold d-block">Ramo de Rosas Premium</span>

                                    <small class="text-muted">ID: #FL-001</small>

                                </div>

                            </div>

                        </td>
                        <td><span class=" bg-flower-pink-soft text-flower-pink">Eterna</span></td>

                        <td class="fw-bold">$890.00</td>

                        <td>

                            <div class="progress" style="height: 6px; width: 100px;">

                                <div class="progress-bar bg-success" style="width: 80%"></div>

                            </div>

                            <small class="text-muted">15 unidades</small>

                        </td>

                        <td><span class="badge rounded-pill bg-success-light text-success">Disponible</span></td>

                        <td class="text-end pe-4">

                            <button class="btn btn-sm btn-light text-success rounded-circle me-1">Editar</button>

                            <button class="btn btn-sm btn-light text-danger rounded-circle">Eliminar</button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>


  
<div class="container mt-5">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header bg-white py-3">

            <h5 class="fw-bold text-flower-dark m-0">📦 Control de Inventario - Florentica</h5>

        </div>


        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
            
                <thead class="bg-light">

                    <tr class="small text-muted text-uppercase">

                        <th class="ps-4">Usuario</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th class="text-end pe-4">Acciones</th>

                    </tr>

                </thead>
                
                <tbody>

                @foreach($usuarios as $u)

                    <tr>

                        <td class="ps-4">

                            <div class="d-flex align-items-center">

                                <div class="rounded-circle bg-flower-pink d-flex align-items-center justify-content-center text-white fw-bold me-2" style="width: 35px; height: 35px; font-size: 0.8rem;">

                                    {{ substr($u->name, 0, 1) }}

                                </div>
                                
                                <span class="fw-bold">{{ $u->name }}</span>

                            </div>
                    
                        <td class="small">{{ $u->email }}</td>
                            
                        <td>

<span class="badge rounded-pill px-3 py-2 fw-bold 
    {{ $u->role->value == 'admin' ? 'bg-danger text-white' : ($u->role->value == 'delivery' ? 'bg-warning text-dark' : 'bg-info text-dark') }}">
    
    @php
        // Usamos match para traducir de forma limpia (PHP 8+)
        $nombreRol = match($u->role->value) {
            'buyer'    => 'cliente',
            'delivery' => 'repartidor',
            'admin'    => 'administrador',
            default    => $u->role->value,
        };
    @endphp
    
    {{ strtoupper($nombreRol) }}
</span>              </td>

                        <td class="text-end pe-4">

                            <button class="btn btn-sm btn-light rounded-circle"><i class="bi bi-pencil"></i></button>

                            <button class="btn btn-sm btn-light rounded-circle"><i class="bi bi-trash"></i></button>

                        </td>

                    </tr>
                
                @endforeach
                
                </tbody>

            </table>
    
        </div>

    </div>

</div>


<div class="container mt-5">

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">   

        <div class="card-header bg-white py-3">

            <h5 class="fw-bold text-flower-dark m-0">📦 Control de lotes - Florentica</h5>
            <a href="" class="btn btn-florentica text-center">Crear lote</a>

        </div>


        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">

                    <tr class="small text-muted text-uppercase">

                        <th class="text-center">Producto</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Stock total</th>
                        <th class="text-center">Fecha de vida</th>
                       

                    </tr>

                </thead>
        

            <tbody>

@foreach($insumos as $insumo)
<tr>
    <td class="align-middle">
        <div class="fw-bold text-dark fs-5">{{ $insumo->nombre_insumo }}</div>
        <div class="mt-2">
            @foreach($insumo->lotes->where('cantidad_actual', '>', 0) as $lote)
                <div class="p-1 mb-1 bg-light rounded border-start border-3 border-flower-pink">
                    <small class="ps-2">
                        <i class="fas fa-hashtag text-flower-pink"></i> 

                        <strong>Lote #{{ $lote->id }}</strong>: 
{{ $lote->cantidad_actual }} 
@if($lote->insumo->tipo == 'flor')
    flores
@else
    {{ $lote->insumo->unidad_medida }}
@endif
                    </small>
                </div>
            @endforeach
        </div>
    </td>

    <td class="align-middle text-center">
        <div class="mt-4"> {{-- Ajuste para alinear con los lotes de abajo --}}
            @foreach($insumo->lotes->where('cantidad_actual', '>', 0) as $lote)
                <div class="mb-1">
                    <span class="badge bg-outline-secondary border text-dark w-100 p-2" style="font-size: 0.8rem;">
                        <i class="far fa-calendar-alt me-1"></i> {{ $lote->created_at->format('d/m/Y') }}
                    </span>
                </div>
            @endforeach
        </div>
    </td>

    <td class="text-center align-middle">
        <div class="display-6 fw-bold text-flower-pink">
            {{ $insumo->lotes->sum('cantidad_actual') }}
        </div>
        <small class="text-uppercase fw-bold text-muted" style="font-size: 0.6rem;">Stock Total</small>
    </td> 

    <td class="align-middle">
        @if($insumo->tipo === 'flor')
            <div class="mt-4">
                @foreach($insumo->lotes->where('cantidad_actual', '>', 0) as $lote)
                    <div class="mb-1">
                        @php 
                            $dias = (int) now()->diffInDays($lote->fecha_vencimiento, false); 
                        @endphp

                        @if($lote->fecha_vencimiento->isPast())
                            <span class="badge bg-danger w-100 p-2 shadow-sm">
                                Lote #{{ $lote->id }}: Marchito
                            </span>
                        @elseif($dias <= 2)
                            <span class="badge bg-warning text-dark w-100 p-2 shadow-sm">
                                Lote #{{ $lote->id }}: Urge ({{ $dias }}d)
                            </span>
                        @else
                            <span class="badge bg-success w-100 p-2 shadow-sm">
                                Lote #{{ $lote->id }}: {{ $dias }} días
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center">
                <span class="badge bg-info text-white p-2">📦 Permanente</span>
            </div>
        @endif
    </td>
</tr>
@endforeach

            </tbody>

    
            </table>

        </div>

    </div>

</div>




</body>
</html>