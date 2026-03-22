@extends('layouts.app') {{-- O el layout que uses --}}

@section('content')
<div class="container py-5">
    <div class="row align-items-center">
        <div class="col-md-6 mb-4">
            <img src="{{ asset($producto->imagen_url) }}" 
                 class="img-fluid rounded-5 shadow-lg" 
                 alt="{{ $producto->nombre_ramo }}"
                 style="width: 100%; height: 500px; object-fit: cover;">
        </div>

        <div class="col-md-6 ps-md-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/shop">Tienda</a></li>
                    <li class="breadcrumb-item active">{{ $producto->categoria }}</li>
                </ol>
            </nav>
            
            <h1 class="display-4 fw-bold text-dark">{{ $producto->nombre_ramo }}</h1>
            <p class="fs-5 text-muted mb-4">{{ $producto->descripcion }}</p>
            
            <h2 class="text-pink fw-bold mb-4">${{ number_format($producto->precio_venta, 2) }}</h2>
            
            <div class="d-grid gap-2">
                <button class="btn btn-pink btn-lg rounded-pill shadow">
                    <i class="bi bi-cart-check-fill"></i> Agregar al carrito
                </button>
            </div>
            
            <hr class="my-4">
            <p class="small text-muted">
                <i class="bi bi-truck me-2"></i> Envío disponible para hoy mismo en CDMX.
            </p>
        </div>
    </div>
</div>
@endsection