<div class="card col-md-3 tarjeta-promo">
    <div class="card-body">
        <h4 class="card-title">{{ ($clase->nombre) ? $clase->nombre : 'Sin nombre' }}</h4>
        <p class="card-text">
            <small>
                Detalles: {{ ($clase->detalle) ? $clase->detalle : 'Sin detalles' }}
                <br/>
                Cupo: <span id="cupo-clase-{{ $clase->id }}">{{ (($clase->cupo_actual) ? $clase->cupo_actual : '0') . '/' . (($clase->cupo_total) ? $clase->cupo_total : '0') }}</span>
                <br/>
                Costo: $ {{ ($clase->costo) ? $clase->costo : 'Sin asignar' }}
                <br/>
            </small>
            <small class="text-right">
                <strong>Comienza:</strong> {{ ($clase->fecha_inicio) ? date('d/m/Y', strtotime($clase->fecha_inicio)) . ' a las ' . $clase->hora_inicio : 'Sin asignar' }}<br/>
                <strong>Termina:</strong> {{ ($clase->fecha_fin) ? date('d/m/Y', strtotime($clase->fecha_fin)) . ' a las ' . $clase->hora_fin : 'Sin asignar' }}
            </small>
        </p>
        @if(Auth::check() && Auth::user()->datosUsuario->tipoCuenta->id == 1)
            <button type="button" class="btn btn-primary btn-registrar" data-title="{{ $clase->id }}" style="cursor: pointer;" data-toggle="modal" data-target="#nuevo-usuario-clase">
                Registrar usuario/profesor
            </button>
        @elseif(Auth::check())
            <button type="button" class="btn btn-primary btn-registrarme" data-title="{{ $clase->id }}" style="cursor: pointer;">
                Registrarme
            </button>
        @endif
    </div>
</div>