
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($tipoEvento) ? 'Editar Tipo Evento' : 'Crear Tipo Evento' }}</h1>
    <form action="{{ isset($tipoEvento) ? route('tipoEventos.update', $tipoEvento->id) : route('tipoEventos.store') }}" method="POST">
        @csrf
        @if(isset($tipoEvento))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="evento">Tipo de Evento</label>
            <input type="text" class="form-control" id="evento" name="evento" placeholder="Ingresa el tipo de Evento" value="{{ isset($tipoEvento) ? $tipoEvento->evento : '' }}" required>
        </div>
        
{{--         <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="4" placeholder="Describe el contenido del menú" required>{{ isset($tipoEvento) ? $tipoEvento->contenido : '' }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" class="form-control" id="costo" name="costo" placeholder="Ingresa el costo del menú" value="{{ isset($tipoEvento) ? $tipoEvento->costo : '' }}" required>
        </div> --}}
        
        {{-- <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Actualizar' : 'Crear' }}</button> --}}
    </form>
</div>
