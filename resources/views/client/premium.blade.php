
<section class="py-5 bg-dark">
    <div class="container py-5 mt-4" id="catalogo-premium">
        {{-- Título con efecto gradiente --}}
        <h2 class="text-center mb-5 fw-bold text-flower-gold display-4" style="letter-spacing: 2px;">
            Catálogo Premium
        </h2>
        
        <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">
            @forelse($productos as $producto)
                <div class="col flower-item" data-category="{{ $producto->categoria }}">
                    {{-- Tarjeta con clase card-premium-product --}}
                    <div class="card card-premium-product h-100 shadow-lg border-0  overflow-hidden bg-dark-card">
                        
                        <div class="position-relative">
                            <img src="{{ asset($producto->imagen_url) }}" 
                                 class="card-img-top" 
                                 alt="{{ $producto->nombre_ramo }}"
                                 style="height: 400px; object-fit: cover; width: 100%;">
                            {{-- Overlay sutil sobre la imagen --}}
                            <div class="card-img-overlay d-flex align-items-start justify-content-end p-3">
                                <span class="badge rounded-pill px-3 py-2 text-dark fw-bold" style="background: linear-gradient(45deg, #bf953f, #fcf6ba);">
                                    VIP
                                </span>
                            </div>
                        </div>

                        <div class="card-body d-flex flex-column p-4">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h4 class="title fw-bold mb-0 text-flower-gold">{{ $producto->nombre_ramo }}</h4>
                            </div>

                            {{-- Texto en color claro para contraste sobre fondo oscuro --}}
                            <p class="card-text text-light-gray small flex-grow-1 opacity-75">
                                {{ Str::limit($producto->descripcion, 120) }}
                            </p>
                            
                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <span class="fs-3 fw-bold text-flower-gold">
                                    ${{ number_format($producto->precio_venta, 2) }}
                                </span>
                                
                                {{-- Botón Dorado --}}
                                <a href="{{ route('shop.show', $producto->id) }}" 
                                   class="btn-premium-action px-4 py-2 rounded-full font-bold text-center no-underline">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-gem display-1 text-flower-gold opacity-50"></i>
                    <p class="mt-3 fs-5 text-flower-gold">Nuestras piezas exclusivas están siendo preparadas.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>