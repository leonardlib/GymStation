<!--
 * Leonardo Lira Becerra
 * Fecha: 21 Octubre 2017
 * Vista de home para administradores
-->

@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ url('/css/admin.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="" id="tab-panel" role="tabpanel">
            <div class="row">
                <div class="col-md-3">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-users-list" data-toggle="tab" href="#list-users" role="tab" aria-controls="list-users" aria-selected="true">Usuarios</a>
                        <a class="list-group-item list-group-item-action" id="list-profes-list" data-toggle="tab" href="#list-profes" role="tab" aria-controls="list-profes" aria-selected="false">Profesores</a>
                        <a class="list-group-item list-group-item-action" id="list-promos-list" data-toggle="tab" href="#list-promos" role="tab" aria-controls="list-promos" aria-selected="false">Promociones</a>
                        <a class="list-group-item list-group-item-action" id="list-clases-list" data-toggle="tab" href="#list-clases" role="tab" aria-controls="list-clases" aria-selected="false">Clases</a>
                    </div>
                </div>
                <div class="col-md-9 panel-contenido">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade active show" id="list-users" role="tabpanel" aria-labelledby="list-users-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nuevo-usuario-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar usuario
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($usuarios as $key => $usuario)
                                    @include('layouts.caratulaUsuario', [
                                        'user' => $usuario,
                                        'ruta' => 'editar-usuario'
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profes" role="tabpanel" aria-labelledby="list-profes-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nuevo-profesor-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar profesor
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($profesores as $key => $profesor)
                                    @include('layouts.caratulaUsuario', [
                                        'user' => $profesor,
                                        'ruta' => 'editar-profesor'
                                    ])
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-promos" role="tabpanel" aria-labelledby="list-promos-list">
                        </div>
                        <div class="tab-pane fade" id="list-clases" role="tabpanel" aria-labelledby="list-clases-list">
                            <button type="button" class="btn btn-success" style="cursor: pointer;" data-toggle="modal" data-target="#nueva-clase-modal">
                                <i class="material-icons" style="vertical-align: middle;">add_circle</i> Agregar clase
                            </button>
                            <br/>
                            <br/>
                            <div class="list-group">
                                @foreach($clases as $key => $clase)
                                    @include('layouts.caratulaClase', [
                                        'clase' => $clase,
                                        'ruta' => 'editar-clase'
                                    ])
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar usuario -->
    <div class="modal fade" id="nuevo-usuario-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="titulo-modal">Nuevo usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger fade show" style="display: none;" id="alerta-info" role="alert">
                        ¡Tienes que completar la información!
                    </div>
                    <form method="POST" action="{{ url('/admin/registro-usuario/') }}" id="form-nuevo-user">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Correo electrónico:</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Contraseña:</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirmar contraseña:</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                    <button type="button" id="btn-guardar-nuevo" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar profesor -->
    <div class="modal fade" id="nuevo-profesor-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="titulo-modal">Nuevo profesor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-profe" role="alert">
                        ¡Tienes que completar la información!
                    </div>
                    <form method="POST" action="{{ url('/admin/registro-profesor/') }}" id="form-nuevo-profesor">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email-profe">Correo electrónico:</label>
                            <input id="email-profe" type="email" class="form-control" name="email-profe" value="{{ old('email') }}" required autofocus>
                            @if (session('errorProfe'))
                                <span class="help-block">
                                    <strong>{{ session('errorProfe') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password-profe">Contraseña:</label>
                            <input id="password-profe" type="password" class="form-control" name="password-profe" required>
                            <span class="help-block" style="display: none;" id="passwords-profe">
                                <strong>Las contraseñas deben coincidir</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="password-confirm-profe">Confirmar contraseña:</label>
                            <input id="password-confirm-profe" type="password" class="form-control" name="password_confirmation-profe" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                    <button type="button" id="btn-guardar-nuevo-profe" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal agregar clase -->
    <div class="modal fade" id="nueva-clase-modal" tabindex="-1" role="dialog" aria-labelledby="titulo-modal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="titulo-modal">Nueva clase</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger fade show" style="display: none;" id="alerta-info-clase" role="alert">
                        ¡Tienes que completar la información!
                    </div>
                    <form method="POST" action="{{ url('/admin/registro-clase/') }}" id="form-nueva-clase">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="nombre-clase">Nombre:</label>
                            <input type="text" id="nombre-clase" name="nombre-clase" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="detalle-clase">Detalles:</label>
                            <textarea type="text" id="detalle-clase" cols="15" style="resize: none;" name="detalle-clase" class="form-control"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cupo-total">Cupo total:</label>
                                <input type="number" min="0" step="1" id="cupo-total" name="cupo-total" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-inicio">Fecha de inicio:</label>
                                <input type="date" id="fecha-inicio" name="fecha-inicio" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-inicio">Hora de inicio:</label>
                                <input type="time" id="hora-inicio" name="hora-inicio" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fecha-fin">Fecha de cierre:</label>
                                <input type="date" id="fecha-fin" name="fecha-fin" class="form-control" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hora-fin">Hora de cierre:</label>
                                <input type="time" id="hora-fin" name="hora-fin" class="form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="cursor: pointer;">Cerrar</button>
                    <button type="button" id="btn-guardar-nueva-clase" style="cursor: pointer;" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');

        @if ($errors->has('email') || $errors->has('password'))
            $('#nuevo-usuario-modal').modal('show');
        @endif

        @if (session('errorProfe'))
            $('#nuevo-profesor-modal').modal('show');
        @endif
        
        $('#btn-guardar-nuevo').on('click', function (evt) {
            var email = $('#email').val();
            var password = $('#password').val();
            var password_con = $('#password-confirm').val();

            if (email == '' || password == '' || password_con == '') {
                $('#alerta-info').css('display', 'block');
            } else {
                $('#alerta-info').css('display', 'none');
                $('#form-nuevo-user').submit();
            }
        });

        $('#btn-guardar-nuevo-profe').on('click', function (evt) {
            var email = $('#email-profe').val();
            var password = $('#password-profe').val();
            var password_con = $('#password-confirm-profe').val();

            if (email == '' || password == '' || password_con == '') {
                $('#alerta-info-profe').css('display', 'block');
            } else if (password != password_con) {
                $('#passwords-profe').css('display', 'block');
            } else {
                $('#alerta-info-profe').css('display', 'none');
                $('#passwords-profe').css('display', 'none');
                $('#form-nuevo-profesor').submit();
            }
        });
        
        $('#btn-guardar-nueva-clase').on('click', function () {
            var nombre = $('#nombre-clase').val();
            var detalles = $('#detalle-clase').val();
            var cupo_total = $('#cupo-total').val();
            var fecha_ini = $('#fecha-inicio').val();
            var fecha_fin = $('#fecha-fin').val();
            var hora_ini = $('#hora-inicio').val();
            var hora_fin = $('#hora-fin').val();

            if (nombre == '' || detalles == '' || cupo_total == '' || fecha_ini == '' || fecha_fin == '' || hora_ini == '' || hora_fin == '') {
                $('#alerta-info-clase').css('display', 'block');
            } else {
                $('#alerta-info-clase').css('display', 'none');
                $('#form-nueva-clase').submit();
            }
        });
    </script>
@endsection