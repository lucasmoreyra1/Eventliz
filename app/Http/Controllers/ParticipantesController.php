<?php

namespace App\Http\Controllers;

use App\Models\ingresos_egresos;
use Illuminate\Http\Request;
use App\Models\participante;
use Faker\Core\Number;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\File;

class ParticipantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $participantes = participante::where('id_evento', $id)->get();
        return view('participantes.index', compact('participantes', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $id_evento = $id;
        return view('participantes.create', compact('id_evento'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'id_evento' => 'required|max:255',
            'nombre' => 'required|max:100',
            'apellido' => 'required|max:100',
            'email' => 'required|max:100',
            'telefono' => 'required|int',

        ]);

        $id_evento = $request->input('id_evento');
        // Aquí deberías guardar la locación en la base de datos, por ejemplo:
        participante::create($validatedData);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $participante = participante::find($id);
        $id_evento = $id;
        return view('participantes.create', compact('participante', 'id_evento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'telefono' => '',
            'email' => ''
        ]);

        $participante = participante::find($id);
        if (!$participante) {
            dd($participante);
            // Manejar el caso en que la locación no se encuentre
            return redirect()->route('participantes.index')->with('error', 'participante no encontrado.');
        }

        $participante->nombre = $validatedData['nombre'];
        $participante->apellido = $validatedData['apellido'];
        $participante->telefono = $validatedData['telefono'];
        $participante->email = $validatedData['email'];

        $participante->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $participante = participante::find($id);
        $participante->delete();

        // return redirect()->back();
    }


    public function pagoParticipante(string $id)
    {
        $participante = participante::find($id);
        $participante->pago = 1;

        $participante->update();
    }

    public function generarExcel(string $id_evento)
    {

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados
        $sheet->setCellValue('A1', 'Nombre');
        $sheet->setCellValue('B1', 'Apellido');
        $sheet->setCellValue('C1', 'Telefono');
        $sheet->setCellValue('D1', 'Pago');

        // Agregar datos de ejemplo
        $participantes = $this->buscarPartipantes($id_evento);

        $row = 2;
        foreach ($participantes as $participante) {


            $nombre = $participante->nombre; // Si la dirección no contiene la calle, establece un valor predeterminado en blanco
            $apellido = $participante->apellido;
            $telefono = $participante->telefono;
            $pago = $participante->pago ? "Pago" : "No pago";

            // Ahora, puedes agregar estos valores al objeto PHPExcel
            $sheet->setCellValue('A' . $row, $nombre);
            $sheet->setCellValue('B' . $row, $apellido);
            $sheet->setCellValue('C' . $row, $telefono);
            $sheet->setCellValue('D' . $row, $pago);

            // Incrementa el contador de fila
            $row++;
        }


        $this->verificarCarpeta();
        // Crear el archivo Excel
        $writer = new Xlsx($spreadsheet);
        $archivoPath = storage_path("app/excel/participantes".$id_evento.".xlsx");
        $writer->save($archivoPath);

        return response()->download($archivoPath, 'Participantes.xlsx');
    }

    public function subirExcel(Request $request, string $id_evento)
    {
        
        if ($request->hasFile('archivo_excel')) {
            // Obtener los datos del archivo Excel
            $data = $this->ExcelToArray($request);
    
            // Iterar sobre los datos del Excel (omitimos la primera fila si es el encabezado)
            foreach ($data as $index => $row) {
                // Omitir la primera fila si es el encabezado
                if ($index == 0) {
                    continue;
                }
    
                // Asignar valores a las variables
                $nombre = $row[0]; // Ajusta el índice según la columna en el archivo Excel
                $apellido = $row[1]; // Ajusta el índice según la columna en el archivo Excel
                $telefono = $row[2]; // Ajusta el índice según la columna en el archivo Excel
                $email = $row[3]; // Ajusta el índice según la columna en el archivo Excel
                $pago = $row[4] ? 1 : 0;
    
                // Guardar en la base de datos
                Participante::create([
                    'id_evento' => $id_evento,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'telefono' => $telefono,
                    'email' => $email,
                    'pago' => $pago,
                ]);
            }
    
            return back()->with('success', 'Datos cargados exitosamente.');
        }
    
        return back()->withErrors('No se ha proporcionado ningún archivo Excel.');
    }

    private function ExcelToArray(Request $request)
    {
        $file = $request->file('archivo_excel');

        // Leer el archivo Excel
        $spreadsheet = IOFactory::load($file->getRealPath());
    
        // Obtener la primera hoja de cálculo
        $sheet = $spreadsheet->getActiveSheet();
    
        // Convertir la hoja de cálculo en un array
        $data = $sheet->toArray();
    
        return $data;
    }

    private function buscarPartipantes(string $id_evento)
    {
        $participantes = DB::select("SELECT participantes.* FROM participantes WHERE id_evento = ?", [$id_evento]);

        return $participantes;
    }


    private function verificarCarpeta()
    {
        $carpeta = storage_path("app/excel");

        // Verifica si la carpeta ya existe
        if (!File::exists($carpeta)) {
            // Si no existe, crea la carpeta
            File::makeDirectory($carpeta, 0755, true, true);
        }
    }

    
}
