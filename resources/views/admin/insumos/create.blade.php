@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-dark text-white p-4 rounded-top-4">
    
                    <h4 class="mb-0 uppercase fw-black">🌿 Registro de Catálogo (Insumos)</h4>
                </div>
                <div class="card-body p-5">
                    <form action="{{ route('insumos.store') }}" method="POST">
                        @csrf

                            @if ($errors->any())
                            <div class="alert alert-danger shadow-sm border-0 rounded-4">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-triangle me-2"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                            <div class="alert alert-success shadow-sm border-0 rounded-4">
                                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            </div>
                        @endif
                                
                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Nombre de la Flor o Material</label>
                            <input type="text" name="nombre_insumo" class="form-control form-control-lg rounded-3" 
                                   placeholder="Ej: Rosa Roja Exportación" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">Categoría</label>
                                <select name="tipo" class="form-select form-select-lg rounded-3" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="flor">🌸 Flor (Perecedero)</option>
                                    <option value="materia_prima">🎀 Material (No perecedero)</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary">Unidad de Medida</label>
                                <select name="unidad_medida" class="form-select form-select-lg rounded-3" required>
                                    <option value="tallos">Tallos (Flores)</option>
                                    <option value="paquetes">Paquetes</option>
                                    <option value="piezas">Piezas</option>
                                    <option value="metros">Metros (Listones)</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold text-secondary">Precio de Venta Sugerido ($)</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light">$</span>
                                <input type="number" step="0.01" name="precio_venta" class="form-control rounded-end-3" 
                                       placeholder="0.00" required>
                            </div>
                            <small class="text-muted">Este precio servirá de base para calcular tu utilidad real.</small>
                        </div>

                        <hr class="my-4 text-secondary opacity-25">

                        <div class="d-grid">
                            <button type="submit" class="btn btn-pink btn-lg py-3 fw-bold shadow-sm uppercase tracking-wider">
                                ✨ Guardar en Catálogo
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-link text-secondary mt-2 text-decoration-none">
                                Cancelar y volver
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection