<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        $user = User::find($id_user);
        // dd($user);
        return view('perfil.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cambiarNombre(Request $request)
    {

        try {
            $validatedData = $request->validate([
                'nombre' => 'required|max:30',
            ]);
    
            $id = Auth::id();
    
            $user = User::find($id);
    
            $user->name = $validatedData['nombre'];
    
            $user->save();
            return response()->json(['message' => 'Nombre cambiado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
    
    public function cambiarEmail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => 'required|max:100',
            ]);
            $id = Auth::id();

            $user = User::find($id);
    
            $user->email = $validatedData['email'];
    
            $user->save();
            return response()->json(['message' => 'Email cambiado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }


    }

    public function cambiarPassword(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'password' => 'required|min:8',
                'confirmPassword' => 'required|min:8|same:password',
            ], [
                'confirmPassword.same' => 'La confirmación de la contraseña no coincide.',
            ]);
    
            $id = Auth::id();
            $user = User::find($id);
    
            $passwordHash = Hash::make($validatedData['password']);
            $user->password = $passwordHash;
    
            $user->save();
    
            return response()->json(['message' => 'La contraseña ha sido cambiada con éxito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }
}
