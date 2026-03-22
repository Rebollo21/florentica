<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Tienda - Florentica</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


{{--fondo color claro | navbar | catalogo de productos | formulario de reseñas--}} 
<body class="bg-light">

@if (session('success'))
    <div class="alert" style="background-color: #d4edda; color: #155724; padding: 15px; border-left: 5px solid #28a745; border-radius: 4px; font-family: 'Courier New', Courier, monospace; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        <strong style="text-transform: uppercase;">[ ALERTA DE SISTEMA ]</strong> <br>
        <span style="font-size: 0.9em;">STATUS: AUTH_SUCCESS</span> <br>
        <hr style="border: 0; border-top: 1px solid #c3e6cb; margin: 10px 0;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->has('error') || session('error'))
    <div class="alert" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-left: 5px solid #dc3545; border-radius: 4px; font-family: 'Courier New', Courier, monospace; margin-bottom: 20px;">
        <strong style="text-transform: uppercase;">[ ERROR CRÍTICO DE SISTEMA ]</strong> <br>
        <span style="font-size: 0.9em;">STATUS: {{ session('error_code') ?? 'DENIED' }}</span> <br>
        <hr style="border: 0; border-top: 1px solid #f5c6cb; margin: 10px 0;">
        {{ session('error') ?? $errors->first('error') }}
    </div>
@endif

{{-- Navbar de navegación con el nombre de la tienda, enlaces a la página de perfil y cierre de sesión, y un saludo personalizado para el usuario autenticado. El navbar es fijo en la parte superior de la página, tiene un fondo blanco, sombra suave y se adapta a diferentes tamaños de pantalla gracias a las clases de Bootstrap. --}}

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    
    <div class="container">
        
        <a class="navbar-brand fw-bold text-flower-pink" href="/shop">🌸 Florentica</a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navFlorentica">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navFlorentica">
            <div class="ms-auto pt-3 pt-lg-0">
                <div class="d-grid d-lg-flex gap-3 align-items-center">
                    <a href="/profile" 
                       class="btn-florentica bg-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">
                    Mi perfil
                    </a>

                    <a href="/profile" 
                       class="btn-florentica bg-flower-gold px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm text-white">
                    Premium
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn-florentica text-white bg-flower-red px-4 py-2 rounded-full font-bold text-center no-underline shadow-sm">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>







<section class=" py-5 mt-4 sticky-categories bg-flower-pink-light">
    <div class="container text-center">
        <h2 class="fw-bold text-flower-pink">Explora nuestras colecciones</h2>
        
        <div class="row g-4 justify-content-center">

             {{-- Tarjeta 4: Temporada --}}
            <div class="col-6 col-md-3 py-5 mt-4">
                <div class="card border-0 shadow-sm p-3 rounded-4 h-100">
                    <a href="{{ route('shop.index', ['categoria' => 'temporada']) }}#catalogo-temporada" class="card-categoria-link text-decoration-none">
                        <div class="card-categoria {{ request('categoria') == 'temporada' ? 'active' : '' }}">
                            <span class="fs-1">🌿</span>
                            <h5 class="mt-2 fw-bold text-flower-pink">Temporada</h5>
                        </div>
                    </a>
                </div>
            </div>
            
             {{-- Tarjeta 2: Clásicas --}}
            <div class="col-6 col-md-3 py-5 mt-4">
                <div class="card card-premium border-0 shadow-sm p-3 rounded-4 h-100">
                    <a href="{{ route('shop.index', ['categoria' => 'clasicas']) }}#catalogo-clasicas" class="card-categoria-link text-decoration-none">
                        <div class="card-categoria {{ request('categoria') == 'clasicas' ? 'active' : '' }}">
                            <span class="fs-1">🌺</span>
                            <h5 class="mt-2 fw-bold text-flower-pink">Ocasión</h5>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Tarjeta 2: Clásicas --}}
            <div class="col-6 col-md-3 py-5 mt-4">
                <div class="card card-premium border-0 shadow-sm p-3 rounded-4 h-100">
                    <a href="{{ route('shop.index', ['categoria' => 'clasicas']) }}#catalogo-clasicas" class="card-categoria-link text-decoration-none">
                        <div class="card-categoria {{ request('categoria') == 'clasicas' ? 'active' : '' }}">
                            <span class="fs-1">🌹</span>
                            <h5 class="mt-2 fw-bold text-flower-pink">Clásicas</h5>
                        </div>
                    </a>
                </div>
            </div>

            {{-- Tarjeta 3: Ocasión --}}
            <div class="col-6 col-md-3 py-5 mt-4">
                <div class="card border-0 shadow-sm p-3 rounded-4 h-100">
                    <a href="{{ route('shop.index', ['categoria' => 'ocasion']) }}#catalogo-ocasion" class="card-categoria-link text-decoration-none">
                        <div class="card-categoria {{ request('categoria') == 'ocasion' ? 'active' : '' }}">
                            <span class="fs-1">🎂</span>
                            <h5 class="mt-2 fw-bold text-flower-pink">Cumpleaños</h5>
                        </div>
                    </a>
                </div>
            </div>

           

        </div> {{-- Fin de la fila (row) --}}
    </div> {{-- Fin del contenedor --}}
</section>

















{{-- Catalogo completo --}}
{{-- Contenedor de flores --}}
<div class="container py-5 mt-4" id="catalogo-temporada">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo Temporada</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

         {{-- Directiva Blade para iterar sobre la colección de productos enviada desde el controlador --}}
         {{-- Si no hay productos, muestra un mensaje alternativo con @empty --}}
        @forelse($productos as $producto)

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

                            <a href="{{ route('shop.show', $producto->id) }}" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Ver detalles
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




{{-- Catalogo completo --}}
{{-- Contenedor de flores --}}
<div class="container py-5 mt-4" id="catalogo-clasicas">
    {{-- Título del catálogo --}}
    <h2 class="text-center mb-4 fw-bold text-flower-pink">Catálogo Clasicas</h2>
    
    {{--  Rejilla de productos con 1 columna en móviles y 3 columnas en pantallas medianas, con espacio entre filas y columnas (g-4) --}} 
    <div class="row row-cols-1 row-cols-md-3 g-4" id="contenedor-flores">

         {{-- Directiva Blade para iterar sobre la colección de productos enviada desde el controlador --}}
         {{-- Si no hay productos, muestra un mensaje alternativo con @empty --}}
        @forelse($productos as $producto)

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

                            <a href="{{ route('shop.show', $producto->id) }}" class="btn-florentica2 border-flower-pink px-4 py-2 rounded-full font-bold text-center no-underline">
                            Ver detalles
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
                            <p class="card-text text-flower-gold small flex-grow-1 opacity-75">
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



 {{-- Sección para dejar una reseña, con un formulario que envía los datos a la ruta 'comments.store' utilizando el método POST. El formulario incluye un campo de selección para la calificación (estrellas), un área de texto para el comentario y un campo opcional para subir una foto. Además, se muestra un mensaje de éxito si la sesión contiene una variable 'success', lo que indica que el comentario se ha enviado correctamente. El mensaje de éxito se muestra dentro de una alerta de Bootstrap con un diseño personalizado que incluye un ícono de verificación y un botón para cerrar la alerta. --}}
@if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 d-flex align-items-center mb-4 fade show" role="alert">
        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
            <i class="fas fa-check"></i>
        </div>
        <div>
            <h6 class="fw-bold mb-0">¡Envío exitoso!</h6>
            <small>{{ session('success') }}</small>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
 {{-- Formulario para dejar una reseña, con un diseño de tarjeta que incluye un título, campos para la calificación, comentario y foto, y un botón para enviar el formulario. El formulario utiliza la clase 'btn-pink' personalizada para el estilo del botón de envío, además de ser redondeado, tener un padding vertical y una sombra para mejorar su apariencia. El formulario también incluye un token CSRF para proteger contra ataques de falsificación de solicitudes entre sitios, lo que es obligatorio en Laravel para cualquier formulario que envíe datos al servidor. --}}

<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                   
                <div class="card shadow-sm border-0 p-4 rounded-4">

                    <h3 class="fw-bold text-center mb-4">Deja tu reseña</h3>
                    
                    <form action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Token de seguridad obligatorio en Laravel --}}

                        <div class="mb-3">
                            <label class="form-label fw-bold">Calificación</label>
                            <select name="stars" class="form-select" required>
                                <option value="5">⭐⭐⭐⭐⭐ (Excelente)</option>
                                <option value="4">⭐⭐⭐⭐ (Muy bueno)</option>
                                <option value="3">⭐⭐⭐ (Bueno)</option>
                                <option value="2">⭐⭐ (Regular)</option>
                                <option value="1">⭐ (Malo)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Tu comentario</label>
                            <textarea name="comment" class="form-control" rows="3" placeholder="¿Qué te parecieron nuestras flores?" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Foto (Opcional)</label>
                            <input type="file" name="photo" class="form-control" accept="image/*">
                        </div>

                        
                        @csrf
                        <button type="submit" id="btnEnviar" 
                            class="btn-pink w-100 py-3 rounded-xl font-bold transition-all duration-300 shadow-md hover:brightness-95 hover:-translate-y-1">
                            Publicar Comentario
                        </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<footer class="bg-dark text-white pt-5 pb-4 mt-5">
    <div class="container text-md-start">
        <div class="row text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold text-flower-pink">Florentica</h5>
                <p>Tu florería boutique de confianza en la Ciudad de México. Calidad y frescura garantizada.</p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 fw-bold">Servicios</h5>
                <p><a href="#" class="text-white text-decoration-none">Suscripciones</a></p>                
                <p><a href="#" class="text-white text-decoration-none">Envíos a domicilio</a></p>
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
            <p>© 2026 Florentica. Desarrollado por <strong>Florentica CEO</strong>.</p>
        </div>
    </div>
</footer>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>