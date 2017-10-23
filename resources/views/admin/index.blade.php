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
                                @foreach($usuarios as $key => $user)
                                    <a href="{{ url('/admin/editar-usuario/' . $user->usuario->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ ($user->nombre) ? $user->nombre : 'Sin nombre' }}</h5>
                                            <small>
                                                @if($user->trashed())
                                                    <i class="material-icons text-danger">account_circle</i>
                                                @else
                                                    <i class="material-icons text-success">account_circle</i>
                                                @endif
                                            </small>
                                        </div>
                                        <!--<p class="mb-1"></p>-->
                                        <small>
                                            Nombre completo: {{ ($user->nombre) ? $user->nombre . ' ' . $user->apellido_paterno . ' ' . $user->apellido_materno : 'Sin nombre' }}
                                            <br/>
                                            Correo: {{ $user->usuario->email }}
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="list-profes" role="tabpanel" aria-labelledby="list-profes-list">
                        </div>
                        <div class="tab-pane fade" id="list-promos" role="tabpanel" aria-labelledby="list-promos-list">
                        </div>
                        <div class="tab-pane fade" id="list-clases" role="tabpanel" aria-labelledby="list-clases-list">
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
                    <form method="POST" action="{{ url('/admin/registro-usuario/' . 2) }}" id="form-nuevo-user">
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

    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');

        @if ($errors->has('email') || $errors->has('password'))
            $('#nuevo-usuario-modal').modal('show');
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
    </script>
@endsection