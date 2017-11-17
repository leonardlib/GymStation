<div class="card col-md-3 tarjeta-promo">
    <img class="card-img-top" src="{{ url($promocion->imagen->ruta) }}" alt="">
    <div class="card-body">
        <h4 class="card-title">{{ $promocion->nombre }}</h4>
        <p class="card-text">{{ $promocion->detalle }}</p>
        @if(Auth::check())
            <a style="cursor:pointer;" class="btn btn-primary obtener-codigo text-white" data-title="{{ $promocion->id }}">Obtener código</a>
        @endif
    </div>
</div>