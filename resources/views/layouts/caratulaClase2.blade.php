<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ ($clase->nombre) ? $clase->nombre : 'Sin nombre' }}</h4>
        <p class="card-text">
            <small>
                Detalles: {{ ($clase->detalle) ? $clase->detalle : 'Sin detalles' }}
                <br/>
                Cupo: {{ (($clase->cupo_actual) ? $clase->cupo_actual : '0') . '/' . (($clase->cupo_total) ? $clase->cupo_total : '0') }}
                <br/>
                <br/>
            </small>
            <small class="text-right">
                <strong>Comienza:</strong> {{ ($clase->fecha_inicio) ? date('d/m/Y', strtotime($clase->fecha_inicio)) . ' a las ' . $clase->hora_inicio : 'Sin asignar' }}<br/>
                <strong>Termina:</strong> {{ ($clase->fecha_fin) ? date('d/m/Y', strtotime($clase->fecha_fin)) . ' a las ' . $clase->hora_fin : 'Sin asignar' }}
            </small>
        </p>
        @if(Auth::check())
            <a href="#" class="btn btn-primary">Registrarme</a>
        @endif
    </div>
</div>