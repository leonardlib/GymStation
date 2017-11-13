<div class="card">
    <img class="card-img-top" src="{{ url($rutaImagen) }}" alt="">
    <div class="card-body">
        <h4 class="card-title">{{ $titulo }}</h4>
        <p class="card-text">{{ $detalle }}</p>
        @if(Auth::check())
            <a href="#" class="btn btn-primary">Obtener código</a>
        @endif
    </div>
</div>