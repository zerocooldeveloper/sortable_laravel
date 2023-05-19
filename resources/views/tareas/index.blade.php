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
                                <button type="button" class="btn btn-primary"  data-taskid="{{ $tarea->id }}">
                                    Comentarios
                                </button>
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
                                <button type="button" class="btn btn-primary"  data-taskid="{{ $tarea->id }}">
                                    Comentarios
                                </button>
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
                                <button type="button" class="btn btn-primary"  data-taskid="{{ $tarea->id }}">
                                    Comentarios
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div id="dialog-form" title="Crear nuevo comentario">
        <div id="comentarios"></div>
        <form>
            <input type="hidden" id="task-id" >
            <fieldset>
                <label for="comentario">Comentario</label>
                <textarea id="comentario" name="comentario" class="text ui-widget-content ui-corner-all"></textarea>

                <!-- Allow form submission with keyboard without duplicating the dialog button -->
                <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
            </fieldset>
        </form>
    </div>

@endsection
@push('scripts')
    <script>

        $(document).ready(function() {
            var dialog = $('#dialog-form').dialog({
                autoOpen: false,
                height: 400,
                width: 350,
                modal: true,
                buttons: {
                    "Agregar comentario": function() {
                        let comentario = $('#comentario').val();
                        let taskId = $('#task-id').val();
                        $.ajax({
                            url: '/tareas/' + taskId + '/comentarios',
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                body: comentario
                            },
                            success: function(){
                                // Aquí puedes hacer algo después de que el comentario se haya creado, como recargar los comentarios.
                                loadComments(taskId);
                                $('#comentario').val('');
                            }
                        });

                    },
                    Cancelar: function() {
                        dialog.dialog("close");
                    }
                },
                close: function() {
                    // Aquí es donde limpiarías el formulario
                    // Por ejemplo, podrías hacer algo como esto:
                    // $('#form-id')[0].reset();
                }
            });

            $(".btn").on( "click", function() {
                let taskId = $(this).data('taskid');
        $('#task-id').val(taskId);
                // Aquí haríamos la llamada AJAX para obtener los comentarios
                $.ajax({
                    url: '/tareas/' + taskId +'/comentarios',
                    method: 'GET',
                    success: function(data) {
                        // Suponiendo que 'data' es una lista de comentarios, los insertaríamos en el diálogo
                        let comentariosHtml = '';
                        for(let comentario of data) {
                            comentariosHtml += '<p>' + comentario.body + '</p>';
                        }
                        $('#comentarios').html(comentariosHtml);
                    }
                });

                $("#dialog-form").dialog("open");
            });



            function loadComments(taskId) {
                $.get('/tareas/' + taskId + '/comentarios', function(data) {
                    $('#comentarios').empty();
                    for (let i = 0; i < data.length; i++) {
                        $('#comentarios').append('<p>' + data[i].body + '</p>');
                    }
                });
            }


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
