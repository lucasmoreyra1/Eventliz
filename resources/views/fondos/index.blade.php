@extends('layouts.app')

@section('content')

<div class="col-md-5">
    <div class="card">
        <div class="card-header">{{ __('PAGOS') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            
                    
            <div>

                <button type="button" class="btn btn-secondary mx-1" onclick="goBack()">
                    Volver
                </button>
                    
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#agregarFondo" id="botonAgregarFondo" data-evento-id="{{ $id }}">
                    Agregar Fondo
                </button>
                <!-- Modal -->
                <div class="modal fade" id="agregarFondo" tabindex="-1" role="dialog" aria-labelledby="agregarFondoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarFondoLabel">Nuevo Fondo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="saveFondoBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
{{--                 <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editarFondo">
                    Modificar Fondo
                </button>
                <!-- Modal -->
                <div class="modal fade" id="editarFondo" tabindex="-1" role="dialog" aria-labelledby="editarFondo" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarFondo">Modificar Fondo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Aquí se cargará el formulario mediante AJAX -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-primary" id="editarFondoBtn">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div> --}}



                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger mx-1" data-toggle="modal" data-target="#eliminarFondo">
                    Eliminar
                </button>
                <!-- Modal -->
                <div class="modal fade" id="eliminarFondo" tabindex="-1" role="dialog" aria-labelledby="editarFondo" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarFondo">Modificar Fondo</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h3>Esta seguro que desea eliminar este fondo? Esta accion es irreversible </h3>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-outline-danger" id="eliminarFondoBtn">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <table class="table  order-column"id="example"style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">fecha</th>
                        <th scope="col">tipo</th>
                        <th scope="col">monto</th>
                        <th scope="col">Descripcion</th>
                    </tr>
                </thead>
                <tbody>
                    <div class="container">
                        @foreach ($fondos as $fondo)
                            <tr class="evento-row" data-evento-id="{{ $fondo->id }}">
                                <td>{{$fondo->fecha}}</td>
                                <td>{{$fondo->tipo}}</td>
                                <td>{{$fondo->monto}}</td>
                                <td>{{$fondo->descripcion}}</td>
                            </tr>
                        @endforeach
                    </div>
                </tbody>
            </table>



        </div>
    </div>
</div>

<div class="col-md-5">
    <div class="card">
        <div class="card-body">
            <div class="flex-container" style="display: flex; justify-content: space-between;">
              @if ($jsonData != "[]")
              <div id="donutchart" style="width: 100%; height: 500px;"></div>
              @endif
            </div>
      </div>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>



<script type="text/javascript">
    var phpData = <?php if(isset($jsonData)) echo $jsonData; ?>; //se deberia hacer una funcion asyncronica que consulte los datos
    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable(phpData);

    var options = {
        title: 'Balance',
        pieHole: 0.3,
    };

    var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart.draw(data, options);
    }
</script>

@endsection