@extends('layouts.app')

@section('content')
{{-- <div class="container d-flex justify-content-center"> --}}
<div class="col-md-9">{{-- mx-auto --}}
    <div class="card">
        <div class="card-header">{{ __('PARTICIPANTES') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
                    
            <div>
                <button type="button" class="btn btn-secondary mx-1" onclick="goBack()">
                    Volver
                </button>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary mx-1" data-toggle="modal" data-target="#agregarParticipante" id="botonAgregarParticipante" data-evento-id="{{ $id }}">
                    Agregar Participante
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agregarParticipante" tabindex="-1" role="dialog" aria-labelledby="agregarParticipanteLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarParticipanteLabel">Nuevo Participante</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="saveParticipanteBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarParticipante">
                    Modificar Participante
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editarParticipante" tabindex="-1" role="dialog" aria-labelledby="editarParticipante" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarParticipante">Modificar Participante</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="editarParticipanteBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarParticipante">
                    Eliminar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminarParticipante" tabindex="-1" role="dialog" aria-labelledby="editarParticipante" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarParticipante">Modificar Participante</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Esta seguro que desea eliminar este participante? Esta accion es irreversible </h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-danger" id="eliminarParticipanteBtn">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <a id="realizarPago" class="btn btn-outline-primary mx-1">Informar Pago</a>

                <a id="descargarExcel" class="btn btn-outline-primary mx-1" href="{{ route('participantes.GenerarExcel', $id) }}">Generar Excel</a>

                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#subirExcelParticipante">
                    Subir Excel
                </button>
                <!-- Modal -->
                <div class="modal fade" id="subirExcelParticipante" tabindex="-1" role="dialog" aria-labelledby="editarParticipante" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarParticipante">Cargar archivo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="container mt-3">
                                    <h1 class="mb-4">Subir archivo</h1>
                                    <form action="{{ route('participantes.subirExcel', $id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        
                                        <div class="form-group">
                                            <label for="archivo_excel">Participantes</label>
                                            <input type="file" class="form-control" id="archivo_excel" name="archivo_excel" required>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary" id="subirExcel">Subir</button>
                                    </form>
                                </div>
                                


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <table class="table  order-column"id="example"style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Nombre Usuario</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Email</th>
                        <th scope="col">Abono</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach ($participantes as $participante)
                            <tr class="evento-row" data-evento-id="{{ $participante->id }}">
                                <td>{{$participante->nombre}}</td>
                                <td>{{$participante->apellido}}</td>
                                <td>{{$participante->telefono}}</td>
                                <td>{{$participante->email}}</td>
                                <td>{!! $participante->pago ? "<span style='color: #1d5224; font-size:16px '>Pago</span>" : "<span style='color: #5a221c'>No pago</span>" !!}</td>
                            </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>

        </div>
    </div>
</div>
{{-- </div> --}}

<script>
    function goBack() {
        window.history.back();
    }
</script>

@endsection