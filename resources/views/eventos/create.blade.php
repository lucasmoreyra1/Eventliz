{{-- @extends('layouts.app')

@section('content') --}}

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Generar nuevo evento</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'eventos.store', 'method' => 'POST']) !!}

                            {!! Form::label('Cliente', 'Cliente:', []) !!}
                            {!! Form::select('cliente', 
                                $clientes->pluck('nombre', 'id')->toArray(),
                                null, 
                                ['class' => 'form-control', 'placeholder' => 'Seleccione un cliente']) !!}

                            {!! Form::label('tipo', 'Tipo de evento:', []) !!}
                            {!! Form::select('tipo', 
                                $tipoEvento->pluck('evento', 'id')->toArray(),
                                null, 
                                ['class' => 'form-control', 'placeholder' => 'Seleccione un tipo']) !!}

                            {!! Form::label('nombre', 'Nombre del evento:', []) !!}
                            {!! Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre del evento']) !!}

                            {!! Form::label('descripcion', 'Descripcion/Detalles', []) !!}
                            {!! Form::textarea('descripcion', '', ['class' => 'form-control', 'placeholder' => 'Descripcion resumida del evento']) !!}

                            {!! Form::label('organizador', 'Organizador:', []) !!}
                            {!! Form::text('organizador', '', ['class' => 'form-control', 'placeholder' => 'Nombre del organizador o encargado']) !!}

                            {!! Form::label('tipo_menu', 'Tipo de Menú:', []) !!}
                            {!! Form::select('tipo_menu', 
                                $menus->pluck('tipo_menu', 'id')->toArray(),
                                null, 
                                ['class' => 'form-control', 'placeholder' => 'Seleccione una menú']) !!}

                            {!! Form::label('locacion', 'Lugar:', []) !!}
                            {!! Form::select('locacion', 
                                $locaciones->pluck('direccion', 'id')->toArray(),
                                null, 
                                ['class' => 'form-control', 'placeholder' => 'Seleccione una Lugar']) !!}

                            {!! Form::label('requisitos', 'Requisitos:', []) !!}
                            {!! Form::text('requisitos', '', ['class' => 'form-control', 'placeholder' => 'Requistos asistencia']) !!}

                            {!! Form::label('web', 'Sitio web para el evento:', []) !!}
                            {!! Form::text('web', '', ['class' => 'form-control']) !!}

                            {!! Form::label('fecha_inicio', 'Fecha inicio:', []) !!}
                            {!! Form::date('fecha_inicio', '', ['class' => 'form-control']) !!}

                            {!! Form::label('fecha_final', 'Fecha final:', []) !!}
                            {!! Form::date('fecha_final', '', ['class' => 'form-control']) !!}

                            {!! Form::label('hora_inicio', 'Hora inicio:', []) !!}
                            {!! Form::time('hora_inicio', '', ['class' => 'form-control']) !!}

                            {!! Form::label('hora_final', 'Hora final', []) !!}
                            {!! Form::time('hora_final', '', ['class' => 'form-control']) !!}

                            {!! Form::label('costo_organizacion', 'Costo estimado de organizacion del evento', []) !!}
                            {!! Form::number('costo_organizacion', '', ['class' => 'form-control', 'step' => '0.01']) !!}

                            {!! Form::label('cant_participantes', 'Cantidad estimada de invitados:', []) !!}
                            {!! Form::number('cant_participantes', '', ['class' => 'form-control']) !!}

                            {!! Form::label('costo_participante', 'Costo de cada participante/entrada :', []) !!}
                            {!! Form::number('costo_participante', '', ['class' => 'form-control', 'step' => '0.01']) !!}

                            {!! Form::label('presupuesto', 'Presupuesto estimado', []) !!}
                            {!! Form::number('presupuesto', '', ['class' => 'form-control', 'step' => '0.01']) !!}

                            {{-- {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!} --}}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection --}}