<?php

namespace App\Http\Controllers;

use App\Models\evento;
use App\Models\locaciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LocacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        session(['id_user' => $id_user]);

        $locaciones = locaciones::where('id_user', $id_user)->get();

        return view('locaciones/index', compact('locaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('locaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_user = Auth::id();

        $validatedData = $request->validate([
            'nombre' => 'required|max:255',
            'direccion' => 'required|max:255',
            'ciudad' => 'required|max:255',
            'capacidad' => 'required|integer'
        ]);

        $validatedData['id_user'] = $id_user;
        $validatedData['disponible'] = 1;

        // Aquí deberías guardar la locación en la base de datos, por ejemplo:
        locaciones::create($validatedData);

        return redirect()->route('locaciones.index')->with('success', 'Locación creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $locacion = locaciones::find($id);

        return view('locaciones.edit', compact('locacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos entrantes
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0',
        ]);
    
        // Buscar la locación por su id
        $locacion = locaciones::find($id);
    
        if (!$locacion) {
            // Manejar el caso en que la locación no se encuentre
            return redirect()->route('locaciones.index')->with('error', 'Locación no encontrada.');
        }
    
        // Actualizar los valores de la locación
        $locacion->nombre = $validatedData['nombre'];
        $locacion->direccion = $validatedData['direccion'];
        $locacion->ciudad = $validatedData['ciudad'];
        $locacion->capacidad = $validatedData['capacidad'];
    
        // Guardar los cambios en la base de datos
        $locacion->save();
    
        // Redirigir a una página adecuada con un mensaje de éxito
        return redirect()->route('locaciones.index')->with('success', 'Locación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


        try {

            $eventosAsociados = evento::where('id_locacion', $id)->exists();

            if($eventosAsociados)
            {
                return response()->json(['errors' => []], 422);
            }

            $locacion = locaciones::find($id);
            $locacion->delete();
            return response()->json(['message' => 'Realizado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' =>[]], 422);
        }

    }
}
