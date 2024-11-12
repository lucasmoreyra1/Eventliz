
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($cliente) ? 'Editar cliente' : 'Nuevo cliente' }}</h1>
    <form action="{{ isset($cliente) ? route('clientes.update', $cliente->id) : route('clientes.store') }}" method="POST">
        @csrf
        @if(isset($cliente))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="nombre">Nombre del cliente</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del cliente" value="{{ isset($cliente) ? $cliente->nombre : '' }}" required>
        </div>
        
        <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" rows="4" placeholder="Telefono del cliente" value="{{ isset($cliente) ? $cliente->telefono : '' }}" required >
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email del cliente" value="{{ isset($cliente) ? $cliente->email : '' }}" required>
        </div>

    </form>
</div>
