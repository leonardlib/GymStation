<a class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ ($clase->nombre) ? $clase->nombre : 'Sin nombre' }}</h5>
        <small class="text-right">
            <strong>Comienza:</strong> {{ ($clase->fecha_inicio) ? date('d/m/Y', strtotime($clase->fecha_inicio)) . ' a las ' . $clase->hora_inicio : 'Sin asignar' }}<br/>
            <strong>Termina:</strong> {{ ($clase->fecha_fin) ? date('d/m/Y', strtotime($clase->fecha_fin)) . ' a las ' . $clase->hora_fin : 'Sin asignar' }}
        </small>
    </div>
    <!--<p class="mb-1"></p>-->
    <small>
        Detalles: {{ ($clase->detalle) ? $clase->detalle : 'Sin detalles' }}
        <br/>
        Cupo: {{ (($clase->cupo_actual) ? $clase->cupo_actual : '0') . '/' . (($clase->cupo_total) ? $clase->cupo_total : '0') }}
        <br/>
        Costo: $ {{ ($clase->costo) ? $clase->costo : 'Sin asignar' }}
        <br/>
        {{ $detalles }}
        <br/>
        <br/>
        @if($clase->trashed())
            <i class="material-icons text-danger" title="Vencida">check_circle</i>
        @else
            <i class="material-icons text-success" title="Activa">check_circle</i>
        @endif
    </small>
</a>