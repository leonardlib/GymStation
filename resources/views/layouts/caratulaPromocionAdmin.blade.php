<a href="{{ url('/admin/'. $ruta .'/' . $promocion->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ ($promocion->nombre) ? $promocion->nombre : 'Sin nombre' }}</h5>
        <small class="text-right">
            <strong>Comienza:</strong> {{ ($promocion->fecha_inicio) ? date('d/m/Y', strtotime($promocion->fecha_inicio)) . ' a las ' . $promocion->hora_inicio : 'Sin asignar' }}<br/>
            <strong>Termina:</strong> {{ ($promocion->fecha_fin) ? date('d/m/Y', strtotime($promocion->fecha_fin)) . ' a las ' . $promocion->hora_fin : 'Sin asignar' }}
        </small>
    </div>
    <!--<p class="mb-1"></p>-->
    <small>
        Detalles: {{ ($promocion->detalle) ? $promocion->detalle : 'Sin detalles' }}
        <br/>
        <br/>
        @if($promocion->trashed())
            <i class="material-icons text-danger">check_circle</i>
        @else
            <i class="material-icons text-success">check_circle</i>
        @endif
    </small>
</a>