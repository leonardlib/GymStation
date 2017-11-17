@extends('layouts.app')

@section('content')
    <img src="{{ url('../storage/app/public/img/home/portada.jpg') }}" class="img-fluid" alt="">
    <div class="col-md-8 offset-md-2 text-center text-primary" id="slogan-empresa">
        <span>El lugar donde alcanzarás tu meta</span>
    </div>
    @if(Auth::check())
        <div class="col-md-12" id="clases">
            <input type="hidden" id="id-usuario-actual" name="id-usuario-actual" value="{{ Auth::user()->id }}">
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

        $('.btn-registrarme').on('click', function (evt) {
            var id_clase = $(this).data('title');
            var id_usuario = Number($('#id-usuario-actual').val());

            $('#id-clase').val(id_clase);
            $('#id-usuario').val(id_usuario);

            if (id_usuario != '' || id_clase != '') {
                $.ajax({
                    url: $('#url').val() + '/clase/registrar',
                    data: {
                        'id_clase': id_clase,
                        'id_usuario': id_usuario
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    dataType: 'JSON',
                    error: function (xhr) {
                        console.log(xhr);
                    },
                    success: function (response) {
                        if (response.success) {
                            alert('Has sido registrado en la clase. Verifíca tu correo para más información.')
                            $('#cupo-clase-' + id_clase).html(response.cupo_actual + '/' + response.cupo_total);
                        } else {
                            alert('¡Ops!, no pudimos registrarte en esta clase, puede que el cupo este lleno o que ya estés registrado.');
                        }
                    }
                });
            }
        });

        //Obtener código de promociones
        $('.obtener-codigo').on('click', function (evt) {
            evt.stopPropagation();
            evt.preventDefault();

            var id_promocion = $(this).data('title');

            $.ajax({
                url: $('#url').val() + '/promocion/enviar',
                data: {
                    'id_promocion': id_promocion
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                dataType: 'JSON',
                error: function (xhr) {
                    console.log(xhr);
                },
                success: function (response) {
                    if (response.success) {
                        alert('Te hemos enviado un correo con la información de la promoción');
                    }
                }
            });
        });
    </script>
@endsection

@section('footer')
    <!--Footer-->
    <div class="col-md-12 text-center text-primary" id="footer">
        <h6>GymStation © 2017</h6>
    </div>
@endsection
