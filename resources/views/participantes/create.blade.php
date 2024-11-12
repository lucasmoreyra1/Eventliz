
<div class="container mt-3">
    <h1 class="mb-4">{{ isset($participante) ? 'Editar Participante' : 'Agregar Participante' }}</h1>
    <form action="{{ isset($participante) ? route('participantes.update', $participante->id) : route('participantes.store') }}" method="POST">
        @csrf
        @if(isset($participante))
            @method('PUT')
        @endif
        

        <div class="form-group">
            <input type="hidden" class="form-control" id="id_evento" name="id_evento" value="{{ $id_evento }}">
        </div>

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset($participante) ? $participante->nombre : '' }}" required>
        </div>
        
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input class="form-control" id="apellido" name="apellido" rows="4" placeholder="Apellido" value="{{ isset($participante) ? $participante->apellido : '' }}">
        </div>
        
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="{{ isset($participante) ? $participante->telefono : '' }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ isset($participante) ? $participante->email : '' }}">
        </div>
        
        {{-- <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Actualizar' : 'Crear' }}</button> --}}
    </form>
</div>
