<a href="{{ url('/admin/'. $ruta .'/' . $user->usuario->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
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