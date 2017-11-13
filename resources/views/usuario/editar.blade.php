@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2 div-panel" id="div-login">
                @include('layouts.caratulaEditarUsuario', [
                    'usuario' => $usuario,
                    'estatus' => $estatus,
                    'tipo' => 'admin'
                ])
            </div>
        </div>
    </div>
@endsection
