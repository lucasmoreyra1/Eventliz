<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Editar evento</div>
                <div class="card-body">
                    <form action="{{ route('eventos.update', $evento->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="cliente">Cliente:</label>
                            <select name="cliente" id="cliente" class="form-control">
                                <option value="">Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" {{ $evento->id_cliente == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo de evento:</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="">Seleccione un tipo</option>
                                @foreach ($tipoEventos as $tipoEvento)
                                    <option value="{{ $tipoEvento->id }}" {{ $evento->id_tipo == $tipoEvento->id ? 'selected' : '' }}>{{ $tipoEvento->evento }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre del evento:</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre del evento" value="{{ $evento->nombre }}">
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripcion/Detalles:</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion resumida del evento">{{ $evento->descripcion }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="organizador">Organizador:</label>
                            <input type="text" name="organizador" id="organizador" class="form-control" placeholder="Nombre del organizador o encargado" value="{{ $evento->organizador }}">
                        </div>

                        <div class="form-group">
                            <label for="tipo_menu">Tipo de Menú:</label>
                            <select name="tipo_menu" id="tipo_menu" class="form-control">
                                <option value="">Seleccione un menú</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ $evento->id_menu == $menu->id ? 'selected' : '' }}>{{ $menu->tipo_menu }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="locacion">Lugar:</label>
                            <select name="locacion" id="locacion" class="form-control">
                                <option value="">Seleccione una ubicación</option>
                                @foreach ($locaciones as $locacion)
                                    <option value="{{ $locacion->id }}" {{ $evento->id_locacion == $locacion->id ? 'selected' : '' }}>{{ $locacion->direccion }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="requisitos">Requisitos:</label>
                            <input type="text" name="requisitos" id="requisitos" class="form-control" placeholder="Requisitos de asistencia" value="{{ $evento->requisitos }}">
                        </div>

                        <div class="form-group">
                            <label for="web">Sitio web para el evento:</label>
                            <input type="text" name="web" id="web" class="form-control" value="{{ $evento->web }}">
                        </div>

                        <div class="form-group">
                            <label for="fecha_inicio">Fecha de inicio:</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ $evento->fecha_inicio }}">
                        </div>

                        <div class="form-group">
                            <label for="fecha_final">Fecha final:</label>
                            <input type="date" name="fecha_final" id="fecha_final" class="form-control" value="{{ $evento->fecha_final }}">
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de inicio:</label>
                            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" value="{{ $evento->hora_inicio }}">
                        </div>

                        <div class="form-group">
                            <label for="hora_final">Hora final:</label>
                            <input type="time" name="hora_final" id="hora_final" class="form-control" value="{{ $evento->hora_final }}">
                        </div>

                        <div class="form-group">
                            <label for="costo_organizacion">Costo estimado de organización del evento:</label>
                            <input type="number" name="costo_organizacion" id="costo_organizacion" class="form-control" step="0.01" value="{{ $evento->costo_organizacion }}">
                        </div>

                        <div class="form-group">
                            <label for="cant_participantes">Cantidad estimada de invitados:</label>
                            <input type="number" name="cant_participantes" id="cant_participantes" class="form-control" value="{{ $evento->cant_participantes }}">
                        </div>

                        <div class="form-group">
                            <label for="costo_participante">Costo de cada participante/entrada:</label>
                            <input type="number" name="costo_participante" id="costo_participante" class="form-control" step="0.01" value="{{ $evento->costo_participante }}">
                        </div>

                        <div class="form-group">
                            <label for="presupuesto">Presupuesto estimado:</label>
                            <input type="number" name="presupuesto" id="presupuesto" class="form-control" step="0.01" value="{{ $evento->presupuesto_evento }}">
                        </div>

                        {{-- <button type="submit" class="btn btn-primary">Enviar</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    