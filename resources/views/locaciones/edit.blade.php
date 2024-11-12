<div class="container mt-5">
    <h1 class="mb-4">Editar Locación</h1>
    <form action="{{ route('locaciones.update', $locacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $locacion->nombre }}" placeholder="Ingresa el nombre de la ubicacion" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $locacion->direccion }}" placeholder="Ingresa la dirección" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" value="{{ $locacion->ciudad }}" placeholder="Ingresa la ciudad" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" value="{{ $locacion->capacidad }}" placeholder="Ingresa la capacidad" required>
        </div>
        <br>
        {{-- <button type="submit" class="btn btn-primary">Actualizar Locación</button> --}}
    </form>
</div>