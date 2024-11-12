@extends('layouts.app')

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header">{{ __('TIPO EVENTOS') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
                    
            <div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#agregarTipoEvento">
                    Agregar Tipo Evento
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agregarTipoEvento" tabindex="-1" role="dialog" aria-labelledby="agregarTipoEventoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarTipoEventoLabel">Nuevo Tipo Evento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="saveTipoEventoBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarTipoEvento">
                    Modificar Tipo evento
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editarTipoEvento" tabindex="-1" role="dialog" aria-labelledby="editarTipoEvento" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarTipoEvento">Modificar TipoEvento</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="editarTipoEventoBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarTipoEvento">
                    Cambiar estado
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminarTipoEvento" tabindex="-1" role="dialog" aria-labelledby="eliminar_TipoEvento" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminar_TipoEvento">Cambiar Estado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Esta seguro que desea cambiar el estado?</h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-danger" id="eliminarTipoEventoBtn">Cambiar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <table class="table  order-column"id="example"style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Evento</th>
                        <th scope="col">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach ($tipoEventos as $tipoEvento)
                            <tr class="evento-row" data-evento-id="{{ $tipoEvento->id }}">
                                <td>{{$tipoEvento->evento}}</td>
                                <td>{!! $tipoEvento->activo ? "<span style='color: #1d5224; font-size:16px '>Activo</span>" : "<span style='color: #5a221c'>Inactivo</span>" !!}</td>
                            </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection