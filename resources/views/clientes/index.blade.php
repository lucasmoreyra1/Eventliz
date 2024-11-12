@extends('layouts.app')

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header">{{ __('CLIENTES') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
                    
            <div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#agregarCliente">
                    Agregar Cliente
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agregarCliente" tabindex="-1" role="dialog" aria-labelledby="agregarClienteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarClienteLabel">Nuevo Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="saveClienteBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarCliente">
                    Modificar Cliente
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editarCliente" tabindex="-1" role="dialog" aria-labelledby="editarCliente" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarCliente">Modificar Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="editarClienteBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarCliente">
                    Eliminar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminarCliente" tabindex="-1" role="dialog" aria-labelledby="eliminarCliente" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eliminarCliente">Eliminar Cliente</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Esta seguro que desea eliminar este Cliente? Esta accion es irreversible </h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-danger" id="eliminarClienteBtn">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <table class="table  order-column"id="example"style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Fecha Creacion</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">

                        @foreach ($clientes as $cliente)
                            <tr class="evento-row" data-evento-id="{{ $cliente->id }}">
                                <td>{{$cliente->nombre}}</td>
                                <td>{{$cliente->telefono}}</td>
                                <td>{{$cliente->email}}</td>
                                <td>{{$cliente->created_at->format('d-m-Y')}}</td>
                            </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection