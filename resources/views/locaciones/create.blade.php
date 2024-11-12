<div class="container mt-5">
    <h1 class="mb-4">Crear Locación</h1>
    <form action="{{ route('locaciones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre del lugar</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre de la ubicacion" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa la dirección" required>
        </div>
        <div class="form-group">
            <label for="ciudad">Ciudad</label>
            <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingresa la ciudad" required>
        </div>
        <div class="form-group">
            <label for="capacidad">Capacidad</label>
            <input type="number" class="form-control" id="capacidad" name="capacidad" placeholder="Ingresa la capacidad" required>
        </div>
        
    </form>
</div>
