@extends('layouts.app')

@section('content')
    <img src="{{ url('../storage/app/public/img/home/portada.jpg') }}" class="img-fluid" alt="">
    <div class="col-md-8 offset-md-2 text-center text-primary" id="slogan-empresa">
        <span>El lugar donde alcanzarás tu meta</span>
    </div>
    @if(Auth::check())
        <div class="col-md-12" id="clases">
            <div class="col-md-4 offset-md-4 text-primary text-center">
                <h1>Clases</h1>
            </div>
            <div class="row" style="margin-left: 120px;">
                @foreach($clases as $clase)
                    @include('layouts.caratulaClase2', [
                        'clase' => $clase
                    ])
                @endforeach
            </div>
        </div>
    @endif
    <div class="col-md-12 bg-primary" id="promociones">
        <div class="col-md-4 offset-md-4 text-white text-center">
            <h1>Promociones</h1>
        </div>
        <div class="row" style="margin-left: 120px;">
            @foreach($promociones as $promocion)
                @include('layouts.caratulaPromocion', [
                    'promocion' => $promocion
                ])
            @endforeach
        </div>
    </div>

    @include('modales.clase.registro', ['usuarios' => $usuarios])

    <script type="text/javascript">
        $('#barra-inicio').parent().addClass('active');

        $('.btn-registrar').on('click', function (evt) {
            var id_clase = $(this).data('title');
            $('#id-clase').val(id_clase);
        });
    </script>
@endsection

@section('footer')
    <!--Footer-->
    <div class="col-md-12 text-center text-primary" id="footer">
        <h6>GymStation © 2017</h6>
    </div>
@endsection
