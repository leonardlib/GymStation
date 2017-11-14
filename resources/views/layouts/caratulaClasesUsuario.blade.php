@if($usuario->trashed() && $tipo == 'admin')
    <div class="alert alert-danger fade show" id="alerta-eliminado" role="alert">
        Este usuario se encuentra actualmente eliminado.
    </div>
    <a href="{{ url('/admin/recuperar-usuario/' . $usuario->id) }}" class="btn btn-primary">Recuperar usuario</a>
@else
    
@endif