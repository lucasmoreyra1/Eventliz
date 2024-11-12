<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Models\evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();

        $clientes = clientes::where('id_user', $id_user)->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $id_user = Auth::id();

            $validatedData = $request->validate([
                'nombre' => 'required|max:100',
                'telefono' => 'required|integer',
                'email' => 'required|max:100'
            ]);
    
            $validatedData['id_user'] = $id_user;
    
            // Aquí deberías guardar la locación en la base de datos, por ejemplo:
            clientes::create($validatedData);
            return response()->json(['message' => 'Realizado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }


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
        $cliente = clientes::find($id);

        return view('clientes.create', compact('cliente'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:100',
            'telefono' => 'required|integer',
            'email' => 'required|max:100'
        ]);

        $cliente = clientes::find($id);
        if (!$cliente) {
            // Manejar el caso en que la locación no se encuentre
            return redirect()->route('clientes.index')->with('error', 'Cliente no encontrado.');
        }

        $cliente->nombre = $validatedData['nombre'];
        $cliente->email = $validatedData['email'];
        $cliente->telefono = $validatedData['telefono'];

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $eventosAsociados = evento::where('id_cliente', $id)->exists();

            if($eventosAsociados)
            {
                return response()->json(['errors' => []], 422);
            }


            $cliente = clientes::find($id);

            $cliente->delete();
            return response()->json(['message' => 'Realizado  con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }

}
