@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Perfil de Usuario</h2>
        </div>
        <div class="card-body">
            <div class="text-center mb-4">
                {{-- <img src="{{ $user->profile_picture_url }}" alt="Foto de Perfil" class="profile-pic"> --}}
            </div>
            <div class="form-group mb-3">
                <label for="nombre">Nombre</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $user->name }}" readonly>
                    <button type="button" class="btn btn-outline-secondary mx-1" data-toggle="modal" data-target="#cambiarNombre">{{-- #agregarMenu --}}
                        Cambiar Nombre
                    </button>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <div class="input-group">
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    <button type="button" class="btn btn-outline-secondary mx-1" data-toggle="modal" data-target="#cambiarEmail">{{-- #agregarMenu --}}
                        Cambiar Email
                    </button>
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="created_at">Fecha de Creación de la Cuenta</label>
                <input type="text" class="form-control" id="created_at" name="created_at" value="{{$user->created_at}}" readonly>
            </div>
            <div class="form-group mb-3 text-center">
                <button type="button" class="btn btn-warning mx-1" data-toggle="modal" data-target="#cambiarContraseña">{{-- #agregarMenu --}}
                    Cambiar Contraseña
                </button>
            </div>
{{--             <div class="text-center">
                <button id="eliminarPerfilBtn" class="btn btn-outline-danger">Eliminar Cuenta</button>
            </div> --}}
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="cambiarNombre" tabindex="-1" role="dialog" aria-labelledby="cambiarNombreLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarNombreLabel">Nuevo Nombre de usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <h1 class="mb-4">Cambiar Nombre</h1>
                    <form action="{{ route('perfil.nombre') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="nombre">Nuevo nombre de usuario</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nuevo nombre de usuario"  required>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-primary" id="saveNombreBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="cambiarEmail" tabindex="-1" role="dialog" aria-labelledby="cambiarEmailLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarEmailLabel">Nuevo Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <h1 class="mb-4">Cambiar Email</h1>
                    <form action="{{ route('perfil.email') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email">Nuevo Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa el nuevo email"  required>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-primary" id="saveEmailBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cambiarContraseña" tabindex="-1" role="dialog" aria-labelledby="cambiarContraseñaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cambiarContraseñaLabel">Nueva Contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container mt-3">
                    <h1 class="mb-4">Cambiar Contraseña</h1>
                    <form action="{{ route('perfil.password') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="password">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa la nueva contraseña"  required>
                        </div>

                        <div class="form-group">
                            <label for="confirmPassword">Repetir Contraseña</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Repetir la nueva contraseña"  required>
                        </div>

                    </form>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-outline-primary" id="savePasswordBtn">Guardar</button>
            </div>
        </div>
    </div>
</div>


@endsection