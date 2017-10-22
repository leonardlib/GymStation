@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 div-panel" id="div-login">
                <form method="POST" action="{{ url('/admin/guardar-usuario') }}">
                    {{ csrf_field() }}

                    <h5 class="text-primary">Cuenta</h5>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">Correo electrónico:</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $usuario->email }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-row">
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-6">
                            <label for="password">Nueva contraseña:</label>
                            <input id="password" type="password" class="form-control" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password-confirm">Confirmar contraseña:</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                        </div>
                    </div>

                    <h5 class="text-primary">Datos Generales</h5>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $usuario->datosUsuario->nombre }}">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="apellido_paterno">Apellido paterno:</label>
                            <input type="text" id="apellido_paterno" name="apellido_paterno" class="form-control" value="{{ $usuario->datosUsuario->apellido_paterno }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="apellido_materno">Apellido materno:</label>
                            <input type="text" id="apellido_materno" name="apellido_paterno" class="form-control" value="{{ $usuario->datosUsuario->apellido_materno }}">
                        </div>
                    </div>
                    @auth
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="select-tipo-cuenta">Elige el tipo de cuenta:</label><br/>
                                <select class="custom-select" id="select-tipo-cuenta" name="select-tipo-cuenta">
                                    @foreach($tiposCuenta as $key => $tipo)
                                        @if($usuario->datosUsuario->tipoCuenta->id == $tipo->id)
                                            <option value="{{ $tipo->id }}" selected>{{ $tipo->tipo }}</option>
                                        @else
                                            <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="select-estatus">Elige el estatus del usuario:</label><br/>
                                <select class="custom-select" id="select-estatus" name="select-estatus">
                                    @foreach($estatus as $key => $est)
                                        @if($usuario->datosUsuario->estatus->id == $est->id)
                                            <option value="{{ $est->id }}" selected>{{ $est->estatus }}</option>
                                        @else
                                            <option value="{{ $est->id }}">{{ $est->estatus }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endauth
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-perfil').parent().addClass('active');
    </script>
@endsection
