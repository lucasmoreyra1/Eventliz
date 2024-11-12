<div class="container mt-5">
    <h1 class="mb-4">{{ isset($fondo) ? 'Editar pago' : 'Crear pago' }}</h1>
    <form action="{{ isset($fondo) ? route('fondos.update', $fondo->id) : route('fondos.store') }}" method="POST">
        @csrf
        @if(isset($fondo))
            @method('PUT')
        @endif
        <div class="form-group">
            <input type="hidden" class="form-control" id="id_evento" name="id_evento" value="{{ $id_evento }}">
        </div>

        <div class="form-group">
            <div class="form-check">
                <label for="ingreso" class="form-check-label" >Ingreso</label>
                <input type="radio" class="form-check-input" id="ingreso" name="tipo" value="Ingreso" />
            </div>
            <div class="form-check">
                <label for="egreso" class="form-check-label">Egreso</label>
                <input type="radio" class="form-check-input" id="egreso" name="tipo" value="Egreso" />
            </div>

            {{-- <input type="text" class="form-control" id="tipo_fondo" name="tipo_fondo" placeholder="Ingresa el tipo de menú" value="{{ isset($fondo) ? $fondo->tipo_fondo : '' }}" required> --}}
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" placeholder="Comentarios" required>{{ isset($fondo) ? $fondo->descripcion : '' }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="monto">Monto</label>
            <input type="number" class="form-control" id="monto" name="monto" placeholder="Ingresa la cantidad del pago" value="{{ isset($fondo) ? $fondo->cantidad : '' }}" required>
        </div>

        <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Ingresa la fecha del pago required">
        </div>
        
        {{-- <button type="submit" class="btn btn-primary">{{ isset($fondo) ? 'Actualizar' : 'Crear' }}</button> --}}
    </form>
</div>
