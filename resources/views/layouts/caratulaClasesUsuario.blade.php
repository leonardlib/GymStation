@if($usuario->trashed() && $tipo == 'admin')
    <div class="alert alert-danger fade show" id="alerta-eliminado" role="alert">
        Este usuario se encuentra actualmente eliminado.
    </div>
    <a href="{{ url('/admin/recuperar-usuario/' . $usuario->id) }}" class="btn btn-primary">Recuperar usuario</a>
@else
    @if($tipo == 'profesor')
        @foreach($clasesUsuarioInstructor as $key => $clase)
            @include('layouts.caratulaClase3', [
                'clase' => $clase->clase,
                'detalles' => [
                    '0' => 'Pago por clase: $ ' . $clase->clase->pago_profesor,
                    '1' => ''
                ]
            ])
        @endforeach
    @else
        @foreach($clasesUsuarioInstructor as $key => $clase)
            @include('layouts.caratulaClase3', [
                'clase' => $clase->clase,
                'detalles' => [
                    '0' => ($clase->pagada) ? 'Mi clave de asistencia única: ' . $clase->clave_asistencia_unica : '',
                    '1' => $clase->pagada
                ]
            ])
        @endforeach
    @endif
@endif