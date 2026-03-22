<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Florentica - Bienvenidos</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" >



<nav class="navbar navbar-expand-lg navbar-light bg-flower-pink-light shadow-sm fixed-top">
    <div class="container">
        
        <a class="navbar-brand fw-bold text-flower-pink" href="/">🌸 Florentica</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navFlorentica">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navFlorentica">
            <div class="ms-auto pt-3 pt-lg-0">
                <div class="d-grid d-lg-flex gap-3 align-items-center">
                    <a href="{{ route('login') }}" 
                       class="btn-florentica border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                       Entrar
                    </a>
                    <a href="/register" 
                       class="btn-florentica bg-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">
                       Ser cliente
                    </a>
                    <a href="/join-delivery" 
                       class="btn-florentica bg-flower-purple px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">
                       Ser Repartidor
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>



<section class="py-5 mt-4 text-center bg-light" style="background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.8)), url('https://images.unsplash.com/photo-1526047932273-341f2a7631f9?auto=format&fit=crop&w=1350&q=80'); background-size: cover; background-position: center;">
    
    <div class="container py-5 ">
        
        <h1 class="display-4 fw-bold text-flower-dark">Dilo con Floresss, <br><span class="text-flower-pink">Dilo con Florentica</span></h1>
        
        <p class=" text-flower-dark  mb-4">Entregas el mismo día con la frescura que tus momentos especiales merecen.</p>
        
    </div>

</section>



<section id="catalogo" class="py-5 mt-4 bg-flower-pink-light">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5">
            <div>
                <h2 class="display-6 fw-bold text-flower-dark">Nuestras Colecciones</h2>
                <p class="text-muted">Diseños frescos, preparados hoy mismo por artesanos locales.</p>
            </div>
        </div>

        <div class="row g-4 ">
            {{-- 1. PRIMERO DEFINES LA LÓGICA (Muévelo arriba de la línea 92) --}}



            <div class="col-12 col-md-3 py-3 mt-4">

                <h2 class=" fw-bold text-flower-pink text-center">Temporada</h2>

                @php
                // Filtramos la colección y tomamos los primeros 2 de forma segura
                $destacados = $productos->where('categoria', 'temporada')->take(1);
                @endphp

                @forelse($destacados as $producto)
                    
                {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

                    <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                    
                    {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                        {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                            <img src="{{ asset($producto->imagen_url) }}" 
                            class="card-img-top" 
                            alt="{{ $producto->nombre_ramo }}"
                            style="height: 350px; object-fit: cover; width: 100%;">
                        
                            {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                            <div class="card-body d-flex flex-column">
                            {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                                    <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                                    {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                                    <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                        {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                        {{ ucfirst($producto->categoria) }}
                                    </span>
                                </div>

                                {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                                <p class="card-text text-muted small flex-grow-1">
                                    {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                                    {{ $producto->descripcion }}
                                </p>
                            
                                {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                                    <span class="fs-4 fw-bold text-flower-green">
                                        {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                        ${{ number_format($producto->precio_venta, 2) }}
                                    </span>
                                    {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                                    <a href="#catalogo-temporada" 
                                    class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                                        Ver más
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
                @empty
                {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
                <div class="col-12 text-center py-5">
                    <i class="bi bi-flower1 display-1 text-muted"></i>
                    <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles. ¡Vuelve pronto!</p>
                </div>
                @endforelse
            </div>






            <div class="col-12 col-md-3 py-3 mt-4">
                <h2 class=" fw-bold text-flower-pink text-center">Ocasión</h2>

                @php
                // Filtramos la colección y tomamos los primeros 2 de forma segura
                $destacados = $productos->where('categoria', 'ocasion')->take(1);
                @endphp

                @forelse($destacados as $producto)
                    
                {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

                    <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                    
                    {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                        {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                            <img src="{{ asset($producto->imagen_url) }}" 
                            class="card-img-top" 
                            alt="{{ $producto->nombre_ramo }}"
                            style="height: 350px; object-fit: cover; width: 100%;">
                        
                            {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                            <div class="card-body d-flex flex-column">
                            {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                                    <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                                    {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                                    <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                        {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                        {{ ucfirst($producto->categoria) }}
                                    </span>
                                </div>

                                {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                                <p class="card-text text-muted small flex-grow-1">
                                    {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                                    {{ $producto->descripcion }}
                                </p>
                            
                                {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                                    <span class="fs-4 fw-bold text-flower-green">
                                        {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                        ${{ number_format($producto->precio_venta, 2) }}
                                    </span>
                                    {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                                    <a href="#catalogo-ocasion" 
                                    class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                                        Ver más
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
                @empty
                {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
                <div class="col-12 text-center py-5">
                    <i class="bi bi-flower1 display-1 text-muted"></i>
                    <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles. ¡Vuelve pronto!</p>
                </div>
                @endforelse
            </div>





            <div class="col-12 col-md-3 py-3 mt-4">

                <h2 class=" fw-bold text-flower-pink text-center">Clasicas</h2>

                @php
                // Filtramos la colección y tomamos los primeros 2 de forma segura
                $destacados = $productos->where('categoria', 'clasicas')->take(1);
                @endphp

                @forelse($destacados as $producto)
                    
                {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

                    <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                    
                    {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                        {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                            <img src="{{ asset($producto->imagen_url) }}" 
                            class="card-img-top" 
                            alt="{{ $producto->nombre_ramo }}"
                            style="height: 350px; object-fit: cover; width: 100%;">
                        
                            {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                            <div class="card-body d-flex flex-column">
                            {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                                    <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                                    {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                                    <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                        {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                        {{ ucfirst($producto->categoria) }}
                                    </span>
                                </div>

                                {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                                <p class="card-text text-muted small flex-grow-1">
                                    {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                                    {{ $producto->descripcion }}
                                </p>
                            
                                {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                                    <span class="fs-4 fw-bold text-flower-green">
                                        {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                        ${{ number_format($producto->precio_venta, 2) }}
                                    </span>
                                    {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                                    <a href="#catalogo-clasicas" 
                                    class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                                        Ver más
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
                @empty
                {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
                <div class="col-12 text-center py-5">
                    <i class="bi bi-flower1 display-1 text-muted"></i>
                    <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles. ¡Vuelve pronto!</p>
                </div>
                @endforelse
            </div>




            <div class="col-12 col-md-3 py-3 mt-4">

                <h2 class=" fw-bold text-flower-pink text-center">Cumpleaños</h2>

                @php
                // Filtramos la colección y tomamos los primeros 2 de forma segura
                $destacados = $productos->where('categoria', 'cumpleaños')->take(1);
                @endphp

                @forelse($destacados as $producto)
                    
                {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

                    <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                    
                    {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                        <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        
                        {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                        {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                            <img src="{{ asset($producto->imagen_url) }}" 
                            class="card-img-top" 
                            alt="{{ $producto->nombre_ramo }}"
                            style="height: 350px; object-fit: cover; width: 100%;">
                        
                            {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                            <div class="card-body d-flex flex-column">
                            {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                                    <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                                    {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                                    <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                        {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                        {{ ucfirst($producto->categoria) }}
                                    </span>
                                </div>

                                {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                                <p class="card-text text-muted small flex-grow-1">
                                    {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                                    {{ $producto->descripcion }}
                                </p>
                            
                                {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                                    <span class="fs-4 fw-bold text-flower-green">
                                        {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                        ${{ number_format($producto->precio_venta, 2) }}
                                    </span>
                                    {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                                    <a href="#catalogo-cumpleaños" 
                                    class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                                        Ver más
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>

                {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
                @empty
                {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
                <div class="col-12 text-center py-5">
                    <i class="bi bi-flower1 display-1 text-muted"></i>
                    <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles. ¡Vuelve pronto!</p>
                </div>
                @endforelse
            </div>
     </div>
    </div>

</section>








{{-- Catalogo de temporada --}}
<div class="container py-5 mt-4" id="catalogo-temporada">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo Temporada</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

        @php
        // Filtramos la colección y tomamos los primeros 2 de forma segura
        $destacados = $productos->where('categoria', 'temporada');
        @endphp

        @forelse($destacados as $producto)

         {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

            <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                 {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                     {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                    {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                        <img src="{{ asset($producto->imagen_url) }}" 
                        class="card-img-top" 
                        alt="{{ $producto->nombre_ramo }}"
                        style="height: 350px; object-fit: cover; width: 100%;">
                    
                          {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                    <div class="card-body d-flex flex-column">
                         {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                        <div class="d-flex justify-content-between align-items-start mb-2">
                             {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                            <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                             {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                            <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                 {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                {{ ucfirst($producto->categoria) }}
                            </span>
                        </div>

                        {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                        <p class="card-text text-muted small flex-grow-1">
                             {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                            {{ $producto->descripcion }}
                        </p>
                        
                         {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                        <div class="d-flex justify-content-between align-items-center mt-3">
                             {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                            <span class="fs-4 fw-bold text-flower-green">
                                 {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                ${{ number_format($producto->precio_venta, 2) }}
                            </span>
                             {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                            <a href="/register" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
            @empty
             {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
            <div class="col-12 text-center py-5">
                <i class="bi bi-flower1 display-1 text-muted"></i>
                <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles de temporada. ¡Vuelve pronto!</p>
            </div>
        @endforelse
    </div>
</div>




{{-- Catalogo clasicas --}}
<div class="container py-5 mt-4" id="catalogo-clasicas">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo Clásicas</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

         @php
        // Filtramos la colección y tomamos los primeros 2 de forma segura
        $destacados = $productos->where('categoria', 'clasicas');
        @endphp

        @forelse($destacados as $producto)

         {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

            <div class="col flower-item" data-category="{{ $producto->categoria }}">
                 {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                     {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                    {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                        <img src="{{ asset($producto->imagen_url) }}" 
                        class="card-img-top" 
                        alt="{{ $producto->nombre_ramo }}"
                        style="height: 350px; object-fit: cover; width: 100%;">
                    
                          {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                    <div class="card-body d-flex flex-column">
                         {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                        <div class="d-flex justify-content-between align-items-start mb-2">
                             {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                            <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                             {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                            <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                 {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                {{ ucfirst($producto->categoria) }}
                            </span>
                        </div>

                        {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                        <p class="card-text text-muted small flex-grow-1">
                             {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                            {{ $producto->descripcion }}
                        </p>
                        
                         {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                        <div class="d-flex justify-content-between align-items-center mt-3">
                             {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                            <span class="fs-4 fw-bold text-flower-green">
                                 {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                ${{ number_format($producto->precio_venta, 2) }}
                            </span>
                             {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                            <a href="/register" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
            @empty
             {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
            <div class="col-12 text-center py-5">
                <i class="bi bi-flower1 display-1 text-muted"></i>
                <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles de clasicas. ¡Vuelve pronto!</p>
            </div>
        @endforelse
    </div>
</div>





{{-- Catalogo  de ocasion --}}
<div class="container py-5 mt-4" id="catalogo-ocasion">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo Ocasión</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

         @php
        // Filtramos la colección y tomamos los primeros 2 de forma segura
        $destacados = $productos->where('categoria', 'ocasion');
        @endphp

        @forelse($destacados as $producto)

         {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

            <div class="col flower-item" data-category="{{ $producto->categoria }}">
                 {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                     {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                    {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                        <img src="{{ asset($producto->imagen_url) }}" 
                        class="card-img-top" 
                        alt="{{ $producto->nombre_ramo }}"
                        style="height: 350px; object-fit: cover; width: 100%;">
                    
                          {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                    <div class="card-body d-flex flex-column">
                         {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                        <div class="d-flex justify-content-between align-items-start mb-2">
                             {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                            <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                             {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                            <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                 {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                {{ ucfirst($producto->categoria) }}
                            </span>
                        </div>

                        {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                        <p class="card-text text-muted small flex-grow-1">
                             {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                            {{ $producto->descripcion }}
                        </p>
                        
                         {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                        <div class="d-flex justify-content-between align-items-center mt-3">
                             {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                            <span class="fs-4 fw-bold text-flower-green">
                                 {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                ${{ number_format($producto->precio_venta, 2) }}
                            </span>
                             {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                            <a href="/register" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
            @empty
             {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
            <div class="col-12 text-center py-5">
                <i class="bi bi-flower1 display-1 text-muted"></i>
                <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles de ocasión. ¡Vuelve pronto!</p>
            </div>
        @endforelse
    </div>
</div>





{{-- Catalogo de cumpleaños --}}
<div class="container py-5 mt-4" id="catalogo-cumpleaños">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo cumpleaños</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

        @php
        // Filtramos la colección y tomamos los primeros 2 de forma segura
        $destacados = $productos->where('categoria', 'cumpleaños');
        @endphp

        @forelse($destacados as $producto)

         {{-- Cada producto se muestra dentro de una columna que tiene la clase 'flower-item' y un atributo data-category para filtrar por categoría --}}

            <div class="col flower-item h-100" data-category="{{ $producto->categoria }}">
                 {{-- Tarjeta de Bootstrap sin bordes, con sombra suave, esquinas redondeadas y altura completa para igualar la altura de todas las tarjetas en la fila --}}

                <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                    
                     {{-- Imagen del producto con altura fija, recorte de exceso (overflow-hidden) y estilo object-fit: cover para mantener la proporción sin deformar la imagen --}}

                    {{-- Cambiamos 'storage/img' por 'imagenes' para que coincida con tu lógica de guardado --}}
                        <img src="{{ asset($producto->imagen_url) }}" 
                        class="card-img-top" 
                        alt="{{ $producto->nombre_ramo }}"
                        style="height: 350px; object-fit: cover; width: 100%;">
                    
                          {{-- Cuerpo de la tarjeta con flexbox para distribuir el contenido verticalmente y justificar el espacio entre el título, descripción y precio/botón --}}

                    <div class="card-body d-flex flex-column">
                         {{-- Título del producto con negrita y un badge que muestra la categoría del ramo --}}

                        <div class="d-flex justify-content-between align-items-start mb-2">
                             {{-- El título del producto se muestra con un tamaño de fuente más grande y color oscuro para destacar --}}

                            <h5 class="card-title fw-bold mb-0 text-flower-pink">{{ $producto->nombre_ramo }}</h5>
                             {{-- El badge muestra la categoría del producto con un fondo suave y texto del color principal del proyecto, además de ser redondeado y tener un padding horizontal para mejorar su apariencia --}}

                            <span class="badge bg-soft-pink text-pink rounded-pill px-3">
                                 {{-- La función ucfirst() convierte la primera letra de la categoría a mayúscula para una mejor presentación --}}
                                {{ ucfirst($producto->categoria) }}
                            </span>
                        </div>

                        {{-- Descripción del producto con texto en gris tenue, tamaño de fuente pequeño y flex-grow-1 para ocupar el espacio restante entre el título y el precio/botón --}}
                        <p class="card-text text-muted small flex-grow-1">
                             {{-- El texto de la descripción se muestra con un límite de caracteres para evitar que las tarjetas se vuelvan demasiado altas. La función Str::limit() corta el texto a un número específico de caracteres y agrega puntos suspensivos al final si se excede ese límite. En este caso, se limita a 100 caracteres. --}}

                            {{ $producto->descripcion }}
                        </p>
                        
                         {{-- Contenedor para el precio y el botón de compra, con flexbox para justificar el espacio entre ambos elementos y alinearlos verticalmente al centro --}}

                        <div class="d-flex justify-content-between align-items-center mt-3">
                             {{-- El precio se muestra con un tamaño de fuente más grande, negrita y color oscuro para destacar --}}

                            <span class="fs-4 fw-bold text-flower-green">
                                 {{-- La función number_format() formatea el número del precio para mostrarlo con dos decimales y separadores de miles, lo que mejora la legibilidad del precio para los usuarios. --}}
                                ${{ number_format($producto->precio_venta, 2) }}
                            </span>
                             {{-- Botón de compra con clases personalizadas para el estilo del proyecto, además de ser redondeado, tener un padding horizontal y una sombra para mejorar su apariencia. El botón también incluye un ícono de carrito de compras para indicar su función. --}}

                            <a href="/register" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Comprar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

             {{-- Si no hay productos en la colección, se muestra un mensaje alternativo centrado con un ícono de flor y texto que indica que no hay ramos disponibles. El bloque @empty se ejecuta solo si la colección $productos está vacía, lo que permite manejar el caso en el que no hay datos para mostrar de manera elegante. --}}
            @empty
             {{-- El mensaje alternativo se muestra dentro de una columna que ocupa todo el ancho (col-12) y está centrada tanto horizontalmente como verticalmente, con un padding vertical para darle espacio alrededor del contenido. El ícono de flor se muestra con un tamaño grande (display-1) y un color gris tenue (text-muted) para indicar visualmente que no hay productos disponibles. El texto debajo del ícono también se muestra en gris tenue y con un tamaño de fuente más grande (fs-5) para mejorar su legibilidad. --}}
            <div class="col-12 text-center py-5">
                <i class="bi bi-flower1 display-1 text-muted"></i>
                <p class="mt-3 fs-5 text-muted">Aún no hay ramos disponibles de cumpleaños ¡Vuelve pronto!</p>
            </div>
        @endforelse
    </div>
</div>


{{-- Inicio de la sección comentarios, con relleno vertical (py-5) y fondo blanco --}}
<section class="py-5 bg-flower-pink-light">
    {{-- Contenedor de Bootstrap para centrar el contenido y dar márgenes laterales --}}
    <div class="container text-center">
        {{-- Título principal con fuente negra, margen inferior y color personalizado del proyecto --}}
        <h2 class="fw-bold mb-5 text-flower-dark">Lo que dicen nuestros clientes</h2>
        
        {{-- Fila de la rejilla con espacio entre columnas (g-4) y centrada horizontalmente --}}
        <div class="row g-4 justify-content-center">
            
            {{-- Directiva Blade para iterar sobre la colección de comentarios enviada desde el controlador --}}
            @foreach($comments as $comment)
                {{-- Columna que ocupa 4 de 12 espacios en pantallas medianas (3 tarjetas por fila) --}}
                <div class="col-md-4">
                    {{-- Tarjeta sin bordes, con sombra suave, padding interno y esquinas muy redondeadas (rounded-4) --}}
                    {{-- La clase h-100 asegura que todas las tarjetas tengan la misma altura --}}
                    <div class="card border-0 shadow-sm p-4 rounded-4 h-100">
                        
                        {{-- Contenedor para las estrellas con color de advertencia (amarillo/dorado) --}}
                        <div class="text-warning mb-2">
                            {{-- Repite el carácter ★ según el número guardado en la columna 'stars' --}}
                            {{-- Luego repite ☆ para completar las 5 estrellas (5 menos el valor real) --}}
                            {{ str_repeat('★', $comment->stars) }}{{ str_repeat('☆', 5 - $comment->stars) }}
                        </div>
                        
                        {{-- Párrafo con texto en cursiva y color gris tenue para el cuerpo del comentario --}}
                        <p class="fst-italic text-muted">"{{ $comment->comment }}"</p>
                        
                        {{-- Condicional: solo renderiza el bloque de imagen si el registro tiene una ruta en 'photo' --}}
                        @if($comment->photo)
                            {{-- Contenedor de imagen con margen, recorte de exceso (overflow-hidden) y altura fija --}}
                            <div class="mb-3 overflow-hidden rounded-3" style="height: 150px;">
                                {{-- Helper asset() genera la URL pública; object-fit: cover evita que la foto se deforme --}}
                                <img src="{{ asset($comment->photo) }}" class="w-100 h-100" style="object-fit: cover;">
                            </div>
                        @endif
                        
                        {{-- Nombre del usuario en negrita precedido por un guion largo --}}
                        <h6 class="fw-bold mb-0">— {{ $comment->user->name }}</h6>
                    </div>
                </div>
            {{-- Fin del ciclo de repetición --}}
            @endforeach

        </div> {{-- Fin de la fila (row) --}}
    </div> {{-- Fin del contenedor --}}
</section> {{-- Fin de la sección --}}





<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-start">
        <div class="row text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-flower-pink">Florentica</h5>
                <p>Tu florería boutique de confianza en la Ciudad de México. Calidad y frescura garantizada.</p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold">Servicios</h5>
                <p><a href="/register" class="text-white text-decoration-none">Suscripciones</a></p>                
                <p><a href="/register" class="text-white text-decoration-none">Envíos a domicilio</a></p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-3 fw-bold">Contacto</h5>
                <p><i class="bi bi-house me-3"></i> CDMX, México</p>
                <p><i class="bi bi-envelope me-3"></i> contacto@florentica.com</p>
                <p><i class="bi bi-envelope me-3"></i> contacto@gmail.com</p>
                <p><i class="bi bi-phone me-3"></i> +52 56 54 02 74 43</p>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row align-items-center text-center">
            <p>© 2026 Florentica. Desarrollado por <strong>Bollotech</strong>.</p>
        </div>
    </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

