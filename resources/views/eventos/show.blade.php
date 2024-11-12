
<div class="container mt-3">
    <h1 class="mb-4">Detalles del Evento</h1>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="cliente" class="form-label">Cliente:</label>
                <input type="text" name="cliente" id="cliente" class="form-control" value="{{ $evento[0]->cliente }}" readonly>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo de evento:</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $evento[0]->evento }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del evento:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $evento[0]->nombre }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion/Detalles:</label>
                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" readonly>{{ $evento[0]->descripcion }}</textarea>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="organizador" class="form-label">Organizador:</label>
                <input type="text" name="organizador" id="organizador" class="form-control" value="{{ $evento[0]->organizador }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="tipo_menu" class="form-label">Tipo de Menú:</label>
                <input type="text" name="tipo_menu" id="tipo_menu" class="form-control" value="{{ $evento[0]->tipo_menu }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="locacion" class="form-label">Lugar:</label>
                <input type="text" name="locacion" id="locacion" class="form-control" value="{{ $evento[0]->direccion }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="requisitos" class="form-label">Requisitos:</label>
                <input type="text" name="requisitos" id="requisitos" class="form-control" value="{{ $evento[0]->requisitos }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="web" class="form-label">Sitio web para el evento:</label>
                <input type="text" name="web" id="web" class="form-control" value="{{ $evento[0]->web }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $evento[0]->fecha_inicio }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="fecha_final" class="form-label">Fecha final:</label>
                <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{ $evento[0]->fecha_final }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="hora_inicio" class="form-label">Hora de inicio:</label>
                <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $evento[0]->hora_inicio }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="hora_final" class="form-label">Hora final:</label>
                <input type="time" name="hora_final" id="hora_final" class="form-control" value="{{ $evento[0]->hora_final }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="costo_organizacion" class="form-label">Costo estimado de organización del evento:</label>
                <input type="number" name="costo_organizacion" id="costo_organizacion" class="form-control" step="0.01" value="{{ $evento[0]->costo_organizacion }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="cant_participantes" class="form-label">Cantidad estimada de invitados:</label>
                <input type="number" name="cant_participantes" id="cant_participantes" class="form-control" value="{{ $evento[0]->cant_participantes }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="costo_participante" class="form-label">Costo de cada participante/entrada:</label>
                <input type="number" name="costo_participante" id="costo_participante" class="form-control" step="0.01" value="{{ $evento[0]->costo_participante }}" readonly>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="presupuesto" class="form-label">Presupuesto estimado:</label>
                <input type="number" name="presupuesto" id="presupuesto" class="form-control" step="0.01" value="{{ $evento[0]->presupuesto_evento }}" readonly>
            </div>
        </div>
    </div>
</div>
