<!-- Vista: tareas/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Entrada
                    </div>
                    <div id="entrada" class="list-group">
                        @foreach ($entrada as $tarea)
                            <div class="list-group-item" data-id="{{ $tarea->id }}">
                                {{ $tarea->titulo }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Proceso
                    </div>
                    <div id="proceso" class="list-group">
                        @foreach ($proceso as $tarea)
                            <div class="list-group-item" data-id="{{ $tarea->id }}">
                                {{ $tarea->titulo }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Completada
                    </div>
                    <div id="completada" class="list-group">
                        @foreach ($completada as $tarea)
                            <div class="list-group-item" data-id="{{ $tarea->id }}">
                                {{ $tarea->titulo }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.list-group').sortable({
                connectWith: '.list-group',
                stop: function(event, ui) {
                    let tareaId = ui.item.data('id');
                    let estado = ui.item.parent().attr('id');

                    $.ajax({
                        url: '/tareas/' + tareaId,
                        method: 'PUT',
                        data: {
                            estado: estado,
                            orden: ui.item.index() // Esto obtendrá la posición actual de la tarea en la nueva lista.
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }
            });
        });

    </script>
@endpush
