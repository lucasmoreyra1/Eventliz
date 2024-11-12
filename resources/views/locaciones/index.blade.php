@extends('layouts.app')

@section('content')

<div class="container-fluid px-3">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('LOCACIONES') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#agregarLocacion">
                            Agregar Locacion
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="agregarLocacion" tabindex="-1" role="dialog" aria-labelledby="agregarLocacionLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="agregarLocacionLabel">Nuevo Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí se cargará el formulario mediante AJAX -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-outline-primary" id="saveLocacionBtn">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarLocacion">
                            Modificar Locacion
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="editarLocacion" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarLabel">Modificar locacion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí se cargará el formulario mediante AJAX -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-outline-primary" id="editarLocacionBtn">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarLocacion">
                            Eliminar
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="eliminarLocacion" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarLabel">Modificar locacion</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h3>Esta seguro que desea eliminar esta locacion? Esta accion es irreversible </h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-outline-danger" id="eliminarLocacionBtn">Eliminar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <br>
                    <table class="table  order-column"id="example"style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Direccion</th>
                                <th scope="col">Ciudad</th>
                                <th scope="col">Capacidad</th>
                                <th scope="col">Disponible</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="container">
                                @foreach ($locaciones as $lugar)
                                <tr class="evento-row" data-evento-id="{{ $lugar->id }}">
                                    <td>{{$lugar->nombre}}</td>
                                    <td>{{$lugar->direccion}}</td>
                                    <td>{{$lugar->ciudad}}</td>
                                    <td>{{$lugar->capacidad}}</td>
                                    <td>{{$lugar->disponible}}</td>
                                </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>


    </div>
</div>

@endsection