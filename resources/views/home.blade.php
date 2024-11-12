@extends('layouts.app')

@section('content')
<div class="container-fluid px-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('EVENTOS') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="d-flex flex-wrap align-items-center mb-3">
                        {{-- <a href="{{route('eventos.create')}}" class="btn btn-primary mx-1">Nuevo evento</a> --}}


                        <!-- Button trigger modal -->
                        @if (!isset($banderaAlter))
                            <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#eventoModal">
                                Nuevo evento
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="eventoModal" tabindex="-1" role="dialog" aria-labelledby="eventoModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="eventoModalLabel">Nuevo Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí se cargará el formulario mediante AJAX -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="saveEventoBtn">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#visualizar">
                            Ver evento
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="visualizarLabel" aria-hidden="true" >
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="visualizarLabel">Ver Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí se cargará el formulario mediante AJAX -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-cerrarVis" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button trigger modal -->
                        @if (!isset($banderaAlter))
                            <button type="button" class="btn btn-outline-primary mx-1" data-toggle="modal" data-target="#editar">
                                Modificar evento
                            </button>
                        @endif
                        <!-- Modal -->
                        <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true" data-backdrop="static">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editarLabel">Modificar Evento</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Aquí se cargará el formulario mediante AJAX -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-cerrar" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="editarEventoBtn">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>




                        {{-- <a data-target="#editarEvento" class="btn btn-primary mx-1">Modificar</a> --}}
                        @if (!isset($banderaAlter))
                            <a id="archivarEventoBtn" class="btn btn-outline-danger mx-1">Archivar</a>
                            <a id="finalizarEventoBtn" class="btn btn-outline-success mx-1">Finalizar</a>
                        @endif
                        @if (isset($banderaAlter) && $banderaAlter == true)
                            <a id="activarEventoBtn" class="btn btn-outline-success mx-1">Activar</a>
                        @endif
                        <a id="gestionarParticipantes" class="btn btn-outline-primary mx-1">Participantes</a>
                        <a id="gestionarFondos" class="btn btn-outline-primary mx-1">Ver Fondos</a>



{{--                         <div class="dropdown d-inline mx-1">
                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                Gestionar
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="{{route('locaciones.index')}}">Locaciones</a></li>
                                <li><a class="dropdown-item" href="{{route('menus.index')}}">Menus</a></li>
                                <li><a class="dropdown-item" href="{{route('clientes.index')}}">Clientes</a></li>
                                <li><a class="dropdown-item" href="{{route('tipoEventos.index')}}">Tipo Evento</a></li>
                                <li><a class="dropdown-item" href="{{route('eventos.archivados')}}">Ver Archivados</a></li>
                                <li><a class="dropdown-item" href="{{route('eventos.finalizados')}}">Ver Finalizados</a></li>
                            </ul>
                        </div>
 --}}
{{--                         <form class="d-flex mx-3">
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form> --}}
                    </div>
                    <br>

                    <table class="table  order-column"id="example"style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Nombre evento</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Invitados</th>
                                <th scope="col">Cliente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <div class="container">
                                @foreach ($eventos as $evento)
                                <tr class="evento-row" data-evento-id="{{ $evento->id }}">
                                    <td>{{$evento->nombre}}</td>
                                    <td>{{$evento->fecha_inicio}}</td>
                                    <td>{{$evento->cant_participantes}}</td>
                                    <td>{{$evento->nombreCliente}}</td>
                                </tr>
                                @endforeach
                            </div>
                        </tbody>
                    </table>

                    
                </div>
            </div>
        </div>

        {{-- <div id="containerGraficos"></div> --}}
        @if (!isset($banderaAlter)) 
            {{-- bandera alter se usa para eventos archivados y finalizados que no necesitan grafico --}}
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                      <div class="flex-container" style="display: flex; justify-content: space-between;">
                        @if ($jsonData != "[]")
                        <div id="donutchart" style="width: 30%; height: 500px;"></div>
                        @endif
                        @if ($proximosEventos != "[]")
                          <div id="example2.2" style="width: 70%; height: 180px;"></div>
                        @endif
                      </div>
                  </div>
            </div>

        @endif

{{--           <div class="card">
            <div class="card-body">
              <div class="flex-container">
                  <div id="donutchart"></div>
                  <div id="example2.2"></div>
              </div>
          </div> --}}
        





        <script type="text/javascript">
        google.charts.load('current', {'packages':['timeline'], 'language': 'es'});
        google.charts.setOnLoadCallback(drawChart);
/*         fetch('/eventos/proximos')
        .then(response => response.json())
        .then(data => {
            var proximosEventos = data.map(evento => {
                return [
                    evento[0], // id
                    evento[1], // nombre
                    new Date(0, evento[2].month, evento[2].day), // fecha_inicio
                    new Date(0, evento[3].month, evento[3].day)  // fecha_final
                ];
            });

        }); */
        console.log('paso');
        jsonEventos = <?php if(isset($proximosEventos)) echo $proximosEventos; ?>;
        var proximosEventos = jsonEventos.map(evento => {
                return [
                    evento[0], // id
                    evento[1], // nombre
                    new Date(0, evento[2].month, evento[2].day), // fecha_inicio
                    new Date(0, evento[3].month, evento[3].day)  // fecha_final
                ];
            });

        console.log(proximosEventos);
        console.log([
                    ['1', 'Project A', new Date(0, 0, 1), new Date(0, 0, 7)], // January to April
                    ['2', 'Project B', new Date(0, 0, 1), new Date(0, 0, 3)], // February to May
                    ['3', 'Project C', new Date(0, 0, 1), new Date(0, 0, 30)]  // March to June
                ]);
        google.charts.load("current", { packages: ["timeline"] });
        google.charts.setOnLoadCallback(drawChart);



            function drawChart() {
                var container = document.getElementById('example2.2');
                var chart = new google.visualization.Timeline(container);
                var dataTable = new google.visualization.DataTable();
                dataTable.addColumn({ type: 'string', id: 'Term' });
                dataTable.addColumn({ type: 'string', id: 'Name' });
                dataTable.addColumn({ type: 'date', id: 'Start' });
                dataTable.addColumn({ type: 'date', id: 'End' });
                dataTable.addRows(proximosEventos);
/*                 dataTable.addRows([
                [ '1', 'George Washington', new Date(1789, 3, 30), new Date(1797, 2, 4) ],
                [ '2', 'John Adams',        new Date(1797, 2, 4),  new Date(1801, 2, 4) ],
                [ '3', 'Thomas Jefferson',  new Date(1801, 2, 4),  new Date(1809, 2, 4) ]]); */


                var options = {
                    timeline: {
                    showRowLabels: false,
                    groupByRowLabel: true
                    },
                    hAxis: {
/*                     format: 'dd',
                    gridlines: { count: 3 },
                    minorGridlines: { count: 1 } */
                    }
                };

                chart.draw(dataTable, options);
                }
        </script>

        <script type="text/javascript">
            var phpData = <?php if(isset($jsonData)) echo $jsonData; ?>; //se deberia hacer una funcion asyncronica que consulte los datos
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable(phpData);

            var options = {
                title: 'Principales tipos de eventos',
                pieHole: 0.3,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
            }
        </script>




    </div>
</div>
@endsection
