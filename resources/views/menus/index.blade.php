@extends('layouts.app')

@section('content')

<div class="col-md-4">
    <div class="card">
        <div class="card-header">{{ __('MENUS') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
                    
            <div>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#agregarMenu">
                    Agregar Menu
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agregarMenu" tabindex="-1" role="dialog" aria-labelledby="agregarMenuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarMenuLabel">Nuevo Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="saveMenuBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarMenu">
                    Modificar Menu
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editarMenu" tabindex="-1" role="dialog" aria-labelledby="editarMenu" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarMenu">Modificar Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="editarMenuBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarMenu">
                    Eliminar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminarMenu" tabindex="-1" role="dialog" aria-labelledby="editarMenu" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarMenu">Modificar Menu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Esta seguro que desea eliminar este menu? Esta accion es irreversible </h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-danger" id="eliminarMenuBtn">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <table class="table  order-column"id="example"style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Tipo menu</th>
                        <th scope="col">Costo</th>
                        <th scope="col">Contenido</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach ($menus as $menu)
                            <tr class="evento-row" data-evento-id="{{ $menu->id }}">
                                <td>{{$menu->tipo_menu}}</td>
                                <td>{{$menu->costo}}</td>
                                <td>{{$menu->contenido}}</td>
                            </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection