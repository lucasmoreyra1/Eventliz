
<div class="container mt-3">
    <h1 class="mb-4">{{ isset($menu) ? 'Editar Menú' : 'Crear Menú' }}</h1>
    <form action="{{ isset($menu) ? route('menus.update', $menu->id) : route('menus.store') }}" method="POST">
        @csrf
        @if(isset($menu))
            @method('PUT')
        @endif
        
        <div class="form-group">
            <label for="tipo_menu">Tipo de Menú</label>
            <input type="text" class="form-control" id="tipo_menu" name="tipo_menu" placeholder="Ingresa el tipo de menú" value="{{ isset($menu) ? $menu->tipo_menu : '' }}" required>
        </div>
        
        <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea class="form-control" id="contenido" name="contenido" rows="4" placeholder="Describe el contenido del menú" required>{{ isset($menu) ? $menu->contenido : '' }}</textarea>
        </div>
        
        <div class="form-group">
            <label for="costo">Costo</label>
            <input type="number" class="form-control" id="costo" name="costo" placeholder="Ingresa el costo del menú" value="{{ isset($menu) ? $menu->costo : '' }}" required>
        </div>
        
        {{-- <button type="submit" class="btn btn-primary">{{ isset($menu) ? 'Actualizar' : 'Crear' }}</button> --}}
    </form>
</div>
