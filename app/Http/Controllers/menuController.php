<?php

namespace App\Http\Controllers;

use App\Models\evento;
use App\Models\menu;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class menuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        session(['id_user' => $id_user]);

        $menus = menu::where('id_user', $id_user)->get();

        return view('menus/index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_user = Auth::id();

        $validatedData = $request->validate([
            'tipo_menu' => 'required|max:255',
            'contenido' => 'required|max:600',
            'costo' => 'required|integer'
        ]);

        $validatedData['id_user'] = $id_user;

        // Aquí deberías guardar la locación en la base de datos, por ejemplo:
        menu::create($validatedData);

        return redirect()->route('menus.index')->with('success', 'Menu creado exitosamente.');
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
        $menu = menu::find($id);

        return view('menus.create', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'tipo_menu' => 'required|max:255',
            'contenido' => 'required|max:600',
            'costo' => 'required|integer'
        ]);

        $menu = menu::find($id);
        if (!$menu) {
            // Manejar el caso en que la locación no se encuentre
            return redirect()->route('menus.index')->with('error', 'Menu no encontrado.');
        }

        $menu->tipo_menu = $validatedData['tipo_menu'];
        $menu->contenido = $validatedData['contenido'];
        $menu->costo = $validatedData['costo'];

        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $eventosAsociados = evento::where('id_menu', $id)->exists();

            if($eventosAsociados)
            {
                return response()->json(['errors' => []], 422);
            }

            $menu = menu::find($id);
            $menu->delete();
            return response()->json(['message' => 'Realizado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' =>[]], 422);
        }
    }
}
