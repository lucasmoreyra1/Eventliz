<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models;
use App\Models\clientes;
use App\Models\evento;
use App\Models\menu;
use App\Models\locaciones;
use App\Models\tipos_eventos;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class eventosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id_user = Auth::id();
        session(['id_user' => $id_user]);

        $eventos = evento::where('eventos.id_user', $id_user)
                        ->where('estado', '=', 'i')
                        ->join('clientes',  'eventos.id_cliente', '=', 'clientes.id')
                        ->select(
                            'eventos.*',
                            'clientes.nombre as nombreCliente'
                            )
                        ->get();

        $jsonData = $this->consultarGraficos();
        $proximosEventos = $this->proximosEventos();

        return view('home', compact('eventos', 'jsonData', 'proximosEventos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $id_user = Auth::id();
        $menus = menu::where('id_user', $id_user)->get();
        $locaciones = locaciones::where('id_user', $id_user)->get();
        $clientes = clientes::where('id_user', $id_user)->get();
        $tipoEvento = tipos_eventos::where('id_user', $id_user)
                                    ->where('activo', 1)
                                    ->get();

        return view('eventos.create', compact('menus', 'locaciones', 'clientes', 'tipoEvento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            // $validator = Validator::make($request->all(), [
            $validatedData = $request->validate([
                'nombre' => 'required|string|between:3,99',
                'descripcion' => 'required|string|between:3,500',
                'organizador' => 'nullable|string|between:1,80',
                'requisitos' => 'nullable|string|between:1,255',
                'web' => 'nullable|string|between:1,80',
                'fecha_inicio' => 'required|string|between:1,80|before_or_equal:fecha_final',
                'fecha_final' => 'nullable|string|between:1,80|after_or_equal:fecha_inicio',
                'hora_inicio' => 'required|string|between:1,80',
                'hora_final' => 'nullable|string|between:1,80',
                'costo_organizacion' => 'nullable|string|between:1,13',
                'cant_participantes' => 'nullable|string|between:1,13',
                'costo_participante' => 'nullable|string|between:1,13',
                'presupuesto' => 'nullable|string|between:1,13',
                'cliente' => 'required|exists:clientes,id', // Validación para cliente
                'tipo' => 'required|exists:tipos_eventos,id', // Validación para tipo
                'tipo_menu' => 'required|exists:menus,id', // Validación para menú
                'locacion' => 'required|exists:locaciones,id', // Validación para locación
            ]);


/*             $validator->after(function ($validator) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_final')) {
                    $fechaInicio = Carbon::parse($request->input('fecha_inicio'));
                    $fechaFinal = Carbon::parse($request->input('fecha_final'));
        
                    if ($fechaFinal->lessThanOrEqualTo($fechaInicio)) {
                        $validator->errors()->add('fecha_final', 'La fecha final debe ser mayor que la fecha de inicio.');
                    }
                }
            });
        
            // Verificar si la validación falla
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } */
            // Crear una nueva instancia del modelo Evento
            $evento = new Evento();
            $evento->id_user = session('id_user');
            $evento->id_cliente = $validatedData['cliente'];
            $evento->id_tipo = $validatedData['tipo'];
            $evento->nombre = $validatedData['nombre'];
            $evento->descripcion = $validatedData['descripcion'];
            $evento->organizador = $validatedData['organizador'];
            $evento->id_menu = $validatedData['tipo_menu'];
            $evento->id_locacion = $validatedData['locacion'];
            $evento->requisitos = $validatedData['requisitos'];
            $evento->web = $validatedData['web'];
            $evento->fecha_inicio = $validatedData['fecha_inicio'];
            $evento->fecha_final = $validatedData['fecha_final'];
            $evento->hora_inicio = $validatedData['hora_inicio'];
            $evento->hora_final = $validatedData['hora_final'];
            $evento->costo_organizacion = $validatedData['costo_organizacion'] == null ? 0 : $validatedData['costo_organizacion'];
            $evento->cant_participantes = $validatedData['cant_participantes'] == null ? 0 : $validatedData['cant_participantes'];
            $evento->costo_participante = $validatedData['costo_participante'] == null ? 0 : $validatedData['costo_participante'];
            $evento->presupuesto_evento = $validatedData['presupuesto'] == null ? 0 : $validatedData['presupuesto'];
            $evento->estado = 'i'; // Estado inicial

            // Guardar el evento en la base de datos
            $evento->save();
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
        // $evento = evento::findOrFail($id);
        
        $evento  = DB::select('SELECT 
                                eventos.nombre,
                                eventos.descripcion,
                                eventos.organizador, 
                                eventos.requisitos, 
                                eventos.web,
                                eventos.fecha_inicio,
                                eventos.fecha_final,
                                eventos.hora_inicio,
                                eventos.hora_final,
                                eventos.costo_organizacion,
                                eventos.cant_participantes, 
                                eventos.costo_participante,
                                eventos.presupuesto_evento,
                                menus.tipo_menu,
                                locaciones.direccion,
                                clientes.nombre as cliente,
                                tipos_eventos.evento
                                FROM eventos
                                JOIN menus on eventos.id_menu = menus.id
                                JOIN locaciones on eventos.id_locacion = locaciones.id
                                JOIN clientes on eventos.id_cliente = clientes.id
                                JOIN tipos_eventos on eventos.id_tipo = tipos_eventos.id
                                WHERE eventos.id = ?
                                ',[$id]);
        
        return view('eventos.show', compact('evento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evento = Evento::find($id); // Encuentra un solo evento por su ID
        $id_user = Auth::id();
        $menus = menu::where('id_user', $id_user)->get();
        $locaciones = locaciones::where('id_user', $id_user)->get();
        $clientes = clientes::where('id_user', $id_user)->get();
        $tipoEventos = tipos_eventos::where('id_user', $id_user)
                                    ->where('activo', 1)
                                    ->get();

        // Pasa el evento a la vista
        return view('eventos.edit', compact('evento','menus', 'locaciones', 'clientes', 'tipoEventos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $evento = Evento::findOrFail($id);

            $validatedData = $request->validate([
                'nombre' => 'required|string|between:3,99',
                'descripcion' => 'required|string|between:3,500',
                'organizador' => 'nullable|string|between:1,80',
                'requisitos' => 'nullable|string|between:1,255',
                'web' => 'nullable|string|between:1,80',
                'fecha_inicio' => 'required|string|between:1,80',
                'fecha_final' => 'nullable|string|between:1,80',
                'hora_inicio' => 'required|string|between:1,80',
                'hora_final' => 'nullable|string|between:1,80',
                'costo_organizacion' => 'nullable|string|between:1,80',
                'cant_participantes' => 'nullable|string|between:1,80',
                'costo_participante' => 'nullable|string|between:1,80',
                'presupuesto' => 'nullable|string|between:1,80',
                'cliente' => 'required|exists:clientes,id', // Validación para cliente
                'tipo' => 'required|exists:tipos_eventos,id', // Validación para tipo
                'tipo_menu' => 'required|exists:menus,id', // Validación para menú
                'locacion' => 'required|exists:locaciones,id', // Validación para locación
            ]);



            $evento->id_user = session('id_user');
            $evento->id_cliente = $validatedData['cliente'];
            $evento->id_tipo = $validatedData['tipo'];
            $evento->nombre = $validatedData['nombre'];
            $evento->descripcion = $validatedData['descripcion'];
            $evento->organizador = $validatedData['organizador'];
            $evento->id_menu = $validatedData['tipo_menu'];
            $evento->id_locacion = $validatedData['locacion'];
            $evento->requisitos = $validatedData['requisitos'];
            $evento->web = $validatedData['web'];
            $evento->fecha_inicio = $validatedData['fecha_inicio'];
            $evento->fecha_final = $validatedData['fecha_final'];
            $evento->hora_inicio = $validatedData['hora_inicio'];
            $evento->hora_final = $validatedData['hora_final'];
            $evento->costo_organizacion = $validatedData['costo_organizacion'] == null ? 0 : $validatedData['costo_organizacion'];
            $evento->cant_participantes = $validatedData['cant_participantes'] == null ? 0 : $validatedData['cant_participantes'];
            $evento->costo_participante = $validatedData['costo_participante'] == null ? 0 : $validatedData['costo_participante'];
            $evento->presupuesto_evento = $validatedData['presupuesto'] == null ? 0 : $validatedData['presupuesto'];


            // $evento->update($validateData);
            $evento->update();
            return response()->json(['message' => 'Realizado con exito.'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function verArchivados()
    {
        $id_user = Auth::id();

        $eventos = evento::where('id_user', $id_user)
                    ->where('estado', 'a')
                    ->get();

        $banderaAlter = true; //se usa para verificar si es un evento archivado o finalizado, true = archivado

        return view('home', compact('eventos', 'banderaAlter'));
    }

    public function verFinalizados()
    {
        $id_user = Auth::id();

        $eventos = evento::where('id_user', $id_user)
                    ->where('estado', 'f')
                    ->get();

        $banderaAlter = false; //se usa para verificar si es un evento archivado o finalizado, false = finalizado

        return view('home', compact('eventos', 'banderaAlter'));
    }

    public function archivar(string $id)
    {
        $evento = Evento::findOrFail($id);

        $evento->estado = 'a'; //archivado

        $res = $evento->update();

        return $res;
    }

    public function finalizar(string $id)
    {
        $evento = Evento::findOrFail($id);

        $evento->estado = 'f'; //archivado

        $res = $evento->update();

        return $res;
    }


    public function activar(string $id)
    {
        $evento = Evento::findOrFail($id);

        $evento->estado = 'i'; //iniciado

        $res = $evento->update();

        return $res;
    }

    function consultarGraficos()
    {

        $id_user = Auth::id();

        $graficoEventos =  DB::select('SELECT tipos_eventos.evento, COUNT(eventos.id) AS eventoscant 
        FROM eventos 
        INNER JOIN tipos_eventos ON eventos.id_tipo = tipos_eventos.id 
        WHERE eventos.id_user = ?
        GROUP BY tipos_eventos.evento', [$id_user]);

        $graficoFinal = [['Tipo evento', 'Cantidad Realizada']];

        foreach ($graficoEventos as $eventoTipo) {
        $graficoFinal[] = [$eventoTipo->evento, (int)$eventoTipo->eventoscant];
        }

        $jsonData = json_encode($graficoFinal);

        return $jsonData;
    }

    public function proximosEventos()
    {
        $user  = Auth::id();
        // Obtener los eventos de la base de datos
        $eventos = DB::table('eventos')
            ->select('id', 'nombre', 'fecha_inicio', 'fecha_final')
            ->where('id_user', $user)
            ->where('estado', '=', 'i')
            ->whereBetween('fecha_inicio', [now(), now()->addDays(60)])
            ->get();

        // Formatear los datos
        $eventosFormateados = $eventos->map(function ($evento) {
            $fechaInicio = new \DateTime($evento->fecha_inicio);
            $fechaFinal = new \DateTime($evento->fecha_final);

            return [
                (string)$evento->id,
                $evento->nombre,
                [
                    'month' => $fechaInicio->format('m') - 1,
                    'day' => $fechaInicio->format('d')
                ],
                [
                    'month' => $fechaFinal->format('m') - 1,
                    'day' => $fechaFinal->format('d')
                ]
            ];
        });

        // dd($eventosFormateados);
        // Devolver los datos en formato JSON
        // return response()->json($eventosFormateados);
        return json_encode($eventosFormateados);
    }


}
