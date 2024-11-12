<?php

namespace App\Http\Controllers;

use App\Models\tipos_eventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TipoEventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $id_user = Auth::id();
        $tipoEventos = tipos_eventos::where('id_user', $id_user)->get();

        return view('tipo_evento.index', compact('tipoEventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_evento.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::id();

        $validateData = $request->validate
        ([
            "evento" => "required|max:255"
        ]);

        $validateData['id_user'] = $user;
        $validateData['activo'] = 1;

        tipos_eventos::create($validateData);

        return redirect()->route('tipoEventos.index')->with('success', 'Tipo evento creado exitosamente.');
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
        $tipoEvento = tipos_eventos::find($id);
        return view('tipo_evento.create', compact('tipoEvento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'evento' => 'required|max:50',
        ]);

        $tipoEvento = tipos_eventos::find($id);
        if (!$tipoEvento) {
            // Manejar el caso en que la locación no se encuentre
            return redirect()->route('participantes.index')->with('error', 'participante no encontrado.');
        }

        $tipoEvento->evento = $validatedData['evento'];

        $tipoEvento->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $tipoEvento = tipos_eventos::find($id);
            $tipoEvento->activo = !$tipoEvento->activo;
            $tipoEvento->save();
            return response()->json(['message' => 'Realizado  con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
