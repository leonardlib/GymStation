@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 div-panel" id="div-login">
                <form method="POST" action="{{ route('login') }}">
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
                    <button type="submit" style="cursor: pointer;" class="btn btn-primary">Iniciar sesión</button>
                    <a class="btn btn-link" href="{{ route('register') }}">¿Aún no tienes cuenta?</a>
                    <a class="btn btn-link text-dark" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#barra-login').parent().addClass('active');
    </script>
@endsection
