<?php

namespace App\Http\Controllers;

use App\Models\ingresos_egresos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IngresoEgresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $fondos = ingresos_egresos::where('id_evento', $id)->get();
        $jsonData = $this->consultarGraficos($id);
        return view('fondos.index', compact('fondos', 'id', 'jsonData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id_evento = $id;
        return view('fondos.create', compact('id_evento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_evento' => 'required',
            'tipo' => 'required|in:Ingreso,Egreso',
            'descripcion' => 'required|max:255',
            'monto' => 'required|int',
            'fecha' => 'required|date',

        ]);

        if ($validatedData['tipo'] === 'Ingreso') {
            $validatedData['tipo'] = 'I';
        } elseif ($validatedData['tipo'] === 'Egreso') {
            $validatedData['tipo'] = 'E';
        }

        $id_evento = $request->input('id_evento');
        // Aquí deberías guardar la locación en la base de datos, por ejemplo:
        ingresos_egresos::create($validatedData);

        return redirect()->back();
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
        $fondo = ingresos_egresos::find($id);
        $fondo->delete();
    }


    function consultarGraficos(string $id_evento)
    {


        // Realizar la consulta a la base de datos para obtener la suma de ingresos y egresos
        $resultadosPagos = DB::select('
            SELECT 
                tipo,
                SUM(monto) AS total
            FROM pagos
            WHERE id_evento = ?
            GROUP BY tipo
        ', [$id_evento]);

        // Formatear los datos para el donut chart
        $datosGrafico = [['Tipo', 'Monto']];

        foreach ($resultadosPagos as $pago) {
            $tipo = $pago->tipo === 'I' ? 'Ingreso' : 'Egreso';
            $datosGrafico[] = [$tipo, (float)$pago->total];
        }

        // Codificar los datos en JSON y retornarlos
        $jsonData = json_encode($datosGrafico);

        return $jsonData;
    }
}
